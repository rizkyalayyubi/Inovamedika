<?php
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pasien";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
		// Cari berdasarkan Nomor RM dan Nama Pasien yang mirip
		$txtKataKunci	= $_POST['txtKataKunci'];
		$mySql = "SELECT * FROM pasien WHERE nomor_rm='$txtKataKunci' OR nm_pasien LIKE '%$txtKataKunci%' 
				  ORDER BY nomor_rm ASC LIMIT $hal, $row";
	}
}
else {
	$mySql = "SELECT * FROM pasien ORDER BY nomor_rm ASC LIMIT $hal, $row";
} 

// Membaca variabel form
$dataKataKunci	= isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';
?>

<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Laporan Data Pasien</h1>
</div>
<!-- /.col-lg-12 -->
</div>


<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
<div class="dataTable-wrapper">
<div class="table-responsive">
  <table  class="table table-striped table-bordered table-hover" id="dataTables-example"  width="100%"cellspacing="1" cellpadding="3">
    <tr>
      <th colspan="3"><strong>CARI PASIEN </strong></th>
    </tr>
    <tr>
      <td width="139"><strong>Nomor RM / Nama </strong></td>
      <td width="1"><strong>:</strong></td>
      <td width="332"><b>
        <input name="txtKataKunci" type="text" value="<?php echo $dataKataKunci; ?>" size="40" maxlength="100" />
      </b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><b>
        <input name="btnCari" type="submit" value="Cari" />
      </b></td>
    </tr>
  </table>
  </div></div>
</form>
<div class="dataTable-wrapper">
<div class="table-responsive">
  <table  class="table table-striped table-bordered table-hover" id="dataTables-example"  width="100%"cellspacing="1" cellpadding="3">
  <tr>
    <td width="22" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="66" bgcolor="#CCCCCC"><strong>No. RM </strong></td>
    <td width="146" bgcolor="#CCCCCC"><strong>Nama Pasien </strong></td>
    <td width="120" bgcolor="#CCCCCC"><strong>No. Identitas </strong></td>
    <td width="94" bgcolor="#CCCCCC"><strong>Kelamin</strong></td>
    <td width="70" bgcolor="#CCCCCC"><strong>G Darah </strong></td>
    <td width="206" bgcolor="#CCCCCC"><strong>Tempat, Tgl Lahir </strong></td>
    <td width="35" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
  <?php
	// Query SQL ada di bagian atas, kolom tombol Cari (btnCari)
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['nomor_rm']; ?></td>
    <td><?php echo $myData['nm_pasien']; ?></td>
    <td><?php echo $myData['no_identitas']; ?></td>
    <td><?php echo $myData['jns_kelamin']; ?></td>
    <td><?php echo $myData['gol_darah']; ?></td>
    <td><?php echo $myData['tempat_lahir']; ?>, 
    <?php echo IndonesiaTgl($myData['tanggal_lahir']); ?></td>
    <td><a href="cetak/pasien_cetak.php?NomorRM=<?php echo $myData['nomor_rm']; ?>" target="_blank">Cetak</a></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3"><strong>Jumlah Data :</strong> <?php echo $jml; ?> </td>
    <td colspan="5" align="right"><strong>Halaman ke :</strong>
      <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Laporan-Pasien&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
</div></div>