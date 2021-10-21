<?php
include_once "../library/inc.seslogin.php";

// Periksa ada atau tidak variabel Kode pada URL (alamat browser)
if(isset($_GET['Kode'])){
	// Hapus data sesuai Kode yang didapat di URL
	$mySql = "DELETE FROM pendaftaran WHERE no_daftar='".$_GET['Kode']."'";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Eror hapus data".mysql_error());
	if($myQry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=?page=Pendaftaran-Tampil'>";
	}
}
else {
	// Jika tidak ada data Kode ditemukan di URL
	echo "<b>Data yang dihapus tidak ada</b>";
}
?>