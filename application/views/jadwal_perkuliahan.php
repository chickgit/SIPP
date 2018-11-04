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
                <div class="page-fixed-main-content">
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green sbold uppercase">Data Jadwal Perkuliahan</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover text-center" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> Nama Jadwal </th>
                                                <th> Finalisasi </th>
                                                <th> Terbit </th>
                                                <th> Tahun Ajaran Terbit </th>
                                                <th> Semester Terbit </th>
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
                                            (isset($list_jp)) ? : $list_jp = array();
                                            foreach ($list_jp as $row) {
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td> <?=$row->draft_nama?> </td>
                                                    <td> <?=($row->finalisasi == 0) ? '<span class="label label-sm label-info"> Belum </span>' : '<span class="label label-sm label-info"> Sudah </span>'?> </td>
                                                    <td> <?=($row->terbit == 0) ? '<span class="label label-sm label-warning"> Belum </span>' : '<span class="label label-sm label-info"> Sudah </span>'?> </td>
                                                    <td> <?=($row->tahun_ajaran == NULL) ? '-' : $row->tahun_ajaran?> </td>
                                                    <td> <?=($row->semester == NULL) ? '-' : $row->semester?> </td>
                                                    <td>
                                                        <div class="btn-group" style="position: relative;">
                                                            <form method="POST" action="jadwal_perkuliahan/actions">
                                                                <input type="hidden" name="final" value="<?=$row->finalisasi?>">
                                                                <input type="hidden" name="nama" value="<?=$row->draft_nama?>">
                                                                <button type="submit" value="<?=$row->draft_id_jp?>" name="view" class="btn btn-xs grey-salsa">
                                                                    <i class="fa fa-search"></i> Lihat</a>
                                                                </button>
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu" style="position: inherit;">
                                                                <li>
                                                                    <?php
                                                                    if ($row->terbit == 0) {
                                                                        ?>
                                                                    <a id="publish" data-val="<?=$row->draft_id_jp?>">
                                                                        <i class="fa fa-share-alt"></i> Terbitkan</a>
                                                                        <?php
                                                                    }else{
                                                                        ?>
                                                                    <a id="cancel_publish" data-val="<?=$row->draft_id_jp?>">
                                                                        <i class="fa fa-share-alt"></i> Batal Terbit</a>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </li>
                                                                <li>
                                                                    <a id="delete" data-val="<?=$row->draft_id_jp?>">
                                                                        <i class="icon-trash"></i> Hapus</a>
                                                                </li>
                                                            </ul>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                        <!-- <button class="btn btn-success mt-sweetalert" data-title="Sweet Alerts with Icons" data-message="Success Icon" data-type="success" data-allow-outside-click="true" data-confirm-button-class="btn-success">Icon Success Alert</button> -->
                                    </table>
                                    <!-- MODAL TERBIT -->
                                    <div class="modal fade " id="modal_terbit" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_terbit"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Penerbitan Jadwal</h4>
                                                </div>
                                                <form id="form_terbit" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-hide alert-terbit-danger">
                                                                <button class="close" data-close="alert"></button> Anda memiliki beberapa bentuk kesalahan. Silakan cek di bawah ini. </div>
                                                            <div class="alert alert-success display-hide alert-terbit-success">
                                                                <button class="close" data-close="alert"></button> Data berhasil di ubah! </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Nama Jadwal
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="nama_jadwal" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Tahun Ajaran
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <?php echo form_dropdown('ta_jadwal', $drop['ta']['opt'], $drop['ta']['slctd'], $drop['ta']['attr']); ?>
                                                                        <!-- <input type="text" class="form-control" name="ta_jadwal" placeholder="2017/2018"> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Semester
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <?php echo form_dropdown('smstr_jadwal', $drop['smstr']['opt'], $drop['smstr']['slctd'], $drop['smstr']['attr']); ?>
                                                                        <!-- <select class="form-control" name="smstr_jadwal">
                                                                            <option value="GANJIL">GANJIL</option>
                                                                            <option value="GENAP">GENAP</option>
                                                                        </select> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="id_draft">
                                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn green">Terbit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- MODAL BATAL TERBIT -->
                                    <div class="modal fade " id="modal_batal_terbit" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_batal_terbit"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Pembatalan Penerbitan Jadwal</h4>
                                                </div>
                                                <form id="form_batal_terbit" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-hide alert-terbit-danger">
                                                                <button class="close" data-close="alert"></button> Anda memiliki beberapa bentuk kesalahan. Silakan cek di bawah ini. </div>
                                                            <div class="alert alert-success display-hide alert-terbit-success">
                                                                <button class="close" data-close="alert"></button> Data berhasil di ubah! </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Nama Jadwal
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" readonly class="form-control" name="nama_jadwal_batal" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Tahun Ajaran
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" readonly class="form-control" name="ta_jadwal_batal" placeholder="2017/2018">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Semester
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-icon right">
                                                                        <i class="fa"></i>
                                                                        <input type="text" readonly class="form-control" name="smstr_jadwal_batal">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="id_draft_batal">
                                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn green">Batalkan</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- MODAL DELETE -->
                                    <div class="modal fade " id="modal_delete" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog " id="modal_dialog_delete"> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Hapus Jadwal</h4>
                                                </div>
                                                <form id="form_delete" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-block">
                                                                Anda yakin ingin menghapus Jadwal ini?
                                                                <br>
                                                                <h6>Peringatan! Semua data jadwal yang ada pada Jadwal <b id="nama_jadwal"></b> akan di hapus</h6>
                                                            </div>
                                                        </div>
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="id_draft">
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
    var JADWAL = "<?=count($list_jp)?>";

    // add the rule here
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg !== value;
    }, "Value must not equal arg.");

    $('#sample_2').on('click', '#publish', function(){
        $.ajax({
            url: "<?=base_url()?>jadwal_perkuliahan/get_draft",
            type: "POST",
            dataType: "json",
            data: {id_draft : $(this).data('val')},
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
                $('input[name="id_draft"]').val(data.draft_id_jp);
                $('input[name="nama_jadwal"]').val(data.draft_nama);
                $('#modal_terbit').modal('show');
                console.log(data);
            },
            complete: function(){
                App.unblockUI();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#modal_terbit').modal('hide');
                swal({
                    title : "Gagal!", 
                    text : xhr.status+"\n"+thrownError, 
                    type : "error"},
                );
                console.log(xhr);
                console.log(thrownError);
            }
        });

        var form4 = $('#form_terbit');
        var error4 = $('.alert-terbit-danger', form4);
        var success4 = $('.alert-terbit-success', form4);

        form4.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                ta_jadwal: {
                    valueNotEquals : '0'
                },
                smstr_jadwal: {
                    valueNotEquals : '0'
                }
            },
            messages: {
                ta_jadwal: {
                    valueNotEquals : "Tahun ajaran harus di pilih"
                },
                smstr_jadwal: {
                    valueNotEquals : "Semester harus di pilih"
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
                    url: "<?=base_url()?>jadwal_perkuliahan/penerbitan", 
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
                        // console.log(data);
                        $('#modal_terbit').modal('hide');
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
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        $('#modal_terbit').modal('hide');
                        swal({
                            title : "Gagal!", 
                            text : xhr.status+"\n"+thrownError, 
                            type : "error"},
                        );
                        // console.log(xhr);
                        // console.log(thrownError);
                    }
                });
            }
        });
    });

    $('#sample_2').on('click', '#cancel_publish', function(){
        $.ajax({
            url: "<?=base_url()?>jadwal_perkuliahan/get_draft",
            type: "POST",
            dataType: "json",
            data: {id_draft : $(this).data('val')},
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
                $('input[name="id_draft_batal"]').val(data.draft_id_jp);
                $('input[name="nama_jadwal_batal"]').val(data.draft_nama);
                $('input[name="ta_jadwal_batal"]').val(data.tahun_ajaran);
                $('input[name="smstr_jadwal_batal"]').val(data.semester);
                $('#modal_batal_terbit').modal('show');
                console.log(data);
            },
            complete: function(){
                App.unblockUI();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#modal_batal_terbit').modal('hide');
                swal({
                    title : "Gagal!", 
                    text : xhr.status+"\n"+thrownError, 
                    type : "error"},
                );
                console.log(xhr);
                console.log(thrownError);
            }
        });

        var form4 = $('#form_batal_terbit');
        var error4 = $('.alert-terbit-danger', form4);
        var success4 = $('.alert-terbit-success', form4);

        form4.validate({
            submitHandler: function (form) {
                error4.hide();
                // console.log($(form).serialize());
                $.ajax({
                    url: "<?=base_url()?>jadwal_perkuliahan/batal_penerbitan", 
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
                        $('#modal_batal_terbit').modal('hide');
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
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        $('#modal_batal_terbit').modal('hide');
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
    });

    $('#sample_2').on('click', '#delete', function(){
        $.ajax({
            url: "<?=base_url()?>jadwal_perkuliahan/get_draft", 
            type: "POST",
            dataType: "json",
            data: {id_draft : $(this).data('val')},
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
                $('#nama_jadwal').text('"'+data.draft_nama+'"');
                $('input[name="id_draft"]').val(data.draft_id_jp);
                $('#modal_delete').modal('show');
                console.log(data);
            },
            complete: function(){
                App.unblockUI();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#modal_delete').modal('hide');
                swal({
                    title : "Gagal!", 
                    text : xhr.status+"\n"+thrownError, 
                    type : "error"},
                );
                console.log(xhr);
                console.log(thrownError);
            }
        });

        var form4 = $('#form_delete');
        form4.validate({
            submitHandler: function (form) {
                $.ajax({
                    url: "<?=base_url()?>jadwal_perkuliahan/penghapusan", 
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
                        $('#modal_delete').modal('hide');
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
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        $('#modal_delete').modal('hide');
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
    })

});
</script>