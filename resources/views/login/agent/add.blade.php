@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Add New Agent</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif

		<form class="form-horizontal" method="POST" action="{{ route('registerAgent') }}">
			{{ csrf_field() }}

			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="name" class="col-md-4 control-label">Agent Name</label>

				<div class="col-md-6">
					<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

					@if ($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
				<label for="address" class="col-md-4 control-label">Address</label>

				<div class="col-md-6">
					<input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required>

					@if ($errors->has('address'))
					<span class="help-block">
						<strong>{{ $errors->first('address') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
				<label for="phone" class="col-md-4 control-label">Phone Number</label>

				<div class="col-md-6">
					<input id="phone" type="number" pattern="^[0-9]*{1,12}$" class="form-control" name="phone" required>

					@if ($errors->has('phone'))
					<span class="help-block">
						<strong>{{ $errors->first('phone') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('branch') ? ' has-error' : '' }}">
				<label for="branch" class="col-md-4 control-label">Branch</label>

				<div class="col-md-6">
					<select name="branch" class="form-control">
					     <option value="1" selected>A</option>
					     <option value="2">B</option>
					     <option value="3">C</option>
					</select>
					@if ($errors->has('branch'))
					<span class="help-block">
						<strong>{{ $errors->first('branch') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
				<label for="username" class="col-md-4 control-label">Username Upline (Optional)</label>

				<div class="col-md-6">
					<input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">

					@if ($errors->has('username'))
					<span class="help-block">
						<strong>{{ $errors->first('username') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-outline-primary">
						Save
					</button>
					<a href="{{ route('agent') }}" class="btn btn-outline-danger">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection