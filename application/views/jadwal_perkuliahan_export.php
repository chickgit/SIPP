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
                        <li>Export Jadwal Perkuliahan</li>
                    </ul>
                    <!-- END BREADCRUMBS -->
                    <div class="content-header-menu">
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
                                        <span class="caption-subject font-green sbold uppercase">Export Jadwal Perkuliahan</span>
                                    </div>
                                    <div class="actions">
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <form action="<?=base_url()?>jadwal_perkuliahan_export/export" method="POST">
                                        <div class="panel-group accordion" id="draft">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle" data-parent="#draft" aria-expanded="true"> Judul Jadwal </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse in" aria-expanded="true" style="">
                                                    <div class="panel-body">
                                                        <input type="text" name="judul" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-group accordion" id="draft">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle" data-parent="#draft" aria-expanded="true"> Pilih Jadwal </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse in" aria-expanded="true" style="">
                                                    <div class="panel-body">
                                                            <select class="form-control input-sm" name="draft_jp">
                                                                <?php
                                                                foreach ($list_draft_jp as $key => $value) {
                                                                ?>
                                                                <option value="<?=$value->draft_id_jp?>" data-text="<?=$value->draft_nama?>"><?=$value->draft_nama?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                                <!-- <option value="1">Halo A</option>
                                                                <option value="2">Halo B</option>
                                                                <option value="3">Halo C</option> -->
                                                            </select>
                                                        <div class="input-group">
                                                            <!-- <span class="input-group-btn">
                                                                <a class="btn green btn-sm" type="button" title="Buka Draft" id="draft_open" onclick="draft(this)"><i class="icon-book-open"></i></a>
                                                            </span>
                                                            <span class="input-group-btn">
                                                                <a class="btn blue btn-sm" type="button" title="Rename Draft" id="draft_edit" onclick="draft(this)"><i class="fa fa-edit"></i></a>
                                                            </span>
                                                            <span class="input-group-btn">
                                                                <a class="btn red btn-sm" type="button" title="Delete Draft" id="draft_delete" onclick="draft(this)"><i class="fa fa-remove"></i></a>
                                                            </span> -->
                                                            <span class="input-group-btn">
                                                                
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-group accordion" id="draft">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle" data-parent="#draft" aria-expanded="true"> Persetujuan </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse in" aria-expanded="true" style="">
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Mengetahui</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" name="mengetahui_nama" placeholder="Enter text">
                                                                <span class="help-block"> Nama </span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" name="mengetahui_sebagai" placeholder="Enter text">
                                                                <span class="help-block"> Sebagai </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Menyetujui</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" name="menyetujui_nama" placeholder="Enter text">
                                                                <span class="help-block"> Nama </span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" name="menyetujui_sebagai" placeholder="Enter text">
                                                                <span class="help-block"> Sebagai </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-group accordion" id="draft">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle" data-parent="#draft" aria-expanded="true"> Catatan Kaki </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse in" aria-expanded="true" style="">
                                                    <div class="panel-body">
                                                        <input type="text" name="catatan_kaki" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <a class="btn red" type="button" title="Export to Pdf" id="draft_export_pdf" target="_blank">Export to PDF <i class="fa fa-file-pdf-o"></i></a> -->
                                        <button class="btn red" type="submit" title="Export to Pdf" formtarget="_blank" name="submit" value="pdf">Export to PDF <i class="fa fa-file-pdf-o"></i></button>
                                        <!-- <button class="btn green-jungle" type="submit" title="Export to Excel" formtarget="_blank" name="submit" value="excel">Export to Excel <i class="fa fa-file-pdf-o"></i></button> -->
                                    </form>
                                    <!-- MODAL VALIDASI DRAFT -->
                                    <div class="modal fade " id="modal_draft" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog "> 
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 id="open" class="modal-title display-hide">Buka Draft</h4>
                                                    <h4 id="edit" class="modal-title display-hide">Edit Draft</h4>
                                                    <h4 id="delete" class="modal-title display-hide">Hapus Draft</h4>
                                                </div>
                                                <form id="form_draft" class="form-horizontal">
                                                    <div class="modal-body"> 
                                                        <!-- BEGIN FORM-->
                                                        <div class="form-body">
                                                            <div id="open" class="alert alert-info display-hide">
                                                                Anda yakin ingin membuka draft ini ? 
                                                            </div>
                                                            <div id="edit" class="alert alert-warning display-hide">
                                                                Anda yakin ingin mengubah nama draft ini ? 
                                                            </div>
                                                            <div id="edit" class="form-group display-hide">
                                                                <label class="control-label col-md-3">Nama
                                                                    <span class="required"> </span>
                                                                </label>
                                                                <div class="col-md-9">
                                                                    <input type="text" class="form-control" id="input_edit_draft" >
                                                                </div>
                                                            </div>
                                                            <div id="delete" class="alert alert-danger display-hide">
                                                                Anda yakin ingin menghapus draft ini ? 
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
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
<?=$footer?>

<script type="text/javascript">
    function draft(elm)
    {
        elm_id = elm.id.split('_');
        modal = $('#modal_'+elm_id[0]);

        $('#modal_'+elm_id[0]+' #'+elm_id[1]).show();
        modal.find('button[type="submit"]').text(elm_id[1].toUpperCase());
        modal.find('#draft').attr('name','draft_id').val(elm_id[1]+'_'+$('select[name="draft_jp"]').find(':selected').val());
        if (elm_id[1] == 'edit') {
            // console.log($('#'+elm.id).parents().find('select[name="draft_jp"]').text());
            modal.find('#input_edit_draft').attr('name','draft_nama').val($('select[name="draft_jp"]').find(':selected').data('text'));
        }

        modal.modal('show');

        $('#form_draft').validate({
            submitHandler: function (form) {
                $.ajax({
                    url: "<?=base_url()?>jadwal_perkuliahan/draft", 
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
    jQuery(document).ready(function(){
        var a_link = $('a#draft_export_pdf'); 
        var _href = a_link.attr('href');
        $('select[name="draft_jp"]').on('change', function(){
            // console.log(this.value)
            a_link.attr('href',_href + 'id='+this.value);
        })
        $('select[name="draft_jp"]').trigger('change');
    });
</script>