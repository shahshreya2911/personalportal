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
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamController extends Controller
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
	
	/*public function dashboard()
    {
		$categories = Categories::orderBy('id', 'ASC')->get();
		
		return view('exam.dashboard', compact('categories'));
	}*/
	
	public function dashboard()
    {
		$categories = ParentCategory::orderBy('id', 'ASC')->get();
		
		return view('exam.main_dashboard', compact('questions', 'categories'));
	}

	public function certification()
    {
		return view('exam.certification');
	}

    /**
     * Displays dashboard based on user's role.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
		$userQuestionAnwser = UserQuestionAnwser::where('user_id', Auth::user()->id)->latest('created_at')->first();
		
		if (empty($userQuestionAnwser)) {
			$questions = Questions::limit(1)->first();	
			
			$categoriesObj = Categories::find(1);
			
			//dump($categoriesObj->parentCategory);exit;
			
		} else {
			$userQuestionAnwser = UserQuestionAnwser::where('user_id', Auth::user()->id)->latest('created_at')->groupBy('category_id')->first();
			
			$questionIds = UserQuestionAnwser::select('question_id')
			->where('user_id', Auth::user()->id)
			->where('category_id', $userQuestionAnwser->category_id)
			->pluck('question_id', 'question_id');
			
			$categoriesObj = Categories::find($userQuestionAnwser->category_id);
			
			$questions = Questions::where('level', $userQuestionAnwser->category_id)
				->whereNotIn('id', $questionIds)
				->orderBy('id', 'ASC')->limit(1)->first();

			if (empty($questions)) {
				$categories = Categories::orderBy('id', 'ASC')->pluck('id', 'id');
				
				$categoryids = UserQuestionAnwser::where('user_id', Auth::user()->id)
				->latest('created_at')
				->groupBy('category_id')
				->orderBy('id', 'ASC')
				->pluck('category_id', 'category_id');
				
				$newCategoryArray = [];
				foreach ($categories as $key => $category) {
					
					if (!isset($categoryids[$key])) {
						$newCategoryArray[] = $key;	
					}
				}
				
				//dump($newCategoryArray);exit;
				if (isset($newCategoryArray[0])) {
					
					$categoriesObj = Categories::find($newCategoryArray[0]);
					
					$questions = Questions::where('level', $newCategoryArray[0])
						->orderBy('id', 'ASC')
						->limit(1)->first();
					
				} else {
					return redirect()->route('exam.questions.dashboard')
					->withSuccess('Please select next exam or your exam level finsihed');
				}
			}
		}
		return view('exam.index', compact('questions', 'userQuestionAnwser', 'categoriesObj'));
    }
	
	public function saveUserQuestionAnwser($categoryId, $answerId) {
		
		$userQuestionAnwser = UserQuestionAnwser::where('category_id', $categoryId)
		//->where('category_id', $categoryId)
		->where('answer_id', $answerId)
		->where('user_id', Auth::user()->id)->count();
		
		if ($userQuestionAnwser == 0) {		
			$categoriesObj = Categories::find($categoryId);
			$questionChoices = QuestionChoices::find($answerId);
			
			$userQuestionAnwser = new UserQuestionAnwser();
			$userQuestionAnwser->user_id = Auth::user()->id;
			$userQuestionAnwser->category_id = $categoryId;
			//$userQuestionAnwser->category_id = $request->get('category_id');
			$userQuestionAnwser->parent_category_id = $categoriesObj->parentCategory->id;
			$userQuestionAnwser->question_id = $questionChoices->fk_question_id;
			$userQuestionAnwser->answer_id = $questionChoices->id;
			$userQuestionAnwser->status = $questionChoices->is_correct;
			$userQuestionAnwser->save();
		}
	}
	
	public function store(CreateAnswerRequest $request)
    {
		$categoriesObj = Categories::find($request->get('category_id'));
		
		
		$this->saveUserQuestionAnwser($request->get('category_id'), $request->get('answer_id'));
				
		
		$userQuestionAnwser = UserQuestionAnwser::where('user_id', Auth::user()->id)->latest('created_at')->groupBy('category_id')->first();
			
		$questionIds = UserQuestionAnwser::select('question_id')
		->where('user_id', Auth::user()->id)
		->where('category_id', $userQuestionAnwser->category_id)
		->pluck('question_id', 'question_id');
		
		$categoriesObj = Categories::find($userQuestionAnwser->category_id);
		
		
		$questions = Questions::where('level', $userQuestionAnwser->category_id)
			->whereNotIn('id', $questionIds)->limit(1)->first();
			
		
		if (empty($questions)) {
			$categories = Categories::orderBy('id', 'ASC')->pluck('id', 'id');
				
			$categoryids = UserQuestionAnwser::where('user_id', Auth::user()->id)
			->latest('created_at')
			->groupBy('category_id')
			->orderBy('id', 'ASC')
			->pluck('category_id', 'category_id');
			
			$newCategoryArray = [];
			foreach ($categories as $key => $category) {
				
				if (!isset($categoryids[$key])) {
					$newCategoryArray[] = $key;	
				}
			}
			
			if(isset($newCategoryArray[0])) {
				$categoriesObj = Categories::find($newCategoryArray[0]);	
			}
			
			$questionsCount = Questions::count();
			$userQuestionAnwserCount = UserQuestionAnwser::count();
			
			view()->share('questionsCount', $questionsCount);
			view()->share('userQuestionAnwser', $userQuestionAnwserCount);
		}
			
		return view('exam._list', compact('questions', 'userQuestionAnwser', 'categoriesObj'));
	}
	
	public function story()
    {
		$categories = Categories::orderBy('id', 'ASC')->pluck('id', 'id');
				
		$categoryids = UserQuestionAnwser::where('user_id', Auth::user()->id)
		->latest('created_at')
		->groupBy('category_id')
		->orderBy('id', 'ASC')
		->pluck('category_id', 'category_id');
		
		$newCategoryArray = [];
		foreach ($categories as $key => $category) {
			
			if (!isset($categoryids[$key])) {
				$newCategoryArray[] = $key;	
			}
		}
		
		$categoriesObj = Categories::find($newCategoryArray[0]);
		
		return view('exam.category_story', compact('categoriesObj'));
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
	
	private function exam()
    {
        return view('dashboard.default', compact('activities'));
    }
}
