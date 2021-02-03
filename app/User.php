<?php



namespace Vanguard;



use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;

use Vanguard\Presenters\UserPresenter;

use Vanguard\Services\Auth\Api\TokenFactory;

use Vanguard\Services\Auth\TwoFactor\Authenticatable as TwoFactorAuthenticatable;

use Vanguard\Services\Auth\TwoFactor\Contracts\Authenticatable as TwoFactorAuthenticatableContract;

use Vanguard\Services\Logging\UserActivity\Activity;

use Vanguard\Support\Authorization\AuthorizationUserTrait;

use Vanguard\Support\CanImpersonateUsers;

use Vanguard\Support\Enum\UserStatus;

use Illuminate\Auth\Passwords\CanResetPassword;

use Laracasts\Presenter\PresentableTrait;

use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable implements TwoFactorAuthenticatableContract, JWTSubject

{

    use TwoFactorAuthenticatable,

        CanResetPassword,

        PresentableTrait,

        AuthorizationUserTrait,

        Notifiable,

        CanImpersonateUsers;



    protected $presenter = UserPresenter::class;



    /**

     * The database table used by the model.

     *

     * @var string

     */

    protected $table = 'users';



    protected $dates = ['last_login'];



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'username',  'password', 'first_name', 'last_name', 'gender', 'phone', 'avatar',

        'address', 'last_login', 'confirmation_token', 'status', 'country_id',

        'remember_token', 'role_id','email','freeebook'

    ];



    /**

     * The attributes excluded from the model's JSON form.

     *

     * @var array

     */

    protected $hidden = ['password', 'remember_token'];



    /**

     * Always encrypt password when it is updated.

     *

     * @param $value

     * @return string

     */

    public function setPasswordAttribute($value)

    {

        $this->attributes['password'] = bcrypt($value);

    }



    public function setBirthdayAttribute($value)

    {

       

    }



    public function gravatar()

    {

        $hash = hash('md5', strtolower(trim($this->attributes['username'])));



        return sprintf("https://www.gravatar.com/avatar/%s?size=150", $hash);

    }



    public function isUnconfirmed()

    {

        return $this->status == UserStatus::UNCONFIRMED;

    }



    public function isActive()

    {

        return $this->status == UserStatus::ACTIVE;

    }



    public function isBanned()

    {

        return $this->status == UserStatus::BANNED;

    }



   

    public function activities()

    {

        return $this->hasMany(Activity::class, 'user_id');

    }



    /**

     * Get the identifier that will be stored in the subject claim of the JWT.

     *

     * @return mixed

     */

    public function getJWTIdentifier()

    {

        return $this->id;

    }



    /**

     * Return a key value array, containing any custom claims to be added to the JWT.

     *

     * @return array

     */

    public function getJWTCustomClaims()

    {

        $token = app(TokenFactory::class)->forUser($this);



        return [

            'jti' => $token->id

        ];

    }

}

