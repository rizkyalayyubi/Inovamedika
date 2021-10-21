<?php
include_once "library/inc.seslogin.php";

# Membaca tombol Simpan saat diklik
if(isset($_POST['btnSimpan'])){
	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($_POST['txtNama'])=="") {
		$pesanError[] = "Data <b>Nama Obat</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtHargaModal'])=="" or ! is_numeric(trim($_POST['txtHargaModal']))) {
		$pesanError[] = "Data <b>Harga Modal (Rp.)</b> jual tidak boleh kosong, harus diisi angka!";		
	}
	if (trim($_POST['txtHargaJual'])=="" or ! is_numeric(trim($_POST['txtHargaJual']))) {
		$pesanError[] = "Data <b>Harga Jual (Rp.)</b> jual tidak boleh kosong, harus diisi angka!";		
	}
	if (trim($_POST['txtStok'])=="" or ! is_numeric(trim($_POST['txtStok']))) {
		$pesanError[] = "Data <b>Stok Obat</b> masih kosong, harus diisi angka !";		
	}
	if (trim($_POST['txtKeterangan'])=="") {
		$pesanError[] = "Data <b>Keterangan</b> tidak boleh kosong !";		
	}
	
	# Baca Variabel Form
	$txtNama		= $_POST['txtNama'];
	$txtHargaModal	= $_POST['txtHargaModal'];
	$txtHargaJual	= $_POST['txtHargaJual'];
	$txtStok		= $_POST['txtStok'];
	$txtKeterangan	= $_POST['txtKeterangan'];
	
	# Validasi Nama obat, jika sudah ada akan ditolak
	$sqlCek="SELECT * FROM obat WHERE nm_obat='$txtNama'";
	$qryCek=mysql_query($sqlCek, $koneksidb) or die ("Eror Query".mysql_error()); 
	if(mysql_num_rows($qryCek)>=1){
		$pesanError[] = "Maaf, Nama Obat <b> $txtNama </b> sudah ada dalam database, ganti dengan yang lain";
	}


	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# SIMPAN DATA KE DATABASE. 
		// Jika tidak menemukan error, simpan data ke database
		$kodeBaru	= buatKode("obat", "H");
		$mySql	= "INSERT INTO obat (kd_obat, nm_obat, harga_modal, harga_jual, stok, keterangan) 
						VALUES ('$kodeBaru',
								'$txtNama',
								'$txtHargaModal',
								'$txtHargaJual',
								'$txtStok',
								'$txtKeterangan')";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Obat-Add'>";
		}
		exit;
	}
} // Penutup POST
	
	
# VARIABEL DATA UNTUK FORM
$dataKode	= buatKode("obat", "H");
$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataHargaModal	= isset($_POST['txtHargaModal']) ? $_POST['txtHargaModal'] : '0';
$dataHargaJual	= isset($_POST['txtHargaJual']) ? $_POST['txtHargaJual'] : '0';
$dataStok		= isset($_POST['txtStok']) ? $_POST['txtStok'] : '';
$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table  class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <th colspan="3" scope="col">TAMBAH DATA OBAT </th>
    </tr>
    <tr>
      <td width="16%"><strong>Kode</strong></td>
      <td width="1%"><strong>:</strong></td>
      <td width="83%"><input name="textfield" value="<?php echo $dataKode; ?>" size="14" maxlength="10" readonly="readonly"/></td>
    </tr>
    <tr>
      <td><strong>Nama Obat </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtNama" value="<?php echo $dataNama; ?>" size="80" maxlength="100" /></td>
    </tr>
    <tr>
      <td><strong>Harga Modal (Rp.) </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtHargaModal" value="<?php echo $dataHargaModal; ?>" size="20" maxlength="12" 
	  			onblur="if (value == '') {value = '0'}" 
				onfocus="if (value == '0') {value =''}"/></td>
    </tr>
    <tr>
      <td><strong>Harga Jual (Rp.) </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtHargaJual" value="<?php echo $dataHargaJual; ?>" size="20" maxlength="12" 
	  			onblur="if (value == '') {value = '0'}" 
				onfocus="if (value == '0') {value =''}"/></td>
    </tr>
    <tr>
      <td><strong>Stok</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtStok" value="<?php echo $dataStok; ?>" size="14" maxlength="10"/></td>
    </tr>
    <tr>
      <td><strong>Keterangan</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtKeterangan" value="<?php echo $dataKeterangan; ?>" size="80" maxlength="200" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
  </table>
</form>
