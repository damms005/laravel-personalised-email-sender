@if ( $errors->any() )
<h6>
	@foreach ( $errors->all() as $message )
	<p class="bg-blue-darkest text-white p-4">{{$message}}</p>
	@endforeach

	<br>
	<br>
</h6>
@endif