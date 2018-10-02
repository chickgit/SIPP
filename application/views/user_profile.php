<?=$header?>
        <!-- BEGIN CONTAINER -->
        <div class="container-fluid">
            <div class="page-content page-content-popup">
                <div class="page-content-fixed-header">
                    <!-- BEGIN BREADCRUMBS -->
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="#">Akun</a>
                        </li>
                        <li><?=$session_detail['nama']?></li>
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
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <?=$menu?>
                <div class="page-fixed-main-content">
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <!-- PORTLET MAIN -->
                                <div class="portlet light profile-sidebar-portlet bordered">
                                    <!-- SIDEBAR USERPIC -->
                                    <div class="profile-userpic">
                                        <img src="<?=$session_detail['gambar_ava'] == NULL ? base_url()."assets/pages/media/profile/profile_user.jpg" : $session_detail['gambar_ava']?>" class="img-responsive" alt=""> </div>
                                    <!-- END SIDEBAR USERPIC -->
                                    <!-- SIDEBAR USER TITLE -->
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name"> <?=$session_detail['nama']?> </div>
                                        <div class="profile-usertitle-job"> 
                                            <?php
                                            switch ($session_login['sebagai']) {
                                                case 0:
                                                    echo 'Kaprodi';
                                                    break;
                                                case 1:
                                                    echo 'Dosen';
                                                    break;
                                                case 2:
                                                    echo 'Mahasiswa';
                                                    break;
                                                default:
                                                    echo 'unknown';
                                                    break;
                                            }
                                            ?> 
                                        </div>
                                    </div>
                                    <!-- END SIDEBAR USER TITLE -->
                                    <!-- SIDEBAR BUTTONS -->
                                    <div class="profile-userbuttons">
                                        <!-- <button type="button" class="btn btn-circle green btn-sm">Follow</button> -->
                                        <!-- <button type="button" class="btn btn-circle red btn-sm">Message</button> -->
                                    </div>
                                    <!-- END SIDEBAR BUTTONS -->
                                    <!-- SIDEBAR MENU -->
                                    <!-- <div class="profile-usermenu">
                                        <ul class="nav">
                                            <li class="active">
                                                <a href="page_user_profile_1.html">
                                                    <i class="icon-home"></i> Overview </a>
                                            </li>
                                            <li class="active">
                                                <a href="page_user_profile_1_account.html">
                                                    <i class="icon-settings"></i> Account Settings </a>
                                            </li>
                                            <li>
                                                <a href="page_user_profile_1_help.html">
                                                    <i class="icon-info"></i> Help </a>
                                            </li>
                                        </ul>
                                    </div> -->
                                    <!-- END MENU -->
                                </div>
                                <!-- END PORTLET MAIN -->
                                <!-- PORTLET MAIN -->
                                
                                <!-- END PORTLET MAIN -->
                            </div>
                            <!-- END BEGIN PROFILE SIDEBAR -->
                            <!-- BEGIN PROFILE CONTENT -->
                            <div class="profile-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light bordered">
                                            <div class="portlet-title tabbable-line">
                                                <div class="caption caption-md">
                                                    <i class="icon-globe theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase">Akun Profil</span>
                                                </div>
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_2" data-toggle="tab">Ganti Avatar</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_3" data-toggle="tab">Ganti Password</a>
                                                    </li>
                                                    <!-- <li>
                                                        <a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>
                                                    </li> -->
                                                </ul>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="tab-content">
                                                    <!-- PERSONAL INFO TAB -->
                                                    <div class="tab-pane active" id="tab_1_1">
                                                        <form role="form" action="#" id="form_update_personal">
                                                            <div class="alert alert-danger display-hide alert-update-danger">
                                                                <button class="close" data-close="alert"></button> Anda memiliki beberapa bentuk kesalahan. Silakan cek di bawah ini. </div>
                                                            <div class="alert alert-success display-hide alert-update-success">
                                                                <button class="close" data-close="alert"></button> Data berhasil di simpan! </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Nama</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" placeholder="John" class="form-control" name="upd_nama" value="<?=$session_detail['nama']?>" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Alamat</label>
                                                                <div class="input-icon right">
                                                                    <textarea class="form-control" name="upd_alamat"><?=$session_detail['alamat']?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Telepon</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" placeholder="+1 646 580 DEMO (6284)" class="form-control" name="upd_telepon" value="<?=$session_detail['telepon']?>" /> 
                                                                </div>
                                                            </div>
                                                            <div class="margiv-top-10">
                                                                <?php //print_r($session_detail)?>
                                                                <input type="hidden" name="id" value="<?=($session_login['sebagai'] == 2) ? 'nim' : 'nid'?>">
                                                                <input type="hidden" name="table" value="<?=($session_login['sebagai'] == 2) ? 'mahasiswa' : 'dosen'?>">
                                                                <input type="hidden" name="upd_id" value="<?=($session_login['sebagai'] == 2) ? $session_detail['nim'] : $session_detail['nid']?>">
                                                                <button class="btn green" type="submit"> Save Changes </button>
                                                                <button class="btn default" type="reset" id="cancel_personal"> Cancel </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END PERSONAL INFO TAB -->
                                                    <!-- CHANGE AVATAR TAB -->
                                                    <div class="tab-pane" id="tab_1_2">
                                                        <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                            eiusmod. </p>
                                                        <form action="#" role="form">
                                                            <div class="form-group">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                    <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"> Select image </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input type="file" name="..."> </span>
                                                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix margin-top-10">
                                                                    <span class="label label-danger">NOTE! </span>
                                                                    <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                                                </div>
                                                            </div>
                                                            <div class="margin-top-10">
                                                                <a href="javascript:;" class="btn green"> Submit </a>
                                                                <a href="javascript:;" class="btn default"> Cancel </a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END CHANGE AVATAR TAB -->
                                                    <!-- CHANGE PASSWORD TAB -->
                                                    <div class="tab-pane" id="tab_1_3">
                                                        <form action="#" id="form_update_password">
                                                            <div class="alert alert-danger display-hide alert-update-password-danger">
                                                                <button class="close" data-close="alert"></button> Anda memiliki beberapa bentuk kesalahan. Silakan cek di bawah ini. </div>
                                                            <div class="alert alert-success display-hide alert-update-password-success">
                                                                <button class="close" data-close="alert"></button> Data berhasil di simpan! </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Current Password</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="password" class="form-control" name="upd_old_password" /> </div>
                                                                </div>
                                                            <div class="form-group">
                                                                <label class="control-label">New Password</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="password" class="form-control" name="upd_new_password" id="upd_new_password" /> </div>
                                                                </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Re-type New Password</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="password" class="form-control" name="upd_new_password_conf" /> </div>
                                                                </div>
                                                            <div class="margin-top-10">
                                                                <input type="hidden" name="id" value="<?=($session_login['sebagai'] == 1) ? 'nid' : 'nim'?>">
                                                                <input type="hidden" name="table" value="<?=($session_login['sebagai'] == 1) ? 'dosen' : 'mahasiswa'?>">
                                                                <input type="hidden" name="upd_id" value="<?=$session_login['id']?>">
                                                                <button class="btn green" type="submit"> Change Password </button>
                                                                <button class="btn default" type="reset"> Cancel </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END CHANGE PASSWORD TAB -->
                                                    <!-- PRIVACY SETTINGS TAB -->
                                                    <div class="tab-pane" id="tab_1_4">
                                                        <form action="#">
                                                            <table class="table table-light table-hover">
                                                                <tr>
                                                                    <td> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus.. </td>
                                                                    <td>
                                                                        <div class="mt-radio-inline">
                                                                            <label class="mt-radio">
                                                                                <input type="radio" name="optionsRadios1" value="option1" /> Yes
                                                                                <span></span>
                                                                            </label>
                                                                            <label class="mt-radio">
                                                                                <input type="radio" name="optionsRadios1" value="option2" checked/> No
                                                                                <span></span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                                    <td>
                                                                        <div class="mt-radio-inline">
                                                                            <label class="mt-radio">
                                                                                <input type="radio" name="optionsRadios11" value="option1" /> Yes
                                                                                <span></span>
                                                                            </label>
                                                                            <label class="mt-radio">
                                                                                <input type="radio" name="optionsRadios11" value="option2" checked/> No
                                                                                <span></span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                                    <td>
                                                                        <div class="mt-radio-inline">
                                                                            <label class="mt-radio">
                                                                                <input type="radio" name="optionsRadios21" value="option1" /> Yes
                                                                                <span></span>
                                                                            </label>
                                                                            <label class="mt-radio">
                                                                                <input type="radio" name="optionsRadios21" value="option2" checked/> No
                                                                                <span></span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                                    <td>
                                                                        <div class="mt-radio-inline">
                                                                            <label class="mt-radio">
                                                                                <input type="radio" name="optionsRadios31" value="option1" /> Yes
                                                                                <span></span>
                                                                            </label>
                                                                            <label class="mt-radio">
                                                                                <input type="radio" name="optionsRadios31" value="option2" checked/> No
                                                                                <span></span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <!--end profile-settings-->
                                                            <div class="margin-top-10">
                                                                <a href="javascript:;" class="btn red"> Save Changes </a>
                                                                <a href="javascript:;" class="btn default"> Cancel </a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END PRIVACY SETTINGS TAB -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PROFILE CONTENT -->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
<?=$footer?>
<script src="<?=base_url()?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
    var form_personal = $('#form_update_personal');
    var error_personal = $('.alert-update-danger', form_personal);
    var success_personal = $('.alert-update-success', form_personal);
    form_personal.validate({
        debug: true,
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",  // validate all fields including form hidden input
        rules: {
            upd_nama: {
                required    : true,
                maxlength   : 50
            },
            upd_alamat: {
                required    : true,
                maxlength   : 200
            },
            upd_telepon: {
                required    : true,
                digits      : true,
                maxlength   : 15
            },
        },
        messages: {
            upd_nama: {
                required    : "Nama harus di isi",
                maxlength   : "Maksimal 50 karakter"
            },
            upd_alamat: {
                required    : "Alamat harus di isi",
                maxlength   : "Maksimal 200 karakter"
            },
            upd_telepon: {
                required    : "Nomor telepon harus di isi",
                digits      : "Hanya angka yang dibolehkan",
                maxlength   : "Maksimal 15 digit"
            },
        },

        invalidHandler: function (event, validator) { //display error alert on form submit              
            success_personal.hide();
            error_personal.show();
            App.scrollTo(error_personal, -200);
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
            error_personal.hide();
            // console.log($(form).serialize());
            $.ajax({
                url: "<?=base_url()?>user/update_personal", 
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
                    success_personal.show();
                    // location.reload();
                    // $('#modal-small').modal('show');
                    console.log(data);
                },
                complete: function(){
                    App.unblockUI();
                }
            });
            return false;
            // success_personal.show();
            // error_personal.hide();
            //form.submit(); // submit the form
        }
    });
    // $('#cancel_personal').on('click', function(e){
    //     e.preventDefault();
    //     form_personal.resetForm();
    //     // $('form').get(0).reset();
    // })

    var form_password = $('#form_update_password');
    var error_password = $('.alert-update-password-danger', form_password);
    var success_password = $('.alert-update-password-success', form_password);
    form_password.validate({
        debug: true,
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",  // validate all fields including form hidden input
        rules: {
            upd_old_password: {
                required    : true,
            },
            upd_new_password: {
                required    : true,
            },
            upd_new_password_conf: {
                equalTo     : '#upd_new_password'
            },
        },
        messages: {
            upd_old_password: {
                required    : "Password harus di isi",
            },
            upd_new_password: {
                required    : "Password baru harus di isi",
            },
            upd_new_password_conf: {
                equalTo     : "Harus sesuai dengan password baru"
            },
        },

        invalidHandler: function (event, validator) { //display error alert on form submit              
            success_password.hide();
            error_password.show();
            App.scrollTo(error_password, -200);
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
            error_password.hide();
            // console.log($(form).serialize());
            $.ajax({
                url: "<?=base_url()?>user/update_password", 
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
                    if (data == 'OK') {
                        success_password.show();
                        error_password.hide();
                    }else{
                        success_password.hide();
                        error_password.show();
                        alert(data);
                    }
                    // location.reload();
                    // $('#modal-small').modal('show');
                    console.log(data);
                },
                complete: function(){
                    App.unblockUI();
                }
            });
            return false;
            // success_password.show();
            // error_password.hide();
            //form.submit(); // submit the form
        }
    });                
});
</script>