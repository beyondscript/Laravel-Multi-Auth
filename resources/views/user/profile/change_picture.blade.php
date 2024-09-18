@extends('layouts.app')
@section('content')
<body class="g-sidenav-show  bg-gray-200">
  @include('user.partials.sidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('user.partials.navbar')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4" style="margin-top: 105px !important;">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3" style="text-align: center; padding-left: 0 !important;">Change Profile Picture</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0" style="padding: 5px !important;">
                @php
                  $type = strtolower(auth()->user()->type);
                  $type_profile = $type.'-profile';
                @endphp
                <form role="form" method="post" action="{{ route('update.picture', $type_profile) }}" enctype="multipart/form-data">
                  @method('patch')
                  @csrf
                  <div style="padding-left: 10px; padding-right: 10px; padding-bottom: 10px;">
                    <div class="input-group input-group-outline my-3" style="margin-top: 0 !important; margin-bottom: 0 !important;">
                      <label for="image">Profile Picture</label>
                      <input id="image" type="file" class="dropify @error('image') is-invalid @enderror" data-height="150" name="image" tabindex="-1">
                      @error('image')
                        <span class="invalid-feedback" style="display: block;" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2" style="width: 192px !important;">Change</button>
                    </div>
                    <div class="text-center">
                      <a class="btn bg-gradient-primary w-100 my-4 mb-2" style="width: 192px !important; margin-top: 15px !important;" href="{{route('user.profile')}}">Cancel</a>
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
    $('.dropify').dropify({
      tpl: {
        wrap: '<div id="dropify-wrapper" class="dropify-wrapper"></div>'
      }
    });

    if('ontouchstart' in window) {
      document.getElementById('dropify-wrapper').classList.remove('touch-fallback')
    }
  </script>
@endsection