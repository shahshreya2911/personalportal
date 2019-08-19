
@if(count($questions) > 0)
	
	<input type="hidden" name="category_id" id="category_id" value="{{ $categoriesObj->id }}">
	
	<h3>{{ $categoriesObj->parentCategory->name }}</h3><br>
	<h4>{{ $categoriesObj->name }}</h4>
	<span id="sentence-error" class="invalid-feedback"></span>
	
	@if($categoriesObj->parentCategory->name == \Vanguard\Models\ParentCategory::CATEGORY_2) 
		<div>{{ $categoriesObj->story }}</div>
		<?php $i = 1;?>
		@foreach ($questions as $question)
			<h4>Question: {{ $question->sentence }}</h4>
									 
			@foreach ($question->answer as $answer)
				<div class="custom-control custom-checkbox">
					<input type="radio" name="answer_<?php echo $i;?>" value="{{$answer->id}}" class='answer'>{{ $answer->answer}}
				</div>
			@endforeach
			<?php $i++;?>
		@endforeach	
	@else
		<h4>Question: {{ $questions->sentence }}</h4>
								 
		@foreach ($questions->answer as $answer)
			<div class="custom-control custom-checkbox">
				<input type="radio" name="answer" value="{{$answer->id}}">{{ $answer->answer}}
			</div>
		@endforeach
	@endif		
	
@else
	<div id='finish_exam'>
		{{ $userQuestionAnwser->category->parentCategory->name }} {{ $userQuestionAnwser->category->name }} exam Finished <a href='{{ route('exam.questions')}}'>Start Next Exam</a>
	</div>
@endif	