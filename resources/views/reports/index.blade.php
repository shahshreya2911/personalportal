@extends('layouts.app')

@section('page-title', 'Reports')
@section('page-heading', 'Reports')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('app.report')
    </li>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

       
     {!! Form::open(['route' => 'report.showdetails', 'files' => true, 'id' => 'question-form' ,'method' =>'POST']) !!}
            <div class="row my-6 flex-md-row flex-column-reverse">
                <div class="col-md-8 mt-md-0 mt-4">
                    <div class="input-group custom-search-form">
                      <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input type="text"
                               class="form-control date"
                               name="from"
                               value="{{ Input::get('search') }}"
                               placeholder="From date">
                          <input type="text"
                               class="form-control date"
                               name="to"
                               value="{{ Input::get('search') }}"
                               placeholder="To date">
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
                    </div>
                </div>

              <div class="col-md-2 mt-2 mt-md-0"></div>
                <div class="col-md-6">
                  
                </div>
            </div>
        {!! Form::close() !!}

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                    
                    <th class="min-width-150">Product id</th>
                    <th class="min-width-150">Stock in By</th>
                    <th class="min-width-150">Quantity</th>
                
                </tr>
                </thead>
                <tbody>
                    @if (count($stockinattributes))
                        @foreach ($stockinattributes as $stockinattribute)
                            @include('reports.partials.row')
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
     $('.date').datepicker({  

       format: 'dd-mm-yyyy'

     })
    </script>
@stop
