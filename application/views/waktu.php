<?=$header?>
        <!-- BEGIN CONTAINER -->
        <div class="container-fluid">
            <div class="page-content page-content-popup">
                <div class="page-content-fixed-header">
                    <!-- BEGIN BREADCRUMBS -->
                    <ul class="page-breadcrumb">
                        <li><?=$role?></li>
                        <li>Waktu</li>
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
                                        <span class="caption-subject font-green sbold uppercase">Data Waktu</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" data-toggle="modal" href="#modal_new_wk" title="Tambah Waktu" id="tambah_wk">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover order-column" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> Waktu Awal </th>
                                                <th> Waktu Akhir </th>
                                                <th> Identitas Waktu </th>
                                                <th> SKS Waktu </th>
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
                                            foreach($list_waktu as $row)
                                            {
                                                ?>
                                            <tr class="odd gradeX">
                                                <td> <?=$row->waktu_aw?> </td>
                                                <td> <?=$row->waktu_ak?> </td>
                                                <td> <?=$row->role?> </td>
                                                <td> <?=$row->sks?> </td>
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
                                                                <a id="update_wk" data-val="<?=$row->id_waktu?>">
                                                                    <i class="icon-docs"></i> Ubah </a>
                                                            </li>
                                                            <li>
                                                                <a id="delete_wk" data-val="<?=$row->id_waktu?>">
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
                                    <div class="modal fade " id="modal_new_wk" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_new_wk"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Tambah Waktu</h4>
                                                </div>
                                                <form id="form_tambah_wk" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-hide">
                                                                <button class="close" data-close="alert"></button> Anda memiliki beberapa bentuk kesalahan. Silakan cek di bawah ini. </div>
                                                            <div class="alert alert-success display-hide">
                                                                <button class="close" data-close="alert"></button> Data berhasil di simpan! </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Waktu Awal
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="time" class="form-control" name="awal_wk" id="awal_wk" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Waktu Akhir
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="time" class="form-control" name="akhir_wk" id="akhir_wk" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Identitas Waktu
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <select name="role" class="form-control">
                                                                            <option value="pilih">Pilih Identitas</option>
                                                                            <option value="PP">PP (Pagi-Pagi)</option>
                                                                            <option value="PS">PS (Pagi-Siang)</option>
                                                                            <option value="SS">SS (Siang-Siang)</option>
                                                                            <option value="SP">SP (Siang-Petang)</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">SKS Waktu
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="number" class="form-control" name="sks_wk" id="sks_wk" /> </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn green">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- MODAL UPDATE -->
                                    <div class="modal fade " id="modal_update_wk" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_update_wk"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Update Waktu</h4>
                                                </div>
                                                <form id="form_update_wk" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-hide">
                                                                <button class="close" data-close="alert"></button> Anda memiliki beberapa bentuk kesalahan. Silakan cek di bawah ini. </div>
                                                            <div class="alert alert-success display-hide">
                                                                <button class="close" data-close="alert"></button> Data berhasil di simpan! </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Waktu Awal
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="time" class="form-control" name="upd_awal_wk" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Waktu Akhir
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="time" class="form-control" name="upd_akhir_wk" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Identitas Waktu
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <select name="upd_role" class="form-control">
                                                                            <option value="pilih">Pilih Identitas</option>
                                                                            <option value="PP">PP (Pagi-Pagi)</option>
                                                                            <option value="PS">PS (Pagi-Siang)</option>
                                                                            <option value="SS">SS (Siang-Siang)</option>
                                                                            <option value="SP">SP (Siang-Petang)</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">SKS Waktu
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="number" class="form-control" name="upd_sks_wk" id="upd_sks_wk" /> </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Tutup</button>
                                                        <input type="hidden" name="upd_id_waktu">
                                                        <button type="submit" class="btn green">Ubah</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- MODAL DELETE -->
                                    <div class="modal fade " id="modal_delete_wk" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_delete_wk"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Hapus Waktu</h4>
                                                </div>
                                                <form id="form_delete_wk" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger alert-danger-delete">
                                                                Anda yakin ingin menghapus ? </div>
                                                            <div class="form-group ">
                                                                <label class="control-label col-md-4">Kode Waktu
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="del_id_waktu" disabled/> 
                                                                        <input type="hidden" name="del_id_waktu">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Waktu Awal
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="time" class="form-control" name="del_awal_wk" disabled /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Waktu Akhir
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="time" class="form-control" name="del_akhir_wk" disabled /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Identitas Waktu
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="del_role" disabled /> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">SKS Waktu
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="del_sks_wk" disabled /> 
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
    $.validator.addMethod("notEqual", function(value, element, param) {
      return this.optional(element) || value != $(param).val();
    }, "Please specify a different (non-default) value");
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg !== value;
    }, "Value must not equal arg.");

    $('#tambah_wk').on('click', function(){
        //console.log('clicked');
        // validation using icons
        var form4 = $('#form_tambah_wk');
        var error4 = $('.alert-danger', form4);
        var success4 = $('.alert-success', form4);

        form4.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                awal_wk: {
                    required: true,
                    notEqual: "#akhir_wk"
                },
                akhir_wk: {
                    required: true,
                    notEqual: "#awal_wk"
                },
                role: {
                    valueNotEquals : 'pilih'
                },
                sks_wk: {
                    required: true,
                    range : [1,3]
                }
            },
            messages: {
                awal_wk: {
                    required: "Waktu awal harus di isi",
                    notEqual: "Waktu awal dan waktu akhir tidak boleh sama"
                },
                akhir_wk: {
                    required: "Waktu akhir harus di isi",
                    notEqual: "Waktu awal dan waktu akhir tidak boleh sama"
                },
                role: {
                    valueNotEquals : "Harap pilih identitas waktu"
                },
                sks_wk: {
                    required : "Masukkan SKS waktu",
                    range : "Masukkan SKS antara 1 dan 3"
                }
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
                    url: "<?=base_url()?>waktu/insert_wk", 
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
            }
        });
    });
    $('#modal_new_wk').on('hidden.bs.modal', function (e) {
        console.log('modal hide');
        var idform = $('#form_tambah_wk');
        idform.find('.has-error').removeClass('has-error');
        idform.find('.has-success').removeClass('has-success');
        idform.find('.fa-warning').removeClass('fa-warning');
        idform.find('.fa-check').removeClass('fa-check');
        idform.find('.alert-danger').css('display','none');
        idform.find('.alert-success').css('display','none');
        idform.find('input').val('');
        idform.find('select').val('pilih');
    });
    $('#sample_2').on('click', '#update_wk', function(){
        $.ajax({
            url: "<?=base_url()?>waktu/get_wk", 
            type: "POST",
            dataType: "json",
            data: {id_waktu : $(this).data('val')},
            beforeSend: function(){
                App.blockUI({
                    boxed : true,
                    zIndex: 20000,
                });
            },
            success: function(data) {
                // success4.show();
                $('input[name="upd_id_waktu"]').val(data.id_waktu);
                $('input[name="upd_awal_wk"]').val(data.waktu_aw);
                $('input[name="upd_akhir_wk"]').val(data.waktu_ak);
                $('select[name="upd_role"]').val(data.role);
                $('input[name="upd_sks_wk"]').val(data.sks);
                $('#modal_update_wk').modal('show');
                console.log(data);
            },
            complete: function(){
                setTimeout(function(){ App.unblockUI(); }, 500);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

        var form4 = $('#form_update_wk');
        var error4 = $('.alert-update-danger', form4);
        var success4 = $('.alert-update-success', form4);

        form4.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                upd_awal_wk: {
                    required: true,
                },
                upd_akhir_wk: {
                    required: true,
                },
                upd_role: {
                    valueNotEquals : 'pilih'
                },
                upd_sks_wk: {
                    required: true,
                    range : [1,3]
                }
            },
            messages: {
                upd_awal_wk: {
                    required: "Awal waktu harus di isi",
                },
                upd_akhir_wk: {
                    required: "Akhir waktu harus di isi",
                },
                upd_role: {
                    valueNotEquals : "Pilih identitas waktu"
                },
                upd_sks_wk: {
                    required: "SKS waktu harus di isi",
                    range : "SKS waktu antara 1 dan 3"
                }
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
                    url: "<?=base_url()?>waktu/update_wk", 
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
                        console.log(data);
                    },
                    complete: function(){
                        setTimeout(function(){ App.unblockUI(); }, 2000);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
            }
        });
    });
    $('#modal_update_wk').on('hidden.bs.modal', function (e) {
        console.log('modal hide');
        var idform = $('#form_update_wk');
        idform.find('.has-error').removeClass('has-error');
        idform.find('.has-success').removeClass('has-success');
        idform.find('.fa-warning').removeClass('fa-warning');
        idform.find('.fa-check').removeClass('fa-check');
        idform.find('.alert-danger').css('display','none');
        idform.find('.alert-success').css('display','none');
        idform.find('input').val('');
    });
    $('#sample_2').on('click', '#delete_wk', function(){
        $.ajax({
            url: "<?=base_url()?>waktu/get_wk", 
            type: "POST",
            dataType: "json",
            data: {id_waktu : $(this).data('val')},
            beforeSend: function(){
                App.blockUI({
                    boxed : true,
                    zIndex: 20000,
                });
            },
            success: function(data) {
                // success4.show();
                $('input[name="del_id_waktu"]').val(data.id_waktu);
                $('input[name="del_awal_wk"]').val(data.waktu_aw);
                $('input[name="del_akhir_wk"]').val(data.waktu_ak);
                $('input[name="del_role"]').val(data.role);
                $('input[name="del_sks_wk"]').val(data.sks);
                $('#modal_delete_wk').modal('show');
                // console.log(data);
            },
            complete: function(){
                setTimeout(function(){ App.unblockUI(); }, 500);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

        var form4 = $('#form_delete_wk');
        var success4 = $('.alert-danger-delete', form4);

        form4.validate({
            submitHandler: function (form) {
                $.ajax({
                    url: "<?=base_url()?>waktu/delete_wk", 
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
            }
        });
    });
});
</script>