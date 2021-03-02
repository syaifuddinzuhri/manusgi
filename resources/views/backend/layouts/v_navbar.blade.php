  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Avatar Dropdown User -->
          <li class="nav-item dropdown">

              <a class="nav-link" data-toggle="dropdown" href="#">
                  {{ Auth::user()->name }}
                  <img src="{{ asset('img/avatar.png') }}" class="img-circle elevation-2 ml-2" alt="Avatar Image"
                      width="30" style="margin-top: -5px;">
              </a>
              <div class="dropdown-menu dropdown-menu-right p-1">
                  <a href="{{ route('frontend.home') }}" class="dropdown-item" target="_blank">
                      <i class="fas fa-fw fa-puzzle-piece mr-2"></i>To Frontend
                  </a>
                  <div class="dropdown-divider m-0"></div>
                  <a href="javascript:void()" class=" dropdown-item" data-toggle="modal" data-target="#logoutModal">
                      <i class="fas fa-fw fa-sign-out-alt mr-2"></i>Logout
                  </a>
              </div>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->
