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
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ZonesController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var ActivityRepository
     */
    private $activities;

    /**
     * DashboardController constructor.
     * @param UserRepository $users
     * @param ActivityRepository $activities
     */
    public function __construct(UserRepository $users, ActivityRepository $activities)
    {
        $this->middleware('auth');
        $this->users = $users;
        $this->activities = $activities;
    }
	 /**
     * Displays dashboard based on user's role.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
		$zones =  $users = DB::table('zones')
        ->paginate(5);
		
		 
		return view('zones.index', compact('zones'));
    }
	 public function create()
    {
      
        return view('zones.add');
    }
	
	
	public function store(ZoneRequest $request)
    {
		  $data = $request->all();
        Zones::create($data);
        return redirect()->route('zone')
        ->withSuccess(trans('app.zone_created'));
	}
	 public function edit($id){
       // echo $id;
        $zone = Zones::find($id);
      

        return view('zones.edit', compact('zone'));
    }
    public function storeedit(ZoneRequest $request){
        $zonetask = Zones::find($request->zoneid);
        $zonetask->warehouse = $request['warehouse'];
        $zonetask->room = $request['room'];
        $zonetask->shelf = $request['shelf'];
        $zonetask->save();
        return redirect()->route('zone')
        ->withSuccess(trans('app.zone_updated'));
    }
	public function delete($id)
    {
        $task = Zones::find($id);
		$task->delete();
		return redirect()->route('zone')
            ->withSuccess(trans('app.zone_deleted'));
    }
}
