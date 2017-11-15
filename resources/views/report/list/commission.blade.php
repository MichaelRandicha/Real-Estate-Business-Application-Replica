<!DOCTYPE html>
<html>
<head>
	<title>Highest Commission Report</title>

	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<script src="{{ asset('js/jquery.js') }}"></script>
	<style type="text/css" media="print">
		@page { size: portrait; margin:0; }
		th { color: #000 !important; }
	</style>
</head>
<body>
	<div style="margin: 1em 2em">
		<h2 class="text-center">Highest Commission Report <br>From {{ date("d F Y", strtotime(request()->dateFrom)) }} To {{ date("d F Y", strtotime(request()->dateTo)) }}</h2>
		
		<button class="btn btn-outline-primary no-print" style="margin:0 auto 1em;display: block;cursor:pointer;" onclick="window.print()">Print</button>
		
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
				</tr>
			</thead>
			<tbody>
				@foreach($commissions as $commission)
				<tr>
					<td class="text-center">{{ $loop->iteration }}</td>
					@if(request()->filter == "agent")
					<td>{{ $commission->agent->nama }}</td>
					@elseif(request()->filter == "branch")
					<td>{{ $commission->cabang->nama }}</td>
					@endif
					<td>Rp. {{ number_format($commission->total_komisi, 2, ',', '.') }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
<script>
	// $(document).ready(function (){
	// 	window.print();
	// 	setTimeout(function(){window.close();}, 1);
	// });
</script>
</html>