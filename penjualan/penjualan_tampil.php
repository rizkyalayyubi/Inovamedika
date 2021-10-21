<?php
include_once "../library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM penjualan";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?><table width="800" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td width="5" align="right">&nbsp;</td>
    <td colspan="2" align="left"><h1><b>DATA PENJUALAN OBAT</b></h1></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="24" align="center"><strong>No</strong></th>
        <th width="85"><strong>No. Nota </strong></th>
        <th width="86"><strong>Tgl. Nota </strong></th>
        <th width="144"><strong>Pelanggan </strong></th>
        <th width="193"><strong>Keterangan</strong></th>
        <th width="123"><strong>Petugas</strong></th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
      </tr>
      <?php
	$mySql = "SELECT penjualan.*, petugas.nm_petugas
				FROM penjualan 
				LEFT JOIN petugas ON penjualan.kd_petugas = petugas.kd_petugas
				ORDER BY penjualan.no_penjualan DESC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['no_penjualan'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['no_penjualan']; ?></td>
        <td><?php echo IndonesiaTgl($myData['tgl_penjualan']); ?></td>
        <td><?php echo $myData['pelanggan']; ?></td>
        <td><?php echo $myData['keterangan']; ?></td>
        <td><?php echo $myData['nm_petugas']; ?></td>
        <td width="44" align="center"><a href="penjualan_nota.php?noNota=<?php echo $Kode; ?>" target="_blank">Nota</a></td>
        <td width="44" align="center"><a href="?page=Penjualan-Hapus&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENJUALAN INI ... ?')">Delete</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td>&nbsp;</td>
    <td width="299"><b>Jumlah Data :</b></td>
    <td width="480" align="right"><b>Halaman ke :</b>
      <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Penjualan-Tampil&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>

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
