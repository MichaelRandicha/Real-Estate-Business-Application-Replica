@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Branch List</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif

		<div>
			<div style="float:left;">
				<a href={{ route('branch.add') }} class="btn btn-md btn-outline-success" style="bottom:0;">Add New Branch</a>
				@unless($cabangs->count() == 0)
					<a href={{ route('branch.list') }} class="btn btn-md btn-outline-primary" style="bottom:0;" target="_blank">Print Branch List</a>
				@endunless
			</div>

			<div style="float:right">
				<form class="form-inline" style="float:right;margin-bottom: 10px" method="GET" action="{{ route('branch') }}">
					<input type="text" name="search" placeholder="Nama Cabang" class="search">
				</form>	
			</div>
		</div>
		<table class="table table-sm table-hover table-bordered">
			<thead class="thead-light">
				<tr>
					<th scope="col" class="text-center" style="width: 30px">No</th>
					<th scope="col">Branch Name</th>
					<th scope="col">Location</th>
					<th scope="col">Phone Number</th>
					<th scope="col" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($cabangs as $cabang)
					<tr>
						<td class="text-center">{{ (($cabangs->currentPage() - 1) * 5) + $loop->iteration }}</td>
						<td>{{ $cabang->nama }}</td>
						<td>{{ $cabang->lokasi }}</td>
						<td>{{ $cabang->telepon }}</td>
						<td class="text-center"><a href="{{ route('branch.view', ['id' => $cabang->id]) }}" class="btn btn-outline-primary btn-xs">View</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>

		{{ $cabangs->links() }}

	</div>
</div>
@endsection