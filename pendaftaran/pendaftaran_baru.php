<?php
include_once "../library/inc.seslogin.php";

# Fungsi membuat nomor antrian
function nomorAntrian($tanggal) {
	//$tanggal dalam format Y-m-d
	$antriKe= 0;
	$mySql	= "SELECT count(*) as jum_antri FROM pendaftaran WHERE tgl_janji='$tanggal' ORDER BY nomor_antri";
	$myQry 	= mysql_query($mySql) or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
	if(mysql_num_rows($myQry) >=1) {
		$antriKe	= $myData['jum_antri'] + 1;
	}
	else {
		$antriKe	= 1;
	}
	
	return $antriKe;
}

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($_POST['txtNomorRM'])=="") {
		$pesanError[] = "Data <b>Nomor RM (Rekam Medik)</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtTglDaftar'])=="") {
		$pesanError[] = "Data <b>Tgl. Daftar</b> tidak boleh kosong, silahkan pilih pada kalender !";		
	}	
	if (trim($_POST['txtTglJanji'])=="") {
		$pesanError[] = "Data <b>Tgl. Janji</b> tidak boleh kosong, silahkan pilih pada kalender !";			
	}
	if (trim($_POST['txtJamJanji'])=="") {
		$pesanError[] = "Data <b>Jam Janji</b> tidak boleh kosong, isi dengan format 00:00:00 !";		
	}
	if (trim($_POST['txtKeluhan'])=="") {
		$pesanError[] = "Data <b>Keluhan Pasien</b> tidak boleh kosong, silahkan dilengkapi !";		
	}
	if (trim($_POST['cmbTindakan'])=="KOSONG") {
		$pesanError[] = "Data <b>Tindakan</b> tidak boleh kosong, silahkan dilengkapi !";		
	}

	# Baca Variabel Form
	$txtNomorRM		= $_POST['txtNomorRM'];
	$txtTglDaftar	= InggrisTgl($_POST['txtTglDaftar']);
	$txtTglJanji	= InggrisTgl($_POST['txtTglJanji']);
	$txtJamJanji	= $_POST['txtJamJanji'];
	$txtKeluhan		= $_POST['txtKeluhan'];
	$cmbTindakan	= $_POST['cmbTindakan'];
	
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='../images/attention.png'> <br><hr>";
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
		$userLogin	= $_SESSION['SES_LOGIN'];
		$nomorAntri = nomorAntrian($txtTglJanji);
		$kodeBaru	= buatKode("pendaftaran", "");
		$mySql	= "INSERT INTO pendaftaran (no_daftar, nomor_rm, tgl_daftar, tgl_janji, jam_janji, 
						keluhan, kd_tindakan, nomor_antri, kd_petugas) 
						VALUES ('$kodeBaru', '$txtNomorRM', '$txtTglDaftar', '$txtTglJanji', '$txtJamJanji', 
						'$txtKeluhan', '$cmbTindakan', '$nomorAntri', '$userLogin')";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){			
			// Menjalankan program cetak
			echo "<script>";
			echo "window.open('pendaftaran_cetak.php?Kode=$kodeBaru', width=330,height=330,left=100, top=25)";
			echo "</script>";
			
			// Refresh halaman 
			echo "<meta http-equiv='refresh' content='0; url=?page=Pendaftaran-Baru'>";
		}
		exit;
	}	
} // Penutup Tombol Simpan

// Membaca Nomor RM data Pasien
$NomorRM= isset($_GET['NomorRM']) ?  $_GET['NomorRM'] : '';
$mySql	= "SELECT nomor_rm, nm_pasien FROM pasien WHERE nomor_rm='$NomorRM'";
$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);
$dataPasien		= $myData['nm_pasien'];

# Kode pasien
if($NomorRM=="") {
	$NomorRM= isset($_POST['txtNomorRM']) ? $_POST['txtNomorRM'] : '';
}

# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)
$dataKode		= buatKode("pendaftaran", "");
$dataTglDaftar	= isset($_POST['txtTglDaftar']) ? $_POST['txtTglDaftar'] :  date('d-m-Y');
$dataTglJanji 	= isset($_POST['txtTglJanji']) ? $_POST['txtTglJanji'] :  date('d-m-Y');
$dataJamJanji	= isset($_POST['txtJamJanji']) ? $_POST['txtJamJanji'] : '';
$dataKeluhan	= isset($_POST['txtKeluhan']) ? $_POST['txtKeluhan'] : '';
$dataTindakan	= isset($_POST['cmbTindakan']) ? $_POST['cmbTindakan'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <th colspan="3" scope="col">PENDAFTARAN PASIEN </th>
    </tr>
    <tr>
      <td width="19%"><strong>Kode</strong></td>
      <td width="1%"><strong>:</strong></td>
      <td width="80%"><input name="textfield" value="<?php echo $dataKode; ?>" size="10" maxlength="10" readonly="readonly"/></td>
    </tr>
    <tr>
      <td><strong>Nomor RM </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtNomorRM" value="<?php echo $NomorRM; ?>" size="23" maxlength="10" />
      * pilih dari <a href="?page=Pencarian-Pasien" target="_self">daftar pasien</a>, lalu klik menu <strong>daftar</strong> </td>
    </tr>
    <tr>
      <td><strong>Nama Pasien </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtPasien" value="<?php echo $dataPasien; ?>" size="80" maxlength="100" readonly="readonly"/></td>
    </tr>
    <tr>
      <td><strong>Tgl.  Daftar </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtTglDaftar" type="text" class="tcal" value="<?php echo $dataTglDaftar; ?>" /></td>
    </tr>
    <tr>
      <td><strong>Tgl.  &amp; Jam Janji </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtTglJanji" type="text" class="tcal" value="<?php echo $dataTglJanji; ?>" />
        / 
        <input name="txtJamJanji" value="<?php echo $dataJamJanji; ?>" size="10" maxlength="8" />
        <strong>ex:</strong> 12:30 </td>
    </tr>
    <tr>
      <td><strong>Keluhan Pasien </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtKeluhan" value="<?php echo $dataKeluhan; ?>" size="80" maxlength="100" /></td>
    </tr>
    <tr>
      <td><strong>Tindakan Pasien </strong></td>
      <td><strong>:</strong></td>
      <td><select name="cmbTindakan">
        <option value="KOSONG">....</option>
        <?php
	  $dataSql = "SELECT * FROM tindakan ORDER BY kd_tindakan";
	  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($dataRow = mysql_fetch_array($dataQry)) {
		if ($dataRow['kd_tindakan'] == $dataTindakan) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$dataRow[kd_tindakan]' $cek>[ $dataRow[kd_tindakan] ]  $dataRow[nm_tindakan]</option>";
	  }
	  ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" SIMPAN "></td>
    </tr>
  </table>
</form>
