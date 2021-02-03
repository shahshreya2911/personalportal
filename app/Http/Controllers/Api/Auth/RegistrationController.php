<?php



namespace Vanguard\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Vanguard\Events\User\Registered;
use Vanguard\Http\Controllers\Api\ApiController;
use Vanguard\Http\Requests\Auth\RegisterRequest;
use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Support\Enum\UserStatus;
use Illuminate\Support\Facades\Validator;
use Vanguard\User;
use Illuminate\Support\Str;


class RegistrationController extends ApiController

{
    /**
     * @var UserRepository
     */

    private $users;

    /**
     * @var RoleRepository
     */

    private $roles;

    /**
     * Create a new authentication controller instance.
     * @param UserRepository $users
     * @param RoleRepository $roles
     */

    public function __construct(UserRepository $users, RoleRepository $roles)
    {
        $this->middleware('registration');

        $this->users = $users;
        $this->roles = $roles;
    }



    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(Request $request)
    {

        
        
        //print_r($request->all());
        // Determine user status. User's status will be set to UNCONFIRMED
        // if he has to confirm his email or to ACTIVE if email confirmation is not required
        
        $blankData = (object)array();

        $validator = Validator::make($request->all(), [ 
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'phone' => 'required|unique:users,phone',

        ]);

        if ($validator->fails()) { 
            $err = '';

            foreach ($validator->errors()->toArray() as $error)  {
                foreach($error as $sub_error){
                    //array_push($err, $sub_error);
                    $err .= $sub_error;
                }
            }    

            return response()->json(['status'   => 'fail','message' => $err,'data' => $blankData], 200);            
            // print_r($err);        
            // return response()->json(['error'=>$validator->errors()], 401);            
        }


        $status = settings('reg_email_confirmation')
            ? UserStatus::UNCONFIRMED
            : UserStatus::ACTIVE;

        $role = $this->roles->findByName('User');

/*        $user = $this->users->create(array_merge(
            $request->only('email', 'username', 'password','phone','gender', 'country_id'),
            ['status' => $status, 'role_id' => $role->id,  ]
        ));
        event(new Registered($user));*/
        $token = Str::random(60);

        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->country_code = $request->country_code;
        $user->status = $status;
        $user->role_id = $role->id;
        $user->confirmation_token = $token; 
        $user->save(); 


            return response()->json([
                'status'   => 'success',
                'message' => 'user created successfully..', 
                'data' => $user
            ], 200);

/*            return response()->json([
                "message" => "User record created",
                "data" => $user
            ], 200);*/
/*        return $this->setStatusCode(201)
            ->respondWithArray([
                'requires_email_confirmation' => !! settings('reg_email_confirmation')
            ]);*/

    }



    /**
     * Verify email via email confirmation token.
     * @param $token
     * @return \Illuminate\Http\Response
     */

    public function verifyEmail($token)
    {
        if (! settings('reg_email_confirmation')) {
            return $this->errorNotFound();
        }


        if ($user = $this->users->findByConfirmationToken($token)) {
            $this->users->update($user->id, [
                'status' => UserStatus::ACTIVE,
                'confirmation_token' => null
            ]);

            return $this->respondWithSuccess();
        }

        return $this->setStatusCode(400)
            ->respondWithError("Invalid confirmation token.");
    }

}

