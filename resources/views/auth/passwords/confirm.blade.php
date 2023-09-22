@extends('layouts.app')
@section('content')
  <main class="main-content position-relative max-height-vh-100  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('{{ asset('assets/img/illustrations/signup.webp')}}'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <a class="link-2" style="display: flex; align-items: center; justify-content: center; margin-top: 16px; margin-bottom: 16px;" href="{{route('welcome')}}">
                <img src="{{ asset('assets/img/logo-ct.webp') }}" style="display: inline; width: 32px; height: 32px; margin-right: 2.5px;">
                <span style="display: inline; text-transform: uppercase; font-weight: 600; font-size: 1rem; margin-left: 2.5px;">{{config('app.name')}}</span>
              </a>
              <div class="card card-plain" style="box-shadow: 0 0 20px 2px rgb(0 0 0 / 10%); margin-bottom: 16px;">
                <div class="card-header">
                  <h4 class="font-weight-bolder">CONFIRM PASSWORD</h4>
                  <p class="mb-0">Please confirm your password before continuing</p>
                </div>
                <div class="card-body">
                  <form role="form" method="post" action="{{ route('password.confirm') }}">
                    @csrf
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
                      <input class="form-check-input" type="checkbox" onclick="showPasswordSignIn()">
                      <label class="form-check-label mb-0 ms-3">Show Password</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Confirm</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    @if (Route::has('password.request'))
                      Forgot your password?
                      <a href="{{ route('password.request') }}" class="text-primary text-gradient font-weight-bold">RESET PASSWORD</a>
                    @endif
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
