<!-- <link href="<?=base_url()?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" /> -->
<?=$header?>
        <!-- BEGIN CONTAINER -->
        <div class="container-fluid">
            <div class="page-content page-content-popup">
                <div class="page-content-fixed-header">
                    <!-- BEGIN BREADCRUMBS -->
                    <ul class="page-breadcrumb">
                        <li><?=$role?></li>
                        <li>Jadwal</li>
                    </ul>
                    <!-- END BREADCRUMBS -->
                    <div class="content-header-menu">
                        <!-- BEGIN DROPDOWN AJAX MENU -->
                        <!-- <div class="dropdown-ajax-menu btn-group">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="fa fa-circle"></i>
                                <i class="fa fa-circle"></i>
                                <i class="fa fa-circle"></i>
                            </button>
                            <ul class="dropdown-menu-v2">
                                <li>
                                    <a href="start.html">Application</a>
                                </li>
                                <li>
                                    <a href="start.html">Reports</a>
                                </li>
                                <li>
                                    <a href="start.html">Templates</a>
                                </li>
                                <li>
                                    <a href="start.html">Settings</a>
                                </li>
                            </ul>
                        </div> -->
                        <!-- END DROPDOWN AJAX MENU -->
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
                <div class="page-fixed-main-content">
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green sbold uppercase">Data Jadwal</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" data-toggle="modal" title="Generate Jadwal" id="generate_table_jadwal">
                                            <i class="fa fa-random"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" data-toggle="modal" title="Hapus Tabel" id="delete_table_jadwal">
                                            <i class="fa fa-remove"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="panel-group accordion" id="accordion3">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1" aria-expanded="true"> Cari </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_3_1" class="panel-collapse collapse in" aria-expanded="true" style="">
                                                <div class="panel-body">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control input-sm global_filter" id="global_filter">
                                                        <span class="input-group-btn">
                                                            <button class="btn red btn-sm clear_search" type="button"><i class="fa fa-remove"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_2" aria-expanded="false"> Pencarian Lanjutan </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_3_2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body" style="height:200px; overflow-y:auto;">
                                                    <table class="table" border="0">
                                                        <tr>
                                                            <td colspan="2">
                                                                <button class="btn red btn-sm pull-right clear_search_all" type="button">
                                                                    <i class="fa fa-remove"></i>
                                                                    Clear All
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr data-column="0">
                                                            <td>Hari</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control column_filter input-sm" id="col0_filter">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn red btn-sm clear_search" type="button"><i class="fa fa-remove"></i></button>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr data-column="1">
                                                            <td>Mata Kuliah</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control column_filter input-sm" id="col1_filter">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn red btn-sm clear_search" type="button"><i class="fa fa-remove"></i></button>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr data-column="2">
                                                            <td>SKS</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control column_filter input-sm" id="col2_filter">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn red btn-sm clear_search" type="button"><i class="fa fa-remove"></i></button>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr data-column="3">
                                                            <td>Semester</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control column_filter input-sm" id="col3_filter">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn red btn-sm clear_search" type="button"><i class="fa fa-remove"></i></button>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr data-column="4">
                                                            <td>Waktu</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control column_filter input-sm" id="col4_filter">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn red btn-sm clear_search" type="button"><i class="fa fa-remove"></i></button>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr data-column="5">
                                                            <td>Dosen</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control column_filter input-sm" id="col5_filter">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn red btn-sm clear_search" type="button"><i class="fa fa-remove"></i></button>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr data-column="6">
                                                            <td>Ruang</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control column_filter input-sm" id="col6_filter">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn red btn-sm clear_search" type="button"><i class="fa fa-remove"></i></button>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr data-column="7">
                                                            <td>Peserta</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control column_filter input-sm" id="col7_filter">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn red btn-sm clear_search" type="button"><i class="fa fa-remove"></i></button>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <button class="btn red btn-sm pull-right clear_search_all" type="button">
                                                                    <i class="fa fa-remove"></i>
                                                                    Clear All
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                <th> Actions </th>
                                                <!-- <th> Created By </th>
                                                <th> Modified Date </th>
                                                <th> Modified By </th>
                                                <th> Show </th>
                                                <th> Actions </th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($list_jw as $row) {
                                                ?>
                                                <tr class="odd gradeX">
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
                                                    <td> <?=$row->kode_rg?> </td>
                                                    <td> <?=$row->peserta?> </td>
                                                    <td>
                                                        <div class="btn-group btn-group-justified">
                                                            <a id="update_jw" data-val="<?=$row->id_j_t?>" class="btn btn-sm green">
                                                                <i class="icon-docs"></i> Ubah</a>
                                                            <a id="delete_jw" data-val="<?=$row->id_j_t?>" class="btn btn-sm red">
                                                                <i class="icon-trash"></i> Hapus</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                        <!-- <button class="btn btn-success mt-sweetalert" data-title="Sweet Alerts with Icons" data-message="Success Icon" data-type="success" data-allow-outside-click="true" data-confirm-button-class="btn-success">Icon Success Alert</button> -->
                                    </table>
                                    <!-- MODAL UPDATE -->
                                    <div class="modal fade bs-modal-lg " id="modal_update_jw" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" id="modal_dialog_update_jw"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Update Jadwal</h4>
                                                </div>
                                                <form id="form_update_jw" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-warning display-hide warning-upd-jw">
                                                                <button class="close" data-close="alert"></button> Anda memiliki beberapa bentuk peringatan
                                                                <a id="popover-warning-upd-jw" class="btn btn-circle btn-icon-only btn-default" data-toggle="popover" data-content="">
                                                                    <i class="fa fa-exclamation"></i>
                                                                </a> 
                                                            </div>
                                                            <div class="alert alert-danger display-hide">
                                                                <button class="close" data-close="alert"></button> Anda memiliki beberapa bentuk kesalahan. Silakan cek di bawah ini. 
                                                            </div>
                                                            <div class="alert alert-success display-hide">
                                                                <button class="close" data-close="alert"></button> Data berhasil di simpan! 
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Hari
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <select class="form-control select2" name="upd_hari_jw">
                                                                        <?php
                                                                            foreach ($all_data['hari'] as $value) {
                                                                        ?>
                                                                        <option value="<?=$value['id']?>"><?=$value['nama_hari']?></option>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Mata Kuliah
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <select class="form-control select2" name="upd_mk_jw">
                                                                        <?php
                                                                            $peminatan = Array(
                                                                              '0' => 'Umum',
                                                                              '1' => 'EIS',
                                                                              '2' => 'MM',
                                                                              '3' => 'JarKom',
                                                                              '4' => 'MobA',
                                                                            );
                                                                            foreach ($all_data['matakuliah'] as $value) {
                                                                        ?>
                                                                        <option value="<?=$value['kode_mk']?>" data-detail="<?=$value['sks_mk']?>_<?=$value['semester_mk']?>_<?=$value['program_studi']?>_<?=$peminatan[$value['peminatan']]?>" data-rg="<?=$value['jenis_rg']?>"><?=$value['nama_mk']?> | <?=$value['sks_mk']?> SKS | Semester <?=$value['semester_mk']?> | <?=$value['program_studi']?> | <?=$peminatan[$value['peminatan']]?></option>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">SKS
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="upd_sks_jw" readonly title="Mengikuti mata kuliah" /> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Semester
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="number" class="form-control" name="upd_semester_jw" readonly title="Mengikuti mata kuliah" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Waktu
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <select class="form-control select2" name="upd_waktu_jw">
                                                                        <?php
                                                                            foreach ($all_data['waktu'] as $value) {
                                                                        ?>
                                                                        <option value="<?=$value['kode_wk']?>"><?=$value['waktu_aw']?> - <?=$value['waktu_ak']?></option>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Dosen
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <select class="form-control select2" name="upd_dosen_jw">
                                                                        <?php
                                                                            foreach ($all_data['dosen'] as $value) 
                                                                            {
                                                                                $hari = explode(';', $value['ketersediaan_hari']);
                                                                                $ketersediaan_hari = '';
                                                                                foreach ($hari as $v_hari) {
                                                                                    # code...
                                                                                    foreach ($all_data['hari'] as $value_hari) {
                                                                                        # code...
                                                                                        if ($v_hari == $value_hari['id']) {
                                                                                            $ketersediaan_hari .= $value_hari['nama_hari'].', ';
                                                                                        }
                                                                                    }
                                                                                }
                                                                        ?>
                                                                        <option value="<?=$value['nid']?>" data-hari="<?=$value['ketersediaan_hari']?>" data-mk="<?=$value['wawasan_matkul']?>"><?=$value['nama']?> | <?=rtrim($ketersediaan_hari,', ')?></option>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Ruangan
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <select class="form-control select2" name="upd_ruangan_jw">
                                                                        <?php
                                                                            foreach ($all_data['ruangan'] as $value) {
                                                                        ?>
                                                                        <option value="<?=$value['kode_rg']?>" data-rg="<?=$value['jenis_rg']?>"><?=$value['kode_rg']?></option>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Peserta
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="upd_peserta_jw" title="Mengikuti mata kuliah" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="upd_kode_jw" value="">
                                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn green">Ubah</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- MODAL DELETE -->
                                    <div class="modal fade " id="modal_delete_jw" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_delete_jw"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Hapus Jadwal</h4>
                                                </div>
                                                <form id="form_delete_jw" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-block">
                                                                Anda yakin ingin menghapus data ini? 
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Hari
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="del_hari_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Mata Kuliah
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="del_mk_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">SKS
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="del_sks_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Semester
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="del_semester_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Waktu
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="del_waktu_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Dosen
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="del_dosen_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Ruangan
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="del_ruangan_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Peserta
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="del_peserta_jw" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="del_kode_jw" value="">
                                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn green">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- MODAL VALIDASI GENERATE -->
                                    <div class="modal fade " id="modal_generate_table_jadwal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_delete_mk"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Generate Jadwal</h4>
                                                </div>
                                                <form id="form_generate" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger alert-danger-delete">
                                                                Anda yakin ingin meng-generate ulang jadwal ? 
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Tutup</button>
                                                        <input type="hidden" name="data" value="ULANG">
                                                        <button type="submit" class="btn green">Generate</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- MODAL VALIDASI GENERATE -->
                                    <div class="modal fade " id="modal_delete_table_jadwal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog "> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Hapus Tabel</h4>
                                                </div>
                                                <form id="form_hapus" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger alert-danger-delete">
                                                                Anda yakin ingin menghapus tabel jadwal ? 
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Tutup</button>
                                                        <input type="hidden" name="data" value="HAPUS">
                                                        <button type="submit" class="btn green">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
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
    var tahun_ajaran = '<?=$user['TA']['semester']?>';
    console.log(tahun_ajaran);
    // Tipe-tipe Warning Html Content Popover Update Jadwal
    var twhcpuj = {
        hari_dosen : "<b>Hari</b> tidak sesuai dengan hari kesediaan dosen<br>",
        dosen_hari : "<b>Dosen</b> tidak sesuai dengan hari<br>",
        mk_dosen : "<b>Mata Kuliah</b> tidak sesuai dengan dosen pengajar<br>",
        dosen_mk : "<b>Dosen</b> tidak sesuai dengan mata kuliah yang diajar<br>",
        mk_ruangan : "<b>Mata Kuliah</b> tidak sesuai dengan tipe ruangan<br>",
        ruangan_mk : "<b>Ruangan</b> tidak sesuai dengan jenis mata kuliah<br>",
        mk_smstr_genap : "<b>Mata Kuliah</b> yang di pilih termasuk semester genap<br>",
        mk_smstr_ganjil : "<b>Mata Kuliah</b> yang di pilih termasuk semester ganjil<br>",
        no_warning : ""
    };
    $('#popover-warning-upd-jw').popover({
        html        : true,
        container   : ".alert-warning",
        placement   : "bottom",
        trigger     : "hover"
    });
    var JADWAL = "<?=count($list_jw)?>";

    // add the rule here
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg !== value;
    }, "Value must not equal arg.");

    $('.select2').select2({
        placeholder : null,
        width: null,
    });
    // console.log(JADWAL);
    $('#generate_table_jadwal').on('click', function(){
        if (JADWAL > 0) 
        {
            $('#modal_generate_table_jadwal').modal('show');
            var form = $('#form_generate');
            form.validate({
                submitHandler: function (form) {
                    $.ajax({
                        url: "<?=base_url()?>jadwal/generate", 
                        type: "POST",             
                        // data: {data : "ULANG"},
                        data: $(form).serialize(),
                        cache: false,             
                        processData: false,      
                        beforeSend: function(){
                            App.blockUI({
                                // target: '#form_tambah_dosen',
                                // overlayColor: 'none',
                                // animate: true,
                                zIndex: 20000,
                            });
                        },
                        success: function(data) {
                            // success4.show();
                            location.reload();
                            console.log(data);
                        },
                        complete: function(){
                            App.unblockUI();
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status);
                            alert(thrownError);
                        }
                    });
                }
            });
        }
        else
        {
            $.ajax({
                url: "<?=base_url()?>jadwal/generate", 
                type: "POST",             
                data: {data : 'NEW'},
                cache: false,             
                processData: false,      
                beforeSend: function(){
                    App.blockUI({
                        // target: '#form_tambah_dosen',
                        // overlayColor: 'none',
                        // animate: true,
                        zIndex: 20000,
                    });
                },
                success: function(data) {
                    // success4.show();
                    location.reload();
                    console.log(data);
                },
                complete: function(){
                    App.unblockUI();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
    });
    
    $('#delete_table_jadwal').on('click', function(){
        $('#modal_delete_table_jadwal').modal('show');
        var form = $('#form_hapus');
        form.validate({
            submitHandler: function (form) {
                $.ajax({
                    url: "<?=base_url()?>jadwal/hapus", 
                    type: "POST",             
                    // data: {data : "ULANG"},
                    data: $(form).serialize(),
                    cache: false,             
                    processData: false,      
                    beforeSend: function(){
                        App.blockUI({
                            // target: '#form_tambah_dosen',
                            // overlayColor: 'none',
                            // animate: true,
                            zIndex: 20000,
                        });
                    },
                    success: function(data) {
                        // success4.show();
                        location.reload();
                        console.log(data);
                    },
                    complete: function(){
                        App.unblockUI();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
            }
        });
    })
    
        // Select Input Hari
    var sih         = $('select[name="upd_hari_jw"]')
        // Select Input Dosen
        sid         = $('select[name="upd_dosen_jw"]')
        // Select Input Mata Kuliah
        simk        = $('select[name="upd_mk_jw"]')
        // Select Input Ruangan
        sirg        = $('select[name="upd_ruangan_jw"]')
        // Input Disabled SKS Mata Kuliah
        id_sks_mk   = $('input[name="upd_sks_jw"]')
        // Input Disabled Semester Mata Kuliah
        id_smstr_mk = $('input[name="upd_semester_jw"]')
        // Input Peserta Mata Kuliah
        i_p_mk      = $('input[name="upd_peserta_jw"]');

    var htmlPopover;

    function getSelectedValues (select, data_ = null)
    {
        var result;

        if (data_ == null) {
            result = select.find(':selected').val();
        }else{
            result = select.find(':selected').data(data_);
        }
        return result;
    }

    function cleanSelect2 (select)
    {
        // untuk bersihin class has-warning di select2-container--open
        select.select2('destroy');
        select.select2();
    }

    function joinAllWarning(arr_obj)
    {
        var str = "";
        for (var key in arr_obj) {
            if (arr_obj.hasOwnProperty(key)) {
                str+=arr_obj[key];
            }
        }
        return str;
    }

    $('#modal_update_jw').on('show.bs.modal', function (e) {
        var warning = {};
        sih.on('select2:select', function (e) {
            var sid_data_hari = String(getSelectedValues(sid,'hari'))
                sih_value = String(getSelectedValues(sih));
            var idform = $('#form_update_jw');

            // Validasi antara Hari dan Dosen
            sid_selected_hari = sid_data_hari.split(';');
            if (jQuery.inArray(sih_value,sid_selected_hari) != -1) {
                // Hari terdapat di kesediaan dosen
                // COCOK
                delete warning.hari_dosen;
                delete warning.dosen_hari;

                // Jika masih ada warning pada input hari
                if (warning.hasOwnProperty('hari_dosen')) {
                    // do nothing
                }else{
                    sih.parents('.form-group').removeClass('has-warning');
                    cleanSelect2(sih);
                }

                // Jika masih ada warning pada input dosen
                if (warning.hasOwnProperty('dosen_hari') || warning.hasOwnProperty('dosen_mk')) {
                    // do nothing
                }else{
                    sid.parents('.form-group').removeClass('has-warning');
                    cleanSelect2(sid);
                }

                // Jika obj warning kosong
                if (jQuery.isEmptyObject(warning)) {
                    idform.find('.alert-warning').addClass('display-hide');
                }
            }else{
                // Hari tidak ada di kesediaan dosen
                // TIDAK COCOK
                
                idform.find('.alert-warning').removeClass('display-hide');
                
                sih.parents('.form-group').addClass('has-warning');
                sid.parents('.form-group').addClass('has-warning');
                
                warning.hari_dosen = twhcpuj.hari_dosen;
                warning.dosen_hari = twhcpuj.dosen_hari;
            }
            $('#popover-warning-upd-jw').attr('data-content',joinAllWarning(warning));
        })

        sid.on('select2:select', function (e) {
            var sid_data_hari = String(getSelectedValues(sid,'hari'))
                sih_value = String(getSelectedValues(sih))
                sid_data_mk = String(getSelectedValues(sid,'mk'))
                simk_value = String(getSelectedValues(simk));

            var idform = $('#form_update_jw');

            // Validasi antara Dosen dan Hari
            sid_selected_hari = sid_data_hari.split(';');
            if (jQuery.inArray(sih_value,sid_selected_hari) != -1) {
                // Dosen hadir di hari tsb
                // COCOK
                delete warning.hari_dosen;
                delete warning.dosen_hari;

                // Jika masih ada warning pada input hari
                if (warning.hasOwnProperty('hari_dosen')) {
                    // do nothing
                }else{
                    sih.parents('.form-group').removeClass('has-warning');
                    cleanSelect2(sih);
                }

                // Jika masih ada warning pada input dosen
                if (warning.hasOwnProperty('dosen_hari') || warning.hasOwnProperty('dosen_mk')) {
                    // do nothing
                }else{
                    sid.parents('.form-group').removeClass('has-warning');
                    cleanSelect2(sid);
                }

                // Jika obj warning kosong
                if (jQuery.isEmptyObject(warning)) {
                    idform.find('.alert-warning').addClass('display-hide');

                }
            }else{
                // Dosen absen di hari tsb
                // TIDAK COCOK
                
                idform.find('.alert-warning').removeClass('display-hide');
                
                sih.parents('.form-group').addClass('has-warning');
                sid.parents('.form-group').addClass('has-warning');
                
                warning.dosen_hari = twhcpuj.dosen_hari;
                warning.hari_dosen = twhcpuj.hari_dosen;
            }

            // Validasi antara Dosen dan Matkul
            sid_mk = sid_data_mk.split(';');
            sid_mk_new = [];
            for (var i = 0; i < sid_mk.length; i++) {
                sid_mk_new.push(sid_mk[i].replace(/_[0-9]/g,''));
            }
            if (jQuery.inArray(simk_value,sid_mk_new) != -1) {
                // Matkul dapat diajar oleh dosen
                delete warning.mk_dosen;
                delete warning.dosen_mk;

                // Jika masih ada warning pada input dosen
                if (warning.hasOwnProperty('dosen_hari') || warning.hasOwnProperty('dosen_mk')) {
                    // do nothing
                }else{
                    sid.parents('.form-group').removeClass('has-warning');
                    cleanSelect2(sid);
                }

                // Jika masih ada warning pada input matkul
                if (warning.hasOwnProperty('mk_dosen') || warning.hasOwnProperty('mk_ruangan') || warning.hasOwnProperty('mk_smstr_genap') || warning.hasOwnProperty('mk_smstr_ganjil')) {
                    // do nothing
                }else{
                    simk.parents('.form-group').removeClass('has-warning');
                    cleanSelect2(simk);
                }

                // Jika obj warning kosong
                if (jQuery.isEmptyObject(warning)) {
                    idform.find('.alert-warning').addClass('display-hide');

                }
            }else{
                // Matkul tidak dapat diajar dosen
                idform.find('.alert-warning').removeClass('display-hide');
                
                simk.parents('.form-group').addClass('has-warning');
                sid.parents('.form-group').addClass('has-warning');
                
                warning.dosen_mk = twhcpuj.dosen_mk;
                warning.mk_dosen = twhcpuj.mk_dosen;
            }
            $('#popover-warning-upd-jw').attr('data-content',joinAllWarning(warning));
        })

        simk.on('select2:select', function (e) {
            var sid_data_mk = String(getSelectedValues(sid,'mk'))
                simk_value = String(getSelectedValues(simk))
                simk_data_detail = String(getSelectedValues(simk,'detail'))
                simk_data_rg = String(getSelectedValues(simk,'rg'))
                sirg_data_rg = String(getSelectedValues(sirg,'rg'));

            var idform = $('#form_update_jw');

            simk_dd_new = simk_data_detail.split('_');
            id_sks_mk.val(simk_dd_new[0]);
            id_smstr_mk.val(simk_dd_new[1]);
            i_p_mk.val(simk_dd_new[2]+' | '+simk_dd_new[3]);

            // Validasi antara Matkul dan Dosen
            sid_mk = sid_data_mk.split(';');
            sid_mk_new = [];
            for (var i = 0; i < sid_mk.length; i++) {
                sid_mk_new.push(sid_mk[i].replace(/_[0-9]/g,''));
            }
            if (jQuery.inArray(simk_value,sid_mk_new) != -1) {
                // Matkul dapat diajar oleh dosen
                delete warning.mk_dosen;
                delete warning.dosen_mk;

                // Jika masih ada warning pada input dosen
                if (warning.hasOwnProperty('dosen_hari') || warning.hasOwnProperty('dosen_mk')) {
                    // do nothing
                }else{
                    sid.parents('.form-group').removeClass('has-warning');
                    cleanSelect2(sid);
                }

                // Jika masih ada warning pada input matkul
                if (warning.hasOwnProperty('mk_dosen') || warning.hasOwnProperty('mk_ruangan') || warning.hasOwnProperty('mk_smstr_genap') || warning.hasOwnProperty('mk_smstr_ganjil')) {
                    // do nothing
                }else{
                    simk.parents('.form-group').removeClass('has-warning');
                    cleanSelect2(simk);
                }

                if (jQuery.isEmptyObject(warning)) {
                    // Jika obj warning kosong
                    idform.find('.alert-warning').addClass('display-hide');
                }
            }else{
                // Matkul tidak dapat diajar dosen
                idform.find('.alert-warning').removeClass('display-hide');
                
                simk.parents('.form-group').addClass('has-warning');
                sid.parents('.form-group').addClass('has-warning');
                
                warning.mk_dosen = twhcpuj.mk_dosen;
                warning.dosen_mk = twhcpuj.dosen_mk;
            }

            // Validasi antara Matkul dan Ruangan
            if (simk_data_rg == sirg_data_rg) {
                // Matkul dan ruangan punya jenis yg sama
                delete warning.mk_ruangan;
                delete warning.ruangan_mk;

                // Jika masih ada warning pada input ruangan
                if (warning.hasOwnProperty('ruangan_mk')) {
                    // do nothing
                }else{
                    sirg.parents('.form-group').removeClass('has-warning');
                    cleanSelect2(sirg);
                }

                // Jika masih ada warning pada input matkul
                if (warning.hasOwnProperty('mk_dosen') || warning.hasOwnProperty('mk_ruangan') || warning.hasOwnProperty('mk_smstr_genap') || warning.hasOwnProperty('mk_smstr_ganjil')) {
                    // do nothing
                }else{
                    simk.parents('.form-group').removeClass('has-warning');
                    cleanSelect2(simk);
                }

                if (jQuery.isEmptyObject(warning)) {
                    // Jika obj warning kosong
                    idform.find('.alert-warning').addClass('display-hide');

                }
            }else{
                // Matkul dan ruangan berbeda jenis
                idform.find('.alert-warning').removeClass('display-hide');
                
                simk.parents('.form-group').addClass('has-warning');
                sirg.parents('.form-group').addClass('has-warning');
                
                warning.mk_ruangan = twhcpuj.mk_ruangan;
                warning.ruangan_mk = twhcpuj.ruangan_mk;
            }

            // Validasi antara Matkul dan Semester
            switch (tahun_ajaran){
                case 'GANJIL':
                    // Jika semester matkul ganjil
                    if (id_smstr_mk.val() % 2 === 1) {
                        delete warning.mk_smstr_genap;
                        // Jika masih ada warning pada input matkul
                        if (warning.hasOwnProperty('mk_dosen') || warning.hasOwnProperty('mk_ruangan') || warning.hasOwnProperty('mk_smstr_genap') || warning.hasOwnProperty('mk_smstr_ganjil')) {
                            // do nothing
                        }else{
                            simk.parents('.form-group').removeClass('has-warning');
                            cleanSelect2(simk);
                        }
                        if (jQuery.isEmptyObject(warning)) {
                            // Jika obj warning kosong
                            idform.find('.alert-warning').addClass('display-hide');
                        }
                    }else{
                        // semester matkul genap
                        idform.find('.alert-warning').removeClass('display-hide');
                
                        simk.parents('.form-group').addClass('has-warning');
                        
                        warning.mk_smstr_genap = twhcpuj.mk_smstr_genap;
                    }
                    break;
                case 'GENAP' :
                    // Jika semester matkul genap
                    if (id_smstr_mk.val() % 2 === 0) {
                        delete warning.mk_smstr_ganjil;
                        // Jika masih ada warning pada input matkul
                        if (warning.hasOwnProperty('mk_dosen') || warning.hasOwnProperty('mk_ruangan') || warning.hasOwnProperty('mk_smstr_genap') || warning.hasOwnProperty('mk_smstr_ganjil')) {
                            // do nothing
                        }else{
                            simk.parents('.form-group').removeClass('has-warning');
                            cleanSelect2(simk);
                        }
                        if (jQuery.isEmptyObject(warning)) {
                            // Jika obj warning kosong
                            idform.find('.alert-warning').addClass('display-hide');
                        }
                    }else{
                        // semester matkul ganjil
                        idform.find('.alert-warning').removeClass('display-hide');
                
                        simk.parents('.form-group').addClass('has-warning');
                        
                        warning.mk_smstr_ganjil = twhcpuj.mk_smstr_ganjil;
                    }
                    break;
            }
            $('#popover-warning-upd-jw').attr('data-content',joinAllWarning(warning));
        })

        sirg.on('select2:select', function (e) {
            var simk_data_rg = String(getSelectedValues(simk,'rg'))
                sirg_data_rg = String(getSelectedValues(sirg,'rg'));

            var idform = $('#form_update_jw');

            // Validasi antara Matkul dan Ruangan
            if (simk_data_rg == sirg_data_rg) {
                // Matkul dan ruangan punya jenis yg sama
                delete warning.mk_ruangan;
                delete warning.ruangan_mk;

                // Jika masih ada warning pada input ruangan
                if (warning.hasOwnProperty('ruangan_mk')) {
                    // do nothing
                }else{
                    sirg.parents('.form-group').removeClass('has-warning');
                    cleanSelect2(sirg);
                }

                // Jika masih ada warning pada input matkul
                if (warning.hasOwnProperty('mk_dosen') || warning.hasOwnProperty('mk_ruangan') || warning.hasOwnProperty('mk_smstr_genap') || warning.hasOwnProperty('mk_smstr_ganjil')) {
                    // do nothing
                }else{
                    simk.parents('.form-group').removeClass('has-warning');
                    cleanSelect2(simk);
                }

                if (jQuery.isEmptyObject(warning)) {
                    // Jika obj warning kosong
                    idform.find('.alert-warning').addClass('display-hide');

                }
            }else{
                // Matkul dan ruangan berbeda jenis
                idform.find('.alert-warning').removeClass('display-hide');
                
                simk.parents('.form-group').addClass('has-warning');
                sirg.parents('.form-group').addClass('has-warning');
                
                warning.mk_ruangan = twhcpuj.mk_ruangan;
                warning.ruangan_mk = twhcpuj.ruangan_mk;
            }
            $('#popover-warning-upd-jw').attr('data-content',joinAllWarning(warning));
        })
        // $('#popover-warning-upd-jw').attr('data-content',function() {return $(this).attr('data-content') + htmlPopover});
    })

    $('#modal_update_jw').on('hidden.bs.modal', function (e) {
        console.log('modal hide');
        var idform = $('#form_update_jw');
        idform.find('.form-group').removeClass('has-warning')
        idform.find('.has-error').removeClass('has-error');
        idform.find('.has-success').removeClass('has-success');
        idform.find('.fa-warning').removeClass('fa-warning');
        idform.find('.fa-check').removeClass('fa-check');
        idform.find('.alert-danger').addClass('display-hide');
        idform.find('.alert-success').addClass('display-hide');
        idform.find('.alert-warning').addClass('display-hide');
        idform.find('#popover-warning-upd-jw').attr('data-content','');
        idform.find('input').val('');
        idform.find('select').val(null).trigger('change');
    })

    $('#sample_2').on('click', '#update_jw', function(){
        $.ajax({
            url: "<?=base_url()?>jadwal/get_detail_jw", 
            type: "POST",
            dataType: "json",
            data: {kode_jw : $(this).data('val')},
            beforeSend: function(){
                App.blockUI({
                    // target: '#form_tambah_dosen',
                    // overlayColor: 'none',
                    // animate: true,
                    zIndex: 20000,
                });
            },
            success: function(data) {
                // success4.show();
                $('select[name="upd_hari_jw"]').val(data.id_hari).trigger('change');
                $('select[name="upd_mk_jw"]').val(data.kode_mk).trigger('change');
                if (data.DETAIL.matkul === null) {
                    $('input[name="upd_sks_jw"]').val(null);
                    $('input[name="upd_semester_jw"]').val(null);
                }else{
                    $('input[name="upd_sks_jw"]').val(data.DETAIL.matkul.sks_mk);
                    $('input[name="upd_semester_jw"]').val(data.DETAIL.matkul.semester_mk);
                }
                $('select[name="upd_waktu_jw"]').val(data.kode_wk).trigger('change');
                $('select[name="upd_dosen_jw"]').val(data.nid).trigger('change');
                $('select[name="upd_ruangan_jw"]').val(data.kode_rg).trigger('change');
                $('input[name="upd_peserta_jw"]').val(data.peserta);
                $('input[name="upd_kode_jw"]').val(data.id_j_t);
                $('#modal_update_jw').modal('show');
                console.log(data);
            },
            complete: function(){
                App.unblockUI();
            }
        });

        var form4 = $('#form_update_jw');
        var error4 = $('.alert-update-danger', form4);
        var success4 = $('.alert-update-success', form4);

        form4.validate({
            invalidHandler: function (event, validator) { //display error alert on form submit              
                // success4.hide();
                // error4.show();
                // App.scrollTo(error4, -200);
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                // var icon = $(element).parent('.input-icon').children('i');
                // icon.removeClass('fa-check').addClass("fa-warning");  
                // icon.attr("data-original-title", error.text()).tooltip();
            },

            highlight: function (element) { // hightlight error inputs
                // $(element)
                //     .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group   
            },

            unhighlight: function (element) { // revert the change done by hightlight
                
            },

            success: function (label, element) {
                // var icon = $(element).parent('.input-icon').children('i');
                // $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                // icon.removeClass("fa-warning").addClass("fa-check");
            },

            submitHandler: function (form) {
                error4.hide();
                // console.log($(form).serialize());
                $.ajax({
                    url: "<?=base_url()?>jadwal/update_jw", 
                    type: "POST",             
                    data: $(form).serialize(),
                    cache: false,             
                    processData: false,      
                    beforeSend: function(){
                        App.blockUI({
                            // target: '#form_tambah_dosen',
                            // overlayColor: 'none',
                            // animate: true,
                            zIndex: 20000,
                        });
                    },
                    success: function(data) {
                        console.log(data);
                        $('#modal_update_jw').modal('hide');
                        swal({
                            title : "Berhasil!", 
                            text : "Data telah di update!", 
                            type : "success"},
                            function(){
                                location.reload();
                        });
                    },
                    complete: function(){
                        App.unblockUI();
                    }
                });
                // return false;
                // success4.show();
                // error4.hide();
                //form.submit(); // submit the form
            }
        });
    });

    $('#sample_2').on('click', '#delete_jw', function(){
        $.ajax({
            url: "<?=base_url()?>jadwal/get_detail_jw", 
            type: "POST",
            dataType: "json",
            data: {kode_jw : $(this).data('val')},
            beforeSend: function(){
                App.blockUI({
                    // target: '#form_tambah_dosen',
                    // overlayColor: 'none',
                    // animate: true,
                    zIndex: 20000,
                });
            },
            success: function(data) {
                // success4.show();
                $('input[name="del_hari_jw"]').val(data.id_hari_nama);
                $('input[name="del_mk_jw"]').val(data.kode_mk_nama);
                if (data.DETAIL.matkul === null) {
                    $('input[name="del_sks_jw"]').val(null);
                    $('input[name="del_semester_jw"]').val(null);
                }else{
                    $('input[name="del_sks_jw"]').val(data.DETAIL.matkul.sks_mk);
                    $('input[name="del_semester_jw"]').val(data.DETAIL.matkul.semester_mk);
                }
                $('input[name="del_waktu_jw"]').val(data.kode_wk_nama);
                $('input[name="del_dosen_jw"]').val(data.nid_nama);
                $('input[name="del_ruangan_jw"]').val(data.kode_rg);
                $('input[name="del_peserta_jw"]').val(data.peserta);
                $('input[name="del_kode_jw"]').val(data.id_j_t);
                $('#modal_delete_jw').modal('show');
                console.log(data);
            },
            complete: function(){
                App.unblockUI();
            }
        });

        var form4 = $('#form_delete_jw');
        var success4 = $('.alert-danger-delete', form4);

        form4.validate({
            submitHandler: function (form) {
                $.ajax({
                    url: "<?=base_url()?>jadwal/delete_jw", 
                    type: "POST",
                    data: $(form).serialize(),
                    cache: false,             
                    processData: false,      
                    beforeSend: function(){
                        App.blockUI({
                            // target: '#form_tambah_dosen',
                            // overlayColor: 'none',
                            // animate: true,
                            zIndex: 20000,
                        });
                    },
                    success: function(data) {
                        console.log(data);
                        $('#modal_delete_jw').modal('hide');
                        swal({
                            title : "Berhasil!", 
                            text : "Data telah di hapus!", 
                            type : "success"},
                            function(){
                                location.reload();
                        });
                    },
                    complete: function(){
                        App.unblockUI();
                    }
                });
            }
        });
    })
});
</script>