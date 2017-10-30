@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Add New Branch</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif
		<form class="form-horizontal" method="POST" action="{{ route('registerBranch') }}">
			{{ csrf_field() }}

			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="name" class="col-md-4 control-label">Branch Name</label>

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
					<input id="phone" type="number" pattern="^[0-9]*{1,12}$" class="form-control" name="phone" required>

					@if ($errors->has('phone'))
					<span class="help-block">
						<strong>{{ $errors->first('phone') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('president') ? ' has-error' : '' }}">
				<label for="president" class="col-md-4 control-label">President</label>

				<div class="col-md-6">
					<select name="president" id="president" class="form-control">
					    <option value="0" selected></option>
					    <option value="1">Alpha</option>
					    <option value="2">Bravo</option>
					    <option value="3">Charlie</option>
					</select>
					@if ($errors->has('president'))
					<span class="help-block">
						<strong>{{ $errors->first('president') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('vice') ? ' has-error' : '' }}">
				<label for="vice" class="col-md-4 control-label">Vice President</label>

				<div class="col-md-6">
					<select name="vice" id="vice" class="form-control">
					    <option value="0" selected></option>
					    <option value="1">Alpha</option>
					    <option value="2">Bravo</option>
					    <option value="3">Charlie</option>
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
					<a href="{{ route('branch') }}" class="btn btn-outline-danger">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var president = document.getElementById("president");
		var vice = document.getElementById("vice");

		$('#president').on('change', function () {
			var index = president.selectedIndex;
			
			var option = vice.children;

			// if(vice.selectedIndex == index && president.value > 0){
			// 	if(index == option.length - 1){
			// 		vice.selectedIndex = index - 1;
			// 	}else{
			// 		vice.selectedIndex = index+1;
			// 	}
			// }

			for (var i = 0; i < option.length; i++) {
				option[i].removeAttribute("hidden");
			}
			if(president.value > 0){
				option[index].setAttribute('hidden', '');
			}
		});

		$('#vice').on('change', function () {
			var index = vice.selectedIndex;
			
			var option = president.children;

			// if(president.selectedIndex == index && vice.value > 0){
			// 	if(index == option.length - 1){
			// 		president.selectedIndex = index - 1;
			// 	}else{
			// 		president.selectedIndex = index + 1;
			// 	}
			// }

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