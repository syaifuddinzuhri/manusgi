  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
      <div class="container d-flex align-items-center">
          <!-- Uncomment below if you prefer to use an image logo -->
          <a href="{{ route('frontend.home') }}" class="logo mr-auto">
              <img src="{{ $app->logo }}" alt="" class="img-fluid" />
              <h5 class="d-lg-inline d-md-inline d-sm-inline d-none font-weight-bold">{{ $app->nama }}</h5>
          </a>

          <nav class="nav-menu d-none d-lg-block">
              <ul>
                  <li class="active"><a href="{{ route('frontend.home') }}">Home</a></li>

                  <li class="drop-down"><a href="javascript:void(0)">Profil</a>
                      <ul>
                          <li><a href="{{ route('frontend.sejarah') }}">Sejarah</a></li>
                          <li><a href="{{ route('frontend.visimisi') }}">Visi & Misi</a></li>
                          <li><a href="{{ route('frontend.sarpras') }}">Sarana & Prasarana</a>
                          <li><a href="{{ route('frontend.pendidik') }}">Tenaga Pendidik &
                                  Kependidikan</a>
                          <li><a href="{{ route('frontend.jurusan') }}">Jurusan</a>
                          <li><a href="#">Testimonial</a>
                          </li>
                      </ul>
                  </li>
                  {{-- <li class="drop-down"><a href="javascript:void(0)">Kesiswaan</a>
                      <ul>
                          <li><a href="#">OSIM</a></li>
                          <li><a href="#">PMR</a></li>
                          <li><a href="#">Pramuka</a></li>
                          <li><a href="#">Ekstrakurikuler</a></li>
                      </ul>
                  </li> --}}
                  <li class="drop-down"><a href="javascript:void(0)">Publikasi</a>
                      <ul>
                          <li><a href="{{ route('frontend.pengumuman') }}">Pengumuman</a></li>
                          <li><a href="{{ route('frontend.berita') }}">Berita</a></li>
                      </ul>
                  </li>
                  <li><a href="{{ route('frontend.galeri') }}">Galeri</a></li>
                  <li><a href="{{ route('frontend.prestasi') }}">Prestasi</a></li>
                  <li><a href="{{ route('frontend.ppdb') }}">PPDB</a></li>
                  <li><a href="#">Kontak</a></li>

              </ul>
          </nav><!-- .nav-menu -->

          <div class="header-social-links">
              <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
              <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
          </div>

      </div>
  </header><!-- End Header -->
