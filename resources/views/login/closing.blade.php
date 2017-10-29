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
				<form class="form-inline" style="float:right;margin-bottom: 10px" method="POST" action="{{ route('searchClosing') }}">
					{{ csrf_field() }}
					<input type="text" name="search" placeholder="Nama Property" class="search">
				</form>
			</div>
		</div>
		<table class="table table-sm table-hover table-bordered">
			<thead class="thead-light">
				<tr>
					<th scope="col" class="text-center" style="width: 30px">No</th>
					<th scope="col">Property</th>
					<th scope="col">Date</th>
					<th scope="col" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="text-center">1</td>
					<td>Rumah01</td>
					<td>11-11-17</td>
					<td class="text-center"><a href="{{ route('viewClosing', ['id' => '1']) }}" class="btn btn-outline-primary btn-xs">View</a></td>
				</tr>
				<tr>
					<td class="text-center">2</td>
					<td>Rumah02</td>
					<td>30-10-17</td>
					<td class="text-center"><a href="{{ route('viewClosing', ['id' => '2']) }}" class="btn btn-outline-primary btn-xs">View</a></td>
				</tr>
				<tr>
					<td class="text-center">3</td>
					<td>Rumah03</td>
					<td>21-10-17</td>
					<td class="text-center"><a href="{{ route('viewClosing', ['id' => '3']) }}" class="btn btn-outline-primary btn-xs">View</a></td>
				</tr>
				<tr>
					<td class="text-center">4</td>
					<td>Rumah04</td>
					<td>19-10-17</td>
					<td class="text-center"><a href="{{ route('viewClosing', ['id' => '4']) }}" class="btn btn-outline-primary btn-xs">View</a></td>
				</tr>
				<tr>
					<td class="text-center">5</td>
					<td>Rumah05</td>
					<td>15-10-17</td>
					<td class="text-center"><a href="{{ route('viewClosing', ['id' => '5']) }}" class="btn btn-outline-primary btn-xs">View</a></td>
				</tr>
			</tbody>
		</table>

		{{-- {{ $branch->links() }} --}}

	</div>
</div>
@endsection