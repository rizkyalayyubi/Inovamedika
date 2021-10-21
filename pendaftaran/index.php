<?php
session_start();
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

date_default_timezone_set("Asia/Jakarta");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SI Klinik</title>
<script type="text/javascript" src="chartjs/Chart.js"></script>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../plugins/tigra_calendar/tcal.css" />
<script type="text/javascript" src="../plugins/tigra_calendar/tcal.js"></script> 
</head>
<body>
<table width="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../images/logo2.png" width="499" height="80"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><a href="?page=Pendaftaran-Baru" target="_self">Pendaftaran Baru</a> | <a href="?page=Pendaftaran-Tampil" target="_self">Tampil Pendaftaran </a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

 <?php 
# KONTROL MENU PROGRAM
if(isset($_GET['page'])) {
	// Jika mendapatkan variabel URL ?page
	switch($_GET['page']){				
		case 'Pendaftaran-Baru' :
			if(!file_exists ("pendaftaran_baru.php")) die ("Empty Main Page!"); 
			include "pendaftaran_baru.php";	break;
		case 'Pendaftaran-Ubah' :
			if(!file_exists ("pendaftaran_ubah.php")) die ("Empty Main Page!"); 
			include "pendaftaran_ubah.php";	break;
		case 'Pendaftaran-Hapus' :
			if(!file_exists ("pendaftaran_hapus.php")) die ("Empty Main Page!"); 
			include "pendaftaran_hapus.php";	break;
		case 'Pendaftaran-Tampil' : 
			if(!file_exists ("pendaftaran_data.php")) die ("Empty Main Page!"); 
			include "pendaftaran_data.php";	break;
		case 'Pencarian-Pasien' : 
			if(!file_exists ("pencarian_pasien.php")) die ("Empty Main Page!"); 
			include "pencarian_pasien.php";	break;
	}
}
else {
	include "pendaftaran_baru.php";
}
?>
</body>
</html>
