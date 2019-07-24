<?php
$code = app()->isDownForMaintenance() ? 'maintenance' : $exception->getStatusCode();
?>

@extends('master-voyager-theme')

@section('page_title', 'Oops!')

@section('page_header')
Oops!
@stop

@section('content')

<meta name="description" content="{!! trans(" server-error-pages::server-error-pages.$code.description", ['domain'=> request()->getHost()]) !!}">
<title>{!! trans("server-error-pages::server-error-pages.$code.title") !!}</title>
<style>
    /* Error Page Inline Styles */
    body {
        padding-top: 20px;
    }

    /* Layout */
    .jumbotron {
        font-size: 21px;
        font-weight: 200;
        line-height: 2.1428571435;
        color: inherit;
        padding: 10px 0px;
    }

    /* Everything but the jumbotron gets side spacing for mobile-first views */
    .masthead,
    .body-content {
        padding-left: 15px;
        padding-right: 15px;
    }

    /* Main marketing message and sign up button */
    .jumbotron {
        text-align: center;
        background-color: transparent;
    }

    .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
    }

    /* Colors */
    .green {
        color: #5cb85c;
    }

    .orange {
        color: #f0ad4e;
    }

    .red {
        color: #d9534f;
    }
</style>
</head>

<!-- Error Page Content -->
<!-- Jumbotron -->
<div class="jumbotron">
    <h1><i class="{!! trans(" server-error-pages::server-error-pages.$code.icon") !!}"></i> {!! trans("server-error-pages::server-error-pages.$code.title") !!}</h1>
    <p class="lead">{!! config('app.env') === 'production' ? trans("server-error-pages::server-error-pages.$code.description", ['domain'=> request()->getHost()]) : $exception->getMessage() ?? trans("server-error-pages::server-error-pages.$code.description", ['domain'=> request()->getHost()]) !!}</p>
    <p>
        <a class="bg-blue-dark text-white p-4 rounded shadow hover:bg-blue hover:text-white" href="{{route('generic-job-application-homepage')}}">
            <span class="">{!! trans("server-error-pages::server-error-pages.$code.button.name") !!}</span>
        </a>
    </p>
</div>
<div class="body-content">
    <div class="row">
        <div class="col-md-6">
            <h2>{!! trans("server-error-pages::server-error-pages.$code.why.title") !!}</h2>
            <p class="lead">{!! trans("server-error-pages::server-error-pages.$code.why.description") !!}</p>
        </div>
        <div class="col-md-6">
            <h2>{!! trans("server-error-pages::server-error-pages.$code.what_do.title") !!}</h2>
            <p class="lead">{!! trans("server-error-pages::server-error-pages.$code.what_do.visitor.title") !!}</p>
            <p>{!! trans("server-error-pages::server-error-pages.$code.what_do.visitor.description", ['domain'=> request()->getHost()]) !!}</p>
            <p class="lead">{!! trans("server-error-pages::server-error-pages.$code.what_do.owner.title") !!}</p>
            <p>{!! trans("server-error-pages::server-error-pages.$code.what_do.owner.description") !!}</p>
        </div>
    </div>
</div>
<!-- End Error Page Content -->
<!--Scripts-->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

@endsection