@extends('layouts.app')

@section('page-title', 'Add Subcategory')
@section('page-heading', 'Add Subcategory')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('subcat') }}">Sub Category</a>
    </li>
    <li class="breadcrumb-item active">
        @lang('app.create')
    </li>
@stop
<style type="text/css">
    .form-group.inline {
    display: inline-block;
}
</style>
@section('content')

@include('partials.messages')

{!! Form::open(['route' => 'subcat.store', 'files' => true, 'id' => 'subcat-form' ,'method' =>'POST', 'enctype'=>'multipart/form-data' ]) !!}
       

    <div class="card">
        <div class="card-body">
            <div class="row">
               <!--  <div class="col-md-1">
                    <h5 class="card-title">
                        Job details
                    </h5>
                    
                </div> -->
                <div class="col-md-12">
                    @include('subcategory.partials.details', ['edit' => false])
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
 {!! JsValidator::formRequest('Vanguard\Http\Requests\Subcategory\SubcategoryRequest', '#subcat-form') !!}
@stop