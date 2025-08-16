<aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-heading">Home</li>

            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link @activeclass('superadmin/dashboard')" href="{{ route('superadmin.dashboard')}}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-heading">Main Menu</li>

            <!-- KATEGORI -->
            <li class="nav-item">
                <a class="nav-link @activeclass('superadmin/super-absen')" href="{{ route('super-absen') }}">
                    <i class="bi bi-journal-check"></i>
                    <span>Absen</span>
                </a>
            </li>

            <!-- Data supplier -->
            <li class="nav-item">
                <a class="nav-link  @activeclass('admin/data_supplier')" href="">
                    <i class="bi bi-people"></i>
                    <span>User</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link  @activeclass('admin/data_barang')" href="">
                    <i class="bi bi-cash-stack"></i>
                    <span>Kas</span>
                </a>
            </li>
            
            
            <li class="nav-heading">Laporan</li>
                
            <li class="nav-item">
                <a class="nav-link  @activeclass('admin/rekap_data')" href="">
                    <i class="bi bi-journals"></i>
                    <span>Rekap data</span>
                </a>
            </li>
            
    </aside>