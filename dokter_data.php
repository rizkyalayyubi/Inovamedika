<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM dokter";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>


<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Data Dokter</h1>
</div>
<!-- /.col-lg-12 -->
</div>


<table  class="table table-striped table-bordered table-hover" id="dataTables-example"  width="100%"cellspacing="1" cellpadding="3">
  <tr>
    <td colspan="2"><a href="?page=Dokter-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a></td>
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
        <th width="24" align="center"><strong>No</strong></th>
        <th width="189"><strong>Nama Dokter </strong></th>
        <th width="110"><strong>Spesialis</strong></th>
        <th width="115"><strong>No. Telepon </strong></th>
        <th width="215"><strong>Alamat </strong></th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
      </tr>
      <?php
	$mySql = "SELECT * FROM dokter ORDER BY kd_dokter ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_dokter'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['nm_dokter']; ?></td>
        <td><?php echo $myData['spesialisasi']; ?></td>
        <td><?php echo $myData['no_telepon']; ?></td>
        <td><?php echo $myData['alamat']; ?></td>
        <td width="45" align="center"><a href="?page=Dokter-Edit&Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
        <td width="50" align="center"><a href="?page=Dokter-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA DOKTER INI ... ?')">Delete</a></td>
      </tr>
      <?php } ?>
    </table>
</div></div>
    </td>
  </tr>
  <tr class="selKecil">
    <td width="306"><strong>Jumlah Data :</strong> <?php echo $jml; ?></td>
    <td width="483" align="right"><strong>Halaman ke :</strong>
      <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Dokter-Data&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
