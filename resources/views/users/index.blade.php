@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('app.dashboard')
    </li>
@stop

@section('content')
<style>
.exam_button {
    color: #fff;
    background-color: #232e6e;
    border-color: #232e6e;
}

.exam_button:hover {
    color: #fff;
    background-color: #232e6e;
    border-color: #232e6e;
}
</style>
@include('partials.messages')
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
							<a href='#next' id='next' class="btn exam_button" >Next</a>
						</form>
					</div>
				
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
	<script>
		function getChecklistItems() {
			var result =
				$("input:radio:checked").get();

			var columns = $.map(result, function(element) {
				//alert($(element).val());
				//return $(element).attr("id");
				return $(element).val();
			});

			return columns.join("|");
		}
		$('#next').click(function () {
			category_id = $('#category_id').val();
			//question_id = $('#question_id').val();
			
			
			@if($categoriesObj->parentCategory->name == \Vanguard\Models\ParentCategory::CATEGORY_2) 
				answer_id = getChecklistItems();
			@else
				answer_id = $('input[name=answer]:checked').val();
			@endif		
			
			var url = "{{ route('exam.questions.store')}}";
			//popup_loader_pattern_two('loaderid');
			$.ajax({
			  url: url,
			  type: "post",
			  data: {'category_id': category_id ,'answer_id': answer_id, '_token': "{{ csrf_token() }}"},
			  success: function(data){
				  
				
				//loader_processing();
				$('#questions_next').html(data);	
				
				if ($("#finish_exam").is(':visible')) {
					$('#next').hide();
				}
				//$('#loaderid').html(''); 
			  } ,
    		error: function (jqXHR , exception) {
    			console.log(jqXHR.status);
    			var msg = '';
    			 if (jqXHR.status === 422) {
            		msg = 'Please Select Any Answer.';
        		}
        		$('#sentence-error').html(msg);
        		$('.invalid-feedback').css('display','block');
    		}		

			});
		});
	</script>	
@stop