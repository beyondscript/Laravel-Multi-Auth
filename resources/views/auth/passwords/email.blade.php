@extends('layouts.app')
@section('content')
<body>
  <main class="main-content position-relative max-height-vh-100  mt-0">
    <section>
      <div id="page_header" class="page-header min-vh-100">
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
              <div class="card card-plain" style="background-color: white; box-shadow: 0 0 20px 2px rgb(0 0 0 / 10%); margin-top: 25px; margin-bottom: 16px;">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0" style="margin-top: 0 !important;">RESET PASSWORD</h4>
                  </div>
                </div>
                <div class="card-body">
                  @if (session('status'))
                    {{ session('status') }}
                  @endif
                  <form role="form" method="post" action="{{ route('password.email') }}">
                    @csrf
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label" for="email">Email</label>
                      <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror">
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Send Link</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">SIGN IN</a>
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

@section('scripts')
  <script>
    var widthLimit = 991
    var windowWidth = window.innerWidth
    var url = "@php echo config('app.url'); @endphp"
    if(windowWidth <= widthLimit) {
      document.getElementById('page_header').style.backgroundImage = "url('/assets/img/illustrations/signup.webp')"
      document.getElementById('page_header').style.backgroundSize = "cover"
      document.getElementById('page_header').style.backgroundPosition = "center"
    }
    window.addEventListener('resize', function () {
      var currentWidth = window.innerWidth
      if (currentWidth <= widthLimit) {
        document.getElementById('page_header').style.backgroundImage = "url('/assets/img/illustrations/signup.webp')"
        document.getElementById('page_header').style.backgroundSize = "cover"
        document.getElementById('page_header').style.backgroundPosition = "center"
      }
      else {
        document.getElementById('page_header').removeAttribute('style')
      }
    })
  </script>
@endsection
