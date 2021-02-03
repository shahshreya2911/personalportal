@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('app.dashboard')
    </li>
@stop

@section('content')
<link rel="stylesheet" href="<?php echo asset('assets/sweetalert/css/sweetalert.css')?>" type="text/css"> 
<div class="question-list">


</div>
@stop

