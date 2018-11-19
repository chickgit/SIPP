        <!-- BEGIN CONTAINER -->
        <div class="container-fluid">
            <div class="page-content page-content-popup">
                <div class="page-content-fixed-header">
                    <!-- BEGIN BREADCRUMBS -->
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="#"><?=$title?></a>
                        </li>
                        <li><?=$session['Detail']['nama']?></li>
                    </ul>
                    <!-- END BREADCRUMBS -->
                </div>
                <?=$menu?>
                <div class="page-fixed-main-content">
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <!-- BEGIN DASHBOARD STATS 1-->
                    <?php
                    if ($session['Login']['sebagai'] == 0) {
                    ?>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                <div class="visual">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$count_dosen?>">0</span>
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
                                        <span data-counter="counterup" data-value="<?=$count_matakuliah?>">0</span>
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
                                        <span data-counter="counterup" data-value="<?=$count_ruangan?>">0</span>
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
                                        <span data-counter="counterup" data-value="<?=$count_waktu?>"></span></div>
                                    <div class="desc"> Waktu </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 dark" href="#">
                                <div class="visual">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$count_hari?>"></span></div>
                                    <div class="desc"> Hari </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                            <h3><b>PENGAMBILAN MATA KULIAH</b></h3>
                            <h3><?=$bta->tahun_ajaran?> - <?=$bta->semester?></h3>
                            <h5>Hingga</h5>
                            <h3 class="font-red"><?=date('d/M/Y',strtotime($bta->batas_akhir))?></h3>
                            <h3 class="font-red" id="batas_ambil_matkul"></h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php
                    if ($session['Login']['sebagai'] == 0) {
                    ?>
                    <div class="row">
                        <!-- BEGIN FORM-->
                        <form id="form_tambah_dosen" class="form-inline text-center" method="post" action="<?=base_url()?>home/update">
                            <div class="form-group">
                                <label class="sr-only" for="tahun-ajaran">Tahun Ajaran</label>
                                <?php echo form_dropdown('tahun_ajaran', $drop['ta']['opt'], $drop['ta']['slctd'], $drop['ta']['attr']); ?>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="semester">Semester</label>
                                <?php echo form_dropdown('semester', $drop['smstr']['opt'], $drop['smstr']['slctd'], $drop['smstr']['attr']); ?>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="date">Date</label>
                                <?php echo form_input($input['batas_akhir']); ?>
                            </div>
                            <!-- END FORM-->
                            <button type="submit" class="btn green">Ubah</button>
                        </form>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="clearfix"></div>
                </div>
<?php
    $baru = explode("-", $bta->batas_akhir);
    $date = "".(isset($baru[1])?$baru[1]:'')." ".(isset($baru[2])?$baru[2]:'').", ".(isset($baru[0])?$baru[0]:'')."";
?>
<script>
// Set the date we're counting down to
// var countDownDate = new Date("<?=$baru[1]?> <?=$baru[2]?>, <?=$baru[0]?>").getTime();
var countDownDate = new Date("<?=$date?>").getTime();

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
    document.getElementById("batas_ambil_matkul").innerHTML ="Sisa " + days + " Hari " + hours + " Jam "
    + minutes + " Menit " + seconds + " Detik ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("batas_ambil_matkul").innerHTML = "EXPIRED";
    }
}, 1000);
</script>