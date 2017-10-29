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
				<a href={{ route('addAgent') }} class="btn btn-md btn-outline-success" style="bottom:0;">Add New Agent</a>
			</div>

			<div style="float:right">
				<form class="form-inline" style="float:right;margin-bottom: 10px" method="POST" action="{{ route('searchAgent') }}">
					{{ csrf_field() }}
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
				<tr>
					<td class="text-center">1</td>
					<td>Alpha</td>
					<td>BranchA</td>
					<td>Normal Agent</td>
					<td class="text-center"><a href="{{ route('viewAgent', ['id' => '1']) }}" class="btn btn-outline-primary btn-xs">View</a></td>
				</tr>
				<tr>
					<td class="text-center">2</td>
					<td>Bravo</td>
					<td>BranchB</td>
					<td>Normal Agent</td>
					<td class="text-center"><a href="{{ route('viewAgent', ['id' => '2']) }}" class="btn btn-outline-primary btn-xs">View</a></td>
				</tr>
				<tr>
					<td class="text-center">3</td>
					<td>Charlie</td>
					<td>BranchC</td>
					<td>Normal Agent</td>
					<td class="text-center"><a href="{{ route('viewAgent', ['id' => '3']) }}" class="btn btn-outline-primary btn-xs">View</a></td>
				</tr>
				<tr>
					<td class="text-center">4</td>
					<td>Delta</td>
					<td>BranchD</td>
					<td>Principal</td>
					<td class="text-center"><a href="{{ route('viewAgent', ['id' => '4']) }}" class="btn btn-outline-primary btn-xs">View</a></td>
				</tr>
				<tr>
					<td class="text-center">5</td>
					<td>Echo</td>
					<td>BranchE</td>
					<td>V. Principal</td>
					<td class="text-center"><a href="{{ route('viewBranch', ['id' => '5']) }}" class="btn btn-outline-primary btn-xs">View</a></td>
				</tr>
			</tbody>
		</table>

		{{-- {{ $branch->links() }} --}}

	</div>
</div>
@endsection