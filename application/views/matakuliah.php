<!-- <link href="<?=base_url()?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" /> -->
<?=$header?>
        <!-- BEGIN CONTAINER -->
        <div class="container-fluid">
            <div class="page-content page-content-popup">
                <div class="page-content-fixed-header">
                    <!-- BEGIN BREADCRUMBS -->
                    <ul class="page-breadcrumb">
                        <li>Kaprodi</li>
                        <li>Mata Kuliah</li>
                    </ul>
                    <!-- END BREADCRUMBS -->
                    <div class="content-header-menu">
                        <!-- BEGIN DROPDOWN AJAX MENU -->
                        <div class="dropdown-ajax-menu btn-group">
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
                        </div>
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
                                        <span class="caption-subject font-green sbold uppercase">Data Mata Kuliah</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" data-toggle="modal" href="#modal_new_mk" title="Tambah Mata Kuliah" id="tambah_mk">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover order-column" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> Kode Mata Kuliah </th>
                                                <th> Nama Mata Kuliah </th>
                                                <th> SKS </th>
                                                <th> Semester </th>
                                                <th> Program Studi </th>
                                                <th> Peminatan </th>
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
                                            foreach($list_mk as $row)
                                            {
                                                ?>
                                            <tr class="odd gradeX">
                                                <td> <?=$row->kode_mk?> </td>
                                                <td> <?=$row->nama_mk?> </td>
                                                <td> <?=$row->sks_mk?> </td>
                                                <td> <?=$row->semester_mk?> </td>
                                                <td> <?=$row->program_studi?> </td>
                                                <td> <?php
                                                $peminatan = Array(
                                                  '0' => 'Umum',
                                                  '1' => 'EIS',
                                                  '2' => 'MM',
                                                  '3' => 'JarKom',
                                                  '4' => 'MobA',
                                                );

                                                $color_type = null;
                                                if (array_key_exists($row->peminatan, $peminatan))
                                                {
                                                  echo $peminatan[$row->peminatan];
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
                                                                <a id="update_mk" data-val="<?=$row->kode_mk?>">
                                                                    <i class="icon-docs"></i> Ubah </a>
                                                            </li>
                                                            <li>
                                                                <a id="delete_mk" data-val="<?=$row->kode_mk?>">
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
                                    <div class="modal fade " id="modal_new_mk" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_new_mk"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Tambah Mata Kuliah</h4>
                                                </div>
                                                <form id="form_tambah_mk" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-hide">
                                                                <button class="close" data-close="alert"></button> Anda memiliki beberapa bentuk kesalahan. Silakan cek di bawah ini. </div>
                                                            <div class="alert alert-success display-hide">
                                                                <button class="close" data-close="alert"></button> Data berhasil di simpan! </div>
                                                            <div class="form-group ">
                                                                <label class="control-label col-md-4">Kode Mata Kuliah
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="kode_mk" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Nama Mata Kuliah
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="nama_mk" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">SKS
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="number" class="form-control" name="sks_mk" min="1" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Semester
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="number" class="form-control" name="semester_mk" min="1" max="8" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Program Studi
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <select name="program_studi" class="form-control">
                                                                            <option value="pilih">Pilih Prodi</option>
                                                                            <option value="SI">SI</option>
                                                                            <option value="TI">TI</option>
                                                                            <option value="SI/TI">SI/TI</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Peminatan
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <select name="peminatan" class="form-control">
                                                                            <option value="pilih">Pilih Peminatan</option>
                                                                            <option value="0">Umum</option>
                                                                            <option value="1">Enterprise Information System</option>
                                                                            <option value="2">Multimedia</option>
                                                                            <option value="3">Jaringan Komputer</option>
                                                                            <option value="4">Mobile Application</option>
                                                                        </select>
                                                                    </div>
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
                                    <div class="modal fade " id="modal_update_mk" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_update_mk"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Update Mata Kuliah</h4>
                                                </div>
                                                <form id="form_update_mk" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-hide">
                                                                <button class="close" data-close="alert"></button> Anda memiliki beberapa bentuk kesalahan. Silakan cek di bawah ini. </div>
                                                            <div class="alert alert-success display-hide">
                                                                <button class="close" data-close="alert"></button> Data berhasil di simpan! </div>
                                                            <div class="form-group ">
                                                                <label class="control-label col-md-4">Kode Mata Kuliah
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="upd_kode_mk" disabled/> 
                                                                        <input type="hidden" name="upd_kode_mk">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Nama Mata Kuliah
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="upd_nama_mk" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">SKS
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="number" class="form-control" name="upd_sks_mk" min="1" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Semester
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="number" class="form-control" name="upd_semester_mk" min="1" max="8" /> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Program Studi
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <select name="upd_program_studi" class="form-control">
                                                                            <option value="pilih">Pilih Prodi</option>
                                                                            <option value="SI">SI</option>
                                                                            <option value="TI">TI</option>
                                                                            <option value="SI/TI">SI/TI</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Peminatan
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <select name="upd_peminatan" class="form-control">
                                                                            <option value="pilih">Pilih Peminatan</option>
                                                                            <option value="0">Umum</option>
                                                                            <option value="1">Enterprise Information System</option>
                                                                            <option value="2">Multimedia</option>
                                                                            <option value="3">Jaringan Komputer</option>
                                                                            <option value="4">Mobile Application</option>
                                                                        </select>
                                                                    </div>
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
                                    <div class="modal fade " id="modal_delete_mk" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_delete_mk"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Hapus Mata Kuliah</h4>
                                                </div>
                                                <form id="form_delete_mk" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger alert-danger-delete">
                                                                Anda yakin ingin menghapus ? </div>
                                                            <div class="form-group ">
                                                                <label class="control-label col-md-4">Kode Mata Kuliah
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="del_kode_mk" disabled/> 
                                                                        <input type="hidden" name="del_kode_mk">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Nama Mata Kuliah
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" class="form-control" name="del_nama_mk" disabled/> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">SKS
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="number" class="form-control" name="del_sks_mk" min="1" disabled/> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Semester
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="number" class="form-control" name="del_semester_mk" min="1" max="8" disabled/> </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Program Studi
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" name="del_program_studi" class="form-control" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Peminatan
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" name="del_peminatan" class="form-control" disabled>
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
    // add the rule here
 $.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg !== value;
 }, "Value must not equal arg.");

    $('#tambah_mk').on('click', function(){
        //console.log('clicked');
        // validation using icons
        var form4 = $('#form_tambah_mk');
        var error4 = $('.alert-danger', form4);
        var success4 = $('.alert-success', form4);

        form4.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                kode_mk: {
                    required    : true,
                    remote      : "<?=base_url()?>matakuliah/check_kode_mk",
                    maxlength   : 8
                },
                nama_mk: {
                    required    : true,
                    maxlength   : 100,
                },
                sks_mk: {
                    required    : true,
                    digits      : true,
                    minlength   : 1
                },
                semester_mk: {
                    required    : true,
                    digits      : true,
                    minlength   : 1,
                    maxlength   : 8
                },
                program_studi: {
                    valueNotEquals :"pilih"
                },
                peminatan: {
                    valueNotEquals :"pilih"
                }
            },
            messages: {
                kode_mk: {
                    required    : "Kode mata kuliah harus di isi",
                    remote      : "Kode mata kuliah sudah terpakai",
                    maxlength   : "Kode mata kuliah maksimal 8 karakter "
                },
                nama_mk: {
                    required    : "Nama mata kuliah harus di isi",
                    maxlength   : "Harap isi tidak lebih dari 100 karakter",
                },
                sks_mk: {
                    required    : "SKS harus di isi",
                    digits      : "Hanya angka yang dibolehkan",
                    minlength   : "Harap isi minimal 1 digit",
                },
                semester_mk: {
                    required    : "Semester harus di isi",
                    digits      : "Hanya angka yang dibolehkan",
                    minlength   : "Harap isi minimal 1 digit",
                    maxlength   : "Harap isi maksimal 8 digit"
                },
                program_studi: {
                    valueNotEquals    :"Pilih Program Studi",
                },
                peminatan: {
                    valueNotEquals    :"Pilih Peminatan",
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
                    url: "<?=base_url()?>matakuliah/insert_matakuliah", 
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
                        success4.show();
                        location.reload();
                        // console.log(data);
                    },
                    complete: function(){
                        App.unblockUI();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
                return false;
                // success4.show();
                // error4.hide();
                //form.submit(); // submit the form
            }
        });
    });
    $('#modal_new_mk').on('hidden.bs.modal', function (e) {
        console.log('modal hide');
        var idform = $('#form_tambah_mk');
        idform.find('.has-error').removeClass('has-error');
        idform.find('.has-success').removeClass('has-success');
        idform.find('.fa-warning').removeClass('fa-warning');
        idform.find('.fa-check').removeClass('fa-check');
        idform.find('.alert-danger').css('display','none');
        idform.find('.alert-success').css('display','none');
        idform.find('input').val('');
        idform.find('select').val('pilih');
    })
    $('#sample_2').on('click', '#update_mk', function(){
        $.ajax({
            url: "<?=base_url()?>matakuliah/get_mk", 
            type: "POST",
            dataType: "json",
            data: {kode_mk : $(this).data('val')},
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
                $('input[name="upd_kode_mk"]').val(data.kode_mk);
                $('input[name="upd_nama_mk"]').val(data.nama_mk);
                $('input[name="upd_sks_mk"]').val(data.sks_mk);
                $('input[name="upd_semester_mk"]').val(data.semester_mk);
                $('select[name="upd_program_studi"]').val(data.program_studi);
                $('select[name="upd_peminatan"]').val(data.peminatan);
                $('#modal_update_mk').modal('show');
                // console.log(data);
            },
            complete: function(){
                App.unblockUI();
            }
        });

        var form4 = $('#form_update_mk');
        var error4 = $('.alert-update-danger', form4);
        var success4 = $('.alert-update-success', form4);

        form4.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                upd_nama_mk: {
                    required: true,
                    maxlength: 100,
                },
                upd_sks_mk: {
                    required: true,
                    digits: true,
                    minlength : 1
                },
                upd_semester_mk: {
                    required: true,
                    digits: true,
                    minlength : 1,
                    maxlength : 8
                },
                upd_program_studi: {
                    valueNotEquals :"pilih"
                },
                upd_peminatan: {
                    valueNotEquals :"pilih"
                }
            },
            messages: {
                upd_nama_mk: {
                    required: "Nama mata kuliah harus di isi",
                    maxlength: "Harap isi tidak lebih dari 100 karakter",
                },
                upd_sks_mk: {
                    required: "SKS harus di isi",
                    digits: "Hanya angka yang dibolehkan",
                    minlength : "Harap isi minimal 1 digit",
                },
                upd_semester_mk: {
                    required: "Semester harus di isi",
                    digits: "Hanya angka yang dibolehkan",
                    minlength : "Harap isi minimal 1 digit",
                    maxlength : "Harap isi maksimal 8 digit"
                },
                upd_program_studi: {
                    valueNotEquals    :"Pilih Program Studi",
                },
                upd_peminatan: {
                    valueNotEquals    :"Pilih Peminatan",
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
                    url: "<?=base_url()?>matakuliah/update_mk", 
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
                        success4.show();
                        location.reload();
                        // console.log(data);
                    },
                    complete: function(){
                        App.unblockUI();
                    }
                });
                return false;
                // success4.show();
                // error4.hide();
                //form.submit(); // submit the form
            }
        });
    });
    $('#modal_update_mk').on('hidden.bs.modal', function (e) {
        console.log('modal hide');
        var idform = $('#form_update_mk');
        idform.find('.has-error').removeClass('has-error');
        idform.find('.has-success').removeClass('has-success');
        idform.find('.fa-warning').removeClass('fa-warning');
        idform.find('.fa-check').removeClass('fa-check');
        idform.find('.alert-danger').css('display','none');
        idform.find('.alert-success').css('display','none');
        idform.find('input').val('');
        idform.find('select').val('pilih');
    })
    $('#sample_2').on('click', '#delete_mk', function(){
        $.ajax({
            url: "<?=base_url()?>matakuliah/get_mk", 
            type: "POST",
            dataType: "json",
            data: {kode_mk : $(this).data('val')},
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
                $('input[name="del_kode_mk"]').val(data.kode_mk);
                $('input[name="del_nama_mk"]').val(data.nama_mk);
                $('input[name="del_sks_mk"]').val(data.sks_mk);
                $('input[name="del_semester_mk"]').val(data.semester_mk);
                $('input[name="del_program_studi"]').val(data.program_studi);
                $('input[name="del_peminatan"]').val(data.peminatan);
                $('#modal_delete_mk').modal('show');
                // console.log(data);
            },
            complete: function(){
                App.unblockUI();
            }
        });

        var form4 = $('#form_delete_mk');
        var success4 = $('.alert-danger-delete', form4);

        form4.validate({
            submitHandler: function (form) {
                $.ajax({
                    url: "<?=base_url()?>matakuliah/delete_mk", 
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