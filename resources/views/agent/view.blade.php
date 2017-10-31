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
					<td id="nama">{{ $agent->nama }}</td>
				</tr>
				<tr>
					<td>Location</td>
					<td>{{ $agent->lokasi }}</td>
				</tr>
				<tr>
					<td>Phone Number</td>
					<td>{{ $agent->telepon }}</td>
				</tr>
				<tr>
					<td>Branch</td>
					<td>{{ $agent->cabang->nama }}</td>
				</tr>
				<tr>
					<td>Agent Name Upline</td>
					<td>@if($agent->upline != null) {{ $agent->upline->nama }} @endif</td>
				</tr>
				<tr>
				<tr>
					<td>Pendapatan</td>
					<td>Rp. {{ number_format($agent->pendapatan, 0 , '', '.') }}</td>
				</tr>
					<td>Position</td>
					<td>@if($agent->isPrincipal) Principal @elseif($agent->isVice) Vice Principal @else Normal Agent @endif</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>@if($agent->isEmployed) Employed @else Unemployed @endif</td>
				</tr>
			</tbody>
		</table>
		<div style="margin:0 auto; text-align: center;">
			<a href="{{ route('editAgent', ['id' => $agent->id]) }}" class="btn btn-outline-warning">Edit</a>
			<Button class="btn btn-outline-danger" onclick="del(event)">Change Status</Button>
			<a href="{{ route('changeStatusAgent', ['id' => $agent->id]) }}" id="del" hidden></a>
			<a href="{{ route('agent') }}" class="btn btn-outline-success">Back</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	function del (event){
		var nama = document.getElementById('nama').innerHTML;
		event.preventDefault()
		$.confirm({
			title: 'Caution!',
			content: 'Change Status of Agent '+nama+'?',
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

@section('bottom-content')
<div class="col-md-8 col-md-offset-2">
	<div class="panel panel-default">
		<div class="panel-heading">Agent Tree View</div>

		<div class="panel-body">
			<div id="agent-tree"></div>
		</div>
	</div>
	@include('js.value')
</div>

<script type="text/javascript">
	// console.log(foo);
	// var agent_tree = {
	//     chart: {
	//         container: "#agent-tree"
	//     },
	    
	//     nodeStructure: {
	//         text: { name: "Parent node" },
	//         children: [
	//             {
	//                 text: { name: "First child" }
	//             },
	//             {
	//                 text: { name: "Second child" }
	//             }
	//         ]
	//     }
	// };
	// var my_chart = new Treant(agent_tree);
</script>
@endsection