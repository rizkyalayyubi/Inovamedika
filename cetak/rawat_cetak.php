<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

if($_GET) {
	# Baca variabel URL
	$noRawat = $_GET['noRawat'];
	
	# Skrip untuk membaca data Rawat pasien
	$mySql = "SELECT rawat.*, pasien.nm_pasien FROM rawat 
				LEFT JOIN pasien ON rawat.nomor_rm = pasien.nomor_rm
				WHERE rawat.no_rawat='$noRawat'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$myData= mysql_fetch_array($myQry);
}
else {
	echo "Nomor Rawat Tidak Terbaca";
	exit;
}
?>
<html>
<head>
<title>:: Cetak Data Rawat Pasien per Nota | Klinik & Apotek Fitria</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2> RAWAT PASIEN </h2>
<table width="500" border="0" cellspacing="1" cellpadding="4" class="table-print">
  <tr>
    <td width="160"><b>No. Rawat </b></td>
    <td width="10"><b>:</b></td>
    <td width="302"><?php echo $myData['no_rawat']; ?></td>
  </tr>
  <tr>
    <td><b>Tgl. Rawat </b></td>
    <td><b>:</b></td>
    <td><?php echo IndonesiaTgl($myData['tgl_rawat']); ?></td>
  </tr>
  <tr>
    <td><b>Nomor RM </b></td>
    <td><b>:</b></td>
    <td><?php echo $myData['nomor_rm']; ?></td>
  </tr>
  <tr>
    <td><strong>Nama Pasien </strong></td>
    <td><b>:</b></td>
    <td><?php echo $myData['nm_pasien']; ?></td>
  </tr>
  <tr>
    <td><strong>Diganosa</strong></td>
    <td><b>:</b></td>
    <td><?php echo $myData['hasil_diagnosa']; ?></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>DAFTAR TINDAKAN </strong></td>
  </tr>
  <tr>
    <td width="26" align="center" bgcolor="#F5F5F5"><b>No</b></td>
    <td width="76" bgcolor="#F5F5F5"><strong>Tanggal</strong></td>
    <td width="58" bgcolor="#F5F5F5"><strong>Kode </strong></td>
    <td width="332" bgcolor="#F5F5F5"><b>Nama Tindakan </b></td>
    <td width="182" bgcolor="#F5F5F5"><strong>Dokter</strong></td>
  </tr>
<?php
// Skrip untuk mengambil data Daftar Tindakan yang diambil Pasien
$mySql ="SELECT rawat_tindakan.*, tindakan.nm_tindakan, dokter.nm_dokter FROM rawat_tindakan 
		 LEFT JOIN tindakan ON rawat_tindakan.kd_tindakan=tindakan.kd_tindakan 
		 LEFT JOIN dokter ON rawat_tindakan.kd_dokter=dokter.kd_dokter
		 WHERE rawat_tindakan.no_rawat='$noRawat' ORDER BY id_tindakan";
$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
$nomor=0; 
while($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_tindakan']); ?></td>
    <td><?php echo $myData['kd_tindakan']; ?></td>
    <td><?php echo $myData['nm_tindakan']; ?></td>
    <td><?php echo$myData['nm_dokter']; ?></td>
  </tr>
  <?php } ?>
</table>
<br/>
<img src="../images/btn_print.png" height="20" onClick="javascript:window.print()" />
</body>
</html>