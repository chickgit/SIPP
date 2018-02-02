        <!-- BEGIN CONTAINER -->
        <div class="container-fluid">
            <div class="page-content page-content-popup">
                <div class="page-content-fixed-header">
                    <!-- BEGIN BREADCRUMBS -->
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><?=$session['nama']?></li>
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
                    <!-- BEGIN DASHBOARD STATS 1-->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                <div class="visual">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=count($count_dosen)?>">0</span>
                                    </div>
                                    <div class="desc"> Dosen </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                <div class="visual">
                                    <i class="fa fa-book"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=count($count_matakuliah)?>">0</span>
                                    </div>
                                    <div class="desc"> Mata Kuliah </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                <div class="visual">
                                    <i class="fa fa-group"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=count($count_ruangan)?>">0</span>
                                    </div>
                                    <div class="desc"> Ruangan </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                                <div class="visual">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=count($count_dosen)?>"></span></div>
                                    <div class="desc"> Waktu </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                                <div class="visual">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=count($count_hari)?>"></span></div>
                                    <div class="desc"> Hari </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                            <h3><b>PENGAMBILAN MATA KULIAH</b></h3>
                            <h3><?=$bta->tahun_ajaran?> - <?=$bta->semester?></h3>
                            <h3 id="batas_ambil_matkul"></h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <!-- BEGIN FORM-->
                        <form id="form_tambah_dosen" class="form-inline text-center" method="post" action="<?=base_url()?>home/update">
                            <div class="form-group">
                                <label class="sr-only" for="tahun-ajar">Tahun Ajaran</label>
                                <input type="text" class="form-control" id="tahun-ajar" name="tahun_ajar" value="<?=$bta->tahun_ajaran?>"> 
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="semester">Semester</label>
                                <select name="semester" class="form-control" id="semester">
                                    <option value="GANJIL" <?=($bta->semester == 'GANJIL') ? 'selected' : '';?>>GANJIL</option>
                                    <option value="GENAP" <?=($bta->semester == 'GENAP') ? 'selected' : '';?>>GENAP</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date" value="<?=$bta->batas_akhir?>"> 
                            </div>
                            <!-- END FORM-->
                            <button type="submit" class="btn green">Ubah</button>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
<?php
    $baru = explode("-", $bta->batas_akhir);
?>
<script>
// Set the date we're counting down to
var countDownDate = new Date("<?=$baru[1]?> <?=$baru[2]?>, <?=$baru[0]?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {
    // console.log(countDownDate);
    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("batas_ambil_matkul").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("batas_ambil_matkul").innerHTML = "EXPIRED";
    }
}, 1000);
</script>