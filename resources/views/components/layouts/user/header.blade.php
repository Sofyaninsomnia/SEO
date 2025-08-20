<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('superadmin.dashboard') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/landing/img/logo-kelas.png') }}" alt="">
            <span class="d-none d-lg-block">S E O</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('storage/foto_profil/' . Auth::user()->foto) }}" alt="Profile" class="rounded-circle"
                        style="width: 40px;
                                        height: 50px;
                                        object-fit: cover;
                                        object-position: center;">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Session::get('name') }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Session::get('email') }}</h6>
                        <span>{{  Session::get('role') }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="">
                            <i class="bi bi-person-add"></i>
                            <span>Kelola Akun</span>            
                        </a>
                    </li>

                    <li>
                        <form action="{{ route('logout-superadmin') }}" method="POST" id="logout-button" class="dropdown-item d-flex align-items-center" >
                            @csrf
                            <i class="bi bi-box-arrow-right"></i>
                            <span><button style="border: none; background: none;"> LogOut</button></span>
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
