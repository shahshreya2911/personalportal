<?php

namespace Vanguard\Http\Controllers\Web;
use DB;
use Illuminate\Http\Request;
use Vanguard\Http\Requests\Question\CreateQuestionRequest;
use Vanguard\Http\Requests\Question\CreateChoiceRequest;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Questions;
use Vanguard\Models\Categories;
use Vanguard\Models\Choices;
use Vanguard\Repositories\Questions\QuestionsRepository;

class QuestionsController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $questions;
  /*   public function __construct(QuestionsRepository $questions)
    {
        //$this->middleware('auth');
        //$this->middleware('session.database', ['only' => ['sessions', 'invalidateSession']]);
        //$this->middleware('permission:users.manage');
        $this->questions = $questions;
    }*/

    public function index()
    {
        //$questions = Questions::get();
        $questions =  Questions::Join('categories', 'categories.id', '=', 'questions.level')->select(
        'questions.id',
        'questions.sentence',
        'questions.active',
        'questions.level',
        'categories.name as catname')->get();
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('questions.add', compact('categories'));
    }
    /**
     * Stores new Question into the database.
     *
     * @param CreateQuestionRequest $request
     * @return mixed
     */
    public function store(CreateQuestionRequest $request)
    {
        $data = $request->all();
        Questions::create($data);
        return redirect()->route('questions')
        ->withSuccess(trans('app.que_created'));
    }
    public function edit($id){
       // echo $id;
        $question = Questions::find($id);
        $categories = Categories::all();
        $choices = DB::table('questionchoices')
        ->leftjoin('questions', 'questionchoices.fk_question_id', '=', 'questions.id')
        ->leftjoin('categories', 'categories.id', '=', 'questions.level')
        ->select(
        'questionchoices.id as ansid',
        'questionchoices.answer',
        'questionchoices.is_correct',
        'questionchoices.active',
        'questionchoices.fk_question_id',
        'questions.sentence',
        'categories.name as catname'
        )->where('questionchoices.fk_question_id', $id)->get();

        return view('questions.edit', compact('question','categories','choices'));
    }
    public function storeedit(request $request){
     /* print_r($request->all());
      exit();*/
      $answers = $request->input('answer'); 
      if (!empty($answers)) {
        foreach($answers as $row){
           
            if(!empty($row['ansid'])){
                $score = Choices::find($row['ansid']); 
                $score->answer = $row['answer']; 
                //$score->is_correct = $row['is_correct']; 
                $score->save(); 
               
            }else {
                if(!empty($row['answer'])){
                $scores = new Choices();
                $scores->fk_question_id = $request->questionid;
                $scores->answer = $row['answer']; 
                //$scores->is_correct = $row['is_correct']; 
                $scores->save();
                }
            }
            
        }
      }
        $task = Questions::find($request->questionid);
        $task->sentence = $request['sentence'];
        $task->level = $request['level'];
        $task->active = $request['active'];
        $task->save();
        return redirect()->route('questions')
        ->withSuccess(trans('app.que_updated'));
    }
    public function indexChoice()
    {
       // $allquestions = Questions::all();
        $choices = DB::table('questionchoices')
        ->leftjoin('questions', 'questionchoices.fk_question_id', '=', 'questions.id')
        ->leftjoin('categories', 'categories.id', '=', 'questions.level')
        ->select(
        'questionchoices.id',
        'questionchoices.answer',
        'questionchoices.is_correct',
        'questionchoices.active',
        'questionchoices.fk_question_id',
        'questions.sentence',
        'categories.name as catname'
        )->get();

        return view('choices.index', compact('choices'));
    }
     public function createChoice()
    {
        $questions = Questions::get();
        return view('choices.add', compact('questions'));
    }
    public function storeChoice(CreateChoiceRequest $request)
    {
        $data = $request->all();
        $choice_data =  Choices::create($data);
        $data= $choice_data->id;
        return response()->json($data);
       // return redirect()->route('choices')
        //->withSuccess(trans('app.ans_created'));
    }
    public function editChoice($id){
       $questions = Questions::get();
         $choices =  Choices::Join('questions', 'questionchoices.fk_question_id', '=', 'questions.id')->select(
        'questionchoices.id',
        'questionchoices.answer',
        'questionchoices.is_correct',
        'questionchoices.active',
        'questionchoices.fk_question_id',
        'questions.sentence')->where('questionchoices.id', $id)->first();
        return view('choices.edit', compact('choices','questions'));
    }
    public function storeeditChoice(request $request){
     
        DB::table('questionchoices') 
        ->where('fk_question_id',$request['fk_question_id'])
        ->update([ 'is_correct' => 0 ]);

        $task = Choices::find($request['choiceid']);
        $task->is_correct = $request['is_correct'];
        $task->save();
       
    }
}