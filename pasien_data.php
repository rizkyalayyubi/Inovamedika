<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pasien";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>

  <div class="row">
  <div class="col-lg-12">
  <h1 class="page-header">Data Pasien</h1>
  </div>
  <!-- /.col-lg-12 -->
  </div>

  <table  class="table table-striped table-bordered table-hover" id="dataTables-example"  width="100%"cellspacing="1" cellpadding="3">
  <tr>
    <td colspan="2"><a href="?page=Pasien-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a></td>
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
        <th width="25" align="center"><strong>No</strong></th>
        <th width="70"><strong>No RM</strong></th>
        <th width="200"><strong>Nama Pasien </strong></th>
        <th width="95"><strong>Kelamin</strong></th>
        <th width="280"><strong>Alamat</strong></th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
      </tr>
      <?php
	$mySql = "SELECT * FROM pasien ORDER BY nomor_rm ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['nomor_rm'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['nomor_rm']; ?></td>
        <td><?php echo $myData['nm_pasien']; ?></td>
        <td><?php echo $myData['jns_kelamin']; ?></td>
        <td><?php echo $myData['alamat']; ?></td>
        <td width="40" align="center"><a href="?page=Pasien-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
        <td width="48" align="center"><a href="?page=Pasien-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PASIEN INI ... ?')">Delete</a></td>
      </tr>
      <?php } ?>
    </table>
    </div></div></td>
  </tr>
  <tr>
    <td width="418"><strong>Jumlah Data :</strong> <?php echo $jml; ?> </td>
    <td width="371" align="right"><strong>Halaman ke :</strong> 
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Pasien-Data&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
