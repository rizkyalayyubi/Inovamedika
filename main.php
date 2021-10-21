<?php
if(isset($_SESSION['SES_ADMIN'])) {
?>


<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Home</h1>
</div>

<h4>Selamat datang di Klinik</h4></b><br/>


            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Pasien</div>
                                    <div>Pengelolaan Data</div>
                                </div>
                            </div>
                        </div>
                        <a href="?page=Pasien-Data">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Dokter</div>
                                    <div>Pengelolaan Data</div>
                                </div>
                            </div>
                        </div>
                        <a href="?page=Dokter-Data">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Obat</div>
                                    <div>Data Penjualan</div>
                                </div>
                            </div>
                        </div>
                        <a href="?page=Obat-Data">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Laporan</div>
                                    <div>Penjualan</div>
                                </div>
                            </div>
                        </div>
                        <a href="?page=Laporan">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				
				<section class="col-lg-6 connectedSortable">                            
                    <div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-book"></i>Grafik Laporan Pendaftaran Pasien</h3> 
						</div>
                    <div class="panel-body">
					<!-- <div class="table-responsive"> -->
					<div style="width: 450px;height: 200px">
						<canvas id="myChart"></canvas>
					</div>
					<?php
					$label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

					for($bulan = 1;$bulan < 13;$bulan++)
					{
						$mysql = "select count(*) as jumlah from pendaftaran where MONTH(tgl_daftar)='$bulan'";
						$query = mysql_query($mysql, $koneksidb) or die ("Query salah : ".mysql_error());
						$row = mysql_fetch_array($query);
						$jumlah_produk[] = $row['jumlah'];
					}
					?>
					<script>
						var ctx = document.getElementById("myChart").getContext('2d');
						var myChart = new Chart(ctx, {
							type: 'bar',
							data: {
								labels: <?php echo json_encode($label); ?>,
								datasets: [{
									label: 'Grafik Pendaftaran Pasien',
									data: <?php echo json_encode($jumlah_produk); ?>,
									borderWidth: 1
								}]
							},
							options: {
								scales: {
									yAxes: [{
										ticks: {
											beginAtZero:true
										}
									}]
								}
							}
						});
					</script>
					
					<!-- </div>-->
					<div class="text-right">
						<a href="?page=Laporan-Pendaftaran" class="btn btn-sm btn-primary">Menu Pendaftaran<i class="fa fa-arrow-circle-right"></i></a>
					</div>
					</div> 
					</div>
				</section><!-- /.Left col -->

            </div>
            <!-- /.row -->

	<?php
}
else if(isset($_SESSION['SES_KLINIK'])) {

?>


<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Home</h1>
</div>

<h4>Selamat datang di Klinik</h4></b><br/>


            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Pasien</div>
                                    <div>Tambah Data</div>
                                </div>
                            </div>
                        </div>
                        <a href="pendaftaran/">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Rawat</div>
                                    <div>Tambah Data</div>
                                </div>
                            </div>
                        </div>
                        <a href="rawat-pasien/">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

	<?php

}
else if(isset($_SESSION['SES_APOTEK'])) {
?>


<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Home</h1>
</div>

<h4>Selamat datang di Klinik</h4></b><br/>


            <!-- /.row -->
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Obat</div>
                                    <div>Data Penjualan</div>
                                </div>
                            </div>
                        </div>
                        <a href="penjualan/">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            <!-- /.row -->

	<?php
}
else {
	?>
	<br><br><br>
	<img src="./images/logo2.png" width="650px" style="setImageOpacity(3.3);">
	<br><br>
	<h2>Selamat datang di Klinik </h2>";
	<b>Anda belum login, silahkan <a href='?page=Login' alt='Login'>login </a>untuk mengakses sistem ini </b>
<?php
}
?>