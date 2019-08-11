@extends('layouts.app')

@section('page-title', 'Edit Answer')
@section('page-heading', 'Edit Answer')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('choices') }}">Choice</a>
    </li>
    <li class="breadcrumb-item active">
        @lang('app.create')
    </li>
@stop

@section('content')

@include('partials.messages')
{!! Form::open(['route' => 'choices.storeedit', 'files' => true, 'id' => 'choices-form' ,'method' =>'POST']) !!}
         

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        Answer details
                    </h5>
                    
                </div>
                <div class="col-md-9">
                    @include('choices.partials.editdetails', ['edit' => false])
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
{!! JsValidator::formRequest('Vanguard\Http\Requests\Question\CreateChoiceRequest', '#choices-form') !!}
   
@stop