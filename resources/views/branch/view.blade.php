@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Branch Information</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif
		<table class="table table-bordered table-hover">
			<tbody>
				<tr>
					<td style="width:30%">Branch Name</td>
					<td>{{ $cabang->nama }}</td>
				</tr>
				<tr>
					<td>Location</td>
					<td>{{ $cabang->lokasi }}</td>
				</tr>
				<tr>
					<td>Phone Number</td>
					<td>{{ $cabang->telepon }}</td>
				</tr>
				<tr>
					<td>Principal</td>
					<td>@if($cabang->principal != null) {{ $cabang->principal->nama }} @endif</td>
				</tr>
				<tr>
					<td>Vice Principal</td>
					<td>@if($cabang->vice != null) {{ $cabang->vice->nama }} @endif</td>
				</tr>
			</tbody>
		</table>
		<div style="margin:0 auto; text-align: center;">
			<a href="{{ route('editBranch', ['id' => $cabang->id]) }}" class="btn btn-outline-warning">Edit</a>
			<a href="{{ route('branch') }}" class="btn btn-outline-success">Back</a>
		</div>
	</div>
</div>
@endsection