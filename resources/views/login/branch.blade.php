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
				
				<a href={{ route('addBranch') }} class="btn btn-md btn-outline-success" style="bottom:0;">Add New Branch</a>
			</div>

			<div style="float:right">
				<form class="form-inline" style="float:right;margin-bottom: 10px" method="POST" action="{{ route('searchBranch') }}">
					{{ csrf_field() }}
					<input type="text" name="search" placeholder="Nama Cabang" class="search">
				</form>
				
			</div>
		</div>
		<table class="table table-sm table-bordered">
			<thead class="thead-light">
				<tr>
					<th scope="col" class="text-center" style="width: 30px">No</th>
					<th scope="col">Nama Cabang</th>
					<th scope="col">Lokasi</td>
						<th scope="col">Nomor Handphone</td>
							<th scope="col" class="text-center">Action</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">1</td>
								<td>BranchA</td>
								<td>Surabaya</td>
								<td>0812345678</td>
								<td class="text-center"><a href="#" class="btn btn-outline-primary btn-xs">View</a></td>
							</tr>
							<tr>
								<td class="text-center">2</td>
								<td>BranchB</td>
								<td>Jakarta</td>
								<td>0812345678</td>
								<td class="text-center"><a href="#" class="btn btn-outline-primary btn-xs">View</a></td>
							</tr>
							<tr>
								<td class="text-center">3</td>
								<td>BranchC</td>
								<td>Bali</td>
								<td>0812345678</td>
								<td class="text-center"><a href="#" class="btn btn-outline-primary btn-xs">View</a></td>
							</tr>
							<tr>
								<td class="text-center">4</td>
								<td>BranchD</td>
								<td>Semarang</td>
								<td>0812345678</td>
								<td class="text-center"><a href="#" class="btn btn-outline-primary btn-xs">View</a></td>
							</tr>
							<tr>
								<td class="text-center">5</td>
								<td>BranchE</td>
								<td>Malang</td>
								<td>0812345678</td>
								<td class="text-center"><a href="#" class="btn btn-outline-primary btn-xs">View</a></td>
							</tr>
						</tbody>
					</table>

					{{-- {{ $branch->links() }} --}}

				</div>
			</div>
			@endsection