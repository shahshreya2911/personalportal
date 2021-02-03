<?php

namespace Vanguard\Http\Controllers\Web;
use DB;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Http\Requests\Product\ProductRequest;
use Vanguard\Http\Requests\Job\JobRequest;
use Vanguard\Http\Requests\Job\JobeditRequest;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\Models\Products;
use Vanguard\Models\Jobs;
use Vanguard\Models\Jobattributes;
use Vanguard\Models\Attributes;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobsController extends Controller
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
		$jobs =  DB::table('jobs')
        ->paginate(5);
		
		 
		return view('jobs.index', compact('jobs'));
    }
	 public function create()
    {
        $products = Products::get();
        return view('jobs.add', compact('products'));
    }
	
	
	public function store(JobRequest $request)
    {
		    $data = $request->all();
          /*  print_r($data);
            exit();*/
        if(!empty($request->file('upload_file'))){
        $uniqueFileName = uniqid() . $request->file('upload_file')->getClientOriginalName();
        $request->file('upload_file')->move(
            base_path() . '/public/files/', $uniqueFileName
        );
        }
  
      
        $jobs_add = new Jobs();
        $jobs_add->name = $request->name;
        $jobs_add->jobnum = $request->jobnum; 
        $jobs_add->starting_date = $request->starting_date;
        $jobs_add->end_date = $request->end_date; 
        $jobs_add->location = $request->location;
        $jobs_add->description = $request->description; 
        $jobs_add->note = $request->note;
        if(!empty($request->file('upload_file'))){
        $jobs_add->file = $uniqueFileName; 
        }
        $jobs_add->save();
        $jobattribute_id = $jobs_add->id;
        $addmore = $request->input('addmore'); 
        if (!empty($addmore)) {
            foreach($addmore as $row){
               
                    $jobattributes_add = new Jobattributes();
                    $jobattributes_add->attribute_id = $row['attr_id']; 
                    $jobattributes_add->productid = $row['product_id']; 
                    $jobattributes_add->quantity = $row['attr_quantity']; 
                    $jobattributes_add->attr_desc = $row['attr_desc']; 
                    $jobattributes_add->attr_remarks = $row['attr_remarks']; 
                    $jobattributes_add->job_id = $jobattribute_id;
                    $jobattributes_add->save();
                    }
               
                
            }
       
     
        return redirect()->route('job')
        ->withSuccess(trans('app.job_created'));
	}
	 public function edit($id){
       // echo $id;
       $jobs = Jobs::find($id);
           $products = Products::get();
      
     $jobwithproduct = Jobattributes::where('job_id', $id) ->groupBy('productid')->get(); 
 $jobattributes = DB::table('jobattributes')
        ->leftjoin('attributes', 'attributes.id', '=', 'jobattributes.attribute_id')
       ->select(
        'attributes.name as attrname',
        'jobattributes.id as jobattrid',
       
        'jobattributes.quantity as attribute_quantity',
        'jobattributes.attr_desc as attr_desc',
        'jobattributes.attr_remarks as attr_remarks',
        'jobattributes.productid as attr_productid'
        


        )->where('jobattributes.job_id', $id)->get();
       return view('jobs.edit', compact('jobs','jobattributes','products','jobwithproduct'));
    }
    public function storeedit(JobeditRequest $request){
      if(!empty($request->file('upload_file'))){
        $uniqueFileName = uniqid() . $request->file('upload_file')->getClientOriginalName();
        $request->file('upload_file')->move(
            base_path() . '/public/files/', $uniqueFileName
        );
      }
        $job_edit = Jobs::find($request->jobid);
        $job_edit->name = $request->name;
        $job_edit->jobnum = $request->jobnum; 
        $job_edit->starting_date = $request->starting_date;
        $job_edit->end_date = $request->end_date; 
        $job_edit->location = $request->location;
        $job_edit->description = $request->description; 
        $job_edit->note = $request->note;
        if(!empty($request->file('upload_file'))){
        $job_edit->file = $uniqueFileName; 
        }
        $job_edit->save();
         $job_attr = Jobattributes::where('job_id', $request->jobid);
        $job_attr->delete();
        $addmore = $request->input('addmore'); 
      if (!empty($addmore)) {
            foreach($addmore as $row){
               
                    $jobattributes_add = new Jobattributes();
                    $jobattributes_add->attribute_id = $row['attr_id']; 
                    $jobattributes_add->productid = $row['product_id']; 
                    $jobattributes_add->quantity = $row['attr_quantity']; 
                    $jobattributes_add->attr_desc = $row['attr_desc']; 
                    $jobattributes_add->attr_remarks = $row['attr_remarks']; 
                    $jobattributes_add->job_id = $request->jobid;
                    $jobattributes_add->save();
                    }
               
                
            }
        return redirect()->route('job')
        ->withSuccess(trans('app.job_updated'));
    }
	 public function delete($id)
    {
        $job_del = Jobs::find($id);
		    $job_del->delete();
          $job_attr = Jobattributes::where('job_id', $id);
        $job_attr->delete();
        return redirect()->route('job')
            ->withSuccess(trans('app.job_deleted'));
    }
public function generateChildCategory(request $request)
    {
        if (!empty($request->parent_category_id)) {

            return  Attributes::where('product_id', $request->parent_category_id)->pluck('name', 'id');   
        } 
        
        return [];
        
    }  
public function generateEditProducts(request $request)
    {
        if (!empty($request->parent_category_id)) {

            return  Attributes::where('product_id', $request->parent_category_id)->pluck('name', 'id');   
        } 
        
        return [];
        
    }    
}
