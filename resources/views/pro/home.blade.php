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
                <h6 class="text-white text-capitalize ps-3" style="text-align: center; padding-left: 0 !important;">Dashboard</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0" style="padding: 5px !important;">
                <div style="padding-left: 10px; padding-right: 10px;">
                  <h4>1. Dashboard:</h4>
                  <div style="padding-left: 10px;">
                    <p>i. Dashboard menu contains all the instructions for controlling the application.</p>
                    <p>ii. Please read all the instructions for controlling the application.</p>
                  </div>
                </div>
                <div style="padding-left: 10px; padding-right: 10px;">
                  <h4>2. Profile:</h4>
                  <div style="padding-left: 10px;">
                    <p>i. Profile menu contains some of the informations of your profile.</p>
                    <p>ii. Profile menu also contains the functionality for changing the current email, password and profile picture.</p>
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