<?php

namespace Vanguard\Http\Controllers\Web;
use DB;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Http\Requests\Question\CreateAnswerRequest;
use Vanguard\Http\Requests\Product\ProductRequest;
use Vanguard\Http\Requests\Job\JobRequest;
use Vanguard\Http\Requests\Stockin\StockinRequest;
use Vanguard\Http\Requests\Stockout\StockoutRequest;
use Vanguard\Http\Requests\Stockout\StockouteditRequest;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\Models\Products;
use Vanguard\Models\StockinReasons;
use Vanguard\Models\StockoutReasons;
use Vanguard\Models\Jobs;
use Vanguard\Models\Stockins;
use Vanguard\Models\Stockouts;
use Vanguard\Models\Stockoutattributes;
use Vanguard\Models\Attributes;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StockoutsController extends Controller
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
		$stockouts =  DB::table('stockout')
        ->leftjoin('stockout_reasons', 'stockout_reasons.id', '=', 'stockout.reason_id')
        ->leftjoin('jobs', 'jobs.id', '=', 'stockout.job_id')
            ->select(
            'stockout_reasons.name as reason',
            'jobs.name as job',
            'stockout.id as id',
            'stockout.stockout_date as stockout_date',
            'stockout.job_id as job_id',
            'stockout.reason_id as reason_id',
            'stockout.notes as notes'
            )
        ->paginate(5);
		
		 
		return view('stockouts.index', compact('stockouts'));
    }
	 public function create()
    {
        $jobs = Jobs::get();
        $products = Products::get();
        $stockoutreasons = StockoutReasons::get();
        return view('stockouts.add', compact('products','jobs','stockoutreasons'));
    }
	
	
	public function store(StockoutRequest $request)
    {
		    $data = $request->all();
       
  
    //  print_r($request->all());
      //exit();
        $stockout_add = new Stockouts();
        $stockout_add->notes = $request->note;
        $stockout_add->stockout_date = $request->stockout_date;
        $stockout_add->job_id = $request->job_id; 
        $stockout_add->reason_id = $request->reason_id;
       
      
        $jobslast_id = $stockout_add->save();
        $stockout_id = $stockout_add->id;
        $addmore = $request->input('addmore'); 
        if (!empty($addmore)) {
            foreach($addmore as $row){
                $stockattributes_add = new Stockoutattributes();
                $stockattributes_add->attribute_id = $row['attr_id']; 
                $stockattributes_add->productid = $row['product_id']; 
                $stockattributes_add->quantity = $row['attr_quantity']; 
                $stockattributes_add->attr_desc = $row['attr_desc']; 
                $stockattributes_add->attr_remarks = $row['attr_remarks']; 
                $stockattributes_add->stockout_id = $stockout_id;
                $stockattributes_add->save();
                }
            }
      
     
        return redirect()->route('stockout')
        ->withSuccess(trans('app.stockout_created'));
	}
	 public function edit($id){
        // echo $id;
        $stockouts = Stockouts::find($id);

        $jobs = Jobs::get();
        $products = Products::get();
        $stockoutreasons = StockoutReasons::get();
        $maxstockinid =  Stockoutattributes::where('stockout_id', $id) ->groupBy('productid')->orderBy('quantity', 'desc')->first();
        $jobwithproduct = Stockoutattributes::where('stockout_id', $id) ->groupBy('productid')->get(); 
        $stockoutattributes = DB::table('stockoutattributes')
            ->leftjoin('attributes', 'attributes.id', '=', 'stockoutattributes.attribute_id')
            ->select(
            'attributes.name as attrname',
            'attributes.id as attrid',
            'stockoutattributes.id as stockoutattrid',
            'stockoutattributes.quantity as attribute_quantity',
            'stockoutattributes.attr_desc as attr_desc',
            'stockoutattributes.attr_remarks as attr_remarks',
            'stockoutattributes.productid as attr_productid'
            )->where('stockoutattributes.stockout_id', $id)->get();
        return view('stockouts.edit', compact('jobs','stockoutattributes','maxstockinid','jobwithproduct','products','stockoutreasons','stockouts'));
    }
    public function storeedit(StockouteditRequest $request){
     
        $stockout_edit = Stockouts::find($request->stockoutid);
      $stockout_edit->notes = $request->note;
        $stockout_edit->stockout_date = $request->stockout_date;
        $stockout_edit->job_id = $request->job_id; 
        $stockout_edit->reason_id = $request->reason_id;
       
      
        $jobslast_id = $stockout_edit->save();
          $job_attr = Stockoutattributes::where('stockout_id', $request->stockoutid);
        $job_attr->delete();
        $addmore = $request->input('addmore'); 
      if (!empty($addmore)) {
        foreach($addmore as $row){
            /*  print_r($row);
              exit();*/
                $stockin_attr = new Stockoutattributes();             
                $stockin_attr->attribute_id = $row['attr_id']; 
                    $stockin_attr->productid = $row['product_id']; 
                    $stockin_attr->quantity = $row['attr_quantity']; 
                    $stockin_attr->attr_desc = $row['attr_desc']; 
                    $stockin_attr->attr_remarks = $row['attr_remarks']; 
                    $stockin_attr->stockout_id = $request->stockoutid;
                    $stockin_attr->save();
                }
           
            
        }
        return redirect()->route('stockout')
        ->withSuccess(trans('app.stockout_updated'));
    }
	 public function delete($id)
    {
        $stockout_del = Stockouts::find($id);
		    $stockout_del->delete();
          $stockout_attr = Stockoutattributes::where('stockout_id', $id);
        $stockout_attr->delete();
        return redirect()->route('stockout')
            ->withSuccess(trans('app.stockout_deleted'));
    }
    
}
