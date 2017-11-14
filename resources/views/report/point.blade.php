@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Top Agent By Point Report</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif
		@include('report.nav')

		<form class="form-horizontal" method="GET" action="{{ route('report.point') }}" id="closing">

			<div class="form-group{{ $errors->has('dateFrom') ? ' has-error' : '' }}">
				<label for="dateFrom" class="col-md-4 control-label">Date From</label>

				<div class="col-md-6">
					<input id="dateFrom" type="date" class="form-control" name="dateFrom" value="@if(empty(request()->dateFrom)){{ old('dateFrom') }}@else{{ request()->dateFrom }}@endif" required autofocus>

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
					<input id="dateTo" type="date" class="form-control" name="dateTo" value="@if(empty(request()->dateTo)){{ old('dateTo') }}@else{{ request()->dateTo }}@endif" required>

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
		@unless(empty($points))
			<div>
				<select name="no" style="padding: 5px 10px;margin: 10px 0 20px;border-radius: 4px;" class="btn-md" form="closing" onchange="this.form.submit()">
					@for($i = 1; $i <= 4; $i++)
						<option value="{{ $i * 5 }}" @if(request()->no / 5 == $i) selected @endif>{{ $i * 5 }}</option>
					@endfor
				</select>
				Baris
				<a href="{{ route('report.point.list', ['dateFrom' => request()->dateFrom, 'dateTo' => request()->dateTo]) }}" class="btn btn-md btn-outline-primary" style="float:right" target="_blank">Print Report</a>
			</div>

			<table class="table table-sm table-hover table-bordered">
				<thead class="thead-blue">
					<tr>
						<th scope="col" class="text-center" style="width: 30px">No</th>
						<th scope="col">Agent Name</th>
						<th scope="col">Branch Name</th>
						<th scope="col">Total Point</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($points as $point)
						<tr>
							<td class="text-center">{{ (($points->currentPage() - 1) * request()->no) + $loop->iteration }}</td>
							<td>{{ $point->agent->nama }}</td>
							<td>{{ $point->cabang->nama }}</td>
							<td>{{ $point->total_point }}</td>
							<td class="text-center"><a href="{{ route('agent.view', ['id' => $point->agent->id]) }}" class="btn btn-outline-primary btn-xs">View</a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{{ $points->links() }}
		@endunless
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