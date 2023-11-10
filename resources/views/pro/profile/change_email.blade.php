@extends('layouts.app')
@section('content')
<body class="g-sidenav-show  bg-gray-200">
  @include('pro.partials.sidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('pro.partials.navbar')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4" style="margin-top: 105px !important;">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3" style="text-align: center; padding-left: 0 !important;">Change Email</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0" style="padding: 5px !important;">
                @php
                  $type = strtolower(auth()->user()->type);
                  $type_profile = $type.'-profile';
                @endphp
                <form role="form" method="post" action="{{ route('update.email', $type_profile) }}">
                  @method('patch')
                  @csrf
                  <div style="padding-left: 10px; padding-right: 10px; padding-bottom: 10px;">
                    <div class="input-group input-group-outline my-3" style="margin-top: 0 !important;">
                      <label class="form-label" for="current_password">Current Password</label>
                      <input id="current_password" name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror">
                      @error('current_password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="input-group input-group-outline my-3" style="margin-top: 0 !important; margin-bottom: 0 !important;">
                      <label class="form-label" for="email">Email</label>
                      <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror">
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="form-check form-switch d-flex align-items-center mb-3" style="margin-bottom: 0 !important; margin-top: 5px;">
                      <input class="form-check-input" type="checkbox" id="showpass" onclick="showPassword()">
                      <label class="form-check-label mb-0 ms-3" style="padding-top: 5px;" for="showpass">Show Password</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2" style="width: 192px !important;">Change</button>
                    </div>
                    <div class="text-center">
                      <a class="btn bg-gradient-primary w-100 my-4 mb-2" style="width: 192px !important; margin-top: 15px !important;" href="{{route('pro.profile')}}">Cancel</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection

@section('scripts')
  <script>
    function showPassword() {
      var x = document.getElementById("current_password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
@endsection