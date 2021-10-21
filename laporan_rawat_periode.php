<?php
include_once "library/inc.seslogin.php";

# Deklarasi variabel
$filterPeriode = ""; 
$tglAwal	= ""; 
$tglAkhir	= "";

# Membaca tanggal dari form, jika belum di-POST formnya, maka diisi dengan tanggal sekarang
$tglAwal 	= isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "01-".date('m-Y');
$tglAkhir 	= isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : date('d-m-Y');

// Jika tombol filter tanggal (Tampilkan) diklik
if (isset($_POST['btnTampil'])) {
	// Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
	$filterPeriode = "WHERE ( tgl_rawat BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
}
else {
	// Membaca data tanggal dari URL, saat menu Pages diklik
	$tglAwal 	= isset($_GET['tglAwal']) ? $_GET['tglAwal'] : $tglAwal;
	$tglAkhir 	= isset($_GET['tglAkhir']) ? $_GET['tglAkhir'] : $tglAkhir; 
	
	// Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
	$filterPeriode = "WHERE ( tgl_rawat BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
}

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM rawat $filterPeriode";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>

<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Laporan Rawat Pasien</h1>
</div>
<!-- /.col-lg-12 -->
</div>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
<div class="dataTable-wrapper">
<div class="table-responsive">
  <table  class="table table-striped table-bordered table-hover" id="dataTables-example"  width="100%"cellspacing="1" cellpadding="3">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>PERIODE RAWAT </strong></td>
    </tr>
    <tr>
      <td width="90"><strong>Periode </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="391"><input name="txtTglAwal" type="text" class="tcal" value="<?php echo $tglAwal; ?>" />
        s/d
      <input name="txtTglAkhir" type="text" class="tcal" value="<?php echo $tglAkhir; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnTampil" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
  </div></div>
</form>

<div class="dataTable-wrapper">
<div class="table-responsive">
  <table  class="table table-striped table-bordered table-hover" id="dataTables-example"  width="100%"cellspacing="1" cellpadding="3">
  <tr>
    <td width="25" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="74" bgcolor="#CCCCCC"><strong>No. Rawat </strong></td>
    <td width="83" bgcolor="#CCCCCC"><strong>Tgl. Rawat </strong></td>
    <td width="83" bgcolor="#CCCCCC"><strong>Nomor RM </strong></td>
    <td width="166" bgcolor="#CCCCCC"><strong>Nama Pasien  </strong></td>
    <td width="85" align="right" bgcolor="#CCCCCC"><strong> Bayar (Rp) </strong></td>
    <td width="204" bgcolor="#CCCCCC"><strong>Hasil Diagnosa </strong></td>
    <td width="39" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
  <?php
	# Perintah untuk menampilkan data Rawat dengan filter Periode
	$mySql = "SELECT rawat.*, pasien.nm_pasien FROM rawat 
				LEFT JOIN pasien ON rawat.nomor_rm = pasien.nomor_rm
				$filterPeriode
				ORDER BY rawat.no_rawat ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;		
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['no_rawat']; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_rawat']); ?></td>
    <td><?php echo $myData['nomor_rm']; ?></td>
    <td><?php echo $myData['nm_pasien']; ?></td>
    <td align="right"><?php echo format_angka($myData['uang_bayar']); ?></td>
    <td><?php echo $myData['hasil_diagnosa']; ?></td>
    <td align="center"><a href="cetak/rawat_cetak.php?noRawat=<?php echo $myData['no_rawat']; ?>" target="_blank">Cetak</a></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3"><strong>Jumlah Data :</strong><?php echo $jml; ?></td>
    <td colspan="5" align="right"><strong>Halaman ke :</strong>
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Laporan-Rawat-Periode&hal=$list[$h]&tglAwal=$tglAwal&tglAkhir=$tglAkhir'>$h</a> ";
	}
	?></td>
  </tr>
</table>
</div></div>