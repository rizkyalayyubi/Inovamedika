<?php
include_once "../library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pendaftaran";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?><table width="800" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td width="5" align="right">&nbsp;</td>
    <td colspan="2" align="left"><h1><b>DATA PENDAFTARAN </b></h1></td>
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
        <th width="28" align="center"><strong>No</strong></th>
        <th width="78"><strong>No. Daftar </strong></th>
        <th width="87"><strong>Tgl. Daftar </strong></th>
        <th width="87"><strong>Nomor RM </strong></th>
        <th width="174"><strong>Nama Pasien </strong></th>
        <th width="87"><strong>Tgl. Janji </strong></th>
        <th width="115"><strong>Jam. Janji </strong></th>
        <td colspan="3" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
      </tr>
      <?php
	$mySql = "SELECT pendaftaran.*, pasien.nm_pasien, tindakan.nm_tindakan 
				FROM pendaftaran 
				LEFT JOIN pasien ON pendaftaran.nomor_rm = pasien.nomor_rm
				LEFT JOIN tindakan ON pendaftaran.kd_tindakan = tindakan.kd_tindakan
				ORDER BY pendaftaran.no_daftar DESC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['no_daftar'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['no_daftar']; ?></td>
        <td><?php echo IndonesiaTgl($myData['tgl_daftar']); ?></td>
        <td><?php echo $myData['nomor_rm']; ?></td>
        <td><?php echo $myData['nm_pasien']; ?></td>
        <td><?php echo IndonesiaTgl($myData['tgl_janji']); ?></td>
        <td><?php echo $myData['jam_janji']; ?></td>
        <td width="41" align="center"><a href="../cetak/pendaftaran_cetak.php?Kode=<?php echo $Kode; ?>" target="_blank">Cetak</a></td>
        <td width="41" align="center"><a href="?page=Pendaftaran-Ubah&Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
        <td width="40" align="center"><a href="?page=Pendaftaran-Hapus&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENDAFTARAN INI ... ?')">Delete</a></td>
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
		echo " <a href='?page=Pendaftaran-Tampil&hal=$list[$h]'>$h</a> ";
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
					</br>
					</br>
					<!-- </div>-->
					<!--<div class="text-right">
						<a href="?page=Laporan-Pendaftaran" class="btn btn-sm btn-primary">Menu Pendaftaran<i class="fa fa-arrow-circle-right"></i></a>
					</div>-->
					</div> 
					</div>
				</section><!-- /.Left col -->
