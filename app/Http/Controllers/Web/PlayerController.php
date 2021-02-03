<?php



namespace Vanguard\Http\Controllers\Web;

use DB;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Players;
use Vanguard\Models\Categories;
use Vanguard\Models\WeightCategory;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Validator;


class PlayerController extends Controller
{

    public function index(Request $request)
    {	
        if($request->ajax())
        {
            $data = Players::leftjoin('categories', 'categories.id', '=', 'players.sports')
                ->select('players.id as id', 'players.name as name', 'categories.name as sports')
                ->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<a href="/player/edit/'.$data->id.'" id="'.$data->id.'" class="edit btn btn-primary btn-sm" title="Edit Player" data-toggle="tooltip" data-placement="top" >Edit</a>';
                        $button .= '<a href="/player/delete/'.$data->id.'" id="'.$data->id.'" class="delete btn btn-danger btn-sm" title="Delete Player" data-toggle="tooltip" data-placement="top" data-method="DELETE" data-confirm-title="Please Confirm" data-confirm-text="Are you sure You Want to Delete Player?? " data-confirm-delete="Yes ! Delete" >Delete </a>';
                        return $button;
                    })
                
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('player.index');



/*        $players =  DB::table('players')
        ->get();

        return view('player.index', compact('players'));*/
    }

     public function create()
    {

        $sports = Categories::get();
        $WeightCategory = WeightCategory::get();

        return view('player.add', compact('sports','WeightCategory'));
    }
    

    public function store(Request $request)
    {	
/*    	print_r($request->all());
    	exit; 
*/
    	$data = new Players();
        $data->name = $request->name;
        $data->age = $request->age;
        $data->weight = $request->weight;
        $data->gender = $request->gender;
        $data->sports = $request->sports;
        $data->weight_cat = $request->weight_cat;
        $data->save(); 

        return redirect()->route('player')
        ->withSuccess("Player Has Been Created Successfully.");

    }

     public function edit($id){

        $player = Players::find($id);
        $sports = Categories::get();
        $WeightCategory = WeightCategory::get();

        return view('player.edit', compact('player','sports','WeightCategory'));

    }

    public function storeedit(Request $request){

/*    	print_r($request->all());
    	exit;     */

        $request->validate([
            'name'=>'required',
        ]);

        $data = Players::find($request->player_id);
        $data->name = $request->name;
        $data->age = $request->age;
        $data->weight = $request->weight;
        $data->gender = $request->gender;
        $data->sports = $request->sports;
        $data->weight_cat = $request->weight_cat;
        $data = $data->save();
   
        return redirect()->route('player')
        ->withSuccess("Player Has Been Updated Successfully.");

    }

    

    public function delete($id)
    {    	
        $data = Players::find($id)->delete();

        return redirect()->route('player')
            ->withSuccess("Player Has Been Deleted Successfully.");

    }

    public function getWeightCat(Request $request)
    {       
        $data = WeightCategory::where('cat_id', '=', $request->cat_id)->pluck("weight","id");
        
        return $data; 
    }    

}

