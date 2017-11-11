@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Closing List Report</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif
		@include('report.nav')
		<form class="form-horizontal" method="GET" action="{{ route('closing.register') }}">

			<div class="form-group{{ $errors->has('dateFrom') ? ' has-error' : '' }}">
				<label for="dateFrom" class="col-md-4 control-label">Date From</label>

				<div class="col-md-6">
					<input id="dateFrom" type="date" class="form-control" name="dateFrom" value="{{ old('dateFrom') }}" required autofocus>

					@if ($errors->has('dateFrom'))
					<span class="help-block">
						<strong>{{ $errors->first('dateFrom') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('dateTo') ? ' has-error' : '' }}">
				<label for="dateTo" class="col-md-4 control-label">Date To</label>

				<div class="col-md-6">
					<input id="dateTo" type="date" class="form-control" name="dateTo" value="{{ old('dateTo') }}" required>

					@if ($errors->has('dateTo'))
					<span class="help-block">
						<strong>{{ $errors->first('dateTo') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-outline-primary">
						Get Report
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var dateFrom = document.getElementById('dateFrom');
		var dateTo = document.getElementById('dateTo');
		$('#dateFrom').on('change', function(){
			if(dateFrom.value == ""){
				dateTo.removeAttribute('min');
			}else{
				dateTo.setAttribute('min', dateFrom.value);
				if(dateTo.value < dateFrom.value && dateTo.value != ""){
					dateTo.value = dateFrom.value;
					dateTo.stepUp(1);
				}
			}
		});
	})
</script>
@endsection