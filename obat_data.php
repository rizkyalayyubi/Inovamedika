<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.library.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM obat";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>

<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Data Obat</h1>
</div>
<!-- /.col-lg-12 -->
</div>

<table  class="table table-striped table-bordered table-hover" id="dataTables-example"  width="100%"cellspacing="1" cellpadding="3">
  <tr>
    <td width="401" colspan="2"><a href="?page=Obat-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
<div class="dataTable-wrapper">
<div class="table-responsive">
<table  class="table table-striped table-bordered table-hover" id="dataTables-example"  width="100%"cellspacing="1" cellpadding="3">
      <tr>
        <th width="23" align="center"><strong>No</strong></th>
        <th width="60"><strong>Kode</strong></th>
        <th width="242"><strong>Nama Obat</strong></th>
        <th width="48" align="center"><strong>Stok</strong></th>
        <th width="98" align="right"><strong>Harga (Rp)</strong></th>
        <th width="193"><strong>Keterangan</strong></th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
      </tr>
	<?php
	$mySql = "SELECT * FROM obat ORDER BY kd_obat ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_obat'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['kd_obat']; ?></td>
        <td><?php echo $myData['nm_obat']; ?></td>
        <td align="center"><?php echo $myData['stok']; ?></td>
        <td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
        <td><?php echo $myData['keterangan']; ?></td>
        <td width="45" align="center"><a href="?page=Obat-Edit&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
        <td width="44" align="center"><a href="?page=Obat-Delete&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA OBAT INI ... ?')">Delete</a></td>
      </tr>
      <?php } ?>
    </table>
</div></div>
    </td>
  </tr>
  <tr>
    <td><strong>Jumlah Data :</strong> <?php echo $jml; ?> </td>
    <td align="right">
	<strong>Halaman ke :</strong> 
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Obat-Data&hal=$list[$h]'>$h</a> ";
	}
	?>	</td>
  </tr>
</table>
