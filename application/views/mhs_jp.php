<?=$header?>
        <!-- BEGIN CONTAINER -->
        <div class="container-fluid">
            <div class="page-content page-content-popup">
                <div class="page-content-fixed-header">
                    <!-- BEGIN BREADCRUMBS -->
                    <ul class="page-breadcrumb">
                        <li><?=$role?></li>
                        <li>Jadwal Perkuliahan</li>
                    </ul>
                    <!-- END BREADCRUMBS -->
                    <div class="content-header-menu">
                        <!-- BEGIN MENU TOGGLER -->
                        <button type="button" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="toggle-icon">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </span>
                        </button>
                        <!-- END MENU TOGGLER -->
                    </div>
                </div>
                <?=$menu?>
                <?php $final = (isset($user['id_draft'])) ? explode('_', $user['id_draft']) : array();?>
                <div class="page-fixed-main-content">
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green sbold uppercase">Jadwal Perkuliahan</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <form class="form-inline" role="form" method="post" action="mhs_jp">
                                        <div class="form-group">
                                            <label class="sr-only" for="tahunAjar">Jadwal Perkuliahan</label>
                                            <select class="form-control" name="tahun_ajar" id="tahunAjar">
                                                <option value="0">Pilih Tahun Ajaran Jadwal Perkuliahan</option>
                                                <?php
                                                foreach ($opt_jp as $key => $value) {
                                                    if (isset($flash_id_jp)) {
                                                        # code...
                                                    }
                                                ?>
                                                <option value="<?=$value->draft_id_jp?>" <?=(isset($flash_id_jp) && $flash_id_jp == $value->draft_id_jp) ? 'selected' : ''?>><?=$value->tahun_ajaran?> - <?=$value->semester?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-default">BUKA</button>
                                        <button class="btn red" type="submit" title="Export to Pdf" formtarget="_blank" name="pdf" value="pdf">Export to PDF <i class="fa fa-file-pdf-o"></i></button>
                                    </form>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> Hari </th>
                                                <th> Mata Kuliah </th>
                                                <th> SKS </th>
                                                <th> Semester </th>
                                                <th> Waktu </th>
                                                <th> Dosen </th>
                                                <th> Ruang </th>
                                                <th> Peserta </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            (isset($list_jp)) ? : $list_jp = array();
                                            foreach ($list_jp as $row) {
                                                if (
                                                    # angka 3 menyatakan matakuliah umum u/ program studi si/ti
                                                    ($row->id_prodi == $this->session->userdata('Detail')['id_prodi'] || $row->id_prodi == 3) 
                                                    # angka 1 menyatakan matakuliah umum u/ peminatan umum baik dari SI atau TI
                                                    && ($row->id_peminatan == $this->session->userdata('Detail')['id_peminatan'] || $row->id_peminatan ==1)
                                                    # matakuliah yang telah diambil
                                                    && (in_array($row->kode_mk, $matkul_diambil->kode_mk))
                                                ) {
                                                    # code...
                                                ?>
                                                <tr>
                                                    <td> <?=$row->nama_hari?> </td>
                                                    <td> <?=$row->nama_mk?> </td>
                                                    <td> <?=$row->sks_mk?> </td>
                                                    <td> <?=$row->semester_mk?> </td>
                                                    <td> <?php 
                                                    if ((isset($row->waktu_aw)) && (isset($row->waktu_ak))) {
                                                        # code...
                                                        echo date('H:i', strtotime($row->waktu_aw)).' - '.date('H:i', strtotime($row->waktu_ak)); 
                                                    }
                                                    ?> </td>
                                                    <td> <?=$row->nama?> </td>
                                                    <td> <?=$row->nama_ruangan?> </td>
                                                    <td> <?=$row->prodi?> | <?=$row->peminatan?> </td>
                                                </tr>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <!-- <button class="btn btn-success mt-sweetalert" data-title="Sweet Alerts with Icons" data-message="Success Icon" data-type="success" data-allow-outside-click="true" data-confirm-button-class="btn-success">Icon Success Alert</button> -->
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
<?=$footer?>

<script type="text/javascript">
jQuery(document).ready(function() {
});
</script>