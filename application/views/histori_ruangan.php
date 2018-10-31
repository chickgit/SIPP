<?=$header?>
        <!-- BEGIN CONTAINER -->
        <div class="container-fluid">
            <div class="page-content page-content-popup">
                <div class="page-content-fixed-header">
                    <!-- BEGIN BREADCRUMBS -->
                    <ul class="page-breadcrumb">
                        <li><?=$role?></li>
                        <li>Ruangan</li>
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
                                        <span class="caption-subject font-green sbold uppercase">Histori Ruangan</span>
                                    </div>
                                    <div class="actions">
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover order-column" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> Nama Ruangan </th>
                                                <th> Gedung </th>
                                                <th> Jenis </th>
                                                <th> Kapasitas </th>
                                                <th> Created Date </th>
                                                <th> Created By </th>
                                                <th> Modified Date </th>
                                                <th> Modified By </th>
                                                <th> Show </th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach($list_histori as $row)
                                            {
                                                ?>
                                            <tr class="odd gradeX">
                                                <td> <?=$row->nama_ruangan?> </td>
                                                <td> <?=$row->gedung_rg?> </td>
                                                <td> <?=$row->id_jenis?> </td>
                                                <td> <?=$row->kapasitas_rg?> </td>
                                                <td> <?=$row->created_date?> </td>
                                                <td> <?=$row->created_by?> </td>
                                                <td> <?=$row->modified_date?> </td>
                                                <td> <?=$row->modified_by?> </td>
                                                <td> <?=($row->isShow == 1)? "Ya" : "Tidak"?> </td>
                                                <td>
                                                    <div class="btn-group" style="position: relative;">
                                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu" style="position: inherit;">
                                                            <li>
                                                                <a id="restore_rg" data-val="<?=$row->id_ruangan?>">
                                                                    <i class="icon-docs"></i> Kembalikan </a>
                                                            </li>
                                                            <li>
                                                                <a id="delete_rg" data-val="<?=$row->id_ruangan?>">
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
                                    <!-- MODAL RESTORE -->
                                    <div class="modal fade " id="modal_restore_rg" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_new_rg"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Mengembalikan Ruangan</h4>
                                                </div>
                                                <form id="form_restore_rg" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger alert-danger-delete">
                                                                Anda yakin ingin mengembalikan data berikut ? </div>
                                                            <div class="form-group ">
                                                                <label class="control-label col-md-3">Nama Ruangan
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="restore_nama_ruangan" disabled /> 
                                                                    </div>
                                                                        <input type="hidden" name="restore_0">
                                                                        <input type="hidden" name="restore_1" value="id_ruangan">
                                                                        <input type="hidden" name="restore_2" value="ruangan">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Gedung
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="restore_gedung_rg" disabled/> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Jenis
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <input type="text" class="form-control" name="restore_jenis_rg"  disabled/> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Kapasitas
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="number" class="form-control" name="restore_kapasitas_rg" min="1" disabled/> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
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
                                    <div class="modal fade " id="modal_delete_rg" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_new_rg"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Hapus Ruangan</h4>
                                                </div>
                                                <form id="form_delete_rg" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger alert-danger-delete">
                                                                Anda yakin ingin menghapus ? </div>
                                                            <div class="form-group ">
                                                                <label class="control-label col-md-3">Nama Ruangan
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="delete_nama_ruangan" disabled /> 
                                                                    </div>
                                                                        <input type="hidden" name="delete_0">
                                                                        <input type="hidden" name="delete_1" value="id_ruangan">
                                                                        <input type="hidden" name="delete_2" value="ruangan">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Gedung
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="delete_gedung_rg" disabled/> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Jenis
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <input type="text" class="form-control" name="delete_jenis_rg"  disabled/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Kapasitas
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="number" class="form-control" name="delete_kapasitas_rg" min="1" disabled/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
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
    $('#sample_2').on('click', '#restore_rg', function(){
        $.ajax({
            url: "<?=base_url()?>histori/ruangan/get_data", 
            type: "POST",
            dataType: "json",
            data: {
                0 : 'ruangan', 
                1 : {
                    id_ruangan : $(this).data('val')
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
                $('input[name="restore_0"]').val(data.id_ruangan);
                $('input[name="restore_nama_ruangan"]').val(data.nama_ruangan);
                $('input[name="restore_gedung_rg"]').val(data.gedung_rg);
                $('input[name="restore_jenis_rg"]').val(data.id_jenis);
                $('input[name="restore_kapasitas_rg"]').val(data.kapasitas_rg);
                $('#modal_restore_rg').modal('show');
                // console.log(data);
            },
            complete: function(){
                App.unblockUI();
            }
        });

        var form4 = $('#form_restore_rg');
        var success4 = $('.alert-danger-delete', form4);

        form4.validate({
            submitHandler: function (form) {
                // var formData = JSON.parse($(form).serializeArray());
                $.ajax({
                    url: "<?=base_url()?>histori/ruangan/restore_data", 
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
    $('#sample_2').on('click', '#delete_rg', function(){
        $.ajax({
            url: "<?=base_url()?>histori/ruangan/get_data", 
            type: "POST",
            dataType: "json",
            data: {
                0 : 'ruangan', 
                1 : {
                    id_ruangan : $(this).data('val')
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
                $('input[name="delete_0"]').val(data.id_ruangan);
                $('input[name="delete_nama_ruangan"]').val(data.nama_ruangan);
                $('input[name="delete_gedung_rg"]').val(data.gedung_rg);
                $('input[name="delete_jenis_rg"]').val(data.id_jenis);
                $('input[name="delete_kapasitas_rg"]').val(data.kapasitas_rg);
                $('#modal_delete_rg').modal('show');
                // console.log(data);
            },
            complete: function(){
                App.unblockUI();
            }
        });

        var form4 = $('#form_delete_rg');
        var success4 = $('.alert-danger-delete', form4);

        form4.validate({
            submitHandler: function (form) {
                $.ajax({
                    url: "<?=base_url()?>histori/ruangan/delete_data", 
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