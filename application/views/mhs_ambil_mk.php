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
                        <li>Mata Kuliah</li>
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
                                        <span class="caption-subject font-green sbold uppercase">List Mata Kuliah | <?=$tahun_ajaran?> - <?=$semester?></span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" data-toggle="modal" href="#modal_ambil_mk" title="Ambil Mata Kuliah" id="ambil_mk">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover order-column" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> Tahun Ajaran </th>
                                                <th> Semester </th>
                                                <th> Kode Mata Kuliah </th>
                                                <th> Nama Mata Kuliah </th>
                                                <th> SKS </th>
                                                <th> Semester </th>
                                                <th> Program Studi </th>
                                                <th> Peminatan </th>
                                                <!-- <th> Created Date </th>
                                                <th> Created By </th>
                                                <th> Modified Date </th>
                                                <th> Modified By </th>
                                                <th> Show </th>
                                                <th> Actions </th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // print_r($list_mk);
                                            // echo $list_mk->kode_mk;
                                            foreach($list_mk as $row)
                                            {
                                                ?>
                                            <tr class="odd gradeX">
                                                <td> <?=$row->tahun_ajaran?> </td>
                                                <td> <?=$row->smstr?> </td>
                                                <td> <?=$row->kode_mk?> </td>
                                                <td> <?=$row->nama_mk?> </td>
                                                <td> <?=$row->sks_mk?> </td>
                                                <td> <?=$row->semester_mk?> </td>
                                                <td> <?=$row->program_studi?> </td>
                                                <td> 
                                                <?php
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
                                                ?> 
                                                </td>
                                                <!-- <td> <?=$row->created_date?> </td>
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
                                                </td> -->
                                            </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <!-- MODAL INSERT -->
                                    <div class="modal fade" id="modal_ambil_mk" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" id="modal_dialog_ambil_mk"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Ambil Mata Kuliah | <?=$tahun_ajaran?>-<?=$semester?></h4>
                                                </div>
                                                <form id="form_ambil_mk" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-hide">
                                                                <button class="close" data-close="alert"></button> Anda memiliki beberapa bentuk kesalahan. Silakan cek di bawah ini. </div>
                                                            <div class="alert alert-success display-hide">
                                                                <button class="close" data-close="alert"></button> Data berhasil di simpan! </div>
                                                            <table class="table table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Kode Mata Kuliah</th>
                                                                        <th>Nama Mata Kuliah</th>
                                                                        <th>SKS</th>
                                                                        <th>Semester</th>
                                                                        <th>Program Studi</th>
                                                                        <th>Peminatan</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    // $x = 0;
                                                                    foreach ($list_open_mk as $row) {
                                                                        ?>
                                                                    <tr>
                                                                        <td>
                                                                            <input type="checkbox" name="kd_mk[]" value="<?=$row->kode_mk?>" data-sks="<?=$row->sks_mk?>" class="kode_mk_cb">
                                                                        </td>
                                                                        <td><?=$row->kode_mk?></td>
                                                                        <td><?=$row->nama_mk?></td>
                                                                        <td><?=$row->sks_mk?></td>
                                                                        <td><?=$row->semester_mk?></td>
                                                                        <td><?=$row->program_studi?></td>
                                                                        <td> 
                                                                        <?php
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
                                                                        ?> 
                                                                        </td>
                                                                    </tr>
                                                                        <?php
                                                                    // $x+=$row->sks_mk;
                                                                    }
                                                                    ?>
                                                                    <!-- <tr>
                                                                        <td colspan="3">TOTAL SELURUH SKS</td>
                                                                        <td colspan=""><?=$x?></td>
                                                                    </tr> -->
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <p class="btn blue" id="total-sks">Total SKS 0 (Maks 24)</p>
                                                        <input type="hidden" name="nim" value="<?=$nim?>">
                                                        <input type="hidden" name="tahun_ajaran" value="<?=$tahun_ajaran?>">
                                                        <input type="hidden" name="semester" value="<?=$semester?>">
                                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn green" id="btn-ambil-mk">Ambil</button>
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
<script type="text/javascript">
jQuery(document).ready(function() {
    // add the rule here
 $.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg !== value;
 }, "Value must not equal arg.");

    $('#ambil_mk').on('click', function(){
        $('.kode_mk_cb').on('click', function(){
            var a = 0;

            $('input[name="kd_mk[]"]:checked').each(function(){
                a += $(this).data('sks');
            });
            if (a > 24) 
            {
                $('#total-sks').text('Total SKS '+a+' (Maks 24)');
                $('#total-sks').addClass('red');
                $('#total-sks').removeClass('blue');
                $('#btn-ambil-mk').prop('disabled',true);
            }
            else
            {
                $('#total-sks').text('Total SKS '+a+' (Maks 24)');
                $('#total-sks').addClass('blue');
                $('#total-sks').removeClass('red');
                $('#btn-ambil-mk').removeAttr('disabled');
            }
            console.log(a);
        });
        //console.log('clicked');
        // validation using icons
        var form4 = $('#form_ambil_mk');
        var error4 = $('.alert-danger', form4);
        var success4 = $('.alert-success', form4);

        form4.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input

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
                console.log($(form).serialize());
                if ($('.kode_mk_cb:checked').length < 1) 
                {
                    alert("Harap memilih minimal 1 mata kuliah");
                }
                else
                {
                    $.ajax({
                        url: "<?=base_url()?>mhs_ambil_mk/insert", 
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
                    return false;
                }
                // success4.show();
                // error4.hide();
                //form.submit(); // submit the form
            }
        });
    });
    $('#modal_ambil_mk').on('hidden.bs.modal', function (e) {
        console.log('modal hide');
        var idform = $('#form_ambil_mk');
        idform.find('.has-error').removeClass('has-error');
        idform.find('.has-success').removeClass('has-success');
        idform.find('.fa-warning').removeClass('fa-warning');
        idform.find('.fa-check').removeClass('fa-check');
        idform.find('.alert-danger').css('display','none');
        idform.find('.alert-success').css('display','none');
        idform.find('input').prop('checked', false);
        // idform.find('select').val('pilih');
    })
});
</script>