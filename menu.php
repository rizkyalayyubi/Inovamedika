<?php
if(isset($_SESSION['SES_ADMIN'])){
# JIKA YANG LOGIN LEVEL ADMIN, menu di bawah yang dijalankan
?>
<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav navbar-collapse">

<ul class="nav" id="side-menu">
                        
    <li>
    	<a href='.?' title='Halaman Utama'><i class="fa fa-dashboard fa-fw"></i> Home</a>
    </li>
    <li>
        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Data<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href='?page=Tindakan-Data' title='Tindakan'>Data Tindakan</a></li>
            <li><a href='?page=Petugas-Data' title='Petugas'>Data Pegawai</a></li>
            <li><a href='?page=Dokter-Data' title='Dokter' target="_self">Data Dokter</a></li>
            <li><a href='?page=Obat-Data' title='Obat'>Data Obat</a></li>
            <li><a href='?page=Pasien-Data' title='Pasien'>Data Pasien</a> </li>

        </ul>
        <!-- /.nav-second-level -->
    </li>
	<li><a href='pendaftaran/' title='Pendaftaran Pasien' target='_blank'><i class="fa fa-pencil-square fa-fw"></i> Pendaftaran Pasien</a></li>
   
	<li><a href='rawat-pasien/' title='Rawat Pasien' target='_blank'><i class="fa fa-share-square fa-fw"></i> Rawat Jalan Pasien</a> </li>
	<li><a href='penjualan/' title='Penjualan Apotek' target='_blank'><i class="fa fa-laptop fa-fw"></i> Penjualan Obat</a> </li>
	
	 <li>
        <a href='?page=Laporan' title='Laporan'><i class="fa fa-file fa-fw"></i> Laporan<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <!--<li><a href="?page=Laporan-Petugas">Laporan Data Petugas</a></li
			<li><a href="?page=Laporan-Tindakan">Laporan Data Tindakan</a></li>-->
			<li><a href="?page=Laporan-Obat">Laporan Data Obat</a></li>
			<!--<li><a href="?page=Laporan-Dokter">Laporan Data Dokter</a></li>-->
			<li><a href="?page=Laporan-Pasien">Laporan Data Pasien</a></li>
			<!--<li><a href="?page=Laporan-Pendaftaran">Laporan Pendaftaran</a></li>-->
			<li><a href="?page=Laporan-Pendaftaran-Periode">Laporan Pendaftaran</a></li>
			
			<!--<li><a href="?page=Laporan-Rawat">Laporan Rawat Pasien</a></li>-->
			<li><a href="?page=Laporan-Rawat-Periode">Laporan Rawat Pasien</a></li>
			<!--<li><a href="?page=Laporan-Rawat-Pasien">Laporan Rawat Pasien/Pasien</a></li>-->
			
			<!--<li><a href="?page=Laporan-Penjualan">Laporan Penjualan Obat</a></li>-->
			<li><a href="?page=Laporan-Penjualan-Periode">Laporan Penjualan Obat</a></li>
        </ul>
        <!-- /.nav-second-level -->
    </li>

	<li><a href='?page=Logout' title='Logout (Exit)'><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
</ul>

</div></div>
<?php
}
elseif(isset($_SESSION['SES_KLINIK'])){
# JIKA YANG LOGIN LEVEL PETUGAS JAGA KLINIK, menu di bawah yang dijalankan
?>

<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav navbar-collapse">

<ul class="nav" id="side-menu">
	<li><a href='?page' title='Halaman Utama'>Home</a></li>
	<li><a href='pendaftaran/' title='Pendaftaran Pasien' target='_blank'>Pendaftaran Pasien</a> </li>
	<li><a href='rawat-pasien/' title='Rawat Pasien' target='_blank'>Rawat Pasien</a> </li>
	<li><a href='?page=Logout' title='Logout (Exit)'>Logout</a></li>
</ul>

</div></div>
<?php
}
elseif(isset($_SESSION['SES_APOTEK'])){
# JIKA YANG LOGIN LEVEL KASIR APOTEK, menu di bawah yang dijalankan
?>
<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav navbar-collapse">

<ul class="nav" id="side-menu">
	<li><a href='?page' title='Halaman Utama'>Home</a></li>
	<li><a href='penjualan/index.php' title='Penjualan Apotek' target='_blank'>Penjualan Apotek</a> </li>
	<li><a href='?page=Logout' title='Logout (Exit)'>Logout</a></li>
</ul>

</div></div>
<?php
}
else {
# JIKA BELUM LOGIN (BELUM ADA SESION LEVEL YG DIBACA)
?>
<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav navbar-collapse">

<ul class="nav" id="side-menu">
	<li></li>
</ul>

</div></div>
<?php
}
?>