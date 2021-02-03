@extends('layouts.app')

@section('page-title', 'Edit Product')
@section('page-heading', 'Edit Product')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('product') }}">Product</a>
    </li>
    <li class="breadcrumb-item active">
        @lang('app.edit')
    </li>
@stop

@section('content')

@include('partials.messages')
{!! Form::open(['route' => 'product.storeedit', 'files' => true, 'id' => 'product-form' ,'method' =>'POST']) !!}
         

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        Product details
                    </h5>
                    
                </div>
                <div class="col-md-9">
                    @include('products.partials.editdetails', ['edit' => false])
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
{!! HTML::script('assets/js/as/attributes.js') !!}
{!! JsValidator::formRequest('Vanguard\Http\Requests\Product\ProductRequest', '#product-form') !!}
   
@stop