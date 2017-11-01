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
		<form class="form-horizontal" method="POST" action="{{ route('registerClosing') }}">
			{{ csrf_field() }}

			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="name" class="col-md-4 control-label">Property Name</label>

				<div class="col-md-6">
					<input id="address" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

					@if ($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
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
				<label for="price" class="col-md-4 control-label">Commission Money</label>

				<div class="col-md-6">
					<input id="price" type="number" class="form-control" name="price" required>

					@if ($errors->has('price'))
					<span class="help-block">
						<strong>{{ $errors->first('price') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('agent.0') ? ' has-error' : '' }}" required>
				<label for="agent[0]" class="col-md-4 control-label">Agent 1 Name</label>

				<div class="col-md-6">
					<select name="agent[0]" id="agent1" class="form-control">
					    <option value="0" disabled hidden></option>
					    @foreach($agents as $agent)	
					    	<option value="{{ $agent->id }}">{{ $agent->nama }}</option>
					    @endforeach
					</select>
					@if ($errors->has('agent.0'))
					<span class="help-block">
						<strong>{{ $errors->first('agent.0') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('agent.1') ? ' has-error' : '' }}">
				<label for="agent[1]" class="col-md-4 control-label">Agent 2 Name</label>

				<div class="col-md-6">
					<select name="agent[1]" id="agent2" class="form-control">
					    <option value="0" selected></option>
					    @foreach($agents as $agent)	
					    	<option value="{{ $agent->id }}">{{ $agent->nama }}</option>
					    @endforeach
					</select>
					@if ($errors->has('agent.1'))
					<span class="help-block">
						<strong>{{ $errors->first('agent.1') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('agent.2') ? ' has-error' : '' }}">
				<label for="agent[2]" class="col-md-4 control-label">Agent 3 Name</label>

				<div class="col-md-6">
					<select name="agent[2]" id="agent3" class="form-control">
					    <option value="0" selected></option>
					    @foreach($agents as $agent)	
					    	<option value="{{ $agent->id }}">{{ $agent->nama }}</option>
					    @endforeach
					</select>
					@if ($errors->has('agent.2'))
					<span class="help-block">
						<strong>{{ $errors->first('agent.2') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('agent.3') ? ' has-error' : '' }}">
				<label for="agent[3]" class="col-md-4 control-label">Agent 4 Name</label>

				<div class="col-md-6">
					<select name="agent[3]" id="agent4" class="form-control">
					    <option value="0" selected></option>
					    @foreach($agents as $agent)	
					    	<option value="{{ $agent->id }}">{{ $agent->nama }}</option>
					    @endforeach
					</select>
					@if ($errors->has('agent.3'))
					<span class="help-block">
						<strong>{{ $errors->first('agent.3') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-outline-primary">
						Save
					</button>
					<a href="{{ route('closing') }}" class="btn btn-outline-danger">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var agent1 = document.getElementById("agent1");
		var agent2 = document.getElementById("agent2");
		var agent3 = document.getElementById("agent3");
		var agent4 = document.getElementById("agent4");

		var one = agent1.children;
		var two = agent2.children;
		var three = agent3.children;
		var four = agent4.children;

		var indexOne = agent1.selectedIndex;

		if(agent1.value > 0){
			two[indexOne].setAttribute('hidden', '');
			three[indexOne].setAttribute('hidden', '');
			four[indexOne].setAttribute('hidden', '');
		}
		if(agent2.value > 0){
			one[indexTwo].setAttribute('hidden', '');
			three[indexTwo].setAttribute('hidden', '');
			four[indexTwo].setAttribute('hidden', '');
		}
		if(agent3.value > 0){
			one[indexThree].setAttribute('hidden', '');
			two[indexThree].setAttribute('hidden', '');
			four[indexThree].setAttribute('hidden', '');
		}
		
		$('#agent1').on('change', function () {
			var indexOne = agent1.selectedIndex;
			var indexTwo = agent2.selectedIndex;
			var indexThree = agent3.selectedIndex;
			var indexFour = agent4.selectedIndex;

			for (var i = 0; i < two.length; i++) {
				two[i].removeAttribute("hidden");
			}

			for (var i = 0; i < three.length; i++) {
				three[i].removeAttribute("hidden");
			}

			for (var i = 0; i < four.length; i++) {
				four[i].removeAttribute("hidden");
			}

			if(agent1.value > 0){
				two[indexOne].setAttribute('hidden', '');
				three[indexOne].setAttribute('hidden', '');
				four[indexOne].setAttribute('hidden', '');
			}
			if(agent2.value > 0){
				one[indexTwo].setAttribute('hidden', '');
				three[indexTwo].setAttribute('hidden', '');
				four[indexTwo].setAttribute('hidden', '');
			}
			if(agent3.value > 0){
				one[indexThree].setAttribute('hidden', '');
				two[indexThree].setAttribute('hidden', '');
				four[indexThree].setAttribute('hidden', '');
			}
			if(agent4.value > 0){
				one[indexFour].setAttribute('hidden', '');
				two[indexFour].setAttribute('hidden', '');
				three[indexFour].setAttribute('hidden', '');
			}
		});

		$('#agent2').on('change', function () {
			var indexOne = agent1.selectedIndex;
			var indexTwo = agent2.selectedIndex;
			var indexThree = agent3.selectedIndex;
			var indexFour = agent4.selectedIndex;
			
			for (var i = 1; i < one.length; i++) {
				one[i].removeAttribute("hidden");
			}

			for (var i = 0; i < three.length; i++) {
				three[i].removeAttribute("hidden");
			}

			for (var i = 0; i < four.length; i++) {
				four[i].removeAttribute("hidden");
			}

			if(agent1.value > 0){
				two[indexOne].setAttribute('hidden', '');
				three[indexOne].setAttribute('hidden', '');
				four[indexOne].setAttribute('hidden', '');
			}
			if(agent2.value > 0){
				one[indexTwo].setAttribute('hidden', '');
				three[indexTwo].setAttribute('hidden', '');
				four[indexTwo].setAttribute('hidden', '');
			}
			if(agent3.value > 0){
				one[indexThree].setAttribute('hidden', '');
				two[indexThree].setAttribute('hidden', '');
				four[indexThree].setAttribute('hidden', '');
			}
			if(agent4.value > 0){
				one[indexFour].setAttribute('hidden', '');
				two[indexFour].setAttribute('hidden', '');
				three[indexFour].setAttribute('hidden', '');
			}
		});

		$('#agent3').on('change', function () {
			var indexOne = agent1.selectedIndex;
			var indexTwo = agent2.selectedIndex;
			var indexThree = agent3.selectedIndex;
			var indexFour = agent4.selectedIndex;
			
			for (var i = 1; i < one.length; i++) {
				one[i].removeAttribute("hidden");
			}

			for (var i = 0; i < two.length; i++) {
				two[i].removeAttribute("hidden");
			}

			for (var i = 0; i < four.length; i++) {
				four[i].removeAttribute("hidden");
			}

			if(agent1.value > 0){
				two[indexOne].setAttribute('hidden', '');
				three[indexOne].setAttribute('hidden', '');
				four[indexOne].setAttribute('hidden', '');
			}
			if(agent2.value > 0){
				one[indexTwo].setAttribute('hidden', '');
				three[indexTwo].setAttribute('hidden', '');
				four[indexTwo].setAttribute('hidden', '');
			}
			if(agent3.value > 0){
				one[indexThree].setAttribute('hidden', '');
				two[indexThree].setAttribute('hidden', '');
				four[indexThree].setAttribute('hidden', '');
			}
			if(agent4.value > 0){
				one[indexFour].setAttribute('hidden', '');
				two[indexFour].setAttribute('hidden', '');
				three[indexFour].setAttribute('hidden', '');
			}
		});

		$('#agent4').on('change', function () {
			var indexOne = agent1.selectedIndex;
			var indexTwo = agent2.selectedIndex;
			var indexThree = agent3.selectedIndex;
			var indexFour = agent4.selectedIndex;
			
			for (var i = 1; i < one.length; i++) {
				one[i].removeAttribute("hidden");
			}

			for (var i = 0; i < two.length; i++) {
				two[i].removeAttribute("hidden");
			}

			for (var i = 0; i < three.length; i++) {
				three[i].removeAttribute("hidden");
			}

			if(agent1.value > 0){
				two[indexOne].setAttribute('hidden', '');
				three[indexOne].setAttribute('hidden', '');
				four[indexOne].setAttribute('hidden', '');
			}
			if(agent2.value > 0){
				one[indexTwo].setAttribute('hidden', '');
				three[indexTwo].setAttribute('hidden', '');
				four[indexTwo].setAttribute('hidden', '');
			}
			if(agent3.value > 0){
				one[indexThree].setAttribute('hidden', '');
				two[indexThree].setAttribute('hidden', '');
				four[indexThree].setAttribute('hidden', '');
			}
			if(agent4.value > 0){
				one[indexFour].setAttribute('hidden', '');
				two[indexFour].setAttribute('hidden', '');
				three[indexFour].setAttribute('hidden', '');
			}
		});

	});
</script>
@endsection