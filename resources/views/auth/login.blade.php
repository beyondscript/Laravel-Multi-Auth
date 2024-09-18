@extends('layouts.app')
@section('content')
<body>
  <main class="main-content position-relative max-height-vh-100  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('{{ asset('assets/img/illustrations/signin.webp')}}');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <a class="link" style="display: flex; align-items: center; justify-content: center; margin-top: 16px; margin-bottom: 16px;" href="{{route('welcome')}}">
              <img src="{{ asset('assets/img/logo-ct.webp') }}" style="display: inline; width: 32px; height: 32px; margin-right: 2.5px;">
              <span style="display: inline; text-transform: uppercase; font-weight: 600; font-size: 1rem; margin-left: 2.5px;">{{config('app.name')}}</span>
            </a>
            <div class="card z-index-0 fadeIn3 fadeInBottom" style="margin-top: 41px; margin-bottom: 16px;">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">SIGN IN</h4>
                  <div class="row mt-3">
                    <div class="col-2 text-center ms-auto">
                      <a class="btn btn-link px-3" href="/login-with-facebook" onclick="event.preventDefault(); document.getElementById('facebook-login').submit();">
                        <i class="fa fa-facebook text-white text-lg"></i>
                        <form id="facebook-login" action="{{route('facebook_login')}}" method="POST">
                          @method('patch')
                          @csrf
                        </form>
                      </a>
                    </div>
                    <div class="col-2 text-center px-1">
                      <a class="btn btn-link px-3" href="/login-with-github" onclick="event.preventDefault(); document.getElementById('github-login').submit();">
                        <i class="fa fa-github text-white text-lg"></i>
                        <form id="github-login" action="{{route('github_login')}}" method="POST">
                          @method('patch')
                          @csrf
                        </form>
                      </a>
                    </div>
                    <div class="col-2 text-center me-auto">
                      <a class="btn btn-link px-3" href="/login-with-google" onclick="event.preventDefault(); document.getElementById('google-login').submit();">
                        <i class="fa fa-google text-white text-lg"></i>
                        <form id="google-login" action="{{route('google_login')}}" method="POST">
                          @method('patch')
                          @csrf
                        </form>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form role="form" class="text-start" method="post" action="{{ route('login') }}">
                  @csrf
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label" for="email">Email</label>
                    <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="showpass" onclick="showPassword()">
                    <label class="form-check-label mb-0 ms-3" style="padding-top: 5px;" for="showpass">Show Password</label>
                  </div>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label mb-0 ms-3" style="padding-top: 5px;" for="remember">Remember Me</label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
                  </div>
                  <p class="mt-4 text-sm text-center">
                    @if (Route::has('password.request'))
                      Forgot your password?
                      <a id="link" href="{{ route('password.request') }}" class="text-primary text-gradient font-weight-bold">RESET PASSWORD</a>
                    @endif
                  </p>
                  <p class="mt-4 text-sm text-center">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">SIGN UP</a>
                  </p>
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
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
@endsection