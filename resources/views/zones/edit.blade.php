@extends('layouts.app')

@section('page-title', 'Edit Zone')
@section('page-heading', 'Edit Zone')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('zone') }}">Zone</a>
    </li>
    <li class="breadcrumb-item active">
        @lang('app.edit')
    </li>
@stop

@section('content')

@include('partials.messages')
{!! Form::open(['route' => 'zone.storeedit', 'files' => true, 'id' => 'zone-form' ,'method' =>'POST']) !!}
         

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        Zone details
                    </h5>
                    
                </div>
                <div class="col-md-9">
                    @include('zones.partials.editdetails', ['edit' => false])
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
{!! JsValidator::formRequest('Vanguard\Http\Requests\Zone\ZoneRequest', '#zone-form') !!}
   
@stop