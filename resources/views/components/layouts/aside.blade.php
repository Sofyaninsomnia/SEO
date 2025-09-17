<aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-heading">Home</li>

            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link @activeclass('admin/dashboard')" href="{{ route('admin.dashboard')}}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-heading">Main Menu</li>

            <!-- KATEGORI -->
            <li class="nav-item">
                <a class="nav-link collapsed @activeclass('admin/absen')" href="{{ route('admin_absen') }}">
                    <i class="bi bi-journal-check"></i>
                    <span>Absen</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed @activeclass('admin/saran/fitur')" href="{{ route('saran.admin') }}">
                    <i class="bi bi-chat"></i>
                    <span>Saran Fitur</span>
                </a>
            </li>
            
            <li class="nav-heading">Laporan</li>
                
            <li class="nav-item">
                <a class="nav-link collapsed @activeclass('admin/rekap_data')" href="">
                    <i class="bi bi-journals"></i>
                    <span>Rekap data</span>
                </a>
            </li>
            
    </aside>