<?php
include_once "library/inc.seslogin.php";

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($_POST['txtNama'])=="") {
		$pesanError[] = "Data <b>Nama Tindakan</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtHarga'])=="") {
		$pesanError[] = "Data <b>Harga (Rp.)</b> tidak boleh kosong !";		
	}
	
	# Baca Variabel Form
	$txtNama	= $_POST['txtNama'];
	$txtHarga	= $_POST['txtHarga'];
	
	# Validasi Nama tindakan, jika sudah ada akan ditolak
	$cekSql="SELECT * FROM tindakan WHERE nm_tindakan='$txtNama'";
	$cekQry=mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error()); 
	if(mysql_num_rows($cekQry)>=1){
		$pesanError[] = "Maaf, Tindakan <b> $txtNama </b> sudah ada, ganti dengan yang lain";
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
		$kodeBaru	= buatKode("tindakan", "T");
		$mySql	= "INSERT INTO tindakan (kd_tindakan, nm_tindakan, harga) VALUES ('$kodeBaru','$txtNama','$txtHarga')";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Tindakan-Data'>";
		}
		exit;
	}	
}

# VARIABEL DATA UNTUK DIBACA FORM
// Supaya saat ada pesan error, data di dalam form tidak hilang. Jadi, tinggal meneruskan/memperbaiki yg salah
$dataKode	= buatKode("tindakan", "T");
$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataHarga	= isset($_POST['txtHarga']) ? $_POST['txtHarga'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
  <table width="100%" class="table-list" border="0" cellpadding="4" cellspacing="1">
    <tr>
      <th colspan="3" scope="col">TAMBAH TINDAKAN </th>
    </tr>
    <tr>
      <td width="181"><strong>Kode</strong></td>
      <td width="3">:</td>
      <td width="1019"><input name="textfield" value="<?php echo $dataKode; ?>" size="10" maxlength="10" readonly="readonly"/></td>
    </tr>
    <tr>
      <td><strong>Nama Tindakan </strong></td>
      <td>:</td>
      <td><input name="txtNama" value="<?php echo $dataNama; ?>" size="70" maxlength="100" /></td>
    </tr>
    <tr>
      <td><strong>Harga (Rp.) </strong></td>
      <td>:</td>
      <td><input name="txtHarga" value="<?php echo $dataHarga; ?>" size="20" maxlength="12" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" SIMPAN "></td>
    </tr>
  </table>
</form>
