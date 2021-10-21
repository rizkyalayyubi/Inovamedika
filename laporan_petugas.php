<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Laporan Data Petugas</h1>
</div>
<!-- /.col-lg-12 -->
</div>

<div class="dataTable-wrapper">
<div class="table-responsive">
  <table  class="table table-striped table-bordered table-hover" id="dataTables-example"  width="100%"cellspacing="1" cellpadding="3">
  <tr>
    <td width="25" align="center" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="50" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="242" bgcolor="#CCCCCC"><b>Nama Petugas </b></td>
    <td width="94" bgcolor="#CCCCCC"><b>No Telepon </b></td>
    <td width="97" bgcolor="#CCCCCC"><b>Username</b></td>
    <td width="61" bgcolor="#CCCCCC"><b>Level</b></td>
  </tr>
  <?php
	$mySql 	= "SELECT * FROM petugas ORDER BY kd_petugas";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td> <?php echo $nomor; ?> </td>
    <td><?php echo $myData['kd_petugas']; ?></td>
    <td> <?php echo $myData['nm_petugas']; ?> </td>
    <td> <?php echo $myData['no_telepon']; ?> </td>
    <td> <?php echo $myData['username']; ?> </td>
    <td> <?php echo $myData['level']; ?> </td>
  </tr>
  <?php } ?>
</table>
</div></div>