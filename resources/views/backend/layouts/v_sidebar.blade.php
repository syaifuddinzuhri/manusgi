  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('backend.admin_dashboard') }}" class="brand-link">
          <img src="{{ asset('img/logo_ma.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-bold">MA NU SUNAN GIRI</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('img/avatar.png') }}" class="img-circle elevation-2" alt="Avatar Image">
              </div>
              <div class="info">
                  <a href="{{ route('backend.admin_dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <li class="nav-item ">
                      <a href="{{ route('backend.admin_dashboard') }}"
                          class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-home"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>

                  @if (Auth::user()->level == 1)
                      <li class="nav-item">
                          <a href="{{ route('user.index') }}"
                              class="nav-link {{ Request::is('admin/user') || Request::is('admin/user/*') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-users"></i>
                              <p>
                                  Manajemen User
                              </p>
                          </a>
                      </li>

                      @php
                      $active = '';
                      $open = '';

                      if (Request::is('admin/sejarah') || Request::is('admin/visi-misi') || Request::is('admin/sejarah')
                      || Request::is('admin/jurusan') || Request::is('admin/pendidik') || Request::is('admin/sarpras'))
                      {
                      $open = 'menu-open';
                      $active = 'active';
                      }

                      @endphp

                      <li class="nav-item has-treeview {{ $open }}">
                          <a href="#" class="nav-link {{ $active }} ">
                              <i class="nav-icon fas fa-building"></i>
                              <p>
                                  Manajemen Profil
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('sejarah.index') }}"
                                      class="nav-link  {{ Request::is('admin/sejarah') ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Sejarah</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('backend.visimisi_index') }}"
                                      class="nav-link {{ Request::is('admin/visi-misi') ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Visi dan Misi</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('sarpras.index') }}"
                                      class="nav-link {{ Request::is('admin/sarpras') ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Sarana dan Prasarana</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('pendidik.index') }}"
                                      class="nav-link d-flex align-items-center {{ Request::is('admin/pendidik') ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Tenaga Pendidik dan <br> Kependidikan</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="#"
                                      class="nav-link d-flex align-items-center {{ Request::is('admin/alumni') ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Alumni</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('jurusan.index') }}"
                                      class="nav-link {{ Request::is('admin/jurusan') ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Jurusan</p>
                                  </a>
                              </li>
                          </ul>
                      </li>

                  @endif

                  @php
                  $active2 = '';
                  $open2 = '';

                  if (Request::is('admin/berita') || Request::is('admin/berita/create') ||
                  Request::is('admin/prestasi') || Request::is('admin/prestasi/create') ||
                  Request::is('admin/pengumuman') || Request::is('admin/kategori')
                  || Request::is('admin/tag'))
                  {
                  $open2 = 'menu-open';
                  $active2 = 'active';
                  }

                  @endphp

                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-newspaper"></i>
                          <p>
                              Manajemen Kesiswaan
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>PMR</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>OSIM</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Pramuka</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('adminlte') }}/index3.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Ekstrakurikuler</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li class="nav-item has-treeview {{ $open2 }}">
                      <a href="#" class="nav-link {{ $active2 }}">
                          <i class="nav-icon fas fa-newspaper"></i>
                          <p>
                              Manajemen Publikasi
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('kategori.index') }}"
                                  class="nav-link {{ Request::is('admin/kategori') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Kategori Berita</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('tag.index') }}"
                                  class="nav-link {{ Request::is('admin/tag') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Tag Berita</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('berita.index') }}"
                                  class="nav-link {{ Request::is('admin/berita') || Request::is('admin/berita/create') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Berita</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('pengumuman.index') }}"
                                  class="nav-link {{ Request::is('admin/pengumuman') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Pengumuman</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('prestasi.index') }}"
                                  class="nav-link  {{ Request::is('admin/prestasi') || Request::is('admin/prestasi/create') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Prestasi</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('album.index') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Galeri</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  @if (Auth::user()->level == 1)
                      <li class="nav-item">
                          <a href="{{ route('aplikasi.index') }}"
                              class="nav-link {{ Request::is('admin/aplikasi') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-cog"></i>
                              <p>
                                  Pengaturan Aplikasi
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="../widgets.html" class="nav-link">
                              <i class="nav-icon fas fa-database"></i>
                              <p>
                                  Backup & Restore
                              </p>
                          </a>
                      </li>
                  @endif


                  <li class="nav-item">
                      <a href="javascript:void()" data-toggle="modal" data-target="#logoutModal" class="nav-link">
                          <i class="nav-icon fas fa-sign-out-alt"></i>
                          <p>
                              Logout
                          </p>
                      </a>
                  </li>

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
