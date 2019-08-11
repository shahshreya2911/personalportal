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
							
						<form name='frm' id='frm' action='#'>	
							<div id='questions_next' class="questions-choice">
							
								@include('exam._list')
							</div>
							<a href='#' id='next' class="btn btn-primary btn-lg">Next</a>
						</form>
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
				
				if ($("#finish_exam").is(':visible')) {
					$('#next').hide();
				}
				//$('#loaderid').html(''); 
			  }
			});
		});
	</script>	
@stop