@extends('layouts.app')

@section('page-title', 'Certification')
@section('page-heading', 'Certification')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('user.list') }}">Certification</a>
    </li>
    
@stop

@section('content')

<div class="row">
    <div class="col-lg-5 col-xl-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    @lang('app.details')
                </h5>
                
            </div>
        </div>
    </div>

    <div class="col-lg-7 col-xl-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    @lang('app.latest_activity')

                   
                </h5>

                    <table class="table table-borderless table-striped">
                        <thead>
                        <tr>
                            <th>@lang('app.action')</th>
                            <th>@lang('app.date')</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                        </tbody>
                    </table>
                
            </div>
        </div>
    </div>
</div>
@stop