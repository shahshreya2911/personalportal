@extends('layouts.app')

@section('page-title', 'Certification')
@section('page-heading', 'Certification')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('user.list') }}">Certification</a>
    </li>
    
@stop

@section('content')
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
                    <th class="min-width-100">Score</th>
                    <th class="min-width-80">Percentage Score</th>
                    <th class="min-width-80">Performance Level</th>
                    <th class="min-width-150">Status</th>
                </tr>
                </thead>
               <tbody>
					<tr>
						<td> {{Auth::user()->first_name}} {{Auth::user()->last_name}}</td>
						<td>{{Auth::user()->id}}</td>
						<td>{{\Vanguard\Helpers\Helper::userAllScore()}}</td>
						<td><?php echo number_format(\Vanguard\Helpers\Helper::allQuestions()/ \Vanguard\Helpers\Helper::userAllScore(), 2); ?>%</td>
						<td>
							@if(\Vanguard\Helpers\Helper::allQuestions()/ \Vanguard\Helpers\Helper::userAllScore() < 49)
							E
							@elseif(\Vanguard\Helpers\Helper::allQuestions()/ \Vanguard\Helpers\Helper::userAllScore() > 50 && \Vanguard\Helpers\Helper::allQuestions()/ \Vanguard\Helpers\Helper::userAllScore() <60)
							D
							@elseif(\Vanguard\Helpers\Helper::allQuestions()/ \Vanguard\Helpers\Helper::userAllScore() > 60 && \Vanguard\Helpers\Helper::allQuestions()/ \Vanguard\Helpers\Helper::userAllScore() <79)	
							C
							@elseif(\Vanguard\Helpers\Helper::allQuestions()/ \Vanguard\Helpers\Helper::userAllScore() > 80 && \Vanguard\Helpers\Helper::allQuestions()/ \Vanguard\Helpers\Helper::userAllScore() <89)	
							B
							@elseif(\Vanguard\Helpers\Helper::allQuestions()/ \Vanguard\Helpers\Helper::userAllScore() > 90 && \Vanguard\Helpers\Helper::allQuestions()/ \Vanguard\Helpers\Helper::userAllScore() <100)	
							A
							@endif
						</td>
						<td>Completed</td>
					</tr>
				</tbody>
            </table>
        </div>
            </div>
        </div>
    </div>
	</div>
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
    </div>
@stop