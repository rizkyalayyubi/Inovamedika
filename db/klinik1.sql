-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2021 at 08:02 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik1`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `kd_dokter` char(4) NOT NULL,
  `nm_dokter` varchar(100) NOT NULL,
  `jns_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `sip` varchar(20) NOT NULL,
  `spesialisasi` varchar(100) NOT NULL,
  `bagi_hasil` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`kd_dokter`, `nm_dokter`, `jns_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_telepon`, `sip`, `spesialisasi`, `bagi_hasil`) VALUES
('D002', 'dr. Sulis Tiyowati', 'Laki-laki', 'Yogyakarta', '1975-01-12', 'Jl. Pattimura', '081971717171', '1001010101010', 'Umum', 10),
('D004', 'dr. Marjoko Suhendra, S.KG', 'Laki-laki', 'Tegal', '1988-01-12', 'Jl. Raya Janti', '081921212333', '2001/101010102', 'Gigi', 10);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `kd_obat` char(5) NOT NULL,
  `nm_obat` varchar(100) NOT NULL,
  `harga_modal` int(10) NOT NULL,
  `harga_jual` int(10) NOT NULL,
  `stok` int(10) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`kd_obat`, `nm_obat`, `harga_modal`, `harga_jual`, `stok`, `keterangan`) VALUES
('H0001', 'Akar Zaitun', 37000, 50000, 92, 'Obat Diabetes'),
('H0002', 'Habatusauda', 85000, 100000, 92, 'untuk kesehatans'),
('H0003', 'Air Zam Zam 1 Liter ', 26000, 40000, 9, 'air zam zam'),
('H0004', 'Alat Bekam 12 Cup', 58000, 70000, 9, 'alat bekam'),
('H0005', 'Bio Skin Car', 10000, 15000, 36, 'Skin car'),
('H0006', 'Bio Xamthone', 60000, 70000, 8, 'xamtone'),
('H0007', 'Buah Merah Papua (BMW) ', 55000, 90000, 10, 'buah merah'),
('H0008', 'Cabe Jawa HIU', 27000, 45000, 6, 'cabe jawa'),
('H0009', 'Cream Jerawat Anisa Dark Spot', 55000, 85000, 9, 'untuk jerawat'),
('H0010', 'Daun Sirsak HIU', 27000, 45000, 17, 'daun sirsak'),
('H0011', 'Diabetas Binasyifa', 27500, 50000, 21, 'obat diabetes'),
('H0012', 'Etawa Emas Original', 25000, 45000, 19, 'susu etawa'),
('H0013', 'FOREDI ', 165000, 200000, 6, 'obat kuat pria'),
('H0014', 'Gamat HIU', 45000, 75000, 9, 'gamat'),
('H0015', 'Gemuk Badan Binasyifa', 22000, 40000, 16, 'herbal gemuk badan'),
('H0016', 'Habasyi Oil 210 Kps', 50000, 89000, 18, 'Habatusauda'),
('H0017', 'Habasyi Oil 75 Kps', 24000, 42500, 19, 'habatusauda'),
('H0018', 'Habasyi Plus 120 Kapsul', 20000, 26500, 17, 'habatusauda plus mnyak zaitun'),
('H0019', 'Habasyi Plus 200 Kapsul', 30500, 42000, 19, 'habatusauda plus mnyak zaitun'),
('H0020', 'Herba Sambung Nyowo HIU', 27500, 45000, 10, 'sambung nyowo'),
('H0021', 'Herbal Oil Sambung Nyowo', 50000, 75000, 20, 'sambung nyowo'),
('H0022', 'Honey Moon', 39500, 70000, 18, 'rapet wanita'),
('H0023', 'Injoy Reflexology Sandal', 90000, 150000, 10, 'sandal refleksi'),
('H0024', 'Jadied Lambung', 15000, 25000, 10, 'untuk lambung'),
('H0025', 'Joss X HIU', 27000, 45000, 10, 'keperkasaan pria'),
('H0026', 'Joss V HIU', 27000, 45000, 10, 'keperkasaan wanita'),
('H0027', 'Kapsul Jati Belanda', 27000, 40000, 10, 'jati belanda'),
('H0028', 'Keladi Tikus Toga Nusantara', 29000, 55000, 10, 'tikus'),
('H0029', 'Klorofil K-Link', 67000, 150000, 10, 'k-link'),
('H0030', 'Koyo Anti Nyamuk', 8000, 15000, 50, 'anti nyamuk'),
('H0031', 'Lamandel ', 20500, 35000, 20, 'obat amandel'),
('H0032', 'Madu Batuk Al Wadey', 18000, 26000, 10, 'obat batuk'),
('H0033', 'Madu Mesir', 47000, 75000, 10, 'madu murni'),
('H0034', 'Madu Sambung Nyowo 100 ML', 24000, 35000, 10, 'sambung nyowo'),
('H0035', 'Madu Sambung Asmoro 100 ML', 24000, 35000, 10, 'sambung asmoro'),
('H0036', 'Nama Obat Baru', 1000, 2000, 10, 'Obat Sakit gigi');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `nomor_rm` char(6) NOT NULL,
  `nm_pasien` varchar(100) NOT NULL,
  `no_identitas` varchar(40) NOT NULL,
  `jns_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `gol_darah` enum('A','B','AB','O') NOT NULL,
  `agama` varchar(30) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `stts_nikah` enum('Menikah','Belum Nikah') NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `keluarga_status` enum('Ayah','Ibu','Suami','Istri','Saudara') NOT NULL,
  `keluarga_nama` varchar(100) NOT NULL,
  `keluarga_telepon` varchar(20) NOT NULL,
  `tgl_rekam` date NOT NULL,
  `kd_petugas` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`nomor_rm`, `nm_pasien`, `no_identitas`, `jns_kelamin`, `gol_darah`, `agama`, `tempat_lahir`, `tanggal_lahir`, `no_telepon`, `alamat`, `stts_nikah`, `pekerjaan`, `keluarga_status`, `keluarga_nama`, `keluarga_telepon`, `tgl_rekam`, `kd_petugas`) VALUES
('RM0002', 'Susi Susanti', '2011/10101010', 'Laki-laki', 'A', 'Islam', 'Yogyakarta', '1988-12-01', '081918181818', 'Jl. Pengangguran, Gg Sengon, 230', 'Menikah', 'Suwasta', 'Ayah', '', '', '2013-12-01', ''),
('RM0003', 'Jono', '1974197401740', 'Laki-laki', 'AB', 'Islam', 'Jakarta', '1961-10-21', '08080183013', 'Jl. Bayangkara', 'Belum Nikah', 'Karyawan', 'Saudara', 'Joni', '08070702414', '2021-10-21', 'P001');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `no_daftar` char(7) NOT NULL,
  `nomor_rm` char(6) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `tgl_janji` date NOT NULL,
  `jam_janji` time NOT NULL,
  `keluhan` varchar(100) NOT NULL,
  `kd_tindakan` char(4) NOT NULL,
  `nomor_antri` int(4) NOT NULL,
  `kd_petugas` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`no_daftar`, `nomor_rm`, `tgl_daftar`, `tgl_janji`, `jam_janji`, `keluhan`, `kd_tindakan`, `nomor_antri`, `kd_petugas`) VALUES
('0000002', 'RM0002', '2014-01-05', '2014-01-05', '20:12:00', 'sakit gigi', 'T001', 2, 'P001');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `no_penjualan` char(7) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `pelanggan` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `uang_bayar` int(12) NOT NULL,
  `kd_petugas` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`no_penjualan`, `tgl_penjualan`, `pelanggan`, `keterangan`, `uang_bayar`, `kd_petugas`) VALUES
('JL00001', '2014-01-08', 'Pelanggan', 'dengan Resep Obat', 400000, 'P001'),
('JL00002', '2014-01-09', 'Pelanggan', 'dengan Resep Obat', 300000, 'P001'),
('JL00003', '2014-01-10', 'Pelanggan', 'dengan Resep Obat', 250000, 'P001'),
('JL00008', '2014-02-08', 'Pasien', 'Pengobatan Herbal', 200000, 'P001');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_item`
--

CREATE TABLE `penjualan_item` (
  `no_penjualan` char(7) NOT NULL,
  `kd_obat` char(5) NOT NULL,
  `harga_modal` int(12) NOT NULL,
  `harga_jual` int(12) NOT NULL,
  `jumlah` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_item`
--

INSERT INTO `penjualan_item` (`no_penjualan`, `kd_obat`, `harga_modal`, `harga_jual`, `jumlah`) VALUES
('JL00001', 'H0001', 37000, 50000, 2),
('JL00001', 'H0002', 85000, 100000, 3),
('JL00002', 'H0013', 165000, 200000, 1),
('JL00002', 'H0022', 39500, 70000, 1),
('JL00003', 'H0005', 10000, 15000, 4),
('JL00003', 'H0010', 27000, 45000, 1),
('JL00003', 'H0017', 24000, 42500, 1),
('JL00003', 'H0018', 20000, 26500, 3),
('JL00004', 'H0013', 165000, 200000, 1),
('JL00005', 'H0011', 27500, 50000, 4),
('JL00005', 'H0012', 25000, 45000, 1),
('JL00006', 'H0015', 22000, 40000, 4),
('JL00006', 'H0002', 85000, 100000, 1),
('JL00007', 'H0001', 37000, 50000, 1),
('JL00007', 'H0002', 85000, 100000, 1),
('JL00008', 'H0001', 37000, 50000, 1),
('JL00008', 'H0002', 85000, 100000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `kd_petugas` char(4) NOT NULL,
  `nm_petugas` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'Kasir'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`kd_petugas`, `nm_petugas`, `no_telepon`, `username`, `password`, `level`) VALUES
('P001', 'Bunafit Nugroho', '081192345111', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
('P002', 'Ayubi', '081192244563', 'Ayubi', '8b2bbde6474fbc9a837dc11226a65e21', 'Klinik'),
('P003', 'Yuda', '081193342223', 'Yuda', '5ca51e2d0fdad943412a140bf420646e', 'Apotek');

-- --------------------------------------------------------

--
-- Table structure for table `rawat`
--

CREATE TABLE `rawat` (
  `no_rawat` char(7) NOT NULL,
  `tgl_rawat` date NOT NULL,
  `nomor_rm` char(6) NOT NULL,
  `hasil_diagnosa` varchar(100) NOT NULL,
  `uang_bayar` int(12) NOT NULL,
  `kd_petugas` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rawat`
--

INSERT INTO `rawat` (`no_rawat`, `tgl_rawat`, `nomor_rm`, `hasil_diagnosa`, `uang_bayar`, `kd_petugas`) VALUES
('RP00001', '2014-01-05', 'RM0001', 'sakit gigi', 0, 'P001'),
('RP00002', '2014-01-11', 'RM0002', 'gigi kotor', 175000, 'P001'),
('RP00003', '2014-01-11', 'RM0003', 'tambal gigi', 100000, 'P001');

-- --------------------------------------------------------

--
-- Table structure for table `rawat_tindakan`
--

CREATE TABLE `rawat_tindakan` (
  `id_tindakan` int(7) NOT NULL,
  `tgl_tindakan` date NOT NULL,
  `no_rawat` char(7) NOT NULL,
  `kd_tindakan` char(4) NOT NULL,
  `harga` int(10) NOT NULL,
  `kd_dokter` char(4) NOT NULL,
  `bagi_hasil_dokter` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rawat_tindakan`
--

INSERT INTO `rawat_tindakan` (`id_tindakan`, `tgl_tindakan`, `no_rawat`, `kd_tindakan`, `harga`, `kd_dokter`, `bagi_hasil_dokter`) VALUES
(1, '2014-01-05', 'RP00001', 'T001', 50000, 'D001', 10),
(2, '2014-01-05', 'RP00001', 'T022', 100000, 'D001', 10),
(3, '2014-01-05', 'RP00001', 'T023', 125000, 'D002', 10),
(5, '2014-01-11', 'RP00002', 'T002', 175000, 'D001', 10),
(6, '2014-01-11', 'RP00003', 'T005', 100000, 'D002', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

CREATE TABLE `tindakan` (
  `kd_tindakan` char(4) NOT NULL,
  `nm_tindakan` varchar(100) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tindakan`
--

INSERT INTO `tindakan` (`kd_tindakan`, `nm_tindakan`, `harga`) VALUES
('T001', 'KONSULTASI / PREMEDIKASI ', 55000),
('T002', 'SCALLING - Pembersihan Karang Gigi - Sedikit', 175000),
('T003', 'SCALLING - Pembersihan Karang Gigi - Sedang', 200000),
('T004', 'SCALLING - Pembersihan Karang Gigi - Banyak', 250000),
('T005', 'PENAMBALAN - Penambalan Sementara', 100000),
('T006', 'PENAMBALAN - Preparasi (Sterilisiasi Saluran Akar)', 125000),
('T007', 'PENAMBALAN - Bongkar Tambalan (Open Bur)', 100000),
('T008', 'PENAMBALAN - Pengisian Saluran Akar', 150000),
('T009', 'PENAMBALAN - Tambal Amalgam', 150000),
('T010', 'PENAMBALAN - Tambal Puji (GIC) - Anak', 175000),
('T011', 'PENAMBALAN - Tambal Puji (GIC) - Dewasa', 200000),
('T012', 'PENAMBALAN - Tambal Sinar (Composite) - Kecil', 175000),
('T013', 'PENAMBALAN - Tambal Sinar (Composite) - Sedang', 200000),
('T014', 'PENAMBALAN - Tambal Sinar (Composite) - Besar', 250000),
('T015', 'PENAMBALAN - Tambal Sinar (Composite) - Selubung/Dibentuk', 300000),
('T016', 'PENAMBALAN - Pengisian Saluran Akar + Tambal Puji', 300000),
('T017', 'PENAMBALAN - Pengisian Saluran Akar + Tambal Sinar', 350000),
('T018', 'PENAMBALAN - Pengisian Saluran Akar + Tambal Metode Sandwich', 400000),
('T019', 'PENAMBALAN - Pasak', 150000),
('T020', 'PENAMBALAN - Inlay/Onlay dari Bahan Metal + Cetak', 1000000),
('T021', 'PENAMBALAN - Inlay/Onlay dari Bahan Metal Porselin + Cetak', 1500000),
('T022', 'PENCABUTAN GIGI - Gigi Susu dg Anestesi Chlor Ethyl (Tanpa Suntik)', 100000),
('T023', 'PENCABUTAN GIGI - Gigi Susu dg Anestesi PH Cain (Dengan Suntik)', 125000),
('T024', 'PENCABUTAN GIGI - Gigi Dewasa (Sisa Akar / Akar Satu)', 150000),
('T025', 'PENCABUTAN GIGI - Gigi Dewasa (Lebih dari Satu Akar)', 200000),
('T026', 'PENCABUTAN GIGI - Gigi Dewasa dg Faktor Penyulit (Komplikasi)', 400000),
('T027', 'Batal Setelah Anestesis', 120000);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_penjualan`
--

CREATE TABLE `tmp_penjualan` (
  `id` int(10) NOT NULL,
  `kd_obat` char(5) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `kd_petugas` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_rawat`
--

CREATE TABLE `tmp_rawat` (
  `id` int(10) NOT NULL,
  `kd_tindakan` char(4) NOT NULL,
  `harga` int(12) NOT NULL,
  `kd_dokter` char(4) NOT NULL,
  `bagi_hasil_dokter` int(4) NOT NULL,
  `kd_petugas` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`kd_dokter`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`kd_obat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`nomor_rm`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`no_daftar`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`no_penjualan`);

--
-- Indexes for table `penjualan_item`
--
ALTER TABLE `penjualan_item`
  ADD KEY `nomor_penjualan_tamu` (`no_penjualan`,`kd_obat`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`kd_petugas`);

--
-- Indexes for table `rawat`
--
ALTER TABLE `rawat`
  ADD PRIMARY KEY (`no_rawat`);

--
-- Indexes for table `rawat_tindakan`
--
ALTER TABLE `rawat_tindakan`
  ADD PRIMARY KEY (`id_tindakan`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`kd_tindakan`);

--
-- Indexes for table `tmp_penjualan`
--
ALTER TABLE `tmp_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmp_rawat`
--
ALTER TABLE `tmp_rawat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rawat_tindakan`
--
ALTER TABLE `rawat_tindakan`
  MODIFY `id_tindakan` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tmp_penjualan`
--
ALTER TABLE `tmp_penjualan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tmp_rawat`
--
ALTER TABLE `tmp_rawat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
