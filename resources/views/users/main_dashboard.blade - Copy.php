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
						<div class="row">
						<?php $i = 0;?>	
						<?php $flag = false;?>	
						<?php foreach ($categories as $category):?>
							<div class="col-xl-4 text-center">
								<div class="card widget">
									<div class="card-body">
										<div class="row">
											<div class="text-success col-xl-12" style="color: #232e6e!important;">
												<i class="fa fa-book fa-3x"></i>
											</div>

											<div class="col-xl-12">
												<strong>{{ $category->name}}</strong>
												<div class="question-name">
												@if (\Vanguard\Helpers\Helper::examLevel($category->id, $i) == '2' && $flag === false)
													<a href='{{ route('exam.questions')}}'>Start Exam</a>
													<?php $flag = true;?>
												@elseif (\Vanguard\Helpers\Helper::examLevel($category->id, $i) == '3' && $flag === false)
													<a href='{{ route('exam.questions')}}'>Exam Running</a>
													<?php $flag = true;?>
												@elseif (\Vanguard\Helpers\Helper::examLevel($category->id, $i) == '4' && $flag === false)	
													<a href='#'>Exam Finished</a>
												 Result: 10/{{ \Vanguard\Helpers\Helper::correctAnswer($category->id, $i) }}

												@elseif (\Vanguard\Helpers\Helper::examLevel($category->id, $i) == '5' || $flag === true)	
													<a href='#'>Finish Above Exam First</a>
												@endif	
												</div>
											
										<?php $i++;?>
										</div>
									</div>
								</div>
							</div>
							</div>		
					<?php endforeach;?>
					</div>
					</div>
				
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Result</h3>
               <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                    <th class="min-width-80">Student</th>
                    <th class="min-width-150">User Id</th>
                    <th class="min-width-100">Basic Vocabulary</th>
                    <th class="min-width-80">Literacy Reading Comprehension</th>
                    <th class="min-width-80">Adult Nummeracy</th>
                    <th class="text-center min-width-150">Completion Date</th>
                </tr>
                </thead>
                <tbody>
                	<tr>
	                	<td> K seloma</td>
	                	<td>222333</td>
	                	<td>50</td>
	                	<td>50</td>
	                	<td>50</td>
	                	<td>4 April 2019</td>
	                </tr>
	                <tr>
	                	<td> KJ seloma</td>
	                	<td>222333</td>
	                	<td>50</td>
	                	<td>50</td>
	                	<td>50</td>
	                	<td>4 April 2019</td>
	                </tr>
	                <tr>
	                	<td> M seloma</td>
	                	<td>222333</td>
	                	<td>50</td>
	                	<td>50</td>
	                	<td>50</td>
	                	<td>4 April 2019</td>
	                </tr>
                </tbody>
                <tfoot>
			    <tr>
			      <th colspan="5" align="right">Total Activities:</th>
			      <th  align="right">150</th>
			    </tr>
			  </tfoot>
            </table>
        </div>
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