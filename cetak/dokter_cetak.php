<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

if($_GET) {
	# Baca variabel URL
	$Kode= isset($_GET['Kode']) ?  $_GET['Kode'] : ''; 
	
	# Perintah untuk mendapatkan data dari tabel pembelian
	$mySql	= "SELECT * FROM dokter WHERE kd_dokter='$Kode'";
	$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
}
else {
	echo "Nomor Dokter Tidak Terbaca";
	exit;
}
?>
<html>
<head>
<title>:: Cetak Data Dokter | Klinik & Apotek Fitria</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2> CETAK DATA DOKTER  </h2>
<table width="100%" cellpadding="4" cellspacing="2" class="table-list">
	<tr>
	  <td width="15%"><strong>Kode</strong></td>
	  <td width="1%"><strong>:</strong></td>
	  <td width="84%"><?php echo $myData['kd_dokter']; ?></td>
	</tr>
	<tr>
      <td><strong>Nama Dokter </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['nm_dokter']; ?></td>
    </tr>
	<tr>
      <td><strong>Jenis Kelamin </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['jns_kelamin']; ?></td>
    </tr>
	<tr>
      <td><strong>Tempat, Tgl. Lahir </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['tempat_lahir'];  ?>, 
	  	  <?php echo IndonesiaTgl($myData['tanggal_lahir']); ?></td>
    </tr>
	<tr>
      <td><strong>Alamat Tinggal </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['alamat']; ?></td>
	</tr>
	<tr>
      <td><strong>No. Telepon </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['no_telepon']; ?></td>
    </tr>
	<tr>
      <td><strong>Nomor SIP</strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['sip']; ?></td>
    </tr>
	<tr>
      <td><strong>Spesialis</strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['spesialisasi']; ?></td>
    </tr>
	<tr>
      <td><strong>Bagi Hasil</strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['bagi_hasil']; ?> %</td>
    </tr>
</table>
</form>

