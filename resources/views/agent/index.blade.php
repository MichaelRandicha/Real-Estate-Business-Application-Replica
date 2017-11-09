@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Agent List</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif

		<div>
			<div style="float:left;">
				<a href={{ route('agent.add') }} class="btn btn-md btn-outline-success" style="bottom:0;">Add New Agent</a>
			</div>

			<div style="float:right">
				<form class="form-inline" style="float:right;margin-bottom: 10px" method="GET" action="{{ route('agent') }}">
					<input type="text" name="search" placeholder="Nama Agent" class="search">
				</form>	
			</div>
		</div>
		<table class="table table-sm table-hover table-bordered">
			<thead class="thead-light">
				<tr>
					<th scope="col" class="text-center" style="width: 30px">No</th>
					<th scope="col">Name</th>
					<th scope="col">Branch</th>
					<th scope="col">Position</th>
					<th scope="col" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				@if(!empty($agents))
					@foreach($agents as $agent)
						<tr @if(!$agent->isEmployed) class="table-danger" @endif>
							<td class="text-center">{{ (($agents->currentPage() - 1) * 5) + $loop->iteration }}</td>
							<td>{{ $agent->nama }}</td>
							<td>{{ $agent->cabang->nama }}</td>
							<td>@if($agent->isPrincipal) Principal @elseif($agent->isVice) Vice Principal @else Normal Agent @endif</td>
							<td class="text-center"><a href="{{ route('agent.view', ['id' => $agent->id]) }}" class="btn btn-outline-primary btn-xs">View</a></td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>

		{{ $agents->links() }}

	</div>
</div>
@endsection