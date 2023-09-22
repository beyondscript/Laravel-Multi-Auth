  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" style="color: #DE2768 !important;" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{route('welcome')}}">
        <img src="{{ asset('assets/img/logo-ct.webp') }}" class="navbar-brand-img h-100">
        <span class="ms-1 font-weight-bold text-white" style="color: #2E4AFF !important;">{{ config('app.name', 'Laravel') }}</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2" style="background-color: #E22D6C;">
    <div class="collapse navbar-collapse  w-auto" style="height: unset; margin-bottom: 10px;" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="{{ request()->segment(1) == 'user-home' ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{ route('user.home') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10" style="color: #FFFF00 !important;">dashboard</i>
            </div>
            <span class="nav-link-text ms-1" style="color: #FFFF00 !important;">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="{{ request()->segment(1) == 'user-profile' ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{route('user.profile')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10" style="color: #FFFF00 !important;">person</i>
            </div>
            <span class="nav-link-text ms-1" style="color: #FFFF00 !important;">Profile</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>