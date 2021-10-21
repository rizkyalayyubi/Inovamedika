<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

if($_GET) {
	// Baca variabel URL
	$NomorRM= isset($_GET['NomorRM']) ?  $_GET['NomorRM'] : ''; 
	
	// Perintah membaca data Pasien
	$mySql	= "SELECT * FROM pasien WHERE nomor_rm='$NomorRM'";
	$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
}
else {
	echo "Nomor Rekam Medik(RM) Tidak Terbaca";
	exit;
}
?>
<html>
<head>
<title>:: Cetak Data Pasien | Klinik & Apotek Fitria</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2> CETAK DATA PASIEN  </h2>
<table width="100%" cellpadding="4" cellspacing="2" class="table-list">
	<tr>
	  <td width="15%"><strong>Nomor RM </strong></td>
	  <td width="1%"><strong>:</strong></td>
	  <td width="84%"><?php echo $myData['nomor_rm']; ?></td>
	</tr>
	<tr>
      <td><strong>Nama Pasien </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['nm_pasien']; ?></td>
    </tr>
	<tr>
      <td><strong>No. Identitas (KTP/SIM) </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['no_identitas']; ?></td>
    </tr>
	<tr>
      <td><b>Jenis Kelamin </b></td>
	  <td><b>:</b></td>
	  <td><?php echo $myData['jns_kelamin']; ?></td>
    </tr>
	<tr>
      <td><b>Gol. Darah </b></td>
	  <td><b>:</b></td>
	  <td><?php echo $myData['gol_darah']; ?></td>
    </tr>
	<tr>
      <td><b>Agama</b></td>
	  <td><b>:</b></td>
	  <td><?php echo $myData['agama']; ?></td>
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
      <td><b>Status Nikah </b></td>
	  <td><b>:</b></td>
	  <td><?php echo $myData['stts_nikah']; ?></td>
    </tr>
	<tr>
      <td><b>Pekerjaan</b></td>
	  <td><b>:</b></td>
	  <td><?php echo $myData['pekerjaan']; ?></td>
    </tr>
	<tr>
      <td bgcolor="#CCCCCC"><strong> KELUARGA</strong> </td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
      <td><b>Status Keluarga </b></td>
	  <td><b>:</b></td>
	  <td><?php echo $myData['keluarga_status']; ?></td>
    </tr>
	<tr>
      <td><strong>Nama Keluarga </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['keluarga_nama']; ?></td>
    </tr>
	<tr>
      <td><strong>No. Telepon </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['keluarga_telepon']; ?></td>
    </tr>
</table>
</form>

