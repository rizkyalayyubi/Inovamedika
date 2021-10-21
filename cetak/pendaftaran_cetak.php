<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

if($_GET) {
	# Baca variabel URL
	$Kode= isset($_GET['Kode']) ?  $_GET['Kode'] : ''; 
	
	# Membaca data dari tabel Pendaftaran
	$mySql = "SELECT pendaftaran.*, pasien.nm_pasien, tindakan.nm_tindakan 
				FROM pendaftaran 
				LEFT JOIN pasien ON pendaftaran.nomor_rm = pasien.nomor_rm
				LEFT JOIN tindakan ON pendaftaran.kd_tindakan = tindakan.kd_tindakan
				WHERE pendaftaran.no_daftar='$Kode'";
	$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
}
else {
	echo "Nomor Pendaftaran Tidak Terbaca";
	exit;
}
?>
<html>
<head>
<title>:: Cetak Antrian Pendaftaran | Klinik & Apotek Fitria</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2> ANTRIAN PENDAFTARAN </h2>
<table width="400" cellpadding="4" cellspacing="2" class="table-list">
	<tr>
	  <td width="35%"><strong>No Daftar </strong></td>
	  <td width="5%"><strong>:</strong></td>
	  <td width="60%"><?php echo $myData['no_daftar']; ?></td>
	</tr>
	<tr>
	  <td><strong>Nomor RM </strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo $myData['nomor_rm']; ?></td>
    </tr>
	<tr>
      <td><strong>Nama Pasien </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['nm_pasien']; ?></td>
  </tr>
	<tr>
	  <td><strong>Tgl.  Daftar </strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo IndonesiaTgl($myData['tgl_daftar']); ?></td>
    </tr>
	<tr>
	  <td><strong>Tgl.  &amp; Jam Janji </strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo IndonesiaTgl($myData['tgl_janji']);  ?>, 
	  	  <?php echo $myData['jam_janji']; ?></td>
    </tr>
	<tr>
	  <td><strong>Keluhan Pasien </strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo $myData['keluhan']; ?></td>
	</tr>
	<tr>
	  <td><strong>Tindakan Pasien </strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo $myData['nm_tindakan']; ?></td>
    </tr>
	<tr>
      <td><strong>Nomor Antrian </strong></td>
	  <td><strong>:</strong></td>
	  <td><h1><?php echo $myData['nomor_antri']; ?></h1></td>
    </tr>
</table>
</form>

