<!DOCTYPE html>
<html>
<head>
	<title>Branch List</title>

	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <style type="text/css" media="print">
		@page { size: portrait;margin:0; }
		th { color: #000 !important; }
	</style>
</head>
<body>
	<div style="margin: 1em 2em">
		<h2 class="text-center">Branch List</h2>

		<button class="btn btn-outline-primary no-print" style="margin:0 auto 1em;display: block;cursor:pointer;" onclick="window.print()">Print</button>
		
		<table class="table table-bordered table-hover">
			<thead class="thead-blue">
				<tr>
					<th style="width:20%">Branch Name</th>
					<th>Location</th>
					<th>Phone Number</th>
					<th>Principal</th>
					<th>Vice Principal</th>
				</tr>
			</thead>
			<tbody>
				@foreach($cabangs as $cabang)
				<tr>
					<td>{{ $cabang->nama }}</td>
					<td>{{ $cabang->lokasi }}</td>
					<td>{{ $cabang->telepon }}</td>
					<td>@if($cabang->principal != null) {{ $cabang->principal->nama }} @else - @endif</td>
					<td>@if($cabang->vice != null) {{ $cabang->vice->nama }} @else - @endif</td>
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