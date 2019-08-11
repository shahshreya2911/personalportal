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
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('profile') }}" class="text-center no-decoration">
                    <div class="icon my-3">
                        <i class="fas fa-user fa-2x"></i>
                    </div>
                    <p class="lead mb-0">@lang('app.update_profile')</p>
                </a>
            </div>
        </div>
    </div>

    @if (config('session.driver') == 'database')
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('profile.sessions') }}" class="text-center  no-decoration">
                        <div class="icon my-3">
                            <i class="fa fa-list fa-2x"></i>
                        </div>
                        <p class="lead mb-0">@lang('app.my_sessions')</p>
                    </a>
                </div>
            </div>
        </div>
    @endif

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('profile.activity') }}" class="text-center no-decoration">
                    <div class="icon my-3">
                        <i class="fas fa-server fa-2x"></i>
                    </div>
                    <p class="lead mb-0">@lang('app.activity_log')</p>
                </a>
            </div>
        </div>

    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('auth.logout') }}" class="text-center no-decoration">
                    <div class="icon my-3">
                        <i class="fas fa-sign-out-alt fa-2x"></i>
                    </div>
                    <p class="lead mb-0">@lang('app.logout')</p>
                </a>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="panel-heading"></div>
            <div class="card-body">
			@if (empty($userQuestionAnwser))
				<h3>Current Level A</h3>
			@else
			<h3>{{ $userQuestionAnwser->category->name }}</h3>
			@endif	
			
            
            <div class="questions-choice"> 
    			<h4>Q.1: {{ $questions->sentence }}</h4>
                 
    			@foreach ($questions->answer as $answer)
    				<input type="radio" name="answer" value="{{ $answer->is_correct}}">{{ $answer->answer}}</br>
    			@endforeach
            </div>
			<a href='#' class="btn btn-primary btn-lg">Next</a>
            </div>
        </div>
    </div>
</div>
</div>
@stop

@section('scripts')
    
@stop