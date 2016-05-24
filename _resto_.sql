-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24 Okt 2015 pada 11.02
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `.resto.`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `_akses`
--

CREATE TABLE IF NOT EXISTS `_akses` (
`id` int(3) unsigned NOT NULL,
  `nama` varchar(45) NOT NULL DEFAULT '',
  `jabatan` varchar(25) NOT NULL DEFAULT '',
  `id_cab` int(2) unsigned NOT NULL DEFAULT '0',
  `user_name` varchar(25) NOT NULL DEFAULT '',
  `password` varchar(45) NOT NULL DEFAULT '',
  `ontime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `blok` varchar(1) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COMMENT='tabel pegawai yang memperoleh akses';

--
-- Dumping data untuk tabel `_akses`
--

INSERT INTO `_akses` (`id`, `nama`, `jabatan`, `id_cab`, `user_name`, `password`, `ontime`, `blok`) VALUES
(1, 'Dedi Rudiyanto', 'Admin', 0, 'admin', '305', '2015-10-24 05:59:48', '0'),
(2, 'Sutati', 'Monitoring', 1, 'tati', '305', '2015-10-22 02:12:55', '0'),
(3, 'Yuli', 'Monitoring', 2, 'yuli', '305', '2015-10-11 15:35:06', '0'),
(4, 'Akiyah', 'Monitoring', 3, 'aki', '305', '2015-10-11 14:56:55', '0'),
(5, 'Urip', 'Kasir', 1, 'urip', '305', '2015-10-23 01:50:16', '0'),
(6, 'Wartawati', 'Kasir', 2, 'wati', '305', '2015-10-11 14:07:42', '0'),
(7, 'Zuliyanto', 'Kasir', 3, 'zul', '305', '2015-10-05 21:51:00', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `_cabang`
--

CREATE TABLE IF NOT EXISTS `_cabang` (
`id_cab` int(2) unsigned NOT NULL,
  `namacab` varchar(45) NOT NULL DEFAULT '',
  `kota` varchar(20) NOT NULL DEFAULT '',
  `alamat` varchar(225) NOT NULL,
  `pegawai` int(2) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='tabel cabang';

--
-- Dumping data untuk tabel `_cabang`
--

INSERT INTO `_cabang` (`id_cab`, `namacab`, `kota`, `alamat`, `pegawai`) VALUES
(1, 'AnyFoods Resto CSB Mall', 'Cirebon', 'Jl Ciptomangunkusumo', 14),
(2, 'AnyFoods Resto Grage City Mall', 'Cirebon', 'Jl Fly Over Pegambiran', 10),
(3, 'AnyFoods Resto Tuparev', 'Cirebon', 'Jl. Tuparev', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `_log`
--

CREATE TABLE IF NOT EXISTS `_log` (
`n` int(10) unsigned NOT NULL,
  `id_user` int(3) NOT NULL,
  `tgl` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(50) NOT NULL DEFAULT '',
  `tamu` varchar(50) NOT NULL DEFAULT '',
  `browser` varchar(350) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Catatan Login';

-- --------------------------------------------------------

--
-- Struktur dari tabel `_log_meja`
--

CREATE TABLE IF NOT EXISTS `_log_meja` (
`n` int(10) unsigned NOT NULL,
  `id_cab` int(2) NOT NULL,
  `id_meja` int(3) NOT NULL DEFAULT '0',
  `tgl` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(50) NOT NULL DEFAULT '',
  `tamu` varchar(50) NOT NULL DEFAULT '',
  `browser` varchar(350) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Catatan Login';

-- --------------------------------------------------------

--
-- Struktur dari tabel `_meja`
--

CREATE TABLE IF NOT EXISTS `_meja` (
`id` int(3) unsigned NOT NULL,
  `id_cab` int(2) unsigned NOT NULL DEFAULT '0',
  `meja` int(2) unsigned NOT NULL DEFAULT '0',
  `pass` varchar(50) NOT NULL DEFAULT '',
  `blok` varchar(1) NOT NULL DEFAULT '',
  `ontime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `jml_kursi` int(2) NOT NULL DEFAULT '0',
  `passout` int(6) unsigned NOT NULL DEFAULT '0',
  `visitor_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `_meja`
--

INSERT INTO `_meja` (`id`, `id_cab`, `meja`, `pass`, `blok`, `ontime`, `jml_kursi`, `passout`, `visitor_time`) VALUES
(1, 1, 1, '305', '0', '0000-00-00 00:00:00', 4, 249, '2015-10-22 11:15:09'),
(2, 1, 2, '305', '0', '0000-00-00 00:00:00', 4, 249, '2015-10-24 05:41:38'),
(3, 1, 3, '305', '0', '0000-00-00 00:00:00', 4, 249, '2015-10-23 13:43:40'),
(4, 1, 4, '305', '0', '0000-00-00 00:00:00', 4, 249, '2015-10-24 05:59:19'),
(5, 1, 5, '305', '0', '0000-00-00 00:00:00', 4, 249, '2015-10-17 11:20:40'),
(6, 1, 6, '305', '0', '0000-00-00 00:00:00', 4, 249, '2015-10-17 20:45:21'),
(7, 1, 7, '305', '0', '0000-00-00 00:00:00', 5, 249, '2015-10-23 20:29:46'),
(8, 1, 8, '305', '0', '2015-10-08 15:53:55', 6, 249, '0000-00-00 00:00:00'),
(9, 1, 9, '305', '0', '0000-00-00 00:00:00', 5, 249, '0000-00-00 00:00:00'),
(10, 1, 10, '305', '0', '0000-00-00 00:00:00', 4, 249, '2015-10-18 00:39:39'),
(11, 2, 1, '305', '0', '2015-10-06 21:51:00', 4, 249, '0000-00-00 00:00:00'),
(12, 2, 2, '305', '0', '2015-10-08 23:30:43', 4, 249, '0000-00-00 00:00:00'),
(13, 2, 3, '305', '0', '0000-00-00 00:00:00', 4, 249, '0000-00-00 00:00:00'),
(14, 2, 4, '305', '0', '2015-10-08 17:33:56', 4, 249, '0000-00-00 00:00:00'),
(15, 2, 5, '305', '0', '2015-10-08 16:04:41', 4, 249, '0000-00-00 00:00:00'),
(16, 2, 6, '305', '0', '0000-00-00 00:00:00', 4, 249, '0000-00-00 00:00:00'),
(17, 2, 7, '305', '0', '2015-10-07 23:47:05', 4, 249, '0000-00-00 00:00:00'),
(18, 2, 8, '305', '0', '2015-09-30 23:51:00', 4, 249, '0000-00-00 00:00:00'),
(19, 3, 1, '305', '0', '2015-10-08 15:26:20', 5, 249, '0000-00-00 00:00:00'),
(20, 3, 2, '305', '0', '0000-00-00 00:00:00', 4, 249, '0000-00-00 00:00:00'),
(21, 3, 3, '0520520575497649', '0', '2015-09-30 23:51:00', 4, 249, '0000-00-00 00:00:00'),
(22, 3, 4, '305', '1', '0000-00-00 00:00:00', 4, 249, '0000-00-00 00:00:00'),
(23, 3, 5, '305', '1', '2015-09-30 23:51:00', 4, 249, '0000-00-00 00:00:00'),
(24, 3, 6, '305', '1', '2015-10-05 21:51:00', 5, 249, '0000-00-00 00:00:00'),
(25, 3, 7, '305', '1', '2015-10-05 21:51:00', 6, 249, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `_menu`
--

CREATE TABLE IF NOT EXISTS `_menu` (
`id_menu` int(3) unsigned NOT NULL,
  `jenis` int(2) unsigned NOT NULL DEFAULT '0',
  `nama` varchar(50) NOT NULL DEFAULT '',
  `harga` int(5) unsigned NOT NULL DEFAULT '0',
  `gambar` varchar(250) NOT NULL DEFAULT '',
  `urutan` int(4) unsigned NOT NULL DEFAULT '0',
  `id_cab` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1 COMMENT='menu makanan';

--
-- Dumping data untuk tabel `_menu`
--

INSERT INTO `_menu` (`id_menu`, `jenis`, `nama`, `harga`, `gambar`, `urutan`, `id_cab`) VALUES
(1, 1, 'Ayam Balado', 25000, 'ayam_balado_1176617994.jpg?lastmod=20151005_094032', 1, '1_,2_,3_'),
(2, 1, 'Ayam Bakar', 20000, 'ayam_bakar_664927083.jpg?lastmod=20151005_094152', 17, '1_,2_,3_'),
(3, 2, 'Aqua Botol', 3500, 'botol_aqua_1183072761.jpg?lastmod=20151005_103219', 1, '1_,2_,3_'),
(4, 2, 'Coca Cola', 4000, 'coca-cola_531270371.png?lastmod=20151005_103517', 18, '1_,2_,3_'),
(5, 2, 'Jus Jambu', 5000, 'jus_jambu_1111726068.jpg?lastmod=20151005_103240', 3, '1_,2_,3_'),
(6, 2, 'Jus Jeruk Manis', 5000, 'jus-jeruk_730163264.jpg?lastmod=20151005_103249', 4, '1_,2_,3_'),
(7, 2, 'Jus Mangga', 5000, 'jus_mangga_979102118.jpg?lastmod=20151005_103259', 5, '1_,2_,3_'),
(8, 2, 'Jus Strawberry', 4000, 'jus_stawberry_242613182.jpg?lastmod=20151005_103307', 6, '1_,2_,3_'),
(9, 2, 'Jus Melon', 4000, 'jus_melon_1110176924.png?lastmod=20151005_103322', 7, '1_,2_,3_'),
(10, 2, 'Jus Mentimun', 3000, 'jus_mentimun_manis_649435642.jpg?lastmod=20151005_103331', 8, '1_,2_,3_'),
(11, 2, 'Jus Semangka', 4000, 'jus_semangka_375796545.jpg?lastmod=20151005_103340', 9, '1_,2_,3_'),
(12, 2, 'Jus Srikaya', 5000, 'jus_srikaya_138476272.jpg?lastmod=20151005_103348', 10, '1_,2_,3_'),
(13, 2, 'Jus Tomat', 5000, 'jus_tomat_70356962.jpg?lastmod=20151005_103357', 11, '1_,2_,3_'),
(14, 2, 'Jus Alpukat', 5000, 'jus-alpukat_202421499.jpg?lastmod=20151005_103406', 12, '1_,2_,3_'),
(15, 2, 'Jus Lemon', 5000, 'jus-lemon_739156906.jpg?lastmod=20151005_103415', 13, '1_,2_,3_'),
(16, 2, 'Jus Sirsak', 5000, 'jus-sirsak_1056085975.jpg?lastmod=20151005_103433', 14, '1_,2_,3_'),
(17, 2, 'Teh Botol Sosro', 3500, 'sosro-tehbotol-reguler-pet-500ml_415816102.jpg?lastmod=20151005_103455', 15, '1_,2_,3_'),
(18, 2, 'Sprite', 3000, 'sprite_1283896225.jpg?lastmod=20151005_103506', 16, '1_,2_,3_'),
(19, 2, 'Es Teh Manis', 3000, 'es_teh_manis_1320085953.jpg?lastmod=20151005_103227', 2, '1_,2_,3_'),
(20, 2, 'Susu Sapi', 4000, 'susu_307505108.png?lastmod=20151005_103533', 20, '1_,2_,3_'),
(21, 1, 'Ayam Goreng', 15000, 'ayam_goreng_451747639.jpg', 18, '1_,2_,3_'),
(22, 1, 'Ayam Padeh (ayam pedas)', 10000, 'asam_padeh_(asam_pedas)_727882579.jpg', 19, '1_,2_,3_'),
(23, 1, 'Gulai Ayam', 15000, 'gulai_ayam_311894350.jpg', 20, '1_,2_,3_'),
(24, 1, 'Bacchus Cuisine', 20000, 'bacchus-cuisine_333625400.jpg', 21, '1_,2_,3_'),
(25, 1, 'Bakso Urat', 10000, 'bakso-urat_917695766.jpg', 22, '1_,2_,3_'),
(26, 1, 'Crab Meat Mari', 15000, 'crab-meat-mari_1194519215.jpg', 23, '1_,2_,3_'),
(27, 1, 'Dengdeng Balado', 10000, 'dendeng_balado_501062060.jpg', 24, '1_,2_,3_'),
(28, 1, 'Beafsteak Daging Sapi', 20000, 'fine-food-restaurant_947602854.jpg', 25, '1_,2_,3_'),
(29, 1, 'Udang-Udangan', 10000, 'udang-udangan_951260556.jpg', 26, '1_,2_,3_'),
(30, 1, 'Gulai Kepala Kakap', 10000, 'gulai_kepala_kakap_1063530473.jpg', 27, '1_,2_,3_'),
(31, 1, 'Gulai Tunjang - Kikil', 10000, 'gulai_tunjang_-_kikil_412072337.jpg', 28, '1_,2_,3_'),
(32, 1, 'Ikan Bakar', 10000, 'ikan-bakar_853793571.jpg', 29, '1_,2_,3_'),
(33, 1, 'Pecel Lele', 10000, 'pecel-lele_1389668343.jpg', 30, '1_,2_,3_'),
(34, 1, 'Japanese Pan Noodles', 10000, 'japanese-pan-noodles_1348400865.png', 31, '1_,2_,3_'),
(35, 1, 'Orari Beaf And Loabster', 20000, 'kingston-food-two_529635163.jpg', 32, '1_,2_,3_'),
(36, 1, 'Beafsteack Cocoldrows', 20000, 'kitchen3_713165710.jpg', 33, '1_,2_,3_'),
(37, 1, 'Nasi Goreng Telor', 10000, 'nasi_goreng_955047353.jpg', 34, '1_,2_,3_'),
(38, 1, 'Nasi Putih', 6000, 'nasi-putih-porsi_947516791.jpg', 35, '1_,2_,3_'),
(39, 1, 'Rendang Daging', 10000, 'rendang_daging_633427820.jpg', 36, '1_,2_,3_'),
(40, 1, 'Rydges', 10000, 'rydges_481654727.jpg', 37, '1_,2_,3_'),
(41, 1, 'Salmon', 15000, 'salmon_484623920.jpg', 38, '1_,2_,3_'),
(42, 1, 'Sirip Ikan Hiu', 20000, 'sirip_ikan_hiu_874362763.jpg', 39, '1_,2_,3_'),
(43, 1, 'Sop Buntut Kuah', 15000, 'sop_buntut_kuah_1208160290.jpg', 40, '1_,2_,3_'),
(44, 1, 'Spageti Sambal Pedas', 20000, 'spageti_820228782.jpg', 41, '1_,2_,3_'),
(45, 1, 'Tahu Tempe', 5000, 'tempe_tahu_110591677.jpg', 42, '1_,2_,3_'),
(46, 2, 'Kopi Hitam', 5000, 'kopi_hitam_862529023.jpg', 21, '1_,2_,3_'),
(47, 2, 'Kopi Susu', 6000, 'kopi_susu_513153991.jpg', 22, '1_,2_,3_'),
(48, 2, 'Pocari Sweat Pet 350 ml', 2000, 'pocari_sweat_pet_350ml_1186041954.jpg', 23, '1_,2_,3_'),
(49, 2, 'Pocari Sweat Pet 500 ml', 3000, 'pocari_sweat_pet_500ml_921009214.jpg', 24, '1_,2_,3_'),
(50, 2, 'Frestea Green Tea', 4500, 'frestea-green-tea-pet-750ml_35458187.jpg', 25, '1_,2_,3_'),
(51, 2, 'Frestea Apel', 4500, 'frestea_apel_500ml_342231756.jpg', 26, '1_,2_,3_'),
(52, 2, 'Frestea Jasmin', 4500, 'frestea-jasmine-botol-500ml_269465014.jpg', 27, '1_,2_,3_'),
(53, 2, 'Frestea Madu', 4500, 'frestea-madu-pet-750ml_159346685.jpg', 28, '1_,2_,3_'),
(54, 3, 'Pumpkin Cake', 10000, 'pumpkin-cake_296230782.jpg', 1, '1_,2_,3_'),
(55, 3, 'Ice Cream', 10000, 'ice_cream_300749119.jpg', 2, '1_,2_,3_'),
(56, 3, 'Creme Caramel', 15000, 'creme-caramel_771215583.jpg', 3, '1_,2_,3_'),
(57, 3, 'Mini Raspberry Chocolate', 8000, 'mini-raspberry-chocolate-nests_298253275.jpg', 4, '1_,2_,3_'),
(58, 3, 'Petitecakes', 8000, 'petitecakes_14458678.jpg', 5, '1_,2_,3_'),
(59, 3, 'Cup Of Ice Cream', 12000, 'cup_of_ice_cream_344641536.jpg', 6, '1_,2_,3_'),
(60, 3, 'Vienna Cake', 10000, 'vienna-cake_708389182.jpg', 7, '1_,2_,3_'),
(61, 3, 'Classic Bumble Cake', 10000, 'classic-bumble-cake_941148087.jpg', 8, '1_,2_,3_'),
(62, 3, 'Rosteme Cake', 10000, 'slice-of-flourless-chocolate-cake2_1084917268.jpg', 9, '1_,2_,3_'),
(63, 3, 'Cheetos Crunchy', 5000, 'cheetos_crunchy_1134877166.jpg', 10, '1_,2_,3_'),
(64, 3, 'Lays Classic', 5000, 'lays-classic_213179444.png', 11, '1_,2_,3_'),
(65, 3, 'Kacang Garuda', 5000, 'kacang-garuda_986417521.jpg', 12, '1_,2_,3_'),
(66, 3, 'Kacang Atom', 4000, 'kacang_atom_467153017.jpg', 13, '1_,2_,3_'),
(67, 3, 'Emping', 2000, 'emping_1217326059.jpg', 14, '1_,2_,3_'),
(68, 3, 'Kerupuk', 1000, 'kerupuk-_122812703.jpg', 15, '1_,2_,3_'),
(69, 3, 'Kerupuk Ikan', 1000, 'kerupuk-ikan-matang_37480681.jpg', 16, '1_,2_,3_'),
(70, 3, 'Kerupuk Udang', 1000, 'krupuk_udang_55941315.jpg', 17, '1_,2_,3_'),
(71, 3, 'Kerupuk Putih', 1000, 'kerupuk_putih_1252956374.jpg', 18, '1_,2_,3_');

-- --------------------------------------------------------

--
-- Struktur dari tabel `_notif`
--

CREATE TABLE IF NOT EXISTS `_notif` (
`id` int(10) unsigned NOT NULL,
  `cab` int(3) unsigned NOT NULL DEFAULT '0',
  `meja` int(2) unsigned NOT NULL DEFAULT '0',
  `diload` varchar(1) NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `_notif`
--

INSERT INTO `_notif` (`id`, `cab`, `meja`, `diload`) VALUES
(1, 1, 2, '1'),
(2, 1, 1, '1'),
(3, 1, 4, '1'),
(4, 1, 6, '1'),
(5, 1, 6, '1'),
(6, 1, 6, '1'),
(7, 1, 6, '1'),
(8, 1, 6, '1'),
(9, 1, 10, '1'),
(10, 1, 10, '1'),
(11, 1, 10, '1'),
(12, 1, 10, '1'),
(13, 1, 3, '1'),
(14, 1, 3, '1'),
(15, 1, 3, '1'),
(16, 1, 3, '1'),
(17, 1, 3, '1'),
(18, 1, 3, '1'),
(19, 1, 2, '1'),
(20, 1, 2, '1'),
(21, 1, 1, '1'),
(22, 1, 2, '1'),
(23, 1, 2, '1'),
(24, 1, 1, '0'),
(25, 1, 2, '0'),
(26, 1, 3, '0'),
(27, 1, 3, '0'),
(28, 1, 2, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `_order`
--

CREATE TABLE IF NOT EXISTS `_order` (
  `id_order` varchar(15) NOT NULL DEFAULT '' COMMENT 'ex : 1.1.001',
  `meja` varchar(3) NOT NULL DEFAULT '',
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  `jam_on` time NOT NULL DEFAULT '00:00:00',
  `diupdate` time NOT NULL DEFAULT '00:00:00',
  `selesai` varchar(1) NOT NULL DEFAULT '0',
  `total` int(7) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `_order`
--

INSERT INTO `_order` (`id_order`, `meja`, `tgl`, `jam_on`, `diupdate`, `selesai`, `total`) VALUES
('1.6.001', '6', '2015-10-22', '19:32:08', '20:45:16', '1', 5000),
('1.4.006', '4', '2015-10-22', '19:28:51', '19:28:55', '1', 15000),
('1.1.001', '1', '2015-10-21', '19:27:03', '19:27:07', '1', 20000),
('1.2.001', '2', '2015-10-21', '17:08:59', '19:26:43', '1', 10000),
('1.4.001', '4', '2015-10-21', '13:13:42', '14:58:27', '1', 3000),
('1.4.002', '4', '2015-10-21', '15:04:20', '15:04:25', '1', 50000),
('1.4.003', '4', '2015-10-21', '15:04:31', '15:04:38', '1', 10000),
('1.4.004', '4', '2015-10-21', '15:04:44', '15:04:52', '1', 5000),
('1.4.005', '4', '2015-10-21', '15:04:55', '15:05:01', '1', 20000),
('1.10.001', '10', '2015-10-21', '20:45:32', '23:12:53', '1', 5000),
('1.3.001', '3', '2015-10-21', '19:05:12', '21:13:59', '1', 15000),
('1.2.002', '2', '2015-10-21', '10:54:05', '10:57:05', '1', 30000),
('1.2.003', '2', '2015-10-21', '11:05:24', '11:05:34', '0', 46000),
('1.1.002', '1', '2015-10-21', '00:43:39', '00:43:56', '1', 73000),
('1.2.004', '2', '2015-10-21', '10:49:27', '11:40:30', '1', 40000),
('1.2.005', '2', '2015-10-11', '15:12:41', '15:52:14', '1', 20000),
('1.1.003', '1', '2015-10-22', '10:42:48', '10:43:07', '1', 64500),
('1.3.002', '3', '2015-10-22', '22:19:14', '22:19:14', '0', 0),
('1.2.006', '2', '2015-10-23', '10:15:10', '13:30:19', '1', 55000),
('1.3.003', '3', '2015-10-23', '13:33:16', '13:33:24', '1', 30000),
('1.3.004', '3', '2015-10-23', '13:42:20', '13:43:30', '1', 20000),
('1.2.007', '2', '2015-10-24', '05:10:13', '05:18:44', '1', 29000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `_order_detail`
--

CREATE TABLE IF NOT EXISTS `_order_detail` (
`id` int(10) unsigned NOT NULL,
  `id_order` varchar(15) NOT NULL DEFAULT '',
  `id_menu` int(3) NOT NULL DEFAULT '0',
  `nama_menu` varchar(35) NOT NULL DEFAULT '',
  `harga` int(10) unsigned NOT NULL DEFAULT '0',
  `qty` int(10) unsigned NOT NULL DEFAULT '0',
  `sub_total` int(10) unsigned NOT NULL DEFAULT '0',
  `itm_baru` varchar(1) NOT NULL DEFAULT '0',
  `jam` time NOT NULL DEFAULT '00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `_order_detail`
--

INSERT INTO `_order_detail` (`id`, `id_order`, `id_menu`, `nama_menu`, `harga`, `qty`, `sub_total`, `itm_baru`, `jam`) VALUES
(11, '1.4.005', 22, 'Ayam Padeh (ayam pedas)', 10000, 2, 20000, '0', '15:05:01'),
(10, '1.4.004', 7, 'Jus Mangga', 5000, 1, 5000, '0', '15:04:52'),
(9, '1.4.003', 55, 'Ice Cream', 10000, 1, 10000, '0', '15:04:38'),
(8, '1.4.002', 1, 'Ayam Balado', 25000, 2, 50000, '0', '15:04:25'),
(7, '1.4.001', 19, 'Es Teh Manis', 3000, 1, 3000, '0', '14:58:27'),
(12, '1.2.001', 21, 'Ayam Goreng', 15000, 1, 15000, '0', '17:09:09'),
(13, '1.2.001', 6, 'Jus Jeruk Manis', 5000, 2, 10000, '0', '17:11:42'),
(14, '1.2.001', 21, 'Ayam Goreng', 15000, 1, 15000, '0', '17:37:12'),
(15, '1.2.001', 23, 'Gulai Ayam', 15000, 1, 15000, '0', '17:38:38'),
(16, '1.2.001', 54, 'Pumpkin Cake', 10000, 1, 10000, '0', '19:21:17'),
(17, '1.2.001', 58, 'Petitecakes', 8000, 1, 8000, '0', '19:22:03'),
(18, '1.2.001', 21, 'Ayam Goreng', 15000, 1, 15000, '0', '19:26:29'),
(19, '1.2.001', 22, 'Ayam Padeh (ayam pedas)', 10000, 1, 10000, '0', '19:26:43'),
(20, '1.1.001', 2, 'Ayam Bakar', 20000, 1, 20000, '0', '19:27:07'),
(21, '1.4.006', 21, 'Ayam Goreng', 15000, 1, 15000, '0', '19:28:55'),
(22, '1.6.001', 2, 'Ayam Bakar', 20000, 1, 20000, '0', '19:32:12'),
(23, '1.6.001', 3, 'Aqua Botol', 3500, 1, 3500, '0', '20:42:18'),
(24, '1.6.001', 55, 'Ice Cream', 10000, 1, 10000, '0', '20:43:17'),
(25, '1.6.001', 47, 'Kopi Susu', 6000, 1, 6000, '0', '20:44:33'),
(26, '1.6.001', 63, 'Cheetos Crunchy', 5000, 1, 5000, '0', '20:45:16'),
(27, '1.10.001', 25, 'Bakso Urat', 10000, 1, 10000, '0', '20:45:41'),
(28, '1.10.001', 26, 'Crab Meat Mari', 15000, 1, 15000, '0', '20:45:41'),
(29, '1.10.001', 32, 'Ikan Bakar', 10000, 1, 10000, '0', '20:56:02'),
(30, '1.10.001', 54, 'Pumpkin Cake', 10000, 1, 10000, '0', '20:56:46'),
(31, '1.10.001', 5, 'Jus Jambu', 5000, 1, 5000, '0', '23:42:53'),
(32, '1.3.001', 1, 'Ayam Balado', 25000, 1, 25000, '0', '20:50:52'),
(33, '1.3.001', 8, 'Jus Strawberry', 4000, 2, 8000, '0', '20:51:00'),
(34, '1.3.001', 1, 'Ayam Balado', 25000, 1, 25000, '0', '20:52:03'),
(35, '1.3.001', 2, 'Ayam Bakar', 20000, 1, 20000, '0', '20:52:03'),
(36, '1.3.001', 54, 'Pumpkin Cake', 10000, 1, 10000, '0', '20:52:03'),
(37, '1.3.001', 1, 'Ayam Balado', 25000, 2, 50000, '0', '20:56:26'),
(38, '1.3.001', 2, 'Ayam Bakar', 20000, 1, 20000, '0', '20:56:26'),
(39, '1.3.001', 21, 'Ayam Goreng', 15000, 2, 30000, '0', '20:56:26'),
(40, '1.3.001', 19, 'Es Teh Manis', 3000, 2, 6000, '0', '20:56:26'),
(41, '1.3.001', 22, 'Ayam Padeh (ayam pedas)', 10000, 1, 10000, '0', '20:58:26'),
(42, '1.3.001', 23, 'Gulai Ayam', 15000, 1, 15000, '0', '21:13:59'),
(43, '1.2.002', 37, 'Nasi Goreng Telor', 10000, 2, 20000, '0', '10:57:05'),
(44, '1.2.002', 16, 'Jus Sirsak', 5000, 1, 5000, '0', '10:57:05'),
(45, '1.2.002', 7, 'Jus Mangga', 5000, 1, 5000, '0', '10:57:05'),
(46, '1.2.003', 2, 'Ayam Bakar', 20000, 2, 40000, '1', '11:05:34'),
(47, '1.2.003', 19, 'Es Teh Manis', 3000, 2, 6000, '1', '11:05:34'),
(48, '1.1.002', 1, 'Ayam Balado', 25000, 2, 50000, '0', '00:43:56'),
(49, '1.1.002', 21, 'Ayam Goreng', 15000, 1, 15000, '0', '00:43:56'),
(50, '1.1.002', 19, 'Es Teh Manis', 3000, 1, 3000, '0', '00:43:56'),
(51, '1.1.002', 5, 'Jus Jambu', 5000, 1, 5000, '0', '00:43:56'),
(52, '1.2.004', 26, 'Crab Meat Mari', 15000, 2, 30000, '0', '11:40:30'),
(53, '1.2.004', 6, 'Jus Jeruk Manis', 5000, 2, 10000, '0', '11:40:30'),
(54, '1.2.005', 40, 'Rydges', 10000, 2, 20000, '0', '15:52:14'),
(55, '1.1.003', 2, 'Ayam Bakar', 20000, 2, 40000, '1', '10:43:07'),
(56, '1.1.003', 21, 'Ayam Goreng', 15000, 1, 15000, '1', '10:43:07'),
(57, '1.1.003', 3, 'Aqua Botol', 3500, 1, 3500, '1', '10:43:07'),
(58, '1.1.003', 19, 'Es Teh Manis', 3000, 2, 6000, '1', '10:43:07'),
(59, '1.2.006', 1, 'Ayam Balado', 25000, 1, 25000, '1', '13:30:19'),
(60, '1.2.006', 24, 'Bacchus Cuisine', 20000, 1, 20000, '1', '13:30:19'),
(61, '1.2.006', 19, 'Es Teh Manis', 3000, 2, 6000, '1', '13:30:19'),
(62, '1.2.006', 8, 'Jus Strawberry', 4000, 1, 4000, '1', '13:30:19'),
(63, '1.3.003', 23, 'Gulai Ayam', 15000, 2, 30000, '1', '13:33:24'),
(64, '1.3.004', 54, 'Pumpkin Cake', 10000, 2, 20000, '1', '13:43:30'),
(65, '1.2.007', 25, 'Bakso Urat', 10000, 2, 20000, '1', '05:18:44'),
(66, '1.2.007', 7, 'Jus Mangga', 5000, 1, 5000, '1', '05:18:44'),
(67, '1.2.007', 8, 'Jus Strawberry', 4000, 1, 4000, '1', '05:18:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `_penjualan`
--

CREATE TABLE IF NOT EXISTS `_penjualan` (
`id_penjualan` int(10) unsigned NOT NULL,
  `nofaktur` varchar(20) NOT NULL DEFAULT '' COMMENT 'ex: 20150819.1.1.001',
  `no_jual` varchar(15) NOT NULL DEFAULT '' COMMENT 'ex: 1.1.001',
  `tanggal` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `total` int(7) unsigned NOT NULL DEFAULT '0',
  `byar` int(7) unsigned NOT NULL DEFAULT '0',
  `kembali` int(7) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `_penjualan`
--

INSERT INTO `_penjualan` (`id_penjualan`, `nofaktur`, `no_jual`, `tanggal`, `total`, `byar`, `kembali`) VALUES
(1, '20151022.1.2.004', '1.2.004', '2015-10-21 02:08:00', 40000, 40000, 0),
(2, '20151022.1.1.002', '1.1.002', '2015-10-22 02:09:00', 73000, 80000, 7000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `_penjualan_detail`
--

CREATE TABLE IF NOT EXISTS `_penjualan_detail` (
`id` int(10) unsigned NOT NULL,
  `nofaktur` varchar(16) NOT NULL DEFAULT '' COMMENT 'ex: 20150819.1.1.001',
  `id_menu` int(3) unsigned NOT NULL DEFAULT '0',
  `namamenu` varchar(30) NOT NULL DEFAULT '',
  `harga` int(5) unsigned NOT NULL DEFAULT '0',
  `jumlah` int(2) unsigned NOT NULL DEFAULT '0',
  `subtotal` int(7) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `_penjualan_detail`
--

INSERT INTO `_penjualan_detail` (`id`, `nofaktur`, `id_menu`, `namamenu`, `harga`, `jumlah`, `subtotal`) VALUES
(1, '20151022.1.2.004', 26, 'Crab Meat Mari', 15000, 2, 30000),
(2, '20151022.1.2.004', 6, 'Jus Jeruk Manis', 5000, 2, 10000),
(3, '20151022.1.1.002', 1, 'Ayam Balado', 25000, 2, 50000),
(4, '20151022.1.1.002', 21, 'Ayam Goreng', 15000, 1, 15000),
(5, '20151022.1.1.002', 19, 'Es Teh Manis', 3000, 1, 3000),
(6, '20151022.1.1.002', 5, 'Jus Jambu', 5000, 1, 5000),
(7, '20151022.1.1.002', 1, 'Ayam Balado', 25000, 2, 50000),
(8, '20151022.1.1.002', 21, 'Ayam Goreng', 15000, 1, 15000),
(9, '20151022.1.1.002', 19, 'Es Teh Manis', 3000, 1, 3000),
(10, '20151022.1.1.002', 5, 'Jus Jambu', 5000, 1, 5000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `_akses`
--
ALTER TABLE `_akses`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_cabang`
--
ALTER TABLE `_cabang`
 ADD PRIMARY KEY (`id_cab`);

--
-- Indexes for table `_log`
--
ALTER TABLE `_log`
 ADD PRIMARY KEY (`n`);

--
-- Indexes for table `_log_meja`
--
ALTER TABLE `_log_meja`
 ADD PRIMARY KEY (`n`);

--
-- Indexes for table `_meja`
--
ALTER TABLE `_meja`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_menu`
--
ALTER TABLE `_menu`
 ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `_notif`
--
ALTER TABLE `_notif`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_order`
--
ALTER TABLE `_order`
 ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `_order_detail`
--
ALTER TABLE `_order_detail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_penjualan`
--
ALTER TABLE `_penjualan`
 ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `_penjualan_detail`
--
ALTER TABLE `_penjualan_detail`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `_akses`
--
ALTER TABLE `_akses`
MODIFY `id` int(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `_cabang`
--
ALTER TABLE `_cabang`
MODIFY `id_cab` int(2) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `_log`
--
ALTER TABLE `_log`
MODIFY `n` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_log_meja`
--
ALTER TABLE `_log_meja`
MODIFY `n` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_meja`
--
ALTER TABLE `_meja`
MODIFY `id` int(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `_menu`
--
ALTER TABLE `_menu`
MODIFY `id_menu` int(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `_notif`
--
ALTER TABLE `_notif`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `_order_detail`
--
ALTER TABLE `_order_detail`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `_penjualan`
--
ALTER TABLE `_penjualan`
MODIFY `id_penjualan` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `_penjualan_detail`
--
ALTER TABLE `_penjualan_detail`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
