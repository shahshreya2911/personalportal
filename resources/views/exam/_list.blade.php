
@if(!empty($questions))
	<input type="hidden" name="question_id" id="question_id" value="{{ $questions->id }}">
	<input type="hidden" name="category_id" id="category_id" value="{{ $categoriesObj->id }}">
	
	<h3>{{ $categoriesObj->parentCategory->name }}</h3><br>
	<h4>{{ $categoriesObj->name }}</h4>
	<span id="sentence-error" class="invalid-feedback"></span>
	<h4>Question: {{ $questions->sentence }}</h4>
								 
	@foreach ($questions->answer as $answer)
		<div class="custom-control custom-checkbox">
			<input type="radio" name="answer" value="{{$answer->id}}">{{ $answer->answer}}
		</div>
	@endforeach
@else
	<div id='finish_exam'>
		{{ $userQuestionAnwser->category->parentCategory->name }} {{ $userQuestionAnwser->category->name }} exam Finished <a href='{{ route('exam.questions.dashboard')}}'>Dashboard</a>
	</div>
@endif	