@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Closing History</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif

		<div>
			<div style="float:left;">
				<a href={{ route('addClosing') }} class="btn btn-md btn-outline-success" style="bottom:0;">Make New Closing</a>
			</div>

			<div style="float:right">
				<form class="form-inline" style="float:right;margin-bottom: 10px" method="GET" action="{{ route('closing') }}">
					<input type="text" name="search" placeholder="Nama Property" class="search">
				</form>
			</div>
		</div>
		<table class="table table-sm table-hover table-bordered">
			<thead class="thead-light">
				<tr>
					<th scope="col" class="text-center" style="width: 30px">No</th>
					<th scope="col">Property</th>
					<th scope="col">Sold Date</th>
					<th scope="col" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($closings as $closing)
					<tr>
						<td class="text-center">{{ (($closings->currentPage() - 1) * 5) + $loop->iteration }}</td>
						<td>{{ $closing->nama }}</td>
						<td>{{ date("d/m/Y", strtotime($closing->tanggal)) }}</td>
						<td class="text-center"><a href="{{ route('viewClosing', ['id' => $closing->id]) }}" class="btn btn-outline-primary btn-xs">View</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>

		{{ $closings->links() }}

	</div>
</div>
@endsection