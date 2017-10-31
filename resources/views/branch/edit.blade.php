@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Edit Branch</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif
		<form class="form-horizontal" method="POST" action="{{ route('changeBranch', ['id' => $cabang->id]) }}">
			{{ csrf_field() }}

			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="name" class="col-md-4 control-label">Branch Name</label>

				<div class="col-md-6">
					<input id="name" type="text" class="form-control" name="name" value={{ $cabang->nama }} required autofocus>

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
					<input id="location" type="text" class="form-control" name="location" value={{ $cabang->lokasi }} required>

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
					<input id="phone" type="text" pattern="^[0-9]{1,12}$" class="form-control" name="phone" value="{{ $cabang->telepon }}" required>

					@if ($errors->has('phone'))
					<span class="help-block">
						<strong>{{ $errors->first('phone') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('principal') ? ' has-error' : '' }}">
				<label for="principal" class="col-md-4 control-label">Principal</label>

				<div class="col-md-6">
					<select name="principal" id="principal" class="form-control">
					    <option value="0" selected></option>
						@foreach($cabang->member as $agent)
							@if($agent->id > 1)
					    		<option value={{ $agent->id }} @if($cabang->principal_id == $agent->id) selected @endif @if($cabang->vice_id == $agent->id) hidden @endif>{{ $agent->nama }}</option>
					    	@endif
					    @endforeach
					</select>
					@if ($errors->has('principal'))
					<span class="help-block">
						<strong>{{ $errors->first('principal') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('vice') ? ' has-error' : '' }}">
				<label for="vice" class="col-md-4 control-label">Vice Principal</label>

				<div class="col-md-6">
					<select name="vice" id="vice" class="form-control">
					    <option value="0" selected></option>
					    @foreach($cabang->member as $agent)
					    		<option value={{ $agent->id }} @if($cabang->vice_id == $agent->id) selected @endif @if($cabang->principal_id == $agent->id) hidden @endif>{{ $agent->nama }}</option>
					    @endforeach
					</select>
					@if ($errors->has('vice'))
					<span class="help-block">
						<strong>{{ $errors->first('vice') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-outline-primary">
						Save
					</button>
					<a href="{{ route('viewBranch', ['id' => $cabang->id]) }}" class="btn btn-outline-danger">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var principal = document.getElementById("principal");
		var vice = document.getElementById("vice");

		$('#principal').on('change', function () {
			var index = principal.selectedIndex;
			
			var option = vice.children;

			for (var i = 0; i < option.length; i++) {
				option[i].removeAttribute("hidden");
			}
			if(principal.value > 0){
				option[index].setAttribute('hidden', '');
			}
		});

		$('#vice').on('change', function () {
			var index = vice.selectedIndex;
			
			var option = principal.children;

			for (var i = 0; i < option.length; i++) {
				option[i].removeAttribute("hidden");
			}
			if(vice.value > 0){
				option[index].setAttribute('hidden', '');				
			}
		});
	});
</script>
@endsection