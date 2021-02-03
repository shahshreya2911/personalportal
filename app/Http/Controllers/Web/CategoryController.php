<?php

namespace Vanguard\Http\Controllers\Web;
use DB;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Categories;
use Vanguard\Models\WeightCategory;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {	
    	echo "cat list ";

        $categories =  DB::table('categories')
        ->paginate(5);
         
        return view('category.index', compact('categories'));
    }
     public function create()
    {
        $category = Categories::get();
       
        return view('category.add', compact('category'));
    }
    
    
    public function store(Request $request)
    {	
/*    	print_r($request->all());
    	exit; 
*/
    	$data = new Categories();
        $data->name = $request->name;
        $data->save(); 

        $catID = $data->id; 
        foreach ($request->addmore as $weight) {

            $addData = new WeightCategory();
            $addData->cat_id = $catID;
            $addData->weight = $weight;
            $addData->save(); 
		}        

        return redirect()->route('category')
        ->withSuccess("Category Has Been Created Successfully.");
    }
     public function edit($id){
        
/*        echo 'edit '.$id;
        exit; */
        $category = Categories::find($id);
        $WeightCategory = WeightCategory::get();

        return view('category.edit', compact('category','WeightCategory'));
    }
    public function storeedit(Request $request){
/*    	print_r($request->all());
    	exit; */
    	     
        $request->validate([
            'name'=>'required',
        ]);
     
        $data = Categories::find($request->cat_id);
        $data->name = $request->name;
        $data = $data->save();
       
        // delete previous
        $catID = $request->cat_id;
        $deleteSubData = WeightCategory::where('cat_id', '=', $catID)->delete(); 
        foreach ($request->addmore as $weight) {

            $addData = new WeightCategory();
            $addData->cat_id = $catID;
            $addData->weight = $weight;
            $addData->save(); 
        }        
        return redirect()->route('category')
        ->withSuccess("Category Has Been Updated Successfully.");
    }
    
    public function delete($id)
    {    	
        $data = Categories::find($id)->delete();
         
        $subData = WeightCategory::where('cat_id', '=', $id)->delete();

        return redirect()->route('category')
            ->withSuccess("Category Has Been Deleted Successfully.");
    }
    
}
