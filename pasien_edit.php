<?php
include_once "library/inc.seslogin.php";

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($_POST['txtNama'])=="") {
		$pesanError[] = "Data <b>Nama Pasien</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtNoIdentitas'])=="") {
		$pesanError[] = "Data <b>No. Identitas</b> tidak boleh kosong !";
	}
	if (trim($_POST['cmbKelamin'])=="KOSONG") {
		$pesanError[] = "Data <b>Jenia Kelamin</b> belum dipilih !";
	}	
	if (trim($_POST['cmbGDarah'])=="KOSONG") {
		$pesanError[] = "Data <b>Golongan Darah</b> belum dipilih !";
	}	
	if (trim($_POST['cmbAgama'])=="KOSONG") {
		$pesanError[] = "Data <b>Agama</b> belum dipilih !";
	}	
	if (trim($_POST['txtTempatLahir'])=="") {
		$pesanError[] = "Data <b>Tempat Lahir</b> tidak boleh kosong !";
	}
	if (trim($_POST['txtAlamat'])=="") {
		$pesanError[] = "Data <b>Alamat Tinggal</b> tidak boleh kosong !";
	}
	if (trim($_POST['txtTelepon'])=="") {
		$pesanError[] = "Data <b>No. Telepon</b> tidak boleh kosong !";
	}
	if (trim($_POST['cmbSttsNikah'])=="KOSONG") {
		$pesanError[] = "Data <b>Status Nikah</b> belum dipilih !";
	}
	if (trim($_POST['cmbPekerjaan'])=="KOSONG") {
		$pesanError[] = "Data <b>Pekerjaan</b> belum dipilih !";
	}
	if (trim($_POST['cmbSttsKeluarga'])=="KOSONG") {
		$pesanError[] = "Data <b>Status Keluarga</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtKlgNama'])=="") {
		$pesanError[] = "Data <b>Nama Keluarga</b> tidak boleh kosong !";		
	}
	if (trim($_POST['txtKlgTelepon'])=="") {
		$pesanError[] = "Data <b>No. Telepon Keluarga</b> tidak boleh kosong !";		
	}
	
	# Baca Variabel Form
	$txtNama		= $_POST['txtNama'];
	$txtNoIdentitas	= $_POST['txtNoIdentitas'];
	$cmbKelamin		= $_POST['cmbKelamin'];
	$cmbGDarah		= $_POST['cmbGDarah'];
	$cmbAgama		= $_POST['cmbAgama'];
	$txtAlamat		= $_POST['txtAlamat'];
	$txtTelepon		= $_POST['txtTelepon'];
	$cmbSttsNikah	= $_POST['cmbSttsNikah'];
	$cmbPekerjaan	= $_POST['cmbPekerjaan'];
	$cmbSttsKeluarga= $_POST['cmbSttsKeluarga'];
	$txtKlgNama		= $_POST['txtKlgNama'];
	$txtKlgTelepon	= $_POST['txtKlgTelepon'];
	$txtTempatLahir	= $_POST['txtTempatLahir'];
	
	// Membaca form tanggal lahir (comboBox : tanggal, bulan dan tahun lahir)
	$cmbTglLahir	= $_POST['cmbTglLahir'];
	$cmbBlnLahir	= $_POST['cmbBlnLahir'];
	$cmbThnLahir	= $_POST['cmbThnLahir'];
	$tanggalLahir	= "$cmbThnLahir-$cmbBlnLahir-$cmbTglLahir";
		
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
		# SIMPAN PERUBAHAN DATA, Jika jumlah error pesanError tidak ada, simpan datanya
		$petugas= $_SESSION['SES_LOGIN'];
		$mySql	= "UPDATE pasien SET  nm_pasien = '$txtNama',
								no_identitas = '$txtNoIdentitas',
								jns_kelamin = '$cmbKelamin',
								gol_darah = '$cmbGDarah',
								agama = '$cmbAgama',
								tempat_lahir = '$txtTempatLahir',
								tanggal_lahir = '$tanggalLahir',
								no_telepon = '$txtTelepon',
								alamat = '$txtAlamat',
								stts_nikah = '$cmbSttsNikah',
								pekerjaan = '$cmbPekerjaan',
								keluarga_status = '$cmbSttsKeluarga',
								keluarga_nama = '$txtKlgNama',
								keluarga_telepon = '$txtKlgTelepon',
								kd_petugas = '$petugas' 
					WHERE nomor_rm ='".$_POST['txtKode']."'";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Pasien-Data'>";
		}
		exit;
	}	
} // Penutup Tombol Simpan

# MENGAMBIL DATA YANG DIEDIT, SESUAI KODE YANG DIDAPAT DARI URL
$Kode	= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
$mySql	= "SELECT * FROM pasien WHERE nomor_rm='$Kode'";
$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)
$dataKode	= $myData['nomor_rm'];
$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_pasien'];
$dataNoIdentitas= isset($_POST['txtNoIdentitas']) ? $_POST['txtNoIdentitas'] : $myData['no_identitas'];
$dataKelamin= isset($_POST['cmbKelamin']) ? $_POST['cmbKelamin'] : $myData['jns_kelamin'];
$dataGDarah	= isset($_POST['cmbGDarah']) ? $_POST['cmbGDarah'] : $myData['gol_darah'];
$dataAgama	= isset($_POST['cmbAgama']) ? $_POST['cmbAgama'] : $myData['agama'];
$dataAlamat = isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : $myData['alamat'];
$dataTelepon= isset($_POST['txtTelepon']) ? $_POST['txtTelepon'] : $myData['no_telepon'];
$dataSttsNikah	= isset($_POST['cmbSttsNikah']) ? $_POST['cmbSttsNikah'] : $myData['stts_nikah'];
$dataPekerjaan	= isset($_POST['cmbPekerjaan']) ? $_POST['cmbPekerjaan'] : $myData['pekerjaan'];
$dataSttsKeluarga= isset($_POST['cmbSttsKeluarga']) ? $_POST['cmbSttsKeluarga'] : $myData['keluarga_status'];
$dataKlgNama	= isset($_POST['txtKlgNama']) ? $_POST['txtKlgNama'] : $myData['keluarga_nama'];
$dataKlgTelepon	= isset($_POST['txtKlgTelepon']) ? $_POST['txtKlgTelepon'] : $myData['keluarga_telepon'];

// Tempat, Tgl Lahir
$dataTempatLahir= isset($_POST['txtTempatLahir']) ? $_POST['txtTempatLahir'] : $myData['tempat_lahir'];
$dataThn		= isset($_POST['cmbThnLahir']) ? $_POST['cmbThnLahir'] : substr($myData['tanggal_lahir'], 0,4);
$dataBln		= isset($_POST['cmbBlnLahir']) ? $_POST['cmbBlnLahir'] : substr($myData['tanggal_lahir'], 5,2);
$dataTgl		= isset($_POST['cmbTglLahir']) ? $_POST['cmbTglLahir'] : substr($myData['tanggal_lahir'], 8,2);
$dataTglLahir 	= $dataThn."-".$dataBln."-".$dataTgl;
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
<table class="table-list" width="100%">
	<tr>
	  <th colspan="3">UBAH DATA PASIEN </th>
	</tr>
	<tr>
	  <td width="15%"><strong>Kode</strong></td>
	  <td width="1%"><strong>:</strong></td>
	  <td width="84%"><input name="textfield" value="<?php echo $dataKode; ?>" size="10" maxlength="10"  readonly="readonly"/>
    <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /> </td>
	</tr>
	<tr>
      <td><strong>Nama Pasien </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtNama" value="<?php echo $dataNama; ?>" size="80" maxlength="100" /></td>
    </tr>
	<tr>
      <td><strong>No. Identitas (KTP/SIM) </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtNoIdentitas" value="<?php echo $dataNoIdentitas; ?>" size="40" maxlength="40" /></td>
    </tr>
	<tr>
      <td><b>Jenis Kelamin </b></td>
	  <td><b>:</b></td>
	  <td><b>
        <select name="cmbKelamin">
          <option value="KOSONG">....</option>
          <?php
		  $pilihan	= array("Laki-laki", "Perempuan");
          foreach ($pilihan as $nilai) {
            if ($dataKelamin==$nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek>$nilai</option>";
          }
          ?>
        </select>
      </b></td>
    </tr>
	<tr>
      <td><b>Gol. Darah </b></td>
	  <td><b>:</b></td>
	  <td><b>
        <select name="cmbGDarah">
          <option value="KOSONG">....</option>
          <?php
		  $pilihan	= array("A", "B", "AB", "O");
          foreach ($pilihan as $nilai) {
            if ($dataGDarah == $nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek>$nilai</option>";
          }
          ?>
        </select>
      </b></td>
    </tr>
	<tr>
      <td><b>Agama</b></td>
	  <td><b>:</b></td>
	  <td><b>
        <select name="cmbAgama">
          <option value="KOSONG">....</option>
          <?php
		  $pilihan	= array("Islam", "Kristen", "Katolik", "Buda", "Hindu");
          foreach ($pilihan as $nilai) {
            if ($dataAgama ==$nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek>$nilai</option>";
          }
          ?>
        </select>
      </b></td>
    </tr>
	<tr>
      <td><strong>Tempat, Tgl. Lahir </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtTempatLahir" type="text"  value="<?php echo $dataTempatLahir; ?>" size="40" maxlength="100" />
	    , <?php echo listTanggal("Lahir",$dataTglLahir); ?></td>
    </tr>
	<tr>
      <td><strong>Alamat Tinggal </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtAlamat" value="<?php echo $dataAlamat; ?>" size="80" maxlength="200" /></td>
    </tr>
	<tr>
      <td><strong>No. Telepon </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtTelepon" value="<?php echo $dataTelepon; ?>" size="20" maxlength="20" /></td>
    </tr>
	<tr>
      <td><b>Status Nikah </b></td>
	  <td><b>:</b></td>
	  <td><b>
        <select name="cmbSttsNikah">
          <option value="KOSONG">....</option>
          <?php
		  $pilihan	= array("Menikah", "Belum Nikah");
          foreach ($pilihan as $nilai) {
            if ($dataSttsNikah ==$nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek>$nilai</option>";
          }
          ?>
        </select>
      </b></td>
    </tr>
	<tr>
      <td><b>Pekerjaan</b></td>
	  <td><b>:</b></td>
	  <td><b>
        <select name="cmbPekerjaan">
          <option value="KOSONG">....</option>
          <?php
		  $pilihan	= array("Pegawai Negri Sipil(PNS)", 
		  					"Karyawan",
							"Wiraswasta",
							"Petani");
          foreach ($pilihan as $nilai) {
            if ($dataPekerjaan ==$nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek>$nilai</option>";
          }
          ?>
        </select>
      </b></td>
    </tr>
	<tr>
      <td bgcolor="#CCCCCC"><strong> KELUARGA</strong> </td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
      <td><b>Status Keluarga </b></td>
	  <td><b>:</b></td>
	  <td><b>
        <select name="cmbSttsKeluarga">
          <option value="KOSONG">....</option>
          <?php
		  $pilihan	= array("Ayah", "Ibu", "Suami", "Istri", "Saudara");
          foreach ($pilihan as $nilai) {
            if ($dataSttsKeluarga ==$nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek>$nilai</option>";
          }
          ?>
        </select>
      </b></td>
    </tr>
	<tr>
      <td><strong>Nama Keluarga </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtKlgNama" value="<?php echo $dataKlgNama; ?>" size="80" maxlength="200" /></td>
    </tr>
	<tr>
      <td><strong>No. Telepon </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtKlgTelepon" value="<?php echo $dataKlgTelepon; ?>" size="20" maxlength="20" /></td>
    </tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" SIMPAN "></td>
    </tr>
</table>
</form>

