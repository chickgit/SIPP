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
                                        <span class="caption-subject font-green sbold uppercase">Data Ruangan</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" data-toggle="modal" href="#modal_new_rg" title="Tambah Ruangan" id="tambah_rg">
                                            <i class="fa fa-plus"></i>
                                        </a>
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
                                            foreach($list_ruangan as $row)
                                            {
                                                ?>
                                            <tr class="odd gradeX">
                                                <td> <?=$row->nama_ruangan?> </td>
                                                <td> <?=$row->gedung_rg?> </td>
                                                <td> <?=$row->jenis?> </td>
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
                                                                <a id="update_rg" data-val="<?=$row->id_ruangan?>">
                                                                    <i class="icon-docs"></i> Ubah </a>
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
                                    <!-- MODAL INSERT -->
                                    <div class="modal fade " id="modal_new_rg" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_new_rg"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Tambah Ruangan</h4>
                                                </div>
                                                <form id="form_tambah_rg" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-hide">
                                                                <button class="close" data-close="alert"></button> Anda memiliki beberapa bentuk kesalahan. Silakan cek di bawah ini. </div>
                                                            <div class="alert alert-success display-hide">
                                                                <button class="close" data-close="alert"></button> Data berhasil di simpan! </div>
                                                            <div class="form-group ">
                                                                <label class="control-label col-md-4">Nama Ruangan
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="nama_ruangan" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Gedung
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="gedung" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Jenis
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <?php echo form_dropdown('jenis', $drop['jenis_ruangan']['opt'],'',array('class' => 'form-control')); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Kapasitas
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="number" class="form-control" name="kapasitas" min="1" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Tampilkan
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-3">
                                                                    <label class="mt-radio-list">
                                                                        <div class="input-icon right">
                                                                            <i class="fa"></i>
                                                                            <label class="mt-radio">
                                                                                <input type="radio" name="isShow" value="1" checked/> Ya
                                                                                <span></span>
                                                                            </label>
                                                                            <label class="mt-radio">
                                                                                <input type="radio" name="isShow" value="0" /> Tidak
                                                                                <span></span>
                                                                            </label>
                                                                        </div>
                                                                    </label>
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
                                    <div class="modal fade " id="modal_update_rg" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_update_rg"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Update Ruangan</h4>
                                                </div>
                                                <form id="form_update_rg" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-hide">
                                                                <button class="close" data-close="alert"></button> Anda memiliki beberapa bentuk kesalahan. Silakan cek di bawah ini. </div>
                                                            <div class="alert alert-success display-hide">
                                                                <button class="close" data-close="alert"></button> Data berhasil di simpan! </div>
                                                            <div class="form-group ">
                                                                <label class="control-label col-md-4">Nama Ruangan
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="upd_nama_ruangan"/> 
                                                                        <input type="hidden" name="upd_nama_ruangan">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Gedung
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="upd_gedung" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Jenis
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <?php echo form_dropdown('upd_jenis', $drop['jenis_ruangan']['opt'],'',array('class' => 'form-control')); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Kapasitas
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="number" class="form-control" name="upd_kapasitas" min="1" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Tampilkan
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-3">
                                                                    <label class="mt-radio-list">
                                                                        <div class="input-icon right">
                                                                            <i class="fa"></i>
                                                                            <label class="mt-radio">
                                                                                <input type="radio" name="upd_isShow" value="1"/> Ya
                                                                                <span></span>
                                                                            </label>
                                                                            <label class="mt-radio">
                                                                                <input type="radio" name="upd_isShow" value="0" /> Tidak
                                                                                <span></span>
                                                                            </label>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="upd_id_ruangan">
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
                                    <div class="modal fade " id="modal_delete_rg" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_delete_rg"> 
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
                                                                <label class="control-label col-md-4">Nama Ruangan
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="del_nama_rg" disabled/> 
                                                                        <input type="hidden" name="del_id_ruangan">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Gedung 
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="del_gedung" disabled/> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Jenis
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="del_jenis"  disabled/> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Kapasitas
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="number" class="form-control" name="del_kapasitas" min="1" disabled/> </div>
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
 $.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg !== value;
 }, "Value must not equal arg.");

    $('#tambah_rg').on('click', function(){
        //console.log('clicked');
        // validation using icons
        var form4 = $('#form_tambah_rg');
        var error4 = $('.alert-danger', form4);
        var success4 = $('.alert-success', form4);

        form4.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                nama_ruangan: {
                    required: true,
                    maxlength: 15
                },
                gedung: {
                    required: true,
                    maxlength: 1
                },
                jenis: {
                    valueNotEquals :"0"
                },
                kapasitas: {
                    required: true,
                    digits: true,
                    minlength : 1
                },
            },
            messages: {
                nama_ruangan: {
                    required: "Nama ruangan harus di isi",
                    maxlength: "Nama ruangan maksimal 15 karakter"
                },
                gedung: {
                    required: "Gedung harus di isi",
                    maxlength: "Isi dengan satu karakter"
                },
                jenis: {
                    valueNotEquals: "Pilih jenis ruangan",
                },
                kapasitas: {
                    required: "Kapasitas harus di isi",
                    digits: "Hanya angka yang dibolehkan",
                    minlength : "Harap isi minimal 1 digit",
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
                    url: "<?=base_url()?>ruangan/insert_ruangan", 
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
    $('#modal_new_rg').on('hidden.bs.modal', function (e) {
        console.log('modal hide');
        var idform = $('#form_tambah_rg');
        idform.find('.has-error').removeClass('has-error');
        idform.find('.has-success').removeClass('has-success');
        idform.find('.fa-warning').removeClass('fa-warning');
        idform.find('.fa-check').removeClass('fa-check');
        idform.find('.alert-danger').css('display','none');
        idform.find('.alert-success').css('display','none');
        idform.find('input').val('');
        idform.find('select').val(0);
    });
    $('#sample_2').on('click', '#update_rg', function(){
        $.ajax({
            url: "<?=base_url()?>ruangan/get_rg", 
            type: "POST",
            dataType: "json",
            data: {id_ruangan : $(this).data('val')},
            beforeSend: function(){
                App.blockUI({
                    boxed : true,
                    zIndex: 20000,
                });
            },
            success: function(data) {
                // success4.show();
                $('input[name="upd_id_ruangan"]').val(data.id_ruangan);
                $('input[name="upd_nama_ruangan"]').val(data.nama_ruangan);
                $('input[name="upd_gedung"]').val(data.gedung_rg);
                $('select[name="upd_jenis"]').val(data.id_jenis);
                $('input[name="upd_kapasitas"]').val(data.kapasitas_rg);
                $.each($('input[name="upd_isShow"]'), function(index_radio,value_radio){
                    if (data.isShow == value_radio.value) {
                        $('input[name="upd_isShow"][value='+value_radio.value+']').prop('checked',true);
                    }
                })
                $('#modal_update_rg').modal('show');
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

        var form4 = $('#form_update_rg');
        var error4 = $('.alert-update-danger', form4);
        var success4 = $('.alert-update-success', form4);

        form4.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                upd_gedung: {
                    required: true,
                },
                upd_jenis: {
                    valueNotEquals :"0"
                },
                upd_kapasitas: {
                    required: true,
                    digits: true,
                    minlength : 1
                },
            },
            messages: {
                upd_gedung: {
                    required: "Gedung harus di isi",
                },
                upd_jenis: {
                    valueNotEquals: "Pilih jenis ruangan",
                },
                upd_kapasitas: {
                    required: "Kapasitas harus di isi",
                    digits: "Hanya angka yang dibolehkan",
                    minlength : "Harap isi minimal 1 digit",
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
                    url: "<?=base_url()?>ruangan/update_rg", 
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
    $('#modal_update_rg').on('hidden.bs.modal', function (e) {
        console.log('modal hide');
        var idform = $('#form_update_rg');
        idform.find('.has-error').removeClass('has-error');
        idform.find('.has-success').removeClass('has-success');
        idform.find('.fa-warning').removeClass('fa-warning');
        idform.find('.fa-check').removeClass('fa-check');
        idform.find('.alert-danger').css('display','none');
        idform.find('.alert-success').css('display','none');
        idform.find('input').val('');
        idform.find('select').val(0);
    });
    $('#sample_2').on('click', '#delete_rg', function(){
        $.ajax({
            url: "<?=base_url()?>ruangan/get_rg", 
            type: "POST",
            dataType: "json",
            data: {id_ruangan : $(this).data('val')},
            beforeSend: function(){
                App.blockUI({
                    boxed : true,
                    zIndex: 20000,
                });
            },
            success: function(data) {
                // success4.show();
                $('input[name="del_id_ruangan"]').val(data.id_ruangan);
                $('input[name="del_nama_rg"]').val(data.nama_ruangan);
                $('input[name="del_gedung"]').val(data.gedung_rg);
                $('input[name="del_jenis"]').val(data.jenis);
                $('input[name="del_kapasitas"]').val(data.kapasitas_rg);
                $('#modal_delete_rg').modal('show');
                // console.log(data);
            },
            complete: function(){
                setTimeout(function(){ App.unblockUI(); }, 500);
            }
        });

        var form4 = $('#form_delete_rg');
        var success4 = $('.alert-danger-delete', form4);

        form4.validate({
            submitHandler: function (form) {
                $.ajax({
                    url: "<?=base_url()?>ruangan/delete_rg", 
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
                    }
                });
            }
        });
    });
});
</script>