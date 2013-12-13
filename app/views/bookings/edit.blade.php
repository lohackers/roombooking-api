@extends('layout')

@section('content')
	<div class="row">
		<div class="col-xs-6">
			<h2>Edit booking</h2>
			{{ Form::open(array('url' => URL::route('bookings.update', $booking->id), 'method' => 'PUT')) }}
				<div class="form-group">
					{{ Form::label('room_id', 'Room') }}
					{{ Form::select('room_id', $rooms, $booking->room_id, array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('user_id', 'User') }}
					{{ Form::select('user_id', $users, $booking->user_id, array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('from', 'From') }}
					{{ Form::text('from', $booking->from, array('id' => 'from', 'class' => 'form-control')) }}

					{{ Form::label('to', 'To') }}
					{{ Form::text('to', $booking->to, array('id' => 'to', 'class' => 'form-control')) }}
				</div>
				<div>
					{{ Form::submit('Update', array('class' => 'btn btn-primary')) }} <a class="btn btn-success" href="{{ URL::route('bookings.index') }}">All bookings</a>
				</div>
			{{ Form::close() }}
		</div>
	</div>

	<script type="text/javascript">
		$('#from').datetimepicker({ 'dateFormat': 'yy-mm-dd' });
		$('#to').datetimepicker({ 'dateFormat': 'yy-mm-dd' });
	</script>
@stop
