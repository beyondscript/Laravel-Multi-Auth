<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="noindex, nofollow">
  <meta property="og:image" content="{{ asset('assets/img/facebookimage.png') }}">

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

  <title>{{ config('app.name') }}</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  @vite('resources/css/app.css')
  @vite('public/assets/css/nucleo-icons.css')
  @vite('public/assets/css/nucleo-svg.css')

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Round">

  @vite('public/assets/css/material-dashboard.min.css')

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  @vite('public/assets/css/dropify.min.css')
</head>

  @yield('content')

  @vite('public/assets/js/core/popper.min.js')

  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="{{ asset('assets/js/material-dashboard.min.js') }}"></script>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="{{ asset('assets/js/dropify.min.js') }}"></script>

  @yield('scripts')

  <script>
    var isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;
    if(!isWindows){
      document.getElementsByTagName('html')[0].style.overflow = 'auto'
      document.getElementById('sidenav-main').style.overflow = 'auto'
    }
  </script>

  <script>
    @if(Session::has('message'))
      toastr.options =
      {
        "closeButton" : true,
        "progressBar" : true
      }
      toastr.success("{{ session('message') }}");
    @endif
    @if(Session::has('error'))
      toastr.options =
      {
        "closeButton" : true,
        "progressBar" : true
      }
      toastr.error("{{ session('error') }}");
    @endif
    @if(Session::has('info'))
      toastr.options =
      {
        "closeButton" : true,
        "progressBar" : true
      }
      toastr.info("{{ session('info') }}");
    @endif
    @if(Session::has('warning'))
      toastr.options =
      {
        "closeButton" : true,
        "progressBar" : true
      }
      toastr.warning("{{ session('warning') }}");
    @endif
  </script>
</body>

</html>