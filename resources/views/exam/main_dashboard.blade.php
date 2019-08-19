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
	<?php if (\Vanguard\Models\Questions::count() == \Vanguard\Models\UserQuestionAnwser::count()):?>
		<div class="row">
			<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title">Results</h3>
				    <div class="table-responsive" id="users-table-wrapper">
						<table class="table table-borderless table-striped">
							<thead>
							<tr>
								<th class="min-width-80">Student</th>
								<th class="min-width-150">User Id</th>
								<th class="min-width-100">Basic Vocabulary</th>
								<th class="min-width-80">Literacy Comphrehension</th>
								<th class="min-width-80">Adult Numeracy</th>
								<th class="min-width-150">Completation Date</th>
							</tr>
							</thead>
							<tbody>
								<tr>
									<td> {{Auth::user()->first_name}} {{Auth::user()->last_name}}</td>
									<td>{{Auth::user()->id}}</td>
									<td>{{\Vanguard\Helpers\Helper::userCategoryScore(1)}}</td>
									<td>{{\Vanguard\Helpers\Helper::userCategoryScore(2)}}</td>
									<td>{{\Vanguard\Helpers\Helper::userCategoryScore(3)}}</td>
									<td>19-08-2019</td>
								</tr>
							</tbody>
						</table>
					</div>
					<h4 class="card-title">Activity Total: {{\Vanguard\Helpers\Helper::userAllScore()}}</h3>
				</div>
			</div>
		</div>
		</div>
	<?php endif;?>	
	<?php /*
	<div class="row">
		<div class="col-md-12">
        	<div class="card">
        		 <div class="card-body">
        		 	<h4 class="alert alert-success">Thank you for participating on the plas program. You have successfully completed.</h4>
        		 	<div class="certificate-pdf col-md-5">
        		 		<h5>Download your certificate below</h5>
        		 		<object data="{{url('upload/users/certificate/PALS_certificate.pdf')}}" type="application/pdf" width="100%" height="100%" style="height: 250px">
        		 			<p>Alternative text - include a link <a href="{{url('upload/users/certificate/PALS_certificate.pdf')}}">to the PDF!</a></p>
						</object><br/>
						<h5><a class="text-danger" href="{{url('upload/users/certificate/PALS_certificate.pdf')}}">Download Certificate</a></h5>
        		 	</div>
        		 </div>
        	</div>
        </div>
    </div>*/?>
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