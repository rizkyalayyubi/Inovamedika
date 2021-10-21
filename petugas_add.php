<?php
include_once "library/inc.seslogin.php";

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
	# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
	$pesanError = array();
	if (trim($_POST['txtNama'])=="") {
		$pesanError[] = "Data <b>Nama Petugas</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtTelepon'])=="") {
		$pesanError[] = "Data <b>No. Telepon</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtUsername'])=="") {
		$pesanError[] = "Data <b>Username</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtPassword'])=="") {
		$pesanError[] = "Data <b>Password</b> tidak boleh kosong !";		
	}
	if (trim($_POST['cmbLevel'])=="KOSONG") {
		$pesanError[] = "Data <b>Level login</b> belum dipilih !";		
	}
			
	# BACA DATA DALAM FORM, masukkan datake variabel
	$txtNama= $_POST['txtNama'];
	$txtUsername= $_POST['txtUsername'];
	$txtPassword= $_POST['txtPassword'];
	$txtTelepon	= $_POST['txtTelepon'];
	$cmbLevel	= $_POST['cmbLevel'];
	
	# VALIDASI USERNAME LOGIN (username), jika sudah ada akan ditolak
	$cekSql="SELECT * FROM petugas WHERE username='$txtUsername'";
	$cekQry=mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error()); 
	if(mysql_num_rows($cekQry)>=1){
		$pesanError[] = "Username <b> $txtUsername </b> sudah ada, ganti dengan yang lain";
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
		$kodeBaru	= buatKode("petugas", "P");
		$mySql  	= "INSERT INTO petugas (kd_petugas, nm_petugas, no_telepon, 
										 username, password, level)
						VALUES ('$kodeBaru', 
								'$txtNama', 
								'$txtTelepon', 
								'$txtUsername', 
								MD5('$txtPassword'), 
								'$cmbLevel')";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Petugas-Data'>";
		}
		exit;
	}	
} // Penutup Tombol Simpan

# VARIABEL DATA UNTUK DIBACA FORM
// Supaya saat ada pesan error, data di dalam form tidak hilang. Jadi, tinggal meneruskan/memperbaiki yg salah
$dataKode		= buatKode("petugas", "P");
$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataUsername	= isset($_POST['txtUsername']) ? $_POST['txtUsername'] : '';
$dataPassword	= isset($_POST['txtPassword']) ? $_POST['txtPassword'] : '';
$dataTelepon	= isset($_POST['txtTelepon']) ? $_POST['txtTelepon'] : '';
$dataLevel		= isset($_POST['cmbLevel']) ? $_POST['cmbLevel'] : '';
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="100%" class="table-list" border="0" cellspacing="1" cellpadding="4">
    <tr>
      <th height="28" colspan="3"><b>TAMBAH DATA PETUGAS </b></th>
    </tr>
    <tr>
      <td width="181"><b>Kode</b></td>
      <td width="5"><b>:</b></td>
      <td width="1000"> <input name="textfield" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="10" readonly="readonly"/></td>
    </tr>
    <tr>
      <td><b>Nama Petugas </b></td>
      <td><b>:</b></td>
      <td><input name="txtNama" type="text" value="<?php echo $dataNama; ?>" size="80" maxlength="100" /></td>
    </tr>
    <tr>
      <td><b>No. Telepon </b></td>
      <td><b>:</b></td>
      <td><input name="txtTelepon" type="text" value="<?php echo $dataTelepon; ?>" size="60" maxlength="20" /></td>
    </tr>
    <tr>
      <td><b>Username</b></td>
      <td><b>:</b></td>
      <td> <input name="txtUsername" type="text"  value="<?php echo $dataUsername; ?>" size="60" maxlength="20" /></td>
    </tr>
    <tr>
      <td><b>Password</b></td>
      <td><b>:</b></td>
      <td><input name="txtPassword" type="password"  size="60" maxlength="20" /></td>
    </tr>
    <tr>
      <td><b>Level</b></td>
      <td><b>:</b></td>
      <td><b>
        <select name="cmbLevel">
          <option value="KOSONG">....</option>
          <?php
		  $pilihan	= array("Klinik", "Apotek", "Admin");
          foreach ($pilihan as $nilai) {
            if ($dataLevel==$nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek>$nilai</option>";
          }
          ?>
        </select>
      </b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="btnSimpan" value=" Simpan " />      </td>
    </tr>
  </table>
</form>
