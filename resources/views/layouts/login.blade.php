@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">

      <div class="col-md-12">
        @yield('top-content')
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-3 col-lg-2">
            <ul class="nav flex-column navbar">
              <li class="nav-item">
                <a class="nav-link active" href="#">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Branch</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Closing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Property</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Agent</a>
              </li>
            </ul>
          </div>
          <div class="col-sm-9 col-lg-10">
            @yield('middle-content')
          </div>
        </div>
      </div>
      
      <div class="col-md-12">
        @yield('bottom-content')          
      </div>

    </div>
  </div>
</div>
@endsection