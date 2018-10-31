<?=$header?>
<?php
function cmp($a,$b)
{
    return strcmp(strtolower($a->nama_mk), strtolower($b->nama_mk));
}
?>
        <!-- BEGIN CONTAINER -->
        <div class="container-fluid">
            <div class="page-content page-content-popup">
                <div class="page-content-fixed-header">
                    <!-- BEGIN BREADCRUMBS -->
                    <ul class="page-breadcrumb">
                        <li><?=$role?></li>
                        <li>Dosen</li>
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
                                        <span class="caption-subject font-green sbold uppercase">Data Dosen</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" data-toggle="modal" href="#modal_new_dosen" title="Tambah Dosen" id="tambah_dosen">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover order-column" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> NID </th>
                                                <th> Nama </th>
                                                <th> Alamat </th>
                                                <th> Telepon </th>
                                                <th> Foto Profil </th>
                                                <th> Ketersediaan Hari </th>
                                                <th> Matakuliah </th>
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
                                            foreach($list_dosen as $row)
                                            {
                                                ?>
                                            <tr class="odd gradeX">
                                                <td> <?=$row->nid?> </td>
                                                <td> <?=$row->nama?> </td>
                                                <td> <?=$row->alamat?> </td>
                                                <td> <?=$row->telepon?> </td>
                                                <td> <?=$row->gambar_ava?> </td>
                                                <td> <?php
                                                $id_hari = explode(';', $row->ketersediaan_hari);
                                                foreach ($id_hari as $value_id) {
                                                	foreach ($list_hari as $key => $value) {
                                                		if ($value->id_hari == $value_id) {
                                                			echo $value->nama_hari.'<br>';
                                                		}
                                                	}
                                                }
                                                ?> </td>
                                                <td> <?php
                                                // print_r($row->wawasan_matkul);
                                                $id_mk = explode(';', $row->wawasan_matkul);
                                                foreach ($id_mk as $value_id) {
                                                    foreach ($list_matakuliah as $key => $value) {
                                                        $id_mk2 = explode('_', $value_id);
                                                        if ($value->kode_mk == $id_mk2[0]) {
                                                            echo $value->nama_mk.',<br>';
                                                        }
                                                    }
                                                }
                                                ?> </td>
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
                                                                <a id="upd_dosen" data-val="<?=$row->nid?>">
                                                                    <i class="icon-docs"></i> Ubah </a>
                                                            </li>
                                                            <li>
                                                                <a id="delete_dosen" data-val="<?=$row->nid?>">
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
                                    <!-- MODAL INSERT -->
                                    <div class="modal fade bs-modal-lg" id="modal_new_dosen" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" id="modal_dialog_new_dosen"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Tambah Dosen</h4>
                                                </div>
                                                <form id="form_tambah_dosen" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-hide">
                                                                <button class="close" data-close="alert"></button> Anda memiliki beberapa bentuk kesalahan. Silakan cek di bawah ini. </div>
                                                            <div class="alert alert-success display-hide">
                                                                <button class="close" data-close="alert"></button> Data berhasil di simpan! </div>
                                                            <div class="form-group ">
                                                                <label class="control-label col-md-3">NID
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="nid" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Nama
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="nama" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Alamat
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <textarea class="form-control" name="alamat"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Telepon
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="telepon" placeholder="0821XXXXXXXX" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Ketersediaan Hari
                                                                    <!-- <span class="required"> * </span> -->
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="mt-checkbox-inline" id="cb-hari-inline">
                                                                        <?php
                                                                        // echo json_encode($list_hari);
                                                                        foreach ($list_hari as $key => $value) {
                                                                            ?>
                                                                            <label class="mt-checkbox">
                                                                                <input type="checkbox" id="<?=$value->id_hari?>" value="<?=$value->id_hari?>" name="ketersediaan_hari[]"> <?=$value->nama_hari?>
                                                                                <span></span>
                                                                            </label>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Matakuliah
                                                                    <!-- <span class="required"> * </span> -->
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <div class="input-group select2-bootstrap-append">
                                                                            <select id="multi-append" class="form-control select2" multiple name="wawasan_matkul[]">
                                                                                <?php
                                                                                
                                                                                usort($list_matakuliah, "cmp");
                                                                                // sort($list_matakuliah);
                                                                                foreach ($list_matakuliah as $key => $value) {
                                                                                    ?>
                                                                                <option value="<?=$value->kode_mk?>_<?=$value->sks_mk?>"><?=$value->nama_mk?> | <?=$value->sks_mk?> SKS | Semester <?=$value->semester_mk?> | <?=$value->program_studi?></option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <span class="input-group-btn">
                                                                                <button class="btn btn-default" type="button" data-select2-open="multi-append">
                                                                                    <span class="glyphicon glyphicon-search"></span>
                                                                                </button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="help-block" id="help-block-matkul-multiple"> 0 SKS | Min :  9 SKS </div> -->
                                                                </div>
                                                            </div>
                                                        <!-- END FORM-->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn green">Tambah</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- MODAL UPDATE -->
                                    <div class="modal fade bs-modal-lg" id="modal_update_dosen" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" id="modal_dialog_new_dosen"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Update Dosen</h4>
                                                </div>
                                                <form id="form_update_dosen" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-hide alert-update-danger">
                                                                <button class="close" data-close="alert"></button> Anda memiliki beberapa bentuk kesalahan. Silakan cek di bawah ini. </div>
                                                            <div class="alert alert-success display-hide alert-update-success">
                                                                <button class="close" data-close="alert"></button> Data berhasil di ubah! </div>
                                                            <div class="form-group ">
                                                                <label class="control-label col-md-3">NID
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="upd_nid" disabled /> </div>
                                                                        <input type="hidden" name="upd_nid">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Nama
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="upd_nama" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Alamat
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <textarea class="form-control" name="upd_alamat"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Telepon
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="upd_telepon"/> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Ketersediaan Hari
                                                                    <!-- <span class="required"> * </span> -->
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="mt-checkbox-inline" id="cb-hari-inline">
                                                                        <?php
                                                                        // echo json_encode($list_hari);
                                                                        foreach ($list_hari as $key => $value) {
                                                                            ?>
                                                                            <label class="mt-checkbox">
                                                                                <input type="checkbox" id="<?=$value->id_hari?>" value="<?=$value->id_hari?>" name="upd_ketersediaan_hari[]"> <?=$value->nama_hari?>
                                                                                <span></span>
                                                                            </label>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Matakuliah
                                                                    <!-- <span class="required"> * </span> -->
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <div class="input-group select2-bootstrap-append">
                                                                            <select id="multi-append" class="form-control select2" multiple name="upd_wawasan_matkul[]">
                                                                                <?php
                                                                                usort($list_matakuliah, "cmp");
                                                                                // sort($list_matakuliah);
                                                                                foreach ($list_matakuliah as $key => $value) {
                                                                                    ?>
                                                                                <option value="<?=$value->kode_mk?>_<?=$value->sks_mk?>"><?=$value->nama_mk?> | <?=$value->sks_mk?> SKS | Semester <?=$value->semester_mk?> | <?=$value->program_studi?></option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <span class="input-group-btn">
                                                                                <button class="btn btn-default" type="button" data-select2-open="multi-append">
                                                                                    <span class="glyphicon glyphicon-search"></span>
                                                                                </button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="help-block" id="help-block-matkul-multiple"> 0 SKS | Min :  9 SKS </div> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
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
                                    <div class="modal fade " id="modal_delete_dosen" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_new_dosen"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Hapus Dosen</h4>
                                                </div>
                                                <form id="form_delete_dosen" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger alert-danger-delete">
                                                                Anda yakin ingin menghapus ? </div>
                                                            <div class="form-group ">
                                                                <label class="control-label col-md-3">NID
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="del_nid" disabled /> </div>
                                                                        <input type="hidden" name="del_nid">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Nama
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="del_nama" disabled/> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Alamat
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <textarea class="form-control" name="del_alamat" disabled></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Telepon
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="del_telepon" disabled/> </div>
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


<script type="text/javascript">
jQuery(document).ready(function() {
    $('.select2').select2({
        // placeholder : 'Pilih matakuliah yang dapat anda ajarkan. Min : 19 SKS',
        width: null
    });

    $('#tambah_dosen').on('click', function(){
        //console.log('clicked');
        // validation using icons
        var form4 = $('#form_tambah_dosen');
        var error4 = $('.alert-danger', form4);
        var success4 = $('.alert-success', form4);

        form4.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                nid: {
                    required: true,
                    remote: "<?=base_url()?>dosen/check_nid",
                    maxlength: 11,
                    digits: true
                },
                nama: {
                    required: true,
                    maxlength: 50,
                },
                telepon: {
                    required: true,
                    number: true,
                    minlength : 12,
                    maxlength : 15
                },
            },
            messages: {
                nid: {
                    required: "NID harus di isi",
                    remote: "NID sudah terpakai",
                    maxlength: "NID maksimal 11 digit",
                    digits: "Hanya digit yang dibolehkan"
                },
                nama: {
                    required: "Nama harus di isi",
                    maxlength: "Harap isi tidak lebih dari 50 karakter",
                },
                telepon: {
                    required: "Telepon harus di isi",
                    number: "Hanya angka yang dibolehkan",
                    minlength : "Harap isi minimal 12 digit",
                    maxlength : "Harap isi maksimal 15 digit"
                },
            },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success4.hide();
                error4.show();
                App.scrollTo(error4, -200);
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                var icon = $(element).parent('.input-icon').children('i');
                icon.removeClass('fa-check').addClass("fa-warning");  
                icon.attr("data-original-title", error.text()).tooltip();
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group   
            },

            unhighlight: function (element) { // revert the change done by hightlight
                
            },

            success: function (label, element) {
                var icon = $(element).parent('.input-icon').children('i');
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                icon.removeClass("fa-warning").addClass("fa-check");
            },

            submitHandler: function (form) {
                error4.hide();
                // console.log($(form).serialize());
                $.ajax({
                    url: "dosen/insert_dosen", 
                    type: "POST",             
                    data: $(form).serialize(),
                    cache: false,             
                    processData: false,      
                    beforeSend: function(){
                        App.blockUI({
                            boxed : true,
                            zIndex: 20000,
                        });
                    },
                    success: function(data) {
                        success4.show();
                        location.reload();
                        // console.log(data);
                    },
                    complete: function(){
                        setTimeout(function(){ App.unblockUI(); }, 2000);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
                return false;
            }
        });
    });
    $('#modal_new_dosen').on('hidden.bs.modal', function (e) {
        console.log('modal hide');
        var idform = $('#form_tambah_dosen');
        idform.find('.has-error').removeClass('has-error');
        idform.find('.has-success').removeClass('has-success');
        idform.find('.fa-warning').removeClass('fa-warning');
        idform.find('.fa-check').removeClass('fa-check');
        idform.find('.alert-danger').css('display','none');
        idform.find('.alert-success').css('display','none');
        idform.find('input').val('');
        idform.find('textarea').val('');
        idform.find('[name="ketersediaan_hari[]"]').prop('checked',false);
        idform.find('select[name="wawasan_matkul[]"]').val(null).trigger('change');
        // idform.find('#help-block-matkul-multiple').text('0 SKS | Min: 9 SKS');
    })
    $('#sample_2').on('click', '#upd_dosen', function(){
        $.ajax({
            url: "<?=base_url()?>dosen/get_dosen", 
            type: "POST",
            dataType: "json",
            data: {nid : $(this).data('val')},
            beforeSend: function(){
                App.blockUI({
                    boxed : true,
                    zIndex: 20000,
                });
            },
            success: function(data) {
                // success4.show();
                $('input[name="upd_nid"]').val(data.nid);
                $('input[name="upd_nama"]').val(data.nama);
                $('textarea[name="upd_alamat"]').val(data.alamat);
                $('input[name="upd_telepon"]').val(data.telepon);

                var hari = data.ketersediaan_hari.split(';');
                $.each(hari, function(index_hr,value_hr){
                    $.each($('input[type=checkbox][name="upd_ketersediaan_hari[]"]'), function(index_hr_cb,value_hr_cb){
                        if (value_hr == value_hr_cb.value) {
                            $('input[type=checkbox][name="upd_ketersediaan_hari[]"][value='+value_hr+']').prop('checked',true);
                        }
                    })
                })

                var matkul = data.wawasan_matkul.split(';');
                $('select[name="upd_wawasan_matkul[]"]').val(matkul).trigger('change');
                // $.each(matkul, function(index_mk,value_mk){
                //     // $.each($('select[name=upd_wawasan_matkul[]]'))
                // })

                $('#modal_update_dosen').modal('show');
                console.log(matkul);
            },
            complete: function(){
                setTimeout(function(){ App.unblockUI(); }, 500);
            }
        });

        var form4 = $('#form_update_dosen');
        var error4 = $('.alert-update-danger', form4);
        var success4 = $('.alert-update-success', form4);

        form4.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                upd_nama: {
                    required: true,
                    maxlength: 50,
                },
                upd_telepon: {
                    required: true,
                    number: true,
                    minlength : 12,
                    maxlength : 15
                },
            },
            messages: {
                upd_nama: {
                    required: "Nama harus di isi",
                    maxlength: "Harap isi tidak lebih dari 50 karakter",
                },
                upd_telepon: {
                    required: "Telepon harus di isi",
                    number: "Hanya angka yang dibolehkan",
                    minlength : "Harap isi minimal 12 digit",
                    maxlength : "Harap isi maksimal 15 digit"
                },
            },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success4.hide();
                error4.show();
                App.scrollTo(error4, -200);
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                var icon = $(element).parent('.input-icon').children('i');
                icon.removeClass('fa-check').addClass("fa-warning");  
                icon.attr("data-original-title", error.text()).tooltip();
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group   
            },

            unhighlight: function (element) { // revert the change done by hightlight
                
            },

            success: function (label, element) {
                var icon = $(element).parent('.input-icon').children('i');
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                icon.removeClass("fa-warning").addClass("fa-check");
            },

            submitHandler: function (form) {
                error4.hide();
                // console.log($(form).serialize());
                $.ajax({
                    url: "dosen/update_dosen", 
                    type: "POST",             
                    data: $(form).serialize(),
                    cache: false,             
                    processData: false,      
                    beforeSend: function(){
                        App.blockUI({
                            boxed : true,
                            zIndex: 20000,
                        });
                    },
                    success: function(data) {
                        success4.show();
                        location.reload();
                        // console.log(data);
                    },
                    complete: function(){
                        setTimeout(function(){ App.unblockUI(); }, 2000);
                    }
                });
            }
        });
    });
    $('#modal_update_dosen').on('hidden.bs.modal', function (e) {
        console.log('modal hide');
        var idform = $('#form_tambah_dosen');
        idform.find('.has-error').removeClass('has-error');
        idform.find('.has-success').removeClass('has-success');
        idform.find('.fa-warning').removeClass('fa-warning');
        idform.find('.fa-check').removeClass('fa-check');
        idform.find('.alert-danger').css('display','none');
        idform.find('.alert-success').css('display','none');
        idform.find('input').val('');
        idform.find('textarea').val('');
    })
    $('#sample_2').on('click', '#delete_dosen', function(){
        $.ajax({
            url: "<?=base_url()?>dosen/get_dosen", 
            type: "POST",
            dataType: "json",
            data: {nid : $(this).data('val')},
            beforeSend: function(){
                App.blockUI({
                    boxed : true,
                    zIndex: 20000,
                });
            },
            success: function(data) {
                // success4.show();
                $('input[name="del_nid"]').val(data.nid);
                $('input[name="del_nama"]').val(data.nama);
                $('textarea[name="del_alamat"]').val(data.alamat);
                $('input[name="del_telepon"]').val(data.telepon);
                $('#modal_delete_dosen').modal('show');
                // console.log(data);
            },
            complete: function(){
                setTimeout(function(){ App.unblockUI(); }, 500);
            }
        });

        var form4 = $('#form_delete_dosen');
        var success4 = $('.alert-danger-delete', form4);

        form4.validate({
            submitHandler: function (form) {
                $.ajax({
                    url: "<?=base_url()?>dosen/delete_dosen", 
                    type: "POST",
                    data: $(form).serialize(),
                    cache: false,             
                    processData: false,      
                    beforeSend: function(){
                        App.blockUI({
                            boxed : true,
                            zIndex: 20000,
                        });
                    },
                    success: function(data) {
                        success4.hide();
                        location.reload();
                    },
                    complete: function(){
                        setTimeout(function(){ App.unblockUI(); }, 2000);
                    }
                });
            }
        });
    })
});
</script>