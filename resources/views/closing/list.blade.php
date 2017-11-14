<!DOCTYPE html>
<html>
<head>
	<title>Closing List</title>

	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <style type="text/css" media="print">
		@page { size: landscape; margin:0; }
	</style>
</head>
<body>
	<div style="margin: 1em 2em">
		<h1 class="text-center">Closing List</h1>
		
		@foreach($closings as $closing)
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

			<table class="table table-bordered table-hover table-md">
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
		@endforeach
	</div>
</body>
<script>
	$(document).ready(function (){
		window.print();
		setTimeout(function(){window.close();}, 1);
	});
</script>
</html>