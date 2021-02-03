<?php

namespace Vanguard\Http\Controllers\Web;
use DB;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Http\Requests\Question\CreateAnswerRequest;
use Vanguard\Http\Requests\Product\ProductRequest;
use Vanguard\Http\Requests\Job\JobRequest;
use Vanguard\Http\Requests\Stockin\StockinRequest;
use Vanguard\Http\Requests\Stockin\StockineditRequest;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\Models\Products;
use Vanguard\Models\StockinReasons;
use Vanguard\Models\Jobs;
use Vanguard\Models\Stockins;
use Vanguard\Models\Stockinattributes;
use Vanguard\Models\Attributes;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StockinsController extends Controller
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
		$stockins =  DB::table('stockin')
        ->leftjoin('stockin_reasons', 'stockin_reasons.id', '=', 'stockin.reason_id')
        ->leftjoin('jobs', 'jobs.id', '=', 'stockin.job_id')
            ->select(
            'stockin_reasons.name as reason',
            'jobs.name as job',
            'stockin.id as id',
            'stockin.stockin_date as stockin_date',
            'stockin.job_id as job_id',
            'stockin.reason_id as reason_id',
            'stockin.notes as notes'
            )
        ->paginate(5);
		
		 
		return view('stockins.index', compact('stockins'));
    }
	 public function create()
    {
        $jobs = Jobs::get();
        $products = Products::get();
        $stockinreasons = StockinReasons::get();
        return view('stockins.add', compact('products','jobs','stockinreasons'));
    }
	
	
	public function store(StockinRequest $request)
    {
		    $data = $request->all();
       
  
    //  print_r($request->all());
      //exit();
        $stockin_add = new Stockins();
        $stockin_add->notes = $request->note;
        $stockin_add->stockin_date = $request->stockin_date;
        $stockin_add->job_id = $request->job_id; 
        $stockin_add->reason_id = $request->reason_id;
       
      
        $jobslast_id = $stockin_add->save();
        $stockin_id = $stockin_add->id;
        $addmore = $request->input('addmore'); 
        if (!empty($addmore)) {
            foreach($addmore as $row){
                $stockattributes_add = new Stockinattributes();
                $stockattributes_add->attribute_id = $row['attr_id']; 
                $stockattributes_add->productid = $row['product_id']; 
                $stockattributes_add->quantity = $row['attr_quantity']; 
                $stockattributes_add->attr_desc = $row['attr_desc']; 
                $stockattributes_add->attr_remarks = $row['attr_remarks']; 
                $stockattributes_add->stockin_id = $stockin_id;
                $stockattributes_add->save();
                }
            }
      
     
        return redirect()->route('stockin')
        ->withSuccess(trans('app.stockin_created'));
	}
	 public function edit($id){
        // echo $id;
        $stockins = Stockins::find($id);

        $jobs = Jobs::get();
        $products = Products::get();
        $stockinreasons = StockinReasons::get();
        $maxstockinid =  Stockinattributes::where('stockin_id', $id) ->groupBy('productid')->orderBy('quantity', 'desc')->first();
        $jobwithproduct = Stockinattributes::where('stockin_id', $id) ->groupBy('productid')->get(); 
        $stockinattributes = DB::table('stockinattributes')
            ->leftjoin('attributes', 'attributes.id', '=', 'stockinattributes.attribute_id')
            ->select(
            'attributes.name as attrname',
            'stockinattributes.id as stockinattrid',
            'stockinattributes.quantity as attribute_quantity',
            'stockinattributes.attr_desc as attr_desc',
            'stockinattributes.attr_remarks as attr_remarks',
            'stockinattributes.productid as attr_productid'
            )->where('stockinattributes.stockin_id', $id)->get();
        return view('stockins.edit', compact('jobs','stockinattributes','maxstockinid','jobwithproduct','products','stockinreasons','stockins'));
    }
    public function storeedit(StockineditRequest $request){
     
        $stockin_edit = Stockins::find($request->stockinid);
        $stockin_edit->notes = $request->note;
        $stockin_edit->stockin_date = $request->stockin_date;
        $stockin_edit->job_id = $request->job_id; 
        $stockin_edit->reason_id = $request->reason_id;
        $jobslast_id = $stockin_edit->save();
        $job_attr = Stockinattributes::where('stockin_id', $request->stockinid);
        $job_attr->delete();
        $addmore = $request->input('addmore'); 
        if (!empty($addmore)) {
            foreach($addmore as $row){
                    $stockin_attr = new Stockinattributes();             
                    $stockin_attr->attribute_id = $row['attr_id']; 
                    $stockin_attr->productid = $row['product_id']; 
                    $stockin_attr->quantity = $row['attr_quantity']; 
                    $stockin_attr->attr_desc = $row['attr_desc']; 
                    $stockin_attr->attr_remarks = $row['attr_remarks']; 
                    $stockin_attr->stockin_id = $request->stockinid;
                    $stockin_attr->save();
                }
           
            
        }
        return redirect()->route('stockin')
        ->withSuccess(trans('app.stockin_updated'));
    }
	 public function delete($id)
    {
        $stockin_del = Stockins::find($id);
		    $stockin_del->delete();
          $stockin_attr = Stockinattributes::where('stockin_id', $id);
        $stockin_attr->delete();
        return redirect()->route('stockin')
            ->withSuccess(trans('app.stockin_deleted'));
    }
    
}
