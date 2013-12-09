@extends('layout')

@section('content')
	@foreach($bookings as $booking)
		<p>
			<strong>{{ $booking->room->name }}</strong> prenotata da <a href="mailto:{{ $booking->user->email}}">{{ $booking->user->name}}</a> da {{ $booking->from }} a {{ $booking->to }}
		</p>
	@endforeach
@stop