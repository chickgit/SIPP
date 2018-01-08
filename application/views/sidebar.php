<div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                            <li class="nav-item start <?=isset($dashboard) ? $dashboard : ''?>">
                                <a href="home" class="nav-link nav-toggle">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard</span>
                                </a>
                            </li>
                            <li class="heading">
                                <h3 class="uppercase">KAPRODI</h3>
                            </li>
                            <!-- MENU DOSEN -->
                            <li class="nav-item <?=isset($dosen) ? $dosen : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-user"></i>
                                    <span class="title">Dosen</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu" style="display: <?=isset($dosen) ? 'block' : ''?>;">
                                    <li class="nav-item <?=isset($dosen) ? $dosen : ''?>">
                                        <a href="dosen" class="nav-link">
                                            <i class="fa fa-table"></i> Data </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-trash-o"></i> Histori </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- MENU MATA KULIAH -->
                            <li class="nav-item <?=isset($mk) ? $mk : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-book"></i>
                                    <span class="title">Mata Kuliah</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu" style="display: <?=isset($mk) ? 'block' : ''?>;">
                                    <li class="nav-item <?=isset($mk) ? $mk : ''?>">
                                        <a href="matakuliah" class="nav-link">
                                            <i class="fa fa-table"></i> Data </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-trash-o"></i> Histori </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- MENU RUANGAN -->
                            <li class="nav-item <?=isset($ruangan) ? $ruangan : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-group"></i>
                                    <span class="title">Ruangan</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu" style="display: <?=isset($ruangan) ? 'block' : ''?>;">
                                    <li class="nav-item <?=isset($ruangan) ? $ruangan : ''?>">
                                        <a href="ruangan" class="nav-link">
                                            <i class="fa fa-table"></i> Data </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-trash-o"></i> Histori </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- MENU WAKTU -->
                            <li class="nav-item <?=isset($waktu) ? $waktu : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-clock-o"></i>
                                    <span class="title">Waktu</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu" style="display: <?=isset($waktu) ? 'block' : ''?>;">
                                    <li class="nav-item <?=isset($waktu) ? $waktu : ''?>">
                                        <a href="waktu" class="nav-link">
                                            <i class="fa fa-table"></i> Data </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-trash-o"></i> Histori </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- MENU JADWAL -->
                            <li class="nav-item <?=isset($jadwal) ? $jadwal : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-th-list"></i>
                                    <span class="title">Jadwal</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu" style="display: <?=isset($jadwal) ? 'block' : ''?>;">
                                    <li class="nav-item <?=isset($jadwal) ? $jadwal : ''?>">
                                        <a href="jadwal" class="nav-link">
                                            <i class="fa fa-table"></i> Data </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-trash-o"></i> Histori </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="heading">
                                <h3 class="uppercase">JADWAL</h3>
                            </li>
                            <li class="nav-item <?=isset($jadwalP) ? $jadwalP : ''?> ">
                                <a href="jadwalP" class="nav-link nav-toggle">
                                    <i class="icon-calendar"></i>
                                    <span class="title">Jadwal Perkuliahan</span>
                                </a>
                            </li>
                        </ul>
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>