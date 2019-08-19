
@if(!empty($questions))
	
	<input type="hidden" name="category_id" id="category_id" value="{{ $categoriesObj->id }}">
	
	<h3>{{ $categoriesObj->parentCategory->name }}</h3><br>
	<h4>{{ $categoriesObj->name }}</h4>
	<span id="sentence-error" class="invalid-feedback"></span>
	@if($categoriesObj->name == 'Numeracy/Literacy') 
		<div>{{ $categoriesObj->story }}</div>	
	@endif		
	<h4>Question: {{ $questions->sentence }}</h4>
							 
	@foreach ($questions->answer as $answer)
		<div class="custom-control custom-checkbox">
			<input type="radio" name="answer" value="{{$answer->id}}">{{ $answer->answer}}
		</div>
	@endforeach
	
@else
	<div id='finish_exam'>
		
		@if(isset($questionsCount) && isset($userQuestionAnwserCount) && $questionsCount == $userQuestionAnwserCount)
			All exam level finished <a href='{{ route('exam.questions.story')}}'>Go dashbaord</a>
		@elseif($categoriesObj->parentCategory->name == \Vanguard\Models\ParentCategory::CATEGORY_2) 
			{{ $userQuestionAnwser->category->parentCategory->name }} {{ $userQuestionAnwser->category->name }} exam Finished <a href='{{ route('exam.questions.story')}}'>Start Next Level</a>
		@else
			{{ $userQuestionAnwser->category->parentCategory->name }} {{ $userQuestionAnwser->category->name }} exam Finished <a href='{{ route('exam.questions')}}'>Start Next Level</a>
		@endif
		
	</div>
@endif	