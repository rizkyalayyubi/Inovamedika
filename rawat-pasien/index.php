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
    <td><a href="?page=Rawat-Baru" target="_self">Rawat Pasien Baru</a> | <a href="?page=Rawat-Tampil" target="_self">Tampilkan Pasien Rawat </a></td>
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
		case 'Rawat-Baru' :
			if(!file_exists ("rawat_baru.php")) die ("Empty Main Page!"); 
			include "rawat_baru.php";	break;
		case 'Rawat-Tampil' :
			if(!file_exists ("rawat_tampil.php")) die ("Empty Main Page!"); 
			include "rawat_tampil.php";	break;
		case 'Rawat-Hapus' :
			if(!file_exists ("rawat_hapus.php")) die ("Empty Main Page!"); 
			include "rawat_hapus.php";	break;
		case 'Pencarian-Pasien' : 
			if(!file_exists ("pencarian_pasien.php")) die ("Empty Main Page!"); 
			include "pencarian_pasien.php";	break;
	}
}
else {
	include "rawat_baru.php";
}
?>
</body>
</html>
