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
					<td>BranchA</td>
				</tr>
				<tr>
					<td>Location</td>
					<td>Surabaya</td>
				</tr>
				<tr>
					<td>Phone Number</td>
					<td>081237209954</td>
				</tr>
				<tr>
					<td>Total Income</td>
					<td>Rp. 500.000</td>
				</tr>
			</tbody>
		</table>
		<div style="margin:0 auto; text-align: center;">
			<a href="{{ route('editBranch', ['id' => '1']) }}" class="btn btn-outline-warning">Edit</a>
			<Button class="btn btn-outline-danger" onclick="del(event)">Delete</Button>
			<a href="{{ route('deleteBranch', ['id' => '1']) }}" id="del" hidden></a>
			<a href="{{ route('branch') }}" class="btn btn-outline-success">Back</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	function del (event){
		event.preventDefault()
		$.confirm({
			title: 'Caution!',
			content: 'Delete BranchA?',
			theme: 'modern',
			type: 'red',
			closeIcon: true,
			backgroundDismiss: true,
			buttons: {
				yes: function () {
					document.getElementById('del').click()
				},
				cancel: {
					keys: ['esc'],
					action: function () {
					}
				}
			}
		})
	}
</script>
@endsection