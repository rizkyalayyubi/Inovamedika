<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM tindakan";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>


<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Data Tindakan</h1>
</div>
<!-- /.col-lg-12 -->
</div>


<table class="table table-striped table-bordered table-hover" id="dataTables-example"  width="100%"cellspacing="1" cellpadding="3">
  <tr>
    <td colspan="2"><a href="?page=Tindakan-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0"  /></a></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
<div class="dataTable-wrapper">
<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover" id="dataTables-example"  width="100%"cellspacing="1" cellpadding="3">
      <thead>
      <tr>
        <th width="4%"><strong>No</strong></th>
        <th width="67%"><strong>Nama Tindakan </strong></th>
        <th width="15%" align="right"><strong>Harga (Rp.) </strong></th>
        <th colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></th>
        </tr>
        </thead>
      <?php
	  // Menampilkan daftar tindakan
	$mySql = "SELECT * FROM tindakan ORDER BY kd_tindakan ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_tindakan'];
	?>
  <tbody>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['nm_tindakan']; ?></td>
        <td align="right"><?php echo format_angka($myData['harga']); ?></td>
        <td width="7%" align="center"><a href="?page=Tindakan-Edit&Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
        <td width="7%" align="center"><a href="?page=Tindakan-Delete&Kode=<?php echo $Kode; ?>" target="_self"  onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA TINDAKAN KLINIK INI ... ?')">Delete</a></td>
      </tr>
  </tbody>
	<?php } ?>
    </table>

</div></div>
    </td>
  </tr>
  <tr>
    <td width="350"><strong>Jumlah Data :</strong> <?php echo $jml; ?> </td>
    <td width="339" align="right"><strong>Halaman ke :</strong> 
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Tindakan-Data&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
