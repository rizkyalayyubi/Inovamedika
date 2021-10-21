<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

# Baca noNota dari URL
if(isset($_GET['nomorRawat'])){
	$nomorRawat = $_GET['nomorRawat'];
	
	// Perintah untuk mendapatkan data dari tabel rawat
	$mySql = "SELECT rawat.*, petugas.nm_petugas FROM rawat
				LEFT JOIN petugas ON rawat.kd_petugas=petugas.kd_petugas 
				WHERE no_rawat='$nomorRawat'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$kolomData = mysql_fetch_array($myQry);
}
else {
	echo "Nomor Rawat (nomorRawat) tidak ditemukan";
	exit;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cetak Nota Rawat Pasien - Apotek & Klinik Fitria</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	window.print();
	window.onfocus=function(){ window.close();}
</script>
</head>
<body onLoad="window.print()">
<table class="table-list" width="600" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td height="87" colspan="4" align="center">
		<strong>APOTEK & KLINIK FITRIA</strong><br />
        <strong>NPWP/ PKP : </strong>1.111111.11111<br />
        <strong>Tanggal Pengukuhan : </strong>10-03-2010<br />
        Kota Metro, Lampung </td>
  </tr>
  <tr>
    <td colspan="2"><strong>No. Nota :</strong> <?php echo $kolomData['no_rawat']; ?></td>
    <td colspan="2" align="right"> <?php echo IndonesiaTgl($kolomData['tgl_rawat']); ?></td>
  </tr>
  <tr>
    <td width="23" bgcolor="#F5F5F5"><strong>No</strong></td>
    <td width="307" bgcolor="#F5F5F5"><strong>Daftar Tindakan </strong></td>
    <td width="174" bgcolor="#F5F5F5"><strong>Dokter</strong></td>
    <td width="80" align="right" bgcolor="#F5F5F5"><strong>Harga@</strong></td>
  </tr>
<?php
# Baca variabel
$totalBayar = 0; 
$uangKembali=0;

# Menampilkan List Item tindakan yang dibeli untuk Nomor Transaksi Terpilih
$notaSql = "SELECT rawat_tindakan.*, tindakan.nm_tindakan, dokter.nm_dokter 
			FROM rawat_tindakan
			LEFT JOIN tindakan ON rawat_tindakan.kd_tindakan=tindakan.kd_tindakan 
			LEFT JOIN dokter ON rawat_tindakan.kd_dokter=dokter.kd_dokter
			WHERE rawat_tindakan.no_rawat='$nomorRawat'
			ORDER BY tindakan.kd_tindakan ASC";
$notaQry = mysql_query($notaSql, $koneksidb)  or die ("Query list salah : ".mysql_error());
$nomor  = 0;  
while ($notaData = mysql_fetch_array($notaQry)) {
$nomor++;
	$totalBayar	= $totalBayar + $notaData['harga'];
	$uangKembali= $kolomData['uang_bayar'] - $totalBayar;
?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $notaData['kd_tindakan']; ?>/ <?php echo $notaData['nm_tindakan']; ?></td>
    <td><?php echo $notaData['nm_dokter']; ?></td>
    <td align="right"><?php echo format_angka($notaData['harga']); ?></td>
  </tr>
<?php } ?>
  <tr>
    <td colspan="3" align="right"><strong>Total Biaya Tindakan (Rp) : </strong></td>
    <td align="right" bgcolor="#F5F5F5"><?php echo format_angka($totalBayar); ?></td>
  </tr>
  <tr>
    <td colspan="3" align="right"><strong> Uang Bayar (Rp) : </strong></td>
    <td align="right"><?php echo format_angka($kolomData['uang_bayar']); ?></td>
  </tr>
  <tr>
    <td colspan="3" align="right">
	<strong>
	<?php 
	// membuat keterangan status Uang Kembali / Uang Hutang
	if($kolomData['uang_bayar'] < $totalBayar) {
		echo "Hutang Pasien (Rp) : ";
	}
	else {
		echo "Uang Kembali (Rp) : ";
	}; ?></strong></td>
    <td align="right"><?php echo format_angka($uangKembali); ?></td>
  </tr>
  <tr>
    <td colspan="4"><strong>Petugas :</strong> <?php echo $kolomData['nm_petugas']; ?></td>
  </tr>
</table>
</body>
</html>
