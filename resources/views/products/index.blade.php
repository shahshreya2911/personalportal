@extends('layouts.app')

@section('page-title', 'Products')
@section('page-heading', 'Products')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('app.product')
    </li>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
                <div class="col-md-4 mt-md-0 mt-2">
                    <!-- <div class="input-group custom-search-form">
                        <input type="text"
                               class="form-control input-solid"
                               name="search"
                               value="{{ Input::get('search') }}"
                               placeholder="Search for questions..">

                            <span class="input-group-append">
                                @if (Input::has('search') && Input::get('search') != '')
                                    <a href="{{ route('user.list') }}"
                                           class="btn btn-light d-flex align-items-center text-muted"
                                           role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn btn-light" type="submit" id="search-users-btn">
                                    <i class="fas fa-search text-muted"></i>
                                </button>
                            </span>
                    </div> -->
                </div>

              <div class="col-md-2 mt-2 mt-md-0"></div>
                <div class="col-md-6">
                    <a href="{{ route('product.create') }}" class="btn btn-primary btn-rounded float-right">
                        <i class="fas fa-plus mr-2"></i>
                        Add Product
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                    
                    <th class="min-width-150">Product Name</th>
                    <th class="min-width-100">Brand</th>
                    <th class="min-width-80">Description</th>
                    <th class="text-center min-width-150">@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($products))
                        @foreach ($products as $product)
                            @include('products.partials.row')
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"><em>@lang('app.no_records_found')</em></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>



@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#users-form").submit();
        });
    </script>
@stop
