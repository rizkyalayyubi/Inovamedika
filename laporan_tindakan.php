<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Laporan Data Tindakan</h1>
</div>
<!-- /.col-lg-12 -->
</div>

<div class="dataTable-wrapper">
<div class="table-responsive">
  <table  class="table table-striped table-bordered table-hover" id="dataTables-example"  width="100%"cellspacing="1" cellpadding="3">
  <tr>
    <td width="25" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="547" bgcolor="#CCCCCC"><strong>Nama Tindakan </strong></td>
    <td width="112" align="right" bgcolor="#CCCCCC"><strong>Harga (Rp.) </strong></td>
  </tr>
  <?php
	  // Menampilkan daftar tindakan
	$mySql = "SELECT * FROM tindakan ORDER BY kd_tindakan ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
  ?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['nm_tindakan']; ?></td>
    <td align="right"><?php echo format_angka($myData['harga']); ?></td>
  </tr>
  <?php } ?>
</table>
</div></div>
