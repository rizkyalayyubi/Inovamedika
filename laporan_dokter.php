
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Laporan Data Dokter</h1>
</div>
<!-- /.col-lg-12 -->
</div>

<div class="dataTable-wrapper">
<div class="table-responsive">
  <table  class="table table-striped table-bordered table-hover" id="dataTables-example"  width="100%"cellspacing="1" cellpadding="3">
  <tr>
    <td width="24" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="60" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="150" bgcolor="#CCCCCC"><strong>Nama Dokter </strong></td>
    <td width="93" bgcolor="#CCCCCC"><strong>Spesialis</strong></td>
    <td width="186" bgcolor="#CCCCCC"><strong>Tempat, Tgl Lahir </strong></td>
    <td width="209" bgcolor="#CCCCCC"><strong>Alamat</strong></td>
    <td width="42" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
<?php
$mySql = "SELECT * FROM dokter ORDER BY kd_dokter ASC";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$nomor = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['kd_dokter']; ?></td>
    <td><?php echo $myData['nm_dokter']; ?></td>
    <td><?php echo $myData['spesialisasi']; ?></td>
    <td><?php echo $myData['tempat_lahir']; ?>, 
		<?php echo IndonesiaTgl($myData['tanggal_lahir']); ?></td>
    <td><?php echo $myData['alamat']; ?></td>
    <td align="center"><a href="cetak/dokter_cetak.php?Kode=<?php echo $myData['kd_dokter']; ?>" target="_blank">Cetak</a></td>
  </tr>
  <?php } ?>
</table>
</div></div>