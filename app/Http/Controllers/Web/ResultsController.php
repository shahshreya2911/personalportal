<?php

namespace Vanguard\Http\Controllers\Web;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Http\Requests\Question\CreateAnswerRequest;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\Models\UserQuestionAnwser;
use Vanguard\Models\QuestionChoices;
use Vanguard\Models\Questions;
use Vanguard\Models\Categories;
use Vanguard\Models\ParentCategory;
use Vanguard\User;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResultsController extends Controller
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
	
	public function index()
    {
		$users = User::where('role_id', 2)->get();
		
		return view('results.main_dashboard', compact('users'));
	}

	
}
