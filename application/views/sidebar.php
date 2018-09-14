                
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
                            
                            <?php
                            switch ($role) {
                                // 1
                                case 'Kaprodi':
                                    ?>
                            <li class="nav-item start <?=isset($dashboard) ? $dashboard : ''?>">
                                <a href="<?=base_url()?>home" class="nav-link nav-toggle">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard</span>
                                </a>
                            </li>
                            <li class="heading">
                                <h3 class="uppercase"><?=strtoupper($role)?></h3>
                            </li>
                            <!-- MENU DOSEN -->
                            <li class="nav-item <?=isset($dosen) ? $dosen : ''?><?=isset($histori_dosen) ? $histori_dosen : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-user"></i>
                                    <span class="title">Dosen</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu" style="display: <?=isset($dosen) ? 'block' : ''?>;">
                                    <li class="nav-item <?=isset($dosen) ? $dosen : ''?>">
                                        <a href="<?=base_url()?>dosen" class="nav-link">
                                            <i class="fa fa-table"></i> Data </a>
                                    </li>
                                    <li class="nav-item <?=isset($histori_dosen) ? $histori_dosen : ''?>">
                                        <a href="<?=base_url()?>histori/dosen" class="nav-link">
                                            <i class="fa fa-trash-o"></i> Histori </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- MENU MATA KULIAH -->
                            <li class="nav-item <?=isset($mk) ? $mk : ''?><?=isset($histori_matakuliah) ? $histori_matakuliah : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-book"></i>
                                    <span class="title">Mata Kuliah</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu" style="display: <?=isset($mk) ? 'block' : ''?>;">
                                    <li class="nav-item <?=isset($mk) ? $mk : ''?>">
                                        <a href="<?=base_url()?>matakuliah" class="nav-link">
                                            <i class="fa fa-table"></i> Data </a>
                                    </li>
                                    <li class="nav-item <?=isset($histori_matakuliah) ? $histori_matakuliah : ''?>">
                                        <a href="<?=base_url()?>histori/matakuliah" class="nav-link">
                                            <i class="fa fa-trash-o"></i> Histori </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- MENU RUANGAN -->
                            <li class="nav-item <?=isset($ruangan) ? $ruangan : ''?><?=isset($histori_ruangan) ? $histori_ruangan : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-group"></i>
                                    <span class="title">Ruangan</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu" style="display: <?=isset($ruangan) ? 'block' : ''?>;">
                                    <li class="nav-item <?=isset($ruangan) ? $ruangan : ''?>">
                                        <a href="<?=base_url()?>ruangan" class="nav-link">
                                            <i class="fa fa-table"></i> Data </a>
                                    </li>
                                    <li class="nav-item <?=isset($histori_ruangan) ? $histori_ruangan : ''?>">
                                        <a href="<?=base_url()?>histori/ruangan" class="nav-link">
                                            <i class="fa fa-trash-o"></i> Histori </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- MENU WAKTU -->
                            <li class="nav-item <?=isset($waktu) ? $waktu : ''?> <?=isset($histori_waktu) ? $histori_waktu : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-clock-o"></i>
                                    <span class="title">Waktu</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu" style="display: <?=isset($waktu) ? 'block' : ''?>;">
                                    <li class="nav-item <?=isset($waktu) ? $waktu : ''?>">
                                        <a href="<?=base_url()?>waktu" class="nav-link">
                                            <i class="fa fa-table"></i> Data </a>
                                    </li>
                                    <li class="nav-item <?=isset($histori_waktu) ? $histori_waktu : ''?>">
                                        <a href="<?=base_url()?>histori/waktu" class="nav-link">
                                            <i class="fa fa-trash-o"></i> Histori </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- MENU HARI -->
                            <li class="nav-item <?=isset($hari) ? $hari : ''?> <?=isset($histori_hari) ? $histori_hari : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-calendar"></i>
                                    <span class="title">Hari</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu" style="display: <?=isset($hari) ? 'block' : ''?>;">
                                    <li class="nav-item <?=isset($hari) ? $hari : ''?>">
                                        <a href="<?=base_url()?>hari" class="nav-link">
                                            <i class="fa fa-table"></i> Data </a>
                                    </li>
                                    <li class="nav-item <?=isset($histori_hari) ? $histori_hari : ''?>">
                                        <a href="<?=base_url()?>histori/hari" class="nav-link">
                                            <i class="fa fa-trash-o"></i> Histori </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- MENU JADWAL -->
                            <li class="nav-item <?=isset($jadwal) ? $jadwal : ''?> <?=isset($histori_jadwal_temp) ? $histori_jadwal_temp : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-th-list"></i>
                                    <span class="title">Jadwal</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu" style="display: <?=isset($jadwal) ? 'block' : ''?>;">
                                    <li class="nav-item <?=isset($jadwal) ? $jadwal : ''?>">
                                        <a href="<?=base_url()?>jadwal" class="nav-link">
                                            <i class="fa fa-table"></i> Data </a>
                                    </li>
                                    <li class="nav-item <?=isset($histori_jadwal_temp) ? $histori_jadwal_temp : ''?>">
                                        <a href="<?=base_url()?>histori/jadwal_temp" class="nav-link">
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
                                    <?php
                                    break;
                                // 2
                                case 'Mahasiswa':
                                    ?>
                            <li class="heading">
                                <h3 class="uppercase"><?=strtoupper($role)?></h3>
                            </li>
                            <!-- MENU MAHASISWA -->
                            <li class="nav-item <?=isset($amk) ? $amk : ''?><?=isset($histori_matakuliah) ? $histori_matakuliah : ''?>">
                                <a href="<?=base_url()?>ambil_matakuliah" class="nav-link nav-toggle">
                                    <i class="fa fa-book"></i>
                                    <span class="title">Mata Kuliah</span>
                                    <!-- <span class="arrow"></span> -->
                                </a>
                                <!-- <ul class="sub-menu" style="display: <?=isset($mk) ? 'block' : ''?>;">
                                    <li class="nav-item <?=isset($mk) ? $mk : ''?>">
                                        <a href="<?=base_url()?>ambil_matakuliah" class="nav-link">
                                            <i class="fa fa-th-list"></i> Ambil </a>
                                    </li>
                                    <li class="nav-item <?=isset($histori_matakuliah) ? $histori_matakuliah : ''?>">
                                        <a href="<?=base_url()?>histori/matakuliah" class="nav-link">
                                            <i class="fa fa-table"></i> Lihat </a>
                                    </li>
                                </ul> -->
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
                                    <?php
                                    break;
                                
                                default:
                                    ?>
                                    <?php
                                    break;
                            }
                            ?>
                            
                        </ul>
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>