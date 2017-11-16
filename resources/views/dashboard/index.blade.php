@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Dashboard</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif

		<h4><strong>Top Agent In {{ Carbon\Carbon::now()->format('F Y') }}</strong></h4>
		<table class="table table-sm table-bordered table-hover">
			<thead class="thead-blue">
				<tr>
					<th scope="col" class="text-center" style="width: 30px">No</th>
					<th scope="col">Agent Name</th>
					<th scope="col">Branch</th>
					<th scope="col">Total Closing</th>
					<th scope="col" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($agents as $agent)
				<tr>
					<td class="text-center">{{ (($agents->currentPage() - 1) * 5) + $loop->iteration }}</td>
					<td>{{ $agent->nama_agent }}</td>
					<td>{{ $agent->cabang->nama }}</td>
					<td>{{ $agent->closing_count }}</td>
					<td class="text-center"><a href="{{ route('agent.view', ['id' => $agent->id]) }}" class="btn btn-outline-primary btn-xs">View</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>

		{{ $agents->links() }}

	</div>
</div>
@endsection