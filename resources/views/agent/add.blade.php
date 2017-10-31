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

			<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
				<label for="location" class="col-md-4 control-label">Location</label>

				<div class="col-md-6">
					<input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" required>

					@if ($errors->has('location'))
					<span class="help-block">
						<strong>{{ $errors->first('location') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
				<label for="phone" class="col-md-4 control-label">Phone Number</label>

				<div class="col-md-6">
					<input id="phone" type="number" class="form-control" name="phone" required>

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
					<select name="branch" class="form-control" required>
					    @foreach($cabangs as $cabang)
					    	<option value={{ $cabang->id }} @if($loop->first) selected @endif>{{ $cabang->nama }}</option>
					    @endforeach
					</select>
					@if ($errors->has('branch'))
					<span class="help-block">
						<strong>{{ $errors->first('branch') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('upline') ? ' has-error' : '' }}">
				<label for="upline" class="col-md-4 control-label">Upline Agent Name</label>

				<div class="col-md-6">
					<select name="upline" class="form-control" @if(count(App\Agent::all()) > 2) required @endif>
					     @if(count(App\Agent::all()) == 1)
					     	<option value="0" selected></option>
					     @endif
					     @foreach($agents as $agent)
					     	<option value={{ $agent->id }}>{{ $agent->nama }}</option>
					     @endforeach
					</select>

					@if ($errors->has('upline'))
					<span class="help-block">
						<strong>{{ $errors->first('upline') }}</strong>
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