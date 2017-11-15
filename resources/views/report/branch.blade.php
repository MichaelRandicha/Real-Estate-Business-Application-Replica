@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Branch Activity Report</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif
		@include('report.nav')

		<form class="form-horizontal" method="GET" action="{{ route('report.branch') }}" id="closing">

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

			<div class="form-group{{ $errors->has('branch') ? ' has-error' : '' }}">
				<label for="branch" class="col-md-4 control-label">Branch</label>

				<div class="col-md-6">
					<select name="branch" class="form-control" required>
						@foreach($cabangs as $cabang)
						<option value="{{ $cabang->id }}" @if(old('branch') == $cabang->id) selected @elseif(request()->branch == $cabang->id) selected @endif>{{ $cabang->nama }}</option>
						@endforeach
					</select>
					@if ($errors->has('branch'))
					<span class="help-block">
						<strong>{{ $errors->first('branch') }}</strong>
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
		@unless(empty($branchs))
		<div>
			<select name="no" style="padding: 5px 10px;margin: 10px 0 20px;border-radius: 4px;" class="btn-md" form="closing" onchange="this.form.submit()">
				@for($i = 1; $i <= 4; $i++)
				<option value="{{ $i * 5 }}" @if(request()->no / 5 == $i) selected @endif>{{ $i * 5 }}</option>
				@endfor
			</select>
			Baris
			<a href="{{ route('report.branch.list', ['dateFrom' => request()->dateFrom, 'dateTo' => request()->dateTo, 'branch' => request()->branch]) }}" class="btn btn-md btn-outline-primary" style="float:right" target="_blank">Print Report</a>
		</div>

		<table class="table table-sm table-hover table-bordered">
			<thead class="thead-blue">
				<tr>
					<th scope="col" class="text-center" style="width: 30px">No</th>
					<th scope="col">Agent Name</th>
					<th scope="col">Property</th>
					<th scope="col">Sold Date</th>
					<th scope="col">Closing Price</th>
					<th scope="col">Agent Income</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($branchs as $branch)
				<tr>
					<td class="text-center">{{ (($branchs->currentPage() - 1) * request()->no) + $loop->iteration }}</td>
					<td>{{ $branch->agent->nama }}</td>
					<td>{{ $branch->closing->nama }}</td>
					<td>{{ date("d F Y", strtotime($branch->closing->tanggal)) }}</td>
					<td>Rp. {{ number_format($branch->closing->harga, 2, ',', '.') }}</td>
					<td>Rp. {{ number_format($branch->komisi, 2, ',', '.') }}</td>
					<td class="text-center"><a href="{{ route('closing.view', ['id' => $branch->closing->id]) }}" class="btn btn-outline-primary btn-xs">View</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $branchs->links() }}
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
				}
			}
		});
	})
</script>
@endsection