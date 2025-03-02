<?php



namespace Vanguard\Http\Controllers\Web;



use Vanguard\Http\Controllers\Controller;

use Vanguard\Repositories\Activity\ActivityRepository;

use Vanguard\Repositories\User\UserRepository;

use Vanguard\Support\Enum\UserStatus;

use Auth;

use Carbon\Carbon;



class DashboardController extends Controller

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

        //dd(Auth::user());

        if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('SuperAdmin') ) {

            return $this->adminDashboard();

        }



        return $this->exam();

    }

	

	private function exam()

    {
         $activities = $this->activities->userActivityForPeriod(

            Auth::user()->id,

            Carbon::now()->subWeeks(2),

            Carbon::now()

        )->toArray();
        return view('dashboard.exam', compact('activities'));

    }



    /**

     * Displays dashboard for admin users.

     *

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    private function adminDashboard()

    {

        $usersPerMonth = $this->users->countOfNewUsersPerMonth(

            Carbon::now()->subYear()->startOfMonth(),

            Carbon::now()->endOfMonth()

        );



        $stats = [

            'total' => $this->users->count(),

            'new' => $this->users->newUsersCount(),

            'banned' => $this->users->countByStatus(UserStatus::BANNED),

            'unconfirmed' => $this->users->countByStatus(UserStatus::UNCONFIRMED)

        ];



        $latestRegistrations = $this->users->latest(6);



        return view('dashboard.admin', compact('stats', 'latestRegistrations', 'usersPerMonth'));

    }



    /**

     * Displays default dashboard for non-admin users.

     *

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    private function defaultDashboard()

    {

        $activities = $this->activities->userActivityForPeriod(

            Auth::user()->id,

            Carbon::now()->subWeeks(2),

            Carbon::now()

        )->toArray();



        return view('dashboard.default', compact('activities'));

    }

}

