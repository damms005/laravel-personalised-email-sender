@extends('master-voyager-theme')

@section('page_title', 'Application for Role - ' . $jobAdvert->jobPosition->name)

@section('page_header')
Job Application - {{$jobAdvert->jobPosition->name}}
@stop

@section('content')
<div class="page-content browse container-fluid">
	@include('voyager::alerts')
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-bordered">

				@if (isset($formFilled))

				<div class="p-12 leading-loose text-2xl">
					<h3>
						Your application has been submitted successfully.
					</h3>
					<br>
					Please check back here for updates on your application.
					<br>
					You can click on the "<a href="{{route('job-application-status')}}">Status</a>" link in the navigation menu.
					<br>
					We may also contact you anytime there is an update on your application.
					<br>
					<br>
					Thank you.
				</div>

				@else

				<div class="panel-body">
					<h5>
						Please fill the form below correctly:
					</h5>
				</div>

				<div class="border rounded bg-grey-lightest p-12">

					{!! Form::model( $user, [ 'files' => true , 'url' => route( 'submit-job-application', [ 'jobAdvert'=>$jobAdvert->id , 'user'=>$user->id ] ) ] ) !!}

					<div class="p-8">
						{{Form::label('lastname', 'Surname')}} <br>
						{{Form::text('lastname',null,['class'=>'border p-2 w-1/3'])}}
					</div>

					<div class="p-8">
						{{Form::label('firstname', 'Other names')}} <br>
						{{Form::text('firstname',null,['class'=>'border p-2 w-1/3'])}}
					</div>

					<div class="p-8">
						{{Form::label('address', 'Contact Address')}} <br>
						{{Form::textarea('address',null,['class'=>'border p-2 w-1/3', 'maxlength'=>300])}}
					</div>

					<div class="p-8">
						{{Form::label('phone_number', 'Contact Phone Number')}} <br>
						{{Form::text('phone_number',null,['class'=>'border p-2 w-1/3'])}}
					</div>

					<div class="p-8">
						{{Form::label('cv', 'Attach Your CV (note: pdf file only)')}} <br>
						{{Form::file('cv' , ['class'=>'p-2 w-1/3'])}}
					</div>

					<div class="p-8">
						{{Form::label('sell_yourself', 'In a few words, why do you believe that you are suitable for this job position?')}} <br>
						{{Form::textarea('sell_yourself',null,['class'=>'border p-2 w-1/3', 'maxlength'=>300])}}
					</div>

					<div class="p-8">
						{{Form::submit('Submit Application',['class'=>'bg-blue text-white hover:shadow rounded border p-4'])}}
					</div>

					{{ Form::close() }}

				</div>

				@endif

			</div>
		</div>
	</div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">
@stop

@section('javascript')
<!-- DataTables -->
<script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>
<script>
	//inits. Do js from mix()
</script>
@stop