<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pendaftaran";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Laporan Pendaftaran Pasien</h1>
</div>
<!-- /.col-lg-12 -->
</div>

<div class="dataTable-wrapper">
<div class="table-responsive">
  <table  class="table table-striped table-bordered table-hover" id="dataTables-example"  width="100%"cellspacing="1" cellpadding="3">
  
  <tr>
    <td width="23" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="67" bgcolor="#CCCCCC"><strong>No. Daftar </strong></td>
    <td width="75" bgcolor="#CCCCCC"><strong>Tgl. Daftar </strong></td>
    <td width="75" bgcolor="#CCCCCC"><strong>Nomor RM </strong></td>
    <td width="150" bgcolor="#CCCCCC"><strong>Nama Pasien  </strong></td>
    <td width="75" bgcolor="#CCCCCC"><strong>Tgl. Janji </strong></td>
    <td width="70" bgcolor="#CCCCCC"><strong>Jam. Janji </strong></td>
    <td width="182" bgcolor="#CCCCCC"><strong>Tindakan</strong></td>
    <td width="37" align="center" bgcolor="#CCCCCC"><strong>Antri</strong></td>
  </tr>
  <?php
	# Perintah untuk menampilkan Semua Daftar Transaksi pendaftaran
	$mySql = "SELECT pendaftaran.*, pasien.nm_pasien, tindakan.nm_tindakan 
				FROM pendaftaran 
				LEFT JOIN pasien ON pendaftaran.nomor_rm = pasien.nomor_rm
				LEFT JOIN tindakan ON pendaftaran.kd_tindakan = tindakan.kd_tindakan
				ORDER BY pendaftaran.no_daftar ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;		
		
	# Membaca Kode pendaftaran/ Nomor transaksi
	$noDaftar = $myData['no_daftar']; 
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['no_daftar']; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_daftar']); ?></td>
    <td><?php echo $myData['nomor_rm']; ?></td>
    <td><?php echo $myData['nm_pasien']; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_janji']); ?></td>
    <td><?php echo $myData['jam_janji']; ?></td>
    <td><?php echo $myData['nm_tindakan']; ?></td>
    <td align="center"><?php echo $myData['nomor_antri']; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3"><strong>Jumlah Data :</strong><?php echo $jml; ?></td>
    <td colspan="6" align="right"><strong>Halaman ke :</strong>
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Laporan-Pendaftaran&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
</div></div>