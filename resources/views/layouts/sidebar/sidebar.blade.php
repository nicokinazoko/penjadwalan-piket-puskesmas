<div class="sidebar">
    {{-- <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
        </div>
    </div> --}}


    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
   with font-awesome or any other icon font library -->
            <li class="nav-header">DATA</li>

            <!-- Data Pegawai -->
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Data Pegawai
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('pegawai-view-data') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Lihat Data Pegawai</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pegawai-input-data') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Input Data Pegawai</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pegawai-edit-data') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Edit Data Pegawai</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Hapus Data Pegawai</p>
                        </a>
                    </li>

                </ul>
            </li>

            <!-- Data Piket -->
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Data Piket
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('piket-view-data') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Lihat Data Piket</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('piket-input-data') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Input Data Piket</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('piket-edit-data') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Edit Data Piket</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Hapus Data Piket</p>
                        </a>
                    </li>

                </ul>
            </li>


            <li class="nav-header">PROSES DATA</li>
            <li class="nav-item">

                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Pilihan Algoritma
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('view-memetika') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Algoritma Memetika</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('view-neuro-fuzzy') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Algoritma Neuro Fuzzy</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-header">LIHAT DATA</li>
            <li class="nav-item">

                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Lihat Data Penjadwalan
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('view-data-algoritma-memetika') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Algoritma Memetika</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Algoritma Neuro Fuzzy</p>
                        </a>
                    </li>
                </ul>
            </li>


            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
