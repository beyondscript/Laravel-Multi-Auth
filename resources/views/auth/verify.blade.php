@extends('layouts.app')
@section('content')
<body>
  <main class="main-content position-relative max-height-vh-100  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('{{ asset('assets/img/illustrations/signin.webp')}}');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <a class="link" style="display: flex; align-items: center; justify-content: center; margin-top: 16px; margin-bottom: 16px;" href="{{route('redirect.welcome')}}">
              <img src="{{ asset('assets/img/logo-ct.webp') }}" style="display: inline; width: 32px; height: 32px; margin-right: 2.5px;">
              <span style="display: inline; text-transform: uppercase; font-weight: 600; font-size: 1rem; margin-left: 2.5px;">{{config('app.name')}}</span>
            </a>
            <div class="card z-index-0 fadeIn3 fadeInBottom" style="margin-top: 41px; margin-bottom: 16px;">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0" style="margin-top: 0 !important;">VERIFY YOUR EMAIL</h4>
                </div>
              </div>
              <div class="card-body">
                <p class="mb-0">
                  @if (session('resent'))
                    A fresh verification link has been sent to your email address.
                  @endif
                  Before proceeding, please check your email for a verification link.
                  If you did not receive the email, click the below button to request another.
                </p>
                <form role="form" method="POST" action="{{ route('verification.resend') }}">
                  @csrf
                  <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">
                    Send Link
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
