<!DOCTYPE html>
<html>
<head>
	<title>Agent List</title>

	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/Treant.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-confirm.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/perfect-scrollbar.css') }}">

	<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/raphael.js') }}"></script>
	<script src="{{ asset('js/Treant.js') }}"></script>
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/jquery.mousewheel.js') }}"></script>
	<script src="{{ asset('js/perfect-scrollbar.js') }}"></script>
	<style type="text/css" media="print">
	@page { size: landscape;margin:0; }
	th { color: #000 !important; }
	</style>
</head>
<body>
	<div style="margin:1em 2em">
		<h2 class="text-center">Agent List</h2>
		
		<button class="btn btn-outline-primary no-print" style="margin:0 auto 1em;display: block;cursor:pointer;" onclick="window.print()">Print</button>
		
		{{-- <div id="agent-tree"></div> --}}

		<table class="table table-bordered table-hover">
			<thead class="thead-blue">
				<tr>
					<th style="width:20%">Agent Name</th>
					<th>Location</th>
					<th>Phone</th>
					<th>Branch</th>
					<th>Upline</th>
					<th>Pendapatan</th>
					<th>Position</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($agents as $agent)
				<tr>
					<td id="nama">{{ $agent->nama }}</td>
					<td>{{ $agent->lokasi }}</td>
					<td>{{ $agent->telepon }}</td>
					<td>{{ $agent->cabang->nama }}</td>
					<td>@if($agent->upline != null) {{ $agent->upline->nama }} @else - @endif</td>
					<td>Rp. {{ number_format($agent->pendapatan, 2, ',', '.') }}</td>
					<td>@if($agent->isPrincipal) Principal @elseif($agent->isVice) Vice Principal @else Normal Agent @endif</td>
					<td>@if($agent->isEmployed) Employed @else Unemployed @endif</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		@include('js.value')
	</div>
</body>
<script>
	// var my_chart = new Treant(JSON.parse(agent_tree));
	// $(document).ready(function (){
	// 	window.print();
	// 	setTimeout(function(){window.close();}, 1);
	// });
</script>
</html>