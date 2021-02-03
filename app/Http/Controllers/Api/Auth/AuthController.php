<?php



namespace Vanguard\Http\Controllers\Api\Auth;



use JWTAuth;

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

class AuthController extends ApiController

{

    public function __construct()

    {

        $this->middleware('guest')->only('login');

        $this->middleware('auth')->only('logout');

    }



    /**

     * Attempt to log the user in and generate unique

     * JWT token on successful authentication.

     * @param LoginRequest $request

     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response

     */

    public function login(LoginRequest $request)

    {
        $blankData = (object)array();
        $credentials = $request->getCredentials();

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                //return $this->errorUnauthorized('Invalid credentials.');
                return response()->json(['status'   => 'fail','message' => 'Invalid credentials.','data' => $blankData], 200);
            }
        } catch (JWTException $e) {
            //return $this->errorInternalError('Could not create token.');
            return response()->json(['status'   => 'fail','message' => 'Could not create token.','data' => $blankData], 200);
        }

        $user = auth()->user();

        if ($user->isBanned()) {
            $this->invalidateToken($token);
            //return $this->errorUnauthorized('Your account is banned by administrators.');
            return response()->json(['status'   => 'fail','message' => 'Your account is banned by administrators.','data' => $blankData], 200);
        }

        if ($user->isUnconfirmed()) {
            $this->invalidateToken($token);
            //return $this->errorUnauthorized('Please confirm your email address first.');
            return response()->json(['status'   => 'fail','message' => 'Please confirm your email address first.','data' => $blankData], 200);
        }

        event(new LoggedIn);
        //return $this->respondWithArray(compact('token'));
        
        $userData = $user; 
        $userData->token = $token; 
        return response()->json([
            'status'   => 'success',
            'message' => 'User LoggedIn Successfully', 
            'data' => $userData
        ], 200);
    }


    private function invalidateToken($token)

    {

        JWTAuth::setToken($token);

        JWTAuth::invalidate();

    }



    /**

     * Logout user and invalidate token.

     * @return \Illuminate\Http\JsonResponse

     */

    public function logout()

    {

        event(new LoggedOut);



        auth()->logout();



        return $this->respondWithSuccess();

    }

}

