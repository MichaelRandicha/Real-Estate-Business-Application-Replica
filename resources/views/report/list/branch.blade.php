<!DOCTYPE html>
<html>
<head>
	<title>Branch Activity Report</title>

	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<script src="{{ asset('js/jquery.js') }}"></script>
	<style type="text/css" media="print">
	@page { size: portrait; margin:0; }
</style>
</head>
<body>
	<div style="margin: 1em 2em">
		<h2 class="text-center">Branch Activity Report <br>From {{ date("d F Y", strtotime(request()->dateFrom)) }} To {{ date("d F Y", strtotime(request()->dateTo)) }}</h2>
		<table class="table table-sm table-hover table-bordered">
			<thead class="thead-light">
				<tr>
					<th scope="col" class="text-center">No</th>
					<th scope="col">Agent Name</th>
					<th scope="col">Property</th>
					<th scope="col">Sold Date</th>
					<th scope="col">Closing Price</th>
					<th scope="col">Agent Income</th>
				</tr>
			</thead>
			<tbody>
				@foreach($branchs as $branch)
				<tr>
					<td class="text-center">{{ $loop->iteration }}</td>
					<td>{{ $branch->agent->nama }}</td>
					<td>{{ $branch->closing->nama }}</td>
					<td>{{ date("d F Y", strtotime($branch->closing->tanggal)) }}</td>
					<td>Rp. {{ number_format($branch->closing->harga, 2, ',', '.') }}</td>
					<td>Rp. {{ number_format($branch->komisi, 2, ',', '.') }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
<script>
	$(document).ready(function (){
		window.print();
		setTimeout(function(){window.close();}, 1);
	});
</script>
</html>