<?php

namespace Vanguard\Http\Controllers\Web;
use DB;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Http\Requests\Question\CreateAnswerRequest;
use Vanguard\Http\Requests\Product\ProductRequest;

use Vanguard\Repositories\User\UserRepository;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\Models\Products;
use Vanguard\Models\Attributes;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductsController extends Controller
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
		$products =  DB::table('products')
        ->paginate(5);
		
		 
		return view('products.index', compact('products'));
    }
	 public function create()
    {
      
        return view('products.add');
    }
	
	
	public function store(ProductRequest $request)
    {
		  $data = $request->all();
        $product_record = Products::create($data);
        $product_id = $product_record->id;
         $answers = $request->input('answer'); 
      $addmore = $request->input('addmore'); 
      if (!empty($addmore)) {
        foreach($addmore as $row){
           
                $pro_attr = new Attributes();
                $pro_attr->product_id = $product_id;
                $pro_attr->name = $row['name']; 
                $pro_attr->description = $row['description']; 
                $pro_attr->save();
                }
           
            
        }
     
        return redirect()->route('product')
        ->withSuccess(trans('app.pro_created'));
	}
	 public function edit($id){
       // echo $id;
        $product = Products::find($id);
       $pro_attr = Attributes::where('product_id', $id)->get();
           

        return view('products.edit', compact('product','pro_attr'));
    }
    public function storeedit(ProductRequest $request){
        $producttask = Products::find($request->productid);
        $producttask->productname = $request['productname'];
        $producttask->brandname = $request['brandname'];
        $producttask->notes = $request['notes'];
        $producttask->save();
        $pro_attr = Attributes::where('product_id', $request->productid);
        $pro_attr->delete();
         $addmore = $request->input('addmore'); 
      if (!empty($addmore)) {
        foreach($addmore as $row){
           
                $pro_attr = new Attributes();
                $pro_attr->product_id = $request->productid;
                $pro_attr->name = $row['name']; 
                $pro_attr->description = $row['description']; 
                $pro_attr->save();
                }
           
            
        }
        return redirect()->route('product')
        ->withSuccess(trans('app.pro_updated'));
    }
	public function delete($id)
    {
        $task = Products::find($id);
		$task->delete();
        $pro_attr = Attributes::where('product_id', $id);
        $pro_attr->delete();
		return redirect()->route('product')
            ->withSuccess(trans('app.pro_deleted'));
    }
    public function attrdelete($id){
        $attribute = Attributes::find($id);
        $attribute->delete();
        return redirect()->route('product')
            ->withSuccess(trans('app.attr_deleted'));
    }
}
