@extends('master-voyager-theme')

@section('page_title', 'Applicants')

@section('page_header')
Job Applicants - Send Customized Emails
@stop


@section('content')
<div id="app">
	<vue-templater></vue-templater>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset(mix('css/app.css'))}}">
<link rel="stylesheet" href="{{asset('css/tailwind-v1.css')}}">
@endsection

@section('javascript')
<script src="{{asset(mix('js/app.js'))}}"></script>
@endsection