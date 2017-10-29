@extends('layouts.login')

@section('middle-content')
<div class="panel panel-default">
  <div class="panel-heading">Agent</div>

  <div class="panel-body">
    @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
    @endif

  </div>
</div>
@endsection