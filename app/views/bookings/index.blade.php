@extends('layout')

@section('content')
	<div class="col-xs-12">
		@foreach($bookings as $booking)
			<div class="row" style="padding: 10px 0">
				<strong>{{ $booking->room->name }}</strong> prenotata da <a href="mailto:{{ $booking->user->email}}">{{ $booking->user->name}}</a> da {{ $booking->from }} a {{ $booking->to }}
				{{ Form::open(array('url' => URL::route('bookings.destroy', $booking->id), 'method' => 'delete')) }}
					{{ Form::submit('Destroy', array('class' => 'btn btn-danger btn-xs')) }}
				{{ Form::close() }} <a class="btn btn-warning btn-xs" href="{{ URL::route('bookings.edit', $booking->id) }}">Edit</a>
			</div>
		@endforeach
		<div class="row">
			<a class="btn btn-primary" href="{{ URL::route('bookings.create') }}">Create new</a>
		</div>
	</div>
@stop