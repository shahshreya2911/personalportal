<?php



namespace Vanguard\Http\Controllers\Api\Auth;



use JWTAuth;
use Illuminate\Http\Request;
use Vanguard\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Vanguard\Events\User\LoggedIn;
use Vanguard\Events\User\LoggedOut;
use Vanguard\Http\Controllers\Api\ApiController;
use Vanguard\Http\Requests\Auth\LoginRequest;
use Vanguard\Services\Auth\Api\JWT;


/**

 * Class LoginController

 * @package Vanguard\Http\Controllers\Api\Auth

 */

class MobileAuthController extends ApiController

{


    public function MobileNoVerify(Request $request)
    {       
        
        $blankData = (object)array();

        $user = User::where('phone', $request->phone)->first();
        // print_r($user);
        // return response()->json(['status'   => 'fail','message' => 'Invalid credentials.','data' => $blankData], 200);
        if($user){
            return response()->json([
                'status'   => 'success',
                'message' => 'Mobile Number Verified Successfully', 
                'data' => $user
            ], 200);

        }else{
            return response()->json([
                'status'   => 'fail',
                'message' => 'Mobile Number Not found', 
                'data' => $blankData
            ], 200);

        }
    }

}

