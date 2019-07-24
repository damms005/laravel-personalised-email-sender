<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
	<title>Start Job Application</title>
</head>

<body class="bg-grey-lighter h-screen font-sans">
	<div class="container mx-auto h-full flex justify-center items-center">

		<div class="w-1/3">

			@include('partials.errors-and-flashes')

			@if (isset($showVerificationSentMessage))

			<div class="leading-loose">

				<h4 class="leading-loose justify">
					We need to verify your email address.
				</h4>

				<br>
				Please check your email address <span class="p-1 bg-black text-white rounded font-mono">{{$user->email}}</span> for a confirmation link.
				<br>
				<br>
				<div>
					You will need to click on the confirmation link in your email address in order to continue with your application.
				</div>
				<br>
				<div>
					If you have not had any email correspondence from
					<span class="text-grey-darker font-bold">
						{{$jobAdvert->jobPosition->company->name}}
					</span>
					before now, you may need to check your
					Spam Folder for the confirmation link.
				</div>

				<br>
				<br>
				Thank you.
				<br>
				<br>
			</div>
			<br>

			@else

			@if (isset($jobAdvert))

			<h1 class="font-hairline mb-6 text-center leading-loose ">Enter your email to start your job application</h1>
			<div class="border-teal p-8 border-t-12 bg-white mb-6 rounded-lg shadow-lg">

				<br>
				<form action="{{ route( 'job-application-start-page', ['jobAdvert' => $jobAdvert] ) }}" method="POST">
					{{ csrf_field() }}
					<div class="mb-4">
						<label class="font-bold text-grey-darker block mb-2">Email:</label>
						<input type="email" name="email" value="{{ old('email') }}" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey p-4 rounded shadow text-blue-darkest" placeholder="Enter your email address">
					</div>

					<br>

					{!! NoCaptcha::renderJs() !!}

					<div class="flex items-center justify-between">
						<button type="submit" class="bg-teal-dark hover:bg-teal text-white font-bold py-2 px-4 rounded">
							Submit
						</button>
					</div>
				</form>
				<br>
				<br>
			</div>

			@else

			No advert placements at the moment

			@endif

			@endif

		</div>
	</div>
</body>

</html>