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
								  @foreach ($users as $users)
								<tr>
									<td> {{$users->first_name}} {{$users->last_name}}</td>
									<td>{{$users->id}}</td>
									<td>{{\Vanguard\Helpers\Helper::alluserCategoryScore(1,$users->id)}}</td>
									<td>{{\Vanguard\Helpers\Helper::alluserCategoryScore(2,$users->id)}}</td>
									<td>{{\Vanguard\Helpers\Helper::alluserCategoryScore(3,$users->id)}}</td>
									<td>{{\Vanguard\Helpers\Helper::alluserExamDate(3,$users->id)}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<h4 class="card-title">Activity Total: {{\Vanguard\Helpers\Helper::userAllScore()}}</h3>
				</div>
			</div>
		</div>
		</div>
</div>
@stop

