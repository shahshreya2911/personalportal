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
	                	<td> K seloma</td>
	                	<td>222333</td>
	                	<td>150</td>
	                	<td>60%</td>
	                	<td>C</td>
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
        		 		<object data="{{url('upload/users/certificate/student.pdf')}}" type="application/pdf" width="100%" height="100%" style="height: 250px">
        		 			<p>Alternative text - include a link <a href="{{url('upload/users/certificate/student.pdf')}}">to the PDF!</a></p>
						</object><br/>
						<h5><a href="{{url('upload/users/certificate/student.pdf')}}">Download Certificate</a></h5>
        		 	</div>
        		 </div>
        	</div>
        </div>
    </div>
@stop