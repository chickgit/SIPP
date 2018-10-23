<!-- <link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" /> -->
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
                                        <span class="caption-subject font-green sbold uppercase">Histori Jadwal</span>
                                    </div>
                                    <div class="actions">
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover order-column" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> Nama Jadwal </th>
                                                <th> Finalisasi </th>
                                                <th> Terbit </th>
                                                <th> Tahun Ajaran Terbit </th>
                                                <th> Semester Terbit </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach($list_histori as $row)
                                            {
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td> <?=$row->draft_nama?> </td>
                                                    <td> <?=($row->finalisasi == 0) ? '<span class="label label-sm label-info"> Belum </span>' : '<span class="label label-sm label-info"> Sudah </span>'?> </td>
                                                    <td> <?=($row->terbit == 0) ? '<span class="label label-sm label-warning"> Belum </span>' : '<span class="label label-sm label-info"> Sudah </span>'?> </td>
                                                    <td> <?=($row->ta_terbit == NULL) ? '-' : $row->ta_terbit?> </td>
                                                    <td> <?=($row->smstr_terbit == NULL) ? '-' : $row->smstr_terbit?> </td>
                                                    <td>
                                                        <div class="btn-group" style="position: relative;">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu" style="position: inherit;">
                                                                <li>
                                                                    <a id="restore_jadwal_perkuliahan" data-val="<?=$row->draft_id_jp?>">
                                                                        <i class="icon-docs"></i> Kembalikan </a>
                                                                </li>
                                                                <li>
                                                                    <a id="delete_jadwal_perkuliahan" data-val="<?=$row->draft_id_jp?>">
                                                                        <i class="icon-trash"></i> Hapus </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <!-- MODAL DELETE -->
                                    <div class="modal fade " id="modal_restore_jadwal_perkuliahan" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_jadwal_perkuliahan"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Mengembalikan Jadwal Perkuliahan</h4>
                                                </div>
                                                <form id="form_restore_jadwal_perkuliahan" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-block">
                                                                Anda yakin ingin mengembalikan data berikut? 
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Nama Jadwal
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="restore_draft_nama" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Finalisasi
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="restore_finalisasi" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Terbit
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="restore_terbit" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Tahun Ajaran terbit
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="restore_ta_terbit" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Semester
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="restore_smstr_terbit" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="restore_0">
                                                        <input type="hidden" name="restore_1" value="draft_id_jp">
                                                        <input type="hidden" name="restore_2" value="draft_jadwal_perkuliahan">
                                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn green">Kembalikan</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- MODAL DELETE -->
                                    <div class="modal fade " id="modal_delete_jadwal_perkuliahan" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_jadwal_perkuliahan"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Hapus Permanen Jadwal Perkuliahan</h4>
                                                </div>
                                                <form id="form_delete_jadwal_perkuliahan" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-block">
                                                                Anda yakin ingin menghapus? 
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Nama Jadwal
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="delete_draft_nama" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Finalisasi
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="delete_finalisasi" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Terbit
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="delete_terbit" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Tahun Ajaran Terbit
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="delete_ta_terbit" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Semester Terbit
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="delete_smstr_terbit" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="delete_0">
                                                        <input type="hidden" name="delete_1" value="draft_id_jp">
                                                        <input type="hidden" name="delete_2" value="draft_jadwal_perkuliahan">
                                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Tutup</button>
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
<script src="<?=base_url()?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/pages/scripts/table-datatables-managed.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
    $('#sample_2').on('click', '#restore_jadwal_perkuliahan', function(){
        $.ajax({
            url: "<?=base_url()?>histori/jadwal_perkuliahan/get_data", 
            type: "POST",
            dataType: "json",
            data: {
                0 : 'draft_jadwal_perkuliahan', 
                1 : {
                    draft_id_jp : $(this).data('val')
                }
            },
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
                $('input[name="restore_0"]').val(data.draft_id_jp);
                $('input[name="restore_draft_nama"]').val(data.draft_nama);
                $('input[name="restore_finalisasi"]').val(data.finalisasi);
                $('input[name="restore_terbit"]').val(data.terbit);
                $('input[name="restore_ta_terbit"]').val(data.ta_terbit);
                $('input[name="restore_smstr_terbit"]').val(data.smstr_terbit);
                $('#modal_restore_jadwal_perkuliahan').modal('show');
                console.log(data);
            },
            complete: function(){
                App.unblockUI();
            }
        });

        var form4 = $('#form_restore_jadwal_perkuliahan');
        var success4 = $('.alert-danger-delete', form4);

        form4.validate({
            submitHandler: function (form) {
                $.ajax({
                    url: "<?=base_url()?>histori/jadwal_perkuliahan/restore_data", 
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
                        success4.hide();
                        location.reload();
                        // console.log(data);
                    },
                    complete: function(){
                        App.unblockUI();
                    }
                });
            }
        });
    })
    $('#sample_2').on('click', '#delete_jadwal_perkuliahan', function(){
        $.ajax({
            url: "<?=base_url()?>histori/jadwal_perkuliahan/get_data", 
            type: "POST",
            dataType: "json",
            data: {
                0 : 'draft_jadwal_perkuliahan', 
                1 : {
                    draft_id_jp : $(this).data('val')
                }
            },
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
                $('input[name="delete_0"]').val(data.draft_id_jp);
                $('input[name="delete__draft_nama"]').val(data.draft_nama);
                $('input[name="delete_finalisasi"]').val(data.finalisasi);
                $('input[name="delete_terbit"]').val(data.terbit);
                $('input[name="delete_ta_terbit"]').val(data.ta_terbit);
                $('input[name="delete_smstr_terbit"]').val(data.smstr_terbit);
                $('#modal_delete_jadwal_perkuliahan').modal('show');
                console.log(data);
            },
            complete: function(){
                App.unblockUI();
            }
        });

        var form4 = $('#form_delete_jadwal_perkuliahan');
        var success4 = $('.alert-danger-delete', form4);

        form4.validate({
            submitHandler: function (form) {
                $.ajax({
                    url: "<?=base_url()?>histori/jadwal_perkuliahan/delete_data", 
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
                        success4.hide();
                        location.reload();
                        // console.log(data);
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