<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper bg-primary text-light d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo " href= ""><img src="{{ asset('dash-front/images/logo.png') }}" class="mr-2" alt="logo"/></a>
    SchoolMind
  </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
      
      <ul class="navbar-nav navbar-nav-right">
       
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{ asset('dash-front/images/dashboard/people.png') }}" alt="people">
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="{{ route('student.password.edit') }}">
              <i class="fas text-primary fa-user-cog me-2"></i>
              Change Password
          </a>
             
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item" type="submit">
                       <i class="fas fa-power-off text-primary me-2"></i>
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
 