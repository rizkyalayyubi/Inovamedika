<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

# Baca noNota dari URL
if(isset($_GET['noNota'])){
	$noNota = $_GET['noNota'];
	
	// Perintah untuk mendapatkan data dari tabel penjualan
	$mySql = "SELECT penjualan.*, petugas.nm_petugas FROM penjualan
				LEFT JOIN petugas ON penjualan.kd_petugas=petugas.kd_petugas 
				WHERE no_penjualan='$noNota'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$kolomData = mysql_fetch_array($myQry);
}
else {
	echo "Nomor Nota (noNota) tidak ditemukan";
	exit;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cetak Nota Penjualan Obat - Apotek & Klinik Fitria</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	window.print();
	window.onfocus=function(){ window.close();}
</script>
</head>
<body onLoad="window.print()">
<table class="table-list" width="430" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td height="87" colspan="5" align="center">
		<strong>APOTEK & KLINIK FITRIA</strong><br />
        <strong>NPWP/ PKP : </strong>1.111111.11111<br />
        <strong>Tanggal Pengukuhan : </strong>10-03-2010<br />
        Kota Metro, Lampung </td>
  </tr>
  <tr>
    <td colspan="2"><strong>No Nota :</strong> <?php echo $kolomData['no_penjualan']; ?></td>
    <td colspan="3" align="right"> <?php echo IndonesiaTgl($kolomData['tgl_penjualan']); ?></td>
  </tr>
  <tr>
    <td width="32" bgcolor="#F5F5F5"><strong>No</strong></td>
    <td width="193" bgcolor="#F5F5F5"><strong>Daftar Obat </strong></td>
    <td width="55" align="right" bgcolor="#F5F5F5"><strong>Harga@</strong></td>
    <td width="27" align="right" bgcolor="#F5F5F5"><strong>Qty</strong></td>
    <td width="97" align="right" bgcolor="#F5F5F5"><strong>Subtotal(Rp) </strong></td>
  </tr>
<?php
# Baca variabel
$totalBayar = 0; 
$jumlahObat = 0;  
$uangKembali=0;

# Menampilkan List Item obat yang dibeli untuk Nomor Transaksi Terpilih
$notaSql = "SELECT penjualan_item.*, obat.nm_obat FROM penjualan_item
			LEFT JOIN obat ON penjualan_item.kd_obat=obat.kd_obat 
			WHERE penjualan_item.no_penjualan='$noNota'
			ORDER BY obat.kd_obat ASC";
$notaQry = mysql_query($notaSql, $koneksidb)  or die ("Query list salah : ".mysql_error());
$nomor  = 0;  
while ($notaData = mysql_fetch_array($notaQry)) {
$nomor++;
	$subSotal 	= $notaData['jumlah'] * $notaData['harga_jual'];
	$totalBayar	= $totalBayar + $subSotal;
	$jumlahObat = $jumlahObat + $notaData['jumlah'];
	$uangKembali= $kolomData['uang_bayar'] - $totalBayar;
?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $notaData['kd_obat']; ?>/  <?php echo $notaData['nm_obat']; ?></td>
    <td align="right"><?php echo format_angka($notaData['harga_jual']); ?></td>
    <td align="right"><?php echo $notaData['jumlah']; ?></td>
    <td align="right"><?php echo format_angka($subSotal); ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3" align="right"><strong>Total Belanja (Rp) : </strong></td>
    <td colspan="2" align="right" bgcolor="#F5F5F5"><?php echo format_angka($totalBayar); ?></td>
  </tr>
  <tr>
    <td colspan="3" align="right"><strong> Uang Bayar (Rp) : </strong></td>
    <td colspan="2" align="right"><?php echo format_angka($kolomData['uang_bayar']); ?></td>
  </tr>
  <tr>
    <td colspan="3" align="right"><strong>Uang Kembali (Rp) : </strong></td>
    <td colspan="2" align="right"><?php echo format_angka($uangKembali); ?></td>
  </tr>
  <tr>
    <td colspan="5"><strong>Petugas :</strong> <?php echo $kolomData['nm_petugas']; ?></td>
  </tr>
</table>
</body>
</html>
