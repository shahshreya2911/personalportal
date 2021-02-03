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
use Vanguard\Models\Stockinattributes;
use Vanguard\Models\Attributes;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
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

		$stockinattributes =  Stockinattributes::all();
		
		 
		return view('reports.index', compact('stockinattributes'));
    }
	public function showDetails(request $request){
       /* print_r($request->from);
        exit();*/
        $from = date("Y-m-d", strtotime($request->from));  
         $to = date("Y-m-d", strtotime($request->to));  
        $stockouts =  Stockins::whereBetween('stockin.stockin_date',array($from,$to))->get();
        foreach ($stockouts as $key => $value) {
           // print_r($value['id']);
            $stockinattributes = Stockinattributes::where('stockin_id', $value['id'])->get();
            //print_r($stockinattributes);
            foreach ($stockinattributes as $key => $stockin) {
                //print_r($stockin['productid']);
                  //print_r($stockin['quantity']);
                $stockoutAtrributes = Stockoutattributes::where('productid',$stockin['productid'])->get();
                if(!empty($stockoutAtrribute)){
                   foreach ($stockoutAtrributes as $key => $stockout) {
                        if(($stockout['quantity'] < $stockin['quantity'])|| ($stockout['quantity'] = $stockin['quantity'])){
                            $remainquantity = $stockout['quantity'] - $stockin['quantity'];
                        }else{
                            $remainquantity = $stockin['quantity'];
                        }
                        # code...
                    } 
                }else{
                    $remainquantity = $stockin['quantity'];
                }
                # code...
            }
            # code...
        }
       // print_r($stockouts);

       //exit();
       return view('reports.index', compact('stockinattributes','remainquantity'));

    }
    
}
