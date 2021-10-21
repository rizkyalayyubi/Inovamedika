<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

if($_GET) {
	# Baca variabel URL
	$noNota = $_GET['noNota'];
	
	# Perintah untuk mendapatkan data dari tabel penjualan
	$mySql = "SELECT penjualan.*, petugas.nm_petugas FROM penjualan 
			  LEFT JOIN petugas ON penjualan.kd_petugas=petugas.kd_petugas
			  WHERE no_penjualan='$noNota'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
}
else {
	echo "Nomor Transaksi Tidak Terbaca";
	exit;
}
?>
<html>
<head>
<title>:: Cetak Penjualan Obat per Nota | Klinik & Apotek Fitria</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css"></head>
<body>
<h2> PENJUALAN OBAT </h2>
<table width="600" border="0" cellspacing="1" cellpadding="4" class="table-print">
  <tr>
    <td width="139"><b>No. Penjualan </b></td>
    <td width="5"><b>:</b></td>
    <td width="378" valign="top"><strong><?php echo $myData['no_penjualan']; ?></strong></td>
  </tr>
  <tr>
    <td><b>Tgl. Penjualan </b></td>
    <td><b>:</b></td>
    <td valign="top"><?php echo IndonesiaTgl($myData['tgl_penjualan']); ?></td>
  </tr>
  <tr>
    <td><b>Pelanggan</b></td>
    <td><b>:</b></td>
    <td valign="top"><?php echo $myData['pelanggan']; ?></td>
  </tr>
  <tr>
    <td><strong>Keterangan</strong></td>
    <td><b>:</b></td>
    <td valign="top"><?php echo $myData['keterangan']; ?></td>
  </tr>
  <tr>
    <td><strong>Petugas/Kasir</strong></td>
    <td><b>:</b></td>
    <td valign="top"><?php echo $myData['nm_petugas']; ?></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>

<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="6" bgcolor="#CCCCCC"><strong>DAFTAR OBAT </strong></td>
  </tr>
  <tr>
    <td width="30" align="center" bgcolor="#F5F5F5"><b>No</b></td>
    <td width="78" bgcolor="#F5F5F5"><strong>Kode </strong></td>
    <td width="319" bgcolor="#F5F5F5"><b>Nama Obat</b></td>
    <td width="91" align="right" bgcolor="#F5F5F5"><b> Harga (Rp) </b></td>
    <td width="55" align="right" bgcolor="#F5F5F5"><b> Jumlah </b></td>
    <td width="96" align="right" bgcolor="#F5F5F5"><strong>Sub Total(Rp) </strong></td>
  </tr>
  <?php
  	// Buat variabel
	$subTotalJual	= 0;
	$grandTotalJual	= 0;
	
	// SQL menampilkan item obat yang dijual
	$mySql ="SELECT penjualan_item.*, obat.nm_obat FROM penjualan_item
			  LEFT JOIN obat ON penjualan_item.kd_obat=obat.kd_obat 
			  WHERE penjualan_item.no_penjualan='$noNota'
			  ORDER BY penjualan_item.kd_obat";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
	$nomor  = 0;  
	while($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$subTotalJual 	= $myData['jumlah'] * $myData['harga_jual'];
		$grandTotalJual	= $grandTotalJual + $subTotalJual;
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['kd_obat']; ?></td>
    <td><?php echo $myData['nm_obat']; ?></td>
    <td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
    <td align="right"><?php echo $myData['jumlah']; ?></td>
    <td align="right"><?php echo format_angka($subTotalJual); ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="5" align="right"><b> Grand Total (Rp)  : </b></td>
    <td align="right" bgcolor="#F5F5F5"><strong><?php echo format_angka($grandTotalJual); ?></strong></td>
  </tr>
</table>
<br/>
<img src="../images/btn_print.png" height="20" onClick="javascript:window.print()" />
</body>
</html>