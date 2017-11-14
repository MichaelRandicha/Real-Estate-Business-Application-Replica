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
			<div style="float:left;" class="btn-group">
				<a href={{ route('closing.add') }} class="btn btn-md btn-outline-success no-radius" style="bottom:0;">Make New Closing</a>
				@unless($closings->count() == 0)
					<a href={{ route('closing.list') }} class="btn btn-md btn-outline-primary no-radius" style="bottom:0;" target="_blank">Print Closing List</a>
				@endunless
			</div>


			<div style="float:right">
				<form class="form-inline" style="float:right;margin-bottom: 10px" method="GET" action="{{ route('closing') }}">
					<input type="text" name="search" placeholder="Nama Property" class="search">
				</form>
			</div>
		</div>
		<table class="table table-sm table-hover table-bordered">
			<thead class="thead-blue">
				<tr>
					<th scope="col" class="text-center" style="width: 30px">No</th>
					<th scope="col">Property</th>
					<th scope="col">Sold Date</th>
					<th scope="col">Closing Price</th>
					<th scope="col" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($closings as $closing)
					<tr>
						<td class="text-center">{{ (($closings->currentPage() - 1) * 5) + $loop->iteration }}</td>
						<td>{{ $closing->nama }}</td>
						<td>{{ date("d F Y", strtotime($closing->tanggal)) }}</td>
						<td>Rp. {{ number_format($closing->harga, 2, ',', '.') }}</td>
						<td class="text-center"><a href="{{ route('closing.view', ['id' => $closing->id]) }}" class="btn btn-outline-primary btn-xs">View</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>

		{{ $closings->links() }}

	</div>
</div>
@endsection