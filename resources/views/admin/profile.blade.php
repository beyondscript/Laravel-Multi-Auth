@extends('layouts.app')
@section('content')
<body class="g-sidenav-show  bg-gray-200">
  @include('admin.partials.sidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('admin.partials.navbar')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4" style="margin-top: 105px !important;">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3" style="text-align: center; padding-left: 0 !important;">Profile</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0" style="padding: 5px !important;">
                <img class="profile_picture" src="{{ asset(Auth::user()->image) }}" alt="Profile Picture">
                <span style="display: block; color: #DE2768; font-size: 18px; font-weight: 500; text-align: center; margin-top: 5px;">{{ auth()->user()->name }}</span>
                <span style="display: block; color: #DE2768; font-size: 14px; font-weight: 400; text-align: center;">Email: {{ auth()->user()->email }}</span>
                <div class="profile_settings_div">
                  <a class="btn btn-outline-primary btn-sm mb-0 me-3" style="display: flex; justify-content: center; align-items: center; width: 165px; height: 52px; margin: 5px !important; padding: 5px;" href="{{route('admin.edit.email')}}">Change Email</a>
                  <a class="btn btn-outline-primary btn-sm mb-0 me-3" style="display: flex; justify-content: center; align-items: center; width: 165px; height: 52px; margin: 5px !important; padding: 5px;" href="{{route('admin.edit.password')}}">Change Password</a>
                  <a class="btn btn-outline-primary btn-sm mb-0 me-3" style="display: flex; justify-content: center; align-items: center; width: 165px; height: 52px; margin: 5px !important; padding: 5px;" href="{{route('admin.edit.picture')}}">Change Profile Picture</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card my-4">
            <div class="card-body px-0 pb-2" style="padding-top: 8px;">
              <div class="table-responsive p-0" style="padding: 5px !important;">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3" style="width: fit-content; padding-left: 10px; padding-right: 10px; padding-bottom: 10px !important; padding-top: 10px !important; margin-right: auto; margin-left: auto; margin-bottom: 25px; margin-top: 12px;">
                  <h4 style="color: white; margin-bottom: 0;">Connect Social Accounts</h4>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3" style="margin-bottom: 10px !important; margin-right: auto !important;">
                  <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="/admin-profile/facebook-tab" role="tab" aria-selected="true" data-bs-target="#facebook">
                          <i class="fa fa-facebook-f"></i>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="/admin-profile/github-tab" role="tab" aria-selected="false" data-bs-target="#github">
                          <i class="fa fa-github"></i>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="/admin-profile/google-tab" role="tab" aria-selected="false" data-bs-target="#google">
                          <i class="fa fa-google"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="tab-content">
                  @php
                    $type = strtolower(auth()->user()->type);
                    $type_profile = $type.'-profile';
                  @endphp
                  <div id="facebook" class="tab-pane active">
                    <div style="text-align: center; margin-top: 5px; margin-bottom: 10px;">
                      <strong>Status: </strong>
                      @if(Auth::user()->facebook_id)
                        <strong>Connected</strong>
                      @else
                        <strong>Not connected</strong>
                      @endif
                    </div>
                    <div style="text-align: center;">
                      <a class="btn btn-outline-primary btn-sm mb-0 me-3" style="width: 200px; height: 52px; padding-top: 14px; margin: 5px !important;" href="/admin-profile/connect-facebook-account" onclick="event.preventDefault(); document.getElementById('facebook-connect').submit();">
                        Connect with Facebook
                        <form id="facebook-connect" action="{{route('facebook_connect', $type_profile)}}" method="POST">
                          @method('patch')
                          @csrf
                        </form>
                      </a>
                      <a class="btn btn-outline-primary btn-sm mb-0 me-3" style="width: 200px; height: 52px; padding-top: 14px; margin: 5px !important;" href="/admin-profile/remove-facebook-account" onclick="event.preventDefault(); document.getElementById('facebook-remove').submit();">
                        Remove from Facebook
                        <form id="facebook-remove" action="{{route('facebook_remove', $type_profile)}}" method="POST">
                          @method('patch')
                          @csrf
                        </form>
                      </a>
                    </div>
                  </div>
                  <div id="github" class="tab-pane">
                    <div style="text-align: center; margin-top: 5px; margin-bottom: 10px;">
                      <strong>Status: </strong>
                      @if(Auth::user()->github_id)
                        <strong>Connected</strong>
                      @else
                        <strong>Not connected</strong>
                      @endif
                    </div>
                    <div style="text-align: center;">
                      <a class="btn btn-outline-primary btn-sm mb-0 me-3" style="width: 200px; height: 52px; padding-top: 14px; margin: 5px !important;" href="/admin-profile/connect-github-account" onclick="event.preventDefault(); document.getElementById('github-connect').submit();">
                        Connect with GitHub
                        <form id="github-connect" action="{{route('github_connect', $type_profile)}}" method="POST">
                          @method('patch')
                          @csrf
                        </form>
                      </a>
                      <a class="btn btn-outline-primary btn-sm mb-0 me-3" style="width: 200px; height: 52px; padding-top: 14px; margin: 5px !important;" href="/admin-profile/remove-github-account" onclick="event.preventDefault(); document.getElementById('github-remove').submit();">
                        Remove from GitHub
                        <form id="github-remove" action="{{route('github_remove', $type_profile)}}" method="POST">
                          @method('patch')
                          @csrf
                        </form>
                      </a>
                    </div>
                  </div>
                  <div id="google" class="tab-pane">
                    <div style="text-align: center; margin-top: 5px; margin-bottom: 10px;">
                      <strong>Status: </strong>
                      @if(Auth::user()->google_id)
                        <strong>Connected</strong>
                      @else
                        <strong>Not connected</strong>
                      @endif
                    </div>
                    <div style="text-align: center;">
                      <a class="btn btn-outline-primary btn-sm mb-0 me-3" style="width: 200px; height: 52px; padding-top: 14px; margin: 5px !important;" href="/admin-profile/connect-google-account" onclick="event.preventDefault(); document.getElementById('google-connect').submit();">
                        Connect with Google
                        <form id="google-connect" action="{{route('google_connect', $type_profile)}}" method="POST">
                          @method('patch')
                          @csrf
                        </form>
                      </a>
                      <a class="btn btn-outline-primary btn-sm mb-0 me-3" style="width: 200px; height: 52px; padding-top: 14px; margin: 5px !important;" href="/admin-profile/remove-google-account" onclick="event.preventDefault(); document.getElementById('google-remove').submit();">
                        Remove from Google
                        <form id="google-remove" action="{{route('google_remove', $type_profile)}}" method="POST">
                          @method('patch')
                          @csrf
                        </form>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection