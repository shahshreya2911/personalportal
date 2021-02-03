<?php
namespace Vanguard\Http\Controllers\Web;
use DB;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Http\Requests\Question\CreateAnswerRequest;
use Vanguard\Http\Requests\Zone\ZoneRequest;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\Models\Zones;
use Vanguard\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
class LeadController extends Controller{
    private $users;
    private $activities;
    public function __construct(UserRepository $users, ActivityRepository $activities)
    {
        $this->middleware('auth');
        $this->users = $users;
        $this->activities = $activities;
    }
    public function index()
    {
        $leads = DB::table('lead_generation')->paginate(5);
        return view('leads.index', compact('leads'));
    }
    public function pdf(){
        $user = User::find(Auth::id());
        if($user->freeebook_access != 1){
             return view('leads.notacess');
        }else{
            return view('leads.pdf');
        }
        
    }
      public function hybrid(){
        $user = User::find(Auth::id());
        if($user->freeebook_access != 1){
            return view('leads.notacess');
        }else{
            return view('leads.hybrid');
        }
    }
      public function chart(){
        $user = User::find(Auth::id());
        if($user->freeebook_access != 1){
            return view('leads.notacess');
        }else{
            return view('leads.chart');
        }
    }
      public function resource(){
        $user = User::find(Auth::id());
        if($user->freeebook_access != 1){
            return view('leads.notacess');
        }else{
            return view('leads.resource');
        }
    }
      public function mind(){
        $user = User::find(Auth::id());
        if($user->freeebook_access != 1){
            return view('leads.notacess');
        }else{
            return view('leads.mind');
        }
    }
}

