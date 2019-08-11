@extends('layouts.app')

@section('page-title', 'Add Question')
@section('page-heading', 'Add Question')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('questions') }}">Question</a>
    </li>
    <li class="breadcrumb-item active">
        @lang('app.edit')
    </li>
@stop

@section('content')

@include('partials.messages')
{!! Form::open(['route' => 'question.storeedit', 'files' => true, 'id' => 'question-form' ,'method' =>'POST']) !!}
         

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        Question details
                    </h5>
                    
                </div>
                <div class="col-md-9">
                    @include('questions.partials.editdetails', ['edit' => false])
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">
                Save
            </button>
        </div>
    </div>
{!! Form::close() !!}

<br>
@stop

@section('scripts')
{!! HTML::script('assets/js/as/choice.js') !!}
{!! JsValidator::formRequest('Vanguard\Http\Requests\Question\CreateQuestionRequest', '#question-form') !!}
   
@stop