<?php

namespace Vanguard\Http\Controllers\Web;
use DB;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Activity\ActivityRepository;

use Vanguard\Http\Requests\Subcategory\SubcategoryRequest;
use Vanguard\Repositories\User\UserRepository;

use Vanguard\Models\Subcategory;
use Vanguard\Models\Categories;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
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
        $subcategory =  DB::table('subcategories')
        ->leftjoin('categories', 'categories.id', '=', 'subcategories.category_id')
        ->select(
            'categories.name as category',
            
            'subcategories.id as id',
            'subcategories.name as name',
            'subcategories.image as image',
            'subcategories.description as description'
           
            )
        ->paginate(5);
        
         
        return view('subcategory.index', compact('subcategory'));
    }
     public function create()
    {
        $category = Categories::get();
       
        return view('subcategory.add', compact('category'));
    }
    
    
    public function store(SubcategoryRequest $request)
    {
        $data = $request->all();
        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);
        $subcat_add = new Subcategory();
        $subcat_add->name = $request->name;
        $subcat_add->category_id = $request->category_id;
        $subcat_add->image = $input['imagename']; 
        $subcat_add->description = $request->description;
        $subcat_details = $subcat_add->save();
        return redirect()->route('subcat')
        ->withSuccess("Sub Category Has Been Created Successfully.");
    }
     public function edit($id){
        
        $subcategory = Subcategory::find($id);
        $category = Categories::get();
        return view('subcategory.edit', compact('subcategory','category'));
    }
    public function storeedit(Request $request){
     
        $request->validate([
            'name'=>'required',
            'category_id'=>'required',
            'description'=>'required'
        ]);
     
        $subcat_edit = Subcategory::find($request->subcat_id);
        if(!empty($request->file('image'))){
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);
        }else{
            $input['imagename'] = $subcat_edit->image;
        }
        $subcat_edit->name = $request->name;
        $subcat_edit->image = $input['imagename'];
        $subcat_edit->category_id = $request->category_id; 
        $subcat_edit->description = $request->description;
        $subcat_details = $subcat_edit->save();
       
        return redirect()->route('subcat')
        ->withSuccess("Sub Category Has Been Updated Successfully.");
    }
     public function delete($id)
    {
        $subcat_del = Subcategory::find($id);
            $subcat_del->delete();
         
        return redirect()->route('subcat')
            ->withSuccess("Sub Category Has Been Deleted Successfully.");
    }
    
}
