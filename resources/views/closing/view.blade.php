@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
	<div class="panel-heading">Closing Information</div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif
		<table class="table table-bordered table-hover">
			<tbody>
				<tr>
					<td style="width:20%">Property Name</td>
					<td>{{ $closing->nama }}</td>
				</tr>
				<tr>
					<td>Sold Date</td>
					<td>{{ date("d F Y", strtotime($closing->tanggal)) }}</td>
				</tr>
				<tr>
					<td>Closing Price</td>
					<td>Rp. {{ number_format($closing->harga, 2, ',', '.') }}</td>
				</tr>
			</tbody>
		</table>

		<table class="table table-bordered table-hover">
			<thead class="thead-blue">
				<tr>
					<th style="width:20%"></th>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<th>Agent {{ $loop->iteration }}</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Agent Name</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>
							{{ $agentclosing->agent->nama }}
							@if(App\Agent::where('nama', '=', $agentclosing->agent->nama)->get()->count() > 1)
							@foreach(App\Agent::where('nama', '=', $agentclosing->agent->nama)->get() as $agen)
								@if($agen->id == $agentclosing->agent->id)
									#{{ $loop->iteration }}
								@endif
							@endforeach 
							@endif
							From {{ $agentclosing->cabang->nama }}
						</td>
					@endforeach
				</tr>
				<tr>
					<td>Total Comission</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>Rp. {{ number_format($agentclosing->komisi, 2, ',', '.') }}</td>
					@endforeach
				</tr>
				<tr>
					<td>Agent Upline 1</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>
							{{ $agentclosing->upline1->nama }}
							@if(App\Agent::where('nama', '=', $agentclosing->upline1->nama)->get()->count() > 1)
							@foreach(App\Agent::where('nama', '=', $agentclosing->upline1->nama)->get() as $agen)
								@if($agen->id == $agentclosing->upline1->id)
									#{{ $loop->iteration }}
								@endif
							@endforeach 
							@endif
						</td>
					@endforeach
				</tr>
				<tr>
					<td>7% Comission</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>Rp. {{ number_format($agentclosing->upline1_komisi, 2, ',', '.') }}</td>
					@endforeach
				</tr>
				<tr>
					<td>Agent Upline 2</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>
							{{ $agentclosing->upline2->nama }}
							@if(App\Agent::where('nama', '=', $agentclosing->upline2->nama)->get()->count() > 1)
							@foreach(App\Agent::where('nama', '=', $agentclosing->upline2->nama)->get() as $agen)
								@if($agen->id == $agentclosing->upline2->id)
									#{{ $loop->iteration }}
								@endif
							@endforeach 
							@endif
						</td>
					@endforeach
				</tr>
				<tr>
					<td>2% Comission</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>Rp. {{ number_format($agentclosing->upline2_komisi, 2, ',', '.') }}</td>
					@endforeach
				</tr>
				<tr>
					<td>Agent Upline 3</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>
							{{ $agentclosing->upline3->nama }}
							@if(App\Agent::where('nama', '=', $agentclosing->upline3->nama)->get()->count() > 1)
							@foreach(App\Agent::where('nama', '=', $agentclosing->upline3->nama)->get() as $agen)
								@if($agen->id == $agentclosing->upline3->id)
									#{{ $loop->iteration }}
								@endif
							@endforeach 
							@endif
						</td>
					@endforeach
				</tr>
				<tr>
					<td>1% Comission</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>Rp. {{ number_format($agentclosing->upline3_komisi, 2, ',', '.') }}</td>
					@endforeach
				</tr>
				<tr>
					<td>Principal</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>
							{{ $agentclosing->principal->nama }}
							@if(App\Agent::where('nama', '=', $agentclosing->principal->nama)->get()->count() > 1)
							@foreach(App\Agent::where('nama', '=', $agentclosing->principal->nama)->get() as $agen)
								@if($agen->id == $agentclosing->principal->id)
									#{{ $loop->iteration }}
								@endif
							@endforeach 
							@endif
						</td>
					@endforeach
				</tr>
				<tr>
					<td>6% Comission</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>Rp. {{ number_format($agentclosing->principal_komisi, 2, ',', '.') }}</td>
					@endforeach
				</tr>
				<tr>
					<td>Vice Principal</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>
							{{ $agentclosing->vice->nama }}
							@if(App\Agent::where('nama', '=', $agentclosing->vice->nama)->get()->count() > 1)
							@foreach(App\Agent::where('nama', '=', $agentclosing->vice->nama)->get() as $agen)
								@if($agen->id == $agentclosing->vice->id)
									#{{ $loop->iteration }}
								@endif
							@endforeach 
							@endif
						</td>
					@endforeach
				</tr>
				<tr>
					<td>4% Comission</td>
					@foreach($closing->closing->sortBy('id') as $agentclosing)
						<td>Rp. {{ number_format($agentclosing->vice_komisi, 2, ',', '.') }}</td>
					@endforeach
				</tr>
			</tbody>
		</table>
		<div style="margin:0 auto; text-align: center;">
			<a href="{{ route('closing') }}" class="btn btn-outline-success">Back</a>
		</div>
	</div>
</div>
@endsection