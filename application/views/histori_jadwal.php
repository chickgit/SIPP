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
                                    <div class="panel-group accordion" id="draft">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle" data-parent="#draft" aria-expanded="true"> Pilih Draft Jadwal </a>
                                                </h4>
                                            </div>
                                            <div class="panel-collapse collapse in" aria-expanded="true" style="">
                                                <div class="panel-body">
                                                    <div class="input-group">
                                                        <select class="form-control input-sm" name="draft_jp" onchange="check_draft(this)">
                                                            <option value="ALL" <?=(isset($user['id_draft_histori']) && ($user['id_draft_histori'] == 'ALL')) ? 'selected' : ''?>>BUKA SEMUA</option>
                                                            <?php
                                                            foreach ($list_draft_jp as $key => $value) {
                                                            ?>
                                                            <option value="<?=$value->draft_id_jp?>" data-text="<?=$value->draft_nama?>" <?=(isset($user['id_draft_histori']) && ($value->draft_id_jp == $user['id_draft_histori'])) ? 'selected' : ''?>><?=$value->draft_nama?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <a class="btn green btn-sm" type="button" title="Buka Draft" id="draft_open" onclick="draft(this)"><i class="icon-book-open"></i></a>
                                                        </span>
                                                        <?php
                                                        if ((isset($user['id_draft_histori'])) && ($user['id_draft_histori'] == 'ALL')) {
                                                            # code...
                                                        }
                                                        ?>
                                                        <span class="input-group-btn">
                                                            <a class="btn blue btn-sm" type="button" title="Kembalikan Draft" id="draft_restore" onclick="draft(this)" <?=(isset($user['id_draft_histori']) && ($user['id_draft_histori'] == 'ALL')) ? 'disabled' : ''?>><i class="icon-docs"></i></a>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <a class="btn red btn-sm" type="button" title="Hapus Permanen Draft" id="draft_delete" onclick="draft(this)" <?=(isset($user['id_draft_histori']) && ($user['id_draft_histori'] == 'ALL')) ? 'disabled' : ''?>><i class="fa fa-remove"></i></a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover order-column" id="sample_2">
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach($list_histori as $row)
                                            {
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
                                                        <div class="btn-group" style="position: relative;">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu" style="position: inherit;">
                                                                <li>
                                                                    <a id="restore_jadwal" data-val="<?=$row->id_jadwal_p?>">
                                                                        <i class="icon-docs"></i> Kembalikan </a>
                                                                </li>
                                                                <li>
                                                                    <a id="delete_jadwal" data-val="<?=$row->id_jadwal_p?>">
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
                                    <!-- MODAL DRAFT - OPEN - RENAME - FINALISASI - DELETE -->
                                    <div class="modal fade " id="modal_draft" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog "> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <!-- open -->
                                                    <h4 id="open" class="modal-title display-hide">Buka Draft</h4>
                                                    <!-- restore -->
                                                    <h4 id="restore" class="modal-title display-hide">Mengembalikan Draft</h4>
                                                    <!-- delete -->
                                                    <h4 id="delete" class="modal-title display-hide">Hapus Permanen Draft</h4>
                                                </div>
                                                <form id="form_draft" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <!-- open -->
                                                            <div id="open" class="alert alert-info display-hide">
                                                                Anda yakin ingin membuka draft ini ? 
                                                            </div>
                                                            <!-- restore -->
                                                            <div id="restore" class="alert alert-warning display-hide">
                                                                Anda yakin ingin mengembalikan draft ini ? 
                                                            </div>
                                                            <!-- delete -->
                                                            <div id="delete" class="alert alert-danger display-hide">
                                                                Anda yakin ingin menghapus permanen draft ini ? 
                                                            </div>
                                                            <div id="delete" class="alert display-hide">
                                                                Data yang telah dihapus permanen tidak dapat dikembalikan lagi. 
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Tutup</button>
                                                        <input type="hidden" id="draft" value="">
                                                        <button type="submit" class="btn green"></button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- MODAL RESTORE -->
                                    <div class="modal fade " id="modal_restore_jadwal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_jadwal"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Mengembalikan Dosen</h4>
                                                </div>
                                                <form id="form_restore_jadwal" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-block">
                                                                Anda yakin ingin mengembalikan data berikut? 
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Hari
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="restore_hari_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Mata Kuliah
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="restore_mk_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">SKS
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="restore_sks_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Semester
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="restore_semester_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Waktu
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="restore_waktu_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Dosen
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="restore_dosen_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Ruangan
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="restore_ruangan_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Peserta
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="restore_peserta_jw" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="restore_0">
                                                        <input type="hidden" name="restore_1" value="id_jadwal_p">
                                                        <input type="hidden" name="restore_2" value="jadwal">
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
                                    <div class="modal fade " id="modal_delete_jadwal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_jadwal"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Hapus Jadwal</h4>
                                                </div>
                                                <form id="form_delete_jadwal" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-block">
                                                                Anda yakin ingin menghapus? 
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Hari
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="delete_hari_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Mata Kuliah
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="delete_mk_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">SKS
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="delete_sks_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Semester
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="delete_semester_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Waktu
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="delete_waktu_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Dosen
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="delete_dosen_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Ruangan
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="delete_ruangan_jw" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Peserta
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="delete_peserta_jw" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="delete_0">
                                                        <input type="hidden" name="delete_1" value="id_jadwal_p">
                                                        <input type="hidden" name="delete_2" value="jadwal">
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
<script src="<?=base_url()?>assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/pages/scripts/ui-sweetalert.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/pages/scripts/table-datatables-managed.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function check_draft(elm)
    {
        var selected = elm.options[elm.selectedIndex].getAttribute('value');
        if (selected === 'ALL') {
            // $('[name='+elm.name+']').parent().find('#draft_restore').attr('disabled','disabled');
            $('[name='+elm.name+']').parent().find('#draft_restore').addClass('disabled',);
            // $('[name='+elm.name+']').parent().find('#draft_delete').attr('disabled','disabled');
            $('[name='+elm.name+']').parent().find('#draft_delete').addClass('disabled',);
            // elm.parent().find('#draft_restore').disabled();
        }else{
            $('[name='+elm.name+']').parent().find('#draft_restore').removeClass('disabled');
            // $('[name='+elm.name+']').parent().find('#draft_restore').removeAttr('disabled');
            $('[name='+elm.name+']').parent().find('#draft_delete').removeClass('disabled');
            // $('[name='+elm.name+']').parent().find('#draft_delete').removeAttr('disabled');
        }
    }
    function draft(elm)
    {
        elm_id = elm.id.split('_');
        modal = $('#modal_'+elm_id[0]);

        $('#modal_'+elm_id[0]+' #'+elm_id[1]).show();
        modal.find('button[type="submit"]').text(elm_id[1].toUpperCase());
        modal.find('#draft').attr('name','draft_id').val(elm_id[1]+'_'+$('select[name="draft_jp"]').find(':selected').val());
        modal.modal('show');

        $('#form_draft').validate({
            submitHandler: function (form) {
                $.ajax({
                    url: "<?=base_url()?>histori/draft", 
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
                        modal.modal('hide');
                        swal({
                            title : "Berhasil!", 
                            type : "success"},
                            function(){
                                location.reload();
                        });
                    },
                    complete: function(){
                        App.unblockUI();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        modal.modal('hide');
                        swal({
                            title : "Gagal!", 
                            text : xhr.status+"\n"+thrownError, 
                            type : "error"},
                        );
                        console.log(xhr);
                        console.log(thrownError);
                    }
                });
            }
        });
        // console.log(elm_id);
    }
jQuery(document).ready(function() {
    $('select[name="draft_jp"]').trigger('change');
    // RESET DRAFT MODAL
    $('#modal_draft').on('hidden.bs.modal', function (e) {
        // console.log($(this.id));
        var idform = $('#form_draft');
        $('#'+this.id).find('[id="open"]').hide();
        $('#'+this.id).find('[id="restore"]').hide();
        $('#'+this.id).find('[id="delete"]').hide();
        $('#'+this.id).find('input[type="text"]').removeAttr('name','');
    })
    // RESTORE MODAL
    $('#sample_2').on('click', '#restore_jadwal', function(){
        $.ajax({
            url: "<?=base_url()?>histori/jadwal/get_data", 
            type: "POST",
            dataType: "json",
            data: {
                0 : 'jadwal', 
                1 : {
                    id_jadwal_p : $(this).data('val')
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
                $('input[name="restore_0"]').val(data.id_jadwal_p);
                $('input[name="restore_hari_jw"]').val(data.nama_hari);
                $('input[name="restore_mk_jw"]').val(data.nama_mk);
                $('input[name="restore_sks_jw"]').val(data.sks_mk);
                $('input[name="restore_semester_jw"]').val(data.semester_mk);
                $('input[name="restore_waktu_jw"]').val(data.waktu_aw+' - '+data.waktu_ak);
                $('input[name="restore_dosen_jw"]').val(data.nama);
                $('input[name="restore_ruangan_jw"]').val(data.kode_rg);
                $('input[name="restore_peserta_jw"]').val(data.peserta);
                $('#modal_restore_jadwal').modal('show');
                console.log(data);
            },
            complete: function(){
                App.unblockUI();
            }
        });

        var form4 = $('#form_restore_jadwal');
        var success4 = $('.alert-danger-delete', form4);

        form4.validate({
            submitHandler: function (form) {
                $.ajax({
                    url: "<?=base_url()?>histori/jadwal/restore_data", 
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
    // DELETE MODAL
    $('#sample_2').on('click', '#delete_jadwal', function(){
        $.ajax({
            url: "<?=base_url()?>histori/jadwal/get_data", 
            type: "POST",
            dataType: "json",
            data: {
                0 : 'jadwal', 
                1 : {
                    id_jadwal_p : $(this).data('val')
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
                $('input[name="delete_0"]').val(data.id_jadwal_p);
                $('input[name="delete_hari_jw"]').val(data.nama_hari);
                $('input[name="delete_mk_jw"]').val(data.nama_mk);
                $('input[name="delete_sks_jw"]').val(data.sks_mk);
                $('input[name="delete_semester_jw"]').val(data.semester_mk);
                $('input[name="delete_waktu_jw"]').val(data.waktu_aw+' - '+data.waktu_ak);
                $('input[name="delete_dosen_jw"]').val(data.nama);
                $('input[name="delete_ruangan_jw"]').val(data.kode_rg);
                $('input[name="delete_peserta_jw"]').val(data.peserta);
                $('#modal_delete_jadwal').modal('show');
                console.log(data);
            },
            complete: function(){
                App.unblockUI();
            }
        });

        var form4 = $('#form_delete_jadwal');
        var success4 = $('.alert-danger-delete', form4);

        form4.validate({
            submitHandler: function (form) {
                $.ajax({
                    url: "<?=base_url()?>histori/jadwal/delete_data", 
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