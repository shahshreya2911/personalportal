@extends('layouts.app')

@section('page-title', 'Edit Subcategory')
@section('page-heading', 'Edit Subcategory')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('subcat') }}">Subcategory</a>
    </li>
    <li class="breadcrumb-item active">
        Edit Subcategory
    </li>
@stop

@section('content')

@include('partials.messages')
{!! Form::open(['route' => 'subcat.storeedit', 'files' => true, 'id' => 'subcat-form' ,'method' =>'POST']) !!}
         

    <div class="card">
        <div class="card-body">
            <div class="row">
              <!--   <div class="col-md-3">
                    <h5 class="card-title">
                        Job details
                    </h5>
                    
                </div> -->
                <div class="col-md-12">
                    @include('subcategory.partials.editdetails', ['edit' => false])
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
  
@stop