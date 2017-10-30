@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Agent Information</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif
		<table class="table table-bordered table-hover">
			<tbody>
				<tr>
					<td style="width:30%">Agent Name</td>
					<td>Alpha</td>
				</tr>
				<tr>
					<td>Address</td>
					<td>Surabaya</td>
				</tr>
				<tr>
					<td>Phone Number</td>
					<td>081237209954</td>
				</tr>
				<tr>
					<td>Branch</td>
					<td>BranchA</td>
				</tr>
				<tr>
					<td>Agent Name Upline</td>
					<td>Bravo</td>
				</tr>
				<tr>
					<td>Position</td>
					<td>Normal Agent</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>Employed</td>
				</tr>
			</tbody>
		</table>
		<div style="margin:0 auto; text-align: center;">
			<a href="{{ route('editAgent', ['id' => '1']) }}" class="btn btn-outline-warning">Edit</a>
			<Button class="btn btn-outline-danger" onclick="del(event)">Change Status</Button>
			<a href="{{ route('changeStatusAgent', ['id' => '1']) }}" id="del" hidden></a>
			<a href="{{ route('agent') }}" class="btn btn-outline-success">Back</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	function del (event){
		event.preventDefault()
		$.confirm({
			title: 'Caution!',
			content: 'Change Status of Agent Alpha?',
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