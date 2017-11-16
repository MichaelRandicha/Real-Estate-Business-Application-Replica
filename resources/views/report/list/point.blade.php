<!DOCTYPE html>
<html>
<head>
	<title>Top Agent By Point Report</title>

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
		<h2 class="text-center">Top Agent By Point Report <br>From {{ date("d F Y", strtotime(request()->dateFrom)) }} To {{ date("d F Y", strtotime(request()->dateTo)) }}</h2>

		<button class="btn btn-outline-primary no-print" style="margin:0 auto 1em;display: block;cursor:pointer;" onclick="window.print()">Print</button>
		
		<table class="table table-sm table-hover table-bordered">
			<thead class="thead-blue">
				<tr>
					<th scope="col" class="text-center" style="width: 30px">No</th>
					<th scope="col">Agent Name</th>
					<th scope="col">Branch Name</th>
					<th scope="col">Total Point</th>
				</tr>
			</thead>
			<tbody>
				@foreach($points as $point)
					<tr>
						<td class="text-center">{{ $loop->iteration }}</td>
						<td>{{ $point->agent->nama }}</td>
						<td>{{ $point->cabang->nama }}</td>
						<td>{{ $point->total_point / 4 }}</td>
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