<?php
include_once "../library/inc.seslogin.php";

// Membaca variabel form
$KeyWord	= isset($_GET['KeyWord']) ? $_GET['KeyWord'] : '';
$dataCari	= isset($_POST['txtCari']) ? $_POST['txtCari'] : $KeyWord;

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
		$filterSql = "WHERE nm_pasien LIKE '%$dataCari%'";
	}
}
else {
	if($KeyWord){
		$filterSql = "WHERE nm_pasien LIKE '%$dataCari%'";
	}
	else {
		$filterSql = "";
	}
} 

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pasien $filterSql";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<h2>Cari Pasien</h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
  <b>Cari Nama Pasien :
  <input name="txtCari" type="text" value="<?php echo $dataCari; ?>" size="40" maxlength="100" />
  <input name="btnCari" type="submit" value="Cari" />
  </b>
</form>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <th width="20">No</th>
    <th width="82"><strong>Nomor RM </strong></th>
    <th width="147"><strong>Nama Pasien </strong></th>
    <th width="59"><strong>Kelamin</strong></th>
    <th width="80"><strong>Gol. Darah </strong></th>
    <th width="238"><strong>Alamat</strong></th>
    <td align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
  <?php
	$mySql = "SELECT * FROM pasien $filterSql ORDER BY nomor_rm ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['nomor_rm']; ?></td>
    <td><?php echo $myData['nm_pasien']; ?></td>
    <td><?php echo $myData['jns_kelamin']; ?></td>
    <td><?php echo $myData['gol_darah']; ?></td>
    <td><?php echo $myData['alamat']; ?></td>
    <td width="38" align="center"><a href="?page=Pendaftaran-Baru&amp;NomorRM=<?php echo $myData['nomor_rm']; ?>" target="_self" alt="Daftar">Daftar</a></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3"><strong>Jumlah Data :</strong> <?php echo $jml; ?> </td>
    <td colspan="4" align="right"><strong>Halaman ke :</strong>
    <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Pencarian-Pasien&hal=$list[$h]&KeyWord=$dataCari'>$h</a> ";
	}
	?></td>
  </tr>
</table>
