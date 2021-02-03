@extends('layouts.app')

@section('page-title', 'Sub Category')
@section('page-heading', 'Sub Category')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
       Sub Category
    </li>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
                <div class="col-md-4 mt-md-0 mt-2">
                   
                </div>

              <div class="col-md-2 mt-2 mt-md-0"></div>
                <div class="col-md-6">
                    <a href="{{ route('subcat.create') }}" class="btn btn-primary btn-rounded float-right">
                        <i class="fas fa-plus mr-2"></i>
                        Add SubCategory
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                    
                    <th class="min-width-150">title</th>
                    <th class="min-width-150">Category</th>
                    <th class="min-width-150">image</th>
                        <th class="min-width-150">Description</th>
                   
                    <th class="text-center min-width-100">@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($subcategory))
                        @foreach ($subcategory as $subcat)
                            @include('subcategory.partials.row')
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
{!! $subcategory->render() !!}


@stop

@section('scripts')
    <script>
       
    </script>
@stop
