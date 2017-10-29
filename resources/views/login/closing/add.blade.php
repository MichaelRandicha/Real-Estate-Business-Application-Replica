@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">New Closing</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif
		<form class="form-horizontal" method="POST" action="{{ route('register') }}">
			{{ csrf_field() }}

			<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
				<label for="address" class="col-md-4 control-label">Property Address</label>

				<div class="col-md-6">
					<input id="address" type="text" class="form-control" address="address" value="{{ old('address') }}" required autofocus>

					@if ($errors->has('address'))
					<span class="help-block">
						<strong>{{ $errors->first('address') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
				<label for="date" class="col-md-4 control-label">Closing date</label>

				<div class="col-md-6">
					<input id="date" type="date" class="form-control" name="date" value="{{ old('date') }}" required>

					@if ($errors->has('date'))
					<span class="help-block">
						<strong>{{ $errors->first('date') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
				<label for="price" class="col-md-4 control-label">Property Price</label>

				<div class="col-md-6">
					<input id="price" type="number" class="form-control" name="price" required>

					@if ($errors->has('price'))
					<span class="help-block">
						<strong>{{ $errors->first('price') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-outline-primary">
						Save
					</button>
					<a href="{{ route('branch') }}" class="btn btn-outline-danger">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection