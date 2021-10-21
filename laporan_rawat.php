<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM rawat";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>


<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Laporan Rawat Pasien</h1>
</div>
<!-- /.col-lg-12 -->
</div>

<div class="dataTable-wrapper">
<div class="table-responsive">
  <table  class="table table-striped table-bordered table-hover" id="dataTables-example"  width="100%"cellspacing="1" cellpadding="3">
  
  <tr>
    <td width="25" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="74" bgcolor="#CCCCCC"><strong>No. Rawat </strong></td>
    <td width="83" bgcolor="#CCCCCC"><strong>Tgl. Rawat </strong></td>
    <td width="83" bgcolor="#CCCCCC"><strong>Nomor RM </strong></td>
    <td width="166" bgcolor="#CCCCCC"><strong>Nama Pasien  </strong></td>
    <td width="85" align="right" bgcolor="#CCCCCC"><strong> Bayar (Rp) </strong></td>
    <td width="204" bgcolor="#CCCCCC"><strong>Hasil Diagnosa </strong></td>
    <td width="39" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
  <?php
	# Perintah untuk menampilkan Semua Daftar Transaksi rawat
	$mySql = "SELECT rawat.*, pasien.nm_pasien FROM rawat 
				LEFT JOIN pasien ON rawat.nomor_rm = pasien.nomor_rm
				ORDER BY rawat.no_rawat ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;		
		
	# Membaca Nomor Rawat
	$noRawat = $myData['no_rawat']; 
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['no_rawat']; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_rawat']); ?></td>
    <td><?php echo $myData['nomor_rm']; ?></td>
    <td><?php echo $myData['nm_pasien']; ?></td>
    <td align="right"><?php echo format_angka($myData['uang_bayar']); ?></td>
    <td><?php echo $myData['hasil_diagnosa']; ?></td>
    <td align="center"><a href="cetak/rawat_cetak.php?noRawat=<?php echo $noRawat; ?>" target="_blank">Cetak</a></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3"><strong>Jumlah Data :</strong><?php echo $jml; ?></td>
    <td colspan="5" align="right"><strong>Halaman ke :</strong>
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Laporan-Rawat&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
</div></div>