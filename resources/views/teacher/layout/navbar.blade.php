<style>
    .sidebar-icon-only .navbar .school-name {
    display: inline !important;
    opacity: 1 !important;
    visibility: visible !important;
    font-size: 0.1px !important;
}
</style>
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
 <div class="text-center navbar-brand-wrapper bg-primary text-light fw-bold d-flex align-items-center justify-content-center">
    <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="{{ asset('dash-front/images/logo.png') }}" class="mr-2" alt="logo" />
        <span class="school-name text-light">NumaSchool</span>
    </a>
</div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
      <ul class="navbar-nav navbar-nav-right">
       
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{ Auth::user()->image != null ? asset('storage/' . Auth::user()->image) : asset('image/' . 'user.jpg') }}"
               alt="user">
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item text-primary" href="{{ route('teacher.profile.edit') }}">
              <i class="fas fa-user-cog text-primary me-2"></i>
              Edit Profile
          </a>
        
             
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item text-primary" type="submit">
                      <i class="fa-solid fa-right-from-bracket text-primary"></i>
                                              Logout
                      </button>
                </form>
             
          </div>
      </li>
      
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="icon-menu"></span>
      </button>
    </div>
  </nav>
 