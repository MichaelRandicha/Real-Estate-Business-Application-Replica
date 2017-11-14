@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Closing Information</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif
		<table class="table table-bordered table-hover">
			<tbody>
				<tr>
					<td style="width:20%">Property Name</td>
					<td>{{ $closing->nama }}</td>
				</tr>
				<tr>
					<td>Sold Date</td>
					<td>{{ date("d F Y", strtotime($closing->tanggal)) }}</td>
				</tr>
				<tr>
					<td>Closing Price</td>
					<td>Rp. {{ number_format($closing->harga, 2, ',', '.') }}</td>
				</tr>
			</tbody>
		</table>

		<table class="table table-bordered table-hover">
			<thead class="thead-light">
				<tr>
					<th style="width:20%"></th>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<th>Agent {{ $loop->iteration }}</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Agent Name</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>{{ $agentclosing->agent->nama }} From {{ $agentclosing->cabang->nama }}</td>
					@endforeach
				</tr>
				<tr>
					<td>Total Comission</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>Rp. {{ number_format($agentclosing->komisi, 2, ',', '.') }}</td>
					@endforeach
				</tr>
				<tr>
					<td>Agent Upline 1</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>{{ $agentclosing->upline1->nama }}</td>
					@endforeach
				</tr>
				<tr>
					<td>7% Comission</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>Rp. {{ number_format($agentclosing->upline1_komisi, 2, ',', '.') }}</td>
					@endforeach
				</tr>
				<tr>
					<td>Agent Upline 2</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>{{ $agentclosing->upline2->nama }}</td>
					@endforeach
				</tr>
				<tr>
					<td>2% Comission</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>Rp. {{ number_format($agentclosing->upline2_komisi, 2, ',', '.') }}</td>
					@endforeach
				</tr>
				<tr>
					<td>Agent Upline 3</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>{{ $agentclosing->upline3->nama }}</td>
					@endforeach
				</tr>
				<tr>
					<td>1% Comission</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>Rp. {{ number_format($agentclosing->upline3_komisi, 2, ',', '.') }}</td>
					@endforeach
				</tr>
				<tr>
					<td>Principal</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>{{ $agentclosing->principal->nama }}</td>
					@endforeach
				</tr>
				<tr>
					<td>6% Comission</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>Rp. {{ number_format($agentclosing->principal_komisi, 2, ',', '.') }}</td>
					@endforeach
				</tr>
				<tr>
					<td>Vice Principal</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>{{ $agentclosing->vice->nama }}</td>
					@endforeach
				</tr>
				<tr>
					<td>4% Comission</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>Rp. {{ number_format($agentclosing->vice_komisi, 2, ',', '.') }}</td>
					@endforeach
				</tr>
			</tbody>
		</table>
		<div style="margin:0 auto; text-align: center;">
			<a href="{{ route('closing') }}" class="btn btn-outline-success">Back</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	function del (event){
		event.preventDefault()
		$.confirm({
			title: 'Caution!',
			content: 'Delete BranchA?',
			theme: 'modern',
			type: 'red',
			closeIcon: true,
			backgroundDismiss: true,
			buttons: {
				yes: function () {
					document.getElementById('del').click()
				},
				cancel: {
					keys: ['esc'],
					action: function () {
					}
				}
			}
		})
	}
</script>
@endsection