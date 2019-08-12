@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('app.dashboard')
    </li>
@stop

@section('content')
<div class="question-list">


	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="panel-heading"></div>
					<div class="card-body">
						<?php $i = 0;?>	
						<?php $flag = false;?>	
						<?php foreach ($categories as $category):?>
							{{ $category->name}}
							@if (\Vanguard\Helpers\Helper::examLevel($category->id, $i) == '2' && $flag === false)
								<a href='{{ route('exam.questions')}}'>Start Exam</a>
								<?php $flag = true;?>
							@elseif (\Vanguard\Helpers\Helper::examLevel($category->id, $i) == '3' && $flag === false)
								<a href='{{ route('exam.questions')}}'>Exam Running</a>
								<?php $flag = true;?>
							@elseif (\Vanguard\Helpers\Helper::examLevel($category->id, $i) == '4' && $flag === false)	
								<a href='#'>Exam Finished</a>
							@elseif (\Vanguard\Helpers\Helper::examLevel($category->id, $i) == '5' || $flag === true)	
								<a href='#'>Finish Above Exam First</a>
							@endif	
							</br>  
						<?php $i++;?>		
						<?php endforeach;?>
					</div>
				
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
	<script>
		$('#next').click(function () {
			category_id = $('#category_id').val();
			question_id = $('#question_id').val();
			answer_id = $('input[name=answer]:checked').val();
			
			var url = "{{ route('exam.questions.store')}}";
			//popup_loader_pattern_two('loaderid');
			$.ajax({
			  url: url,
			  type: "post",
			  data: {'category_id': category_id ,'question_id': question_id,'answer_id': answer_id, '_token': "{{ csrf_token() }}"},
			  success: function(data){
				//loader_processing();
				$('#questions_next').html(data);	
				//$('#loaderid').html(''); 
			  }
			});
		});
	</script>	
@stop