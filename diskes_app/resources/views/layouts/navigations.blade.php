<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('user_profile/'.auth()->user()->foto) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                @auth
                   <a href="{{ route('user-profile') }}"> <h5>{{ Auth::user()->nama }}</h5></a>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                @endauth
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <li class="nav-item">
                <a href="{{ url('/dashboard') }}" class="nav-link active">
                    <i class="fa fa-pie-chart" style="margin-right: 10px"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('index-pegawai') }}" class="nav-link">
                    <i class="fa  fa-users" style="margin-right: 10px"></i>Daftar Pegawai
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('index-gedung') }}" class="nav-link">
                    <i class="fa fa-building" style="margin-right: 10px"></i>Daftar Gedung
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('index-berkas') }}" class="nav-link">
                    <i class="fa fa-folder-open" style="margin-right: 10px"></i>Daftar Berkas
                </a>
            </li>
            @if (Auth::user()->role === 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('index-verifikasi') }}" class="nav-link">
                        <i class="fa  fa-check-square-o" style="margin-right: 10px"></i>Daftar Verifikasi Berkas
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('index-user') }}" class="nav-link">
                        <i class="fa fa-user" style="margin-right: 10px"></i>Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pengelolaan-angaran') }}" class="nav-link">
                        <i class="fa fa-fax" style="margin-right: 10px"></i>Pengelolaan Angaran
                    </a>
                </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
