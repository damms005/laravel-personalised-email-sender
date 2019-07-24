<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
	<title>Oops!</title>
</head>

<body class="bg-grey-lighter h-screen font-sans">
	<div class="container mx-auto h-full flex justify-center items-center">

		<div class="w-1/3">

			@include('partials.errors-and-flashes')

			<div class="leading-loose">
				<h1>
					Oops!
				</h1>
				<br>
				Sorry, you ended up on a blank page!
				<br>
				<br>
				Please send details of this uncomfortable experience to <span class="p-1 bg-black text-white rounded font-mono">hr@schoolserver.com.ng</span>

				<br>
				<br>
				<h5>Thank you!</h5>
				<br>
				<br>
			</div>
			<br>
		</div>
	</div>
</body>

</html>