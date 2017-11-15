@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Highest Commission Report</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif
		@include('report.nav')

		<form class="form-horizontal" method="GET" action="{{ route('report.commission') }}" id="closing">

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
				<div class="col-md-4 control-label"></div>
				<div class="col-md-6">
					<div class="btn-group" data-toggle="buttons" style="width:100%;">
						<label class="btn btn-primary @if(request()->filter == "agent")active @elseif(request()->filter == "")active @endif">
							<input type="radio" name="filter" value="agent" @if(request()->filter == "agent") checked @elseif(request()->filter == "") checked @endif> Agent 
						</label>
						<label class="btn btn-primary @if(request()->filter == "branch") active @endif">
							<input type="radio" name="filter" value="branch" @if(request()->filter == "branch") checked @endif> Branch
						</label>
					</div>
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
		@unless(empty($commissions))
		<div>
			<select name="no" style="padding: 5px 10px;margin: 10px 0 20px;border-radius: 4px;" class="btn-md" form="closing" onchange="this.form.submit()">
				@for($i = 1; $i <= 4; $i++)
				<option value="{{ $i * 5 }}" @if(request()->no / 5 == $i) selected @endif>{{ $i * 5 }}</option>
				@endfor
			</select>
			Baris
			<a href="{{ route('report.commission.list', ['dateFrom' => request()->dateFrom, 'dateTo' => request()->dateTo, 'filter' => request()->filter]) }}" class="btn btn-md btn-outline-primary" style="float:right" target="_blank">Print Report</a>
		</div>

		<table class="table table-sm table-hover table-bordered">
			<thead class="thead-blue">
				<tr>
					<th scope="col" class="text-center" style="width: 30px">No</th>
					@if(request()->filter == "agent")
					<th scope="col">Agent Name</th>
					@elseif(request()->filter == "branch")
					<th scope="col">Branch Name</th>
					@endif
					<th scope="col">Total Commission</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($commissions as $commission)
				<tr>
					<td class="text-center">{{ (($commissions->currentPage() - 1) * request()->no) + $loop->iteration }}</td>
					@if(request()->filter == "agent")
					<td>{{ $commission->agent->nama }}</td>
					@elseif(request()->filter == "branch")
					<td>{{ $commission->cabang->nama }}</td>
					@endif
					<td>Rp. {{ number_format($commission->total_komisi, 2, ',', '.') }}</td>
					@if(request()->filter == "agent")
					<td class="text-center"><a href="{{ route('agent.view', ['id' => $commission->agent->id]) }}" class="btn btn-outline-primary btn-xs">View</a></td>
					@elseif(request()->filter == "branch")
					<td class="text-center"><a href="{{ route('branch.view', ['id' => $commission->cabang->id]) }}" class="btn btn-outline-primary btn-xs">View</a></td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $commissions->links() }}
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