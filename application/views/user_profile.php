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
                                        <img src="../assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt=""> </div>
                                    <!-- END SIDEBAR USERPIC -->
                                    <!-- SIDEBAR USER TITLE -->
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name"> <?=$session_detail['nama']?> </div>
                                        <div class="profile-usertitle-job"> <?=$session_login['sebagai'] == 1 ? "Dosen" : "Mahasiswa"?> </div>
                                    </div>
                                    <!-- END SIDEBAR USER TITLE -->
                                    <!-- SIDEBAR BUTTONS -->
                                    <div class="profile-userbuttons">
                                        <!-- <button type="button" class="btn btn-circle green btn-sm">Follow</button> -->
                                        <!-- <button type="button" class="btn btn-circle red btn-sm">Message</button> -->
                                    </div>
                                    <!-- END SIDEBAR BUTTONS -->
                                    <!-- SIDEBAR MENU -->
                                    <div class="profile-usermenu">
                                        <ul class="nav">
                                            <li class="active">
                                                <a href="page_user_profile_1.html">
                                                    <i class="icon-home"></i> Overview </a>
                                            </li>
                                            <!-- <li class="active">
                                                <a href="page_user_profile_1_account.html">
                                                    <i class="icon-settings"></i> Account Settings </a>
                                            </li>
                                            <li>
                                                <a href="page_user_profile_1_help.html">
                                                    <i class="icon-info"></i> Help </a>
                                            </li> -->
                                        </ul>
                                    </div>
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
                                                        <form role="form" action="#">
                                                            <div class="form-group">
                                                                <label class="control-label">Nama</label>
                                                                <input type="text" placeholder="John" class="form-control" name="upd_nama" value="<?=$session_detail['nama']?>" /></div>
                                                            <div class="form-group">
                                                                <label class="control-label">Alamat</label>
                                                                <textarea class="form-control" name="upd_alamat"><?=$session_detail['alamat']?></textarea></div>
                                                            <div class="form-group">
                                                                <label class="control-label">Telepon</label>
                                                                <input type="text" placeholder="+1 646 580 DEMO (6284)" class="form-control" name="upd_telepon" value="<?=$session_detail['telepon']?>" /> </div>
                                                            <div class="margiv-top-10">
                                                                <a href="javascript:;" class="btn green"> Save Changes </a>
                                                                <a href="javascript:;" class="btn default"> Cancel </a>
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
                                                        <form action="#">
                                                            <div class="form-group">
                                                                <label class="control-label">Current Password</label>
                                                                <input type="password" class="form-control" /> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">New Password</label>
                                                                <input type="password" class="form-control" /> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Re-type New Password</label>
                                                                <input type="password" class="form-control" /> </div>
                                                            <div class="margin-top-10">
                                                                <a href="javascript:;" class="btn green"> Change Password </a>
                                                                <a href="javascript:;" class="btn default"> Cancel </a>
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
                