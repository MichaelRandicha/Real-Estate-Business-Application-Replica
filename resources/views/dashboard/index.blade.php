@extends('layouts.login')

@section('title', '- Dashboard')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Dashboard</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif
		<h4><strong>Top Agent</strong></h4>
		<table class="table table-sm table-bordered">
			<thead class="thead-light">
				<tr>
					<th scope="col" class="text-center" style="width: 30px">No</th>
					<th scope="col">Agent Name</th>
					<th scope="col">Branch</th>
					<th scope="col">Total Closing</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-center">1</td>
						<td>Alpha</td>
						<td>BranchA</td>
						<td>20</td>
					</tr>
					<tr>
						<td class="text-center">2</td>
						<td>Beta</td>
						<td>BranchB</td>
						<td>15</td>
					</tr>
					<tr>
						<td class="text-center">3</td>
						<td>Gamma</td>
						<td>BranchC</td>
						<td>10</td>
					</tr>
					<tr>
						<td class="text-center">4</td>
						<td>Charlie</td>
						<td>BranchD</td>
						<td>7</td>
					</tr>
					<tr>
						<td class="text-center">5</td>
						<td>Delta</td>
						<td>BranchE</td>
						<td>5</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	@endsection