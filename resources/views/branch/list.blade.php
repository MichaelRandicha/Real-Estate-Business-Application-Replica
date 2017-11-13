<!DOCTYPE html>
<html>
<head>
	<title>Branch List</title>

	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <style type="text/css" media="print">
	  @page { size: landscape;margin:0; }
	</style>
</head>
<body>
	<div style="margin: 1em 2em">
		<h1 class="text-center">Branch List</h1>
		
		<table class="table table-bordered table-hover">
			<thead>
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
	$(document).ready(function (){
		window.print();
		setTimeout(function(){window.close();}, 1);
	});
</script>
</html>