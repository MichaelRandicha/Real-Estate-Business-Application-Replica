<div class="flex w100 mb15">
	<a href="{{ route('report.branch') }}" class="btn btn-md btn-outline-success flex-1 no-radius @if(Request::is('report/branch')) active @endif">Branch Report</a>
	<a href="{{ route('report.commission') }}" class="btn btn-md btn-outline-success flex-1 button-center no-radius @if(Request::is('report/commission')) active @endif">Highest Commission Report</a>
	<a href="{{ route('report.closing') }}" class="btn btn-md btn-outline-success flex-1 no-radius @if(Request::is('report/closing')) active @endif">Closing List Report</a>
</div>