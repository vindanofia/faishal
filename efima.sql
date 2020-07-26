-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jul 2020 pada 16.12
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `efima`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_jenis_penghargaan`
--

CREATE TABLE `m_jenis_penghargaan` (
  `id_reward` int(11) NOT NULL,
  `nama_reward` varchar(100) NOT NULL,
  `point_reward` int(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_jenis_penghargaan`
--

INSERT INTO `m_jenis_penghargaan` (`id_reward`, `nama_reward`, `point_reward`, `created`, `deleted`, `updated`) VALUES
(3, 'Tindak penyelamatan pekerja yang mengalami insiden/accident', 30, '2020-06-26 16:11:46', 1, NULL),
(4, 'Tindak penanggulangan awal saat terjadi kebakaran', 30, '2020-06-26 16:11:57', 1, NULL),
(5, 'Mengamankan alat/mesin rusak yang memungkinkan terjadinya kecelakaan', 30, '2020-06-26 16:12:08', 1, NULL),
(6, 'dweee', 34, '2020-07-07 22:05:21', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_konten`
--

CREATE TABLE `m_konten` (
  `id_konten` int(11) NOT NULL,
  `judul_konten` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `deskripsi_konten` text NOT NULL,
  `deleted` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_konten`
--

INSERT INTO `m_konten` (`id_konten`, `judul_konten`, `foto`, `deskripsi_konten`, `deleted`, `created`, `updated`) VALUES
(1, 'Hari K3 Nasional', 'm (1).png', 'wukukukuhuwaa', 0, '2020-06-26 17:29:10', '2020-07-15 09:09:47'),
(2, 'Agenda PJA', '2e3ce18a1eb1c1c7a0cdef6028c82231.jpg', 'ydhajduegdhcbakdhue', 0, '2020-06-27 08:38:31', '2020-07-15 09:09:59'),
(3, 'Uhuyy', 'efima.png', 'udwahrerh ckaeuai', 0, '2020-06-28 12:47:29', '2020-07-07 17:10:31'),
(4, 'hhhh', 'images.jpg', 'kjdkshehwhdja', 0, '2020-07-03 21:25:08', '2020-07-07 17:10:29'),
(5, 'grd', 'WhatsApp Image 2020-06-28 at 11.19.30 PM.jpeg', 'heuhjadnmsdbhjejweka', 0, '2020-07-04 18:31:35', '2020-07-07 17:10:26'),
(6, 'Hari K3 Nasional huyyyyyy', '2e3ce18a1eb1c1c7a0cdef6028c82231.jpg', 'snmdsm', 0, '2020-07-07 22:10:11', '2020-07-15 09:10:19'),
(7, 'Hari K3 Nasionalhuyykds', '2e3ce18a1eb1c1c7a0cdef6028c82231.jpg', 'jewji', 0, '2020-07-07 22:10:47', '2020-07-16 13:34:03'),
(8, 'Hari K3 Nasional', '2e3ce18a1eb1c1c7a0cdef6028c82231.jpg', 'udwahrerh ckaeuai', 0, '2020-07-11 20:26:30', '2020-07-16 13:34:06'),
(9, 'Pergantian UU', '#LOGO PAS SIP TRANS.png', 'Alat pelindung diri (APD) adalah seperangkat perlengkapan yang berfungsi untuk melindungi penggunanya dari bahaya atau gangguan kesehatan tertentu, misalnya infeksi virus atau bakteri. Bila digunakan dengan benar, APD mampu menghalangi masuknya virus atau bakteri ke dalam tubuh melalui mulut, hidung, mata, atau kulit.', 0, '2020-07-11 23:14:13', '2020-07-16 13:34:10'),
(10, 'Uhuyy', 'Rumah-Tipe-45-Perumahan-Minimalis.jpg', 'heuhjadnmsdbhjejweka', 0, '2020-07-12 15:12:05', '2020-07-12 10:12:48'),
(11, 'Hari K3 Nasionalyyyyy', 'Rumah-Tipe-45-Perumahan-Minimalis.jpg', 'wukukukuhuwaa', 0, '2020-07-12 15:12:33', '2020-07-12 10:12:44'),
(12, 'Uhuyy', 'Rumah-Tipe-45-Perumahan-Minimalis.jpg', 'udwahrerh ckaeuai', 0, '2020-07-12 15:12:57', '2020-07-16 13:34:13'),
(13, 'Uhuyy', 'Rumah-Tipe-45-Perumahan-Minimalis.jpg', 'heuhjadnmsdbhjejweka', 0, '2020-07-12 15:37:01', '2020-07-16 13:34:16'),
(14, 'hhhh', 'm (1).png', 'udwahrerh ckaeuai', 0, '2020-07-15 14:10:33', '2020-07-16 13:34:18'),
(15, 'Hari K3 Nasional', 'm (1).png', 'heuhjadnmsdbhjejweka', 0, '2020-07-15 14:16:54', '2020-07-16 13:34:21'),
(16, 'Agenda PJA', 'm (1).png', 'udwahrerh ckaeuai', 0, '2020-07-15 14:38:10', '2020-07-16 13:34:23'),
(17, 'Hari K3 Nasional', 'konten-200715-1fd0cdb610.png', 'heuhjadnmsdbhjejweka', 0, '2020-07-15 14:59:32', '2020-07-17 06:02:59'),
(18, 'Update Corona COVID-19 di Jawa Timur pada 16 Juli 2020', 'konten-200717-e296cbb154.jpg', 'Pemerintah Provinsi Jawa Timur (Jatim) lewat laman resmi untuk mengantisipasi penyebaran pandemi virus corona baru (Sars-CoV-2) yang memicu COVID-19, yaitu infocovid19.jatimprov.go.id, menyebutkan perkembangan situasi pandemi COVID-19 di sejumlah wilayah di Jatim.\r\n\r\nPada Kamis, 16 Juli 2020, pasien dinyatakan positif Corona COVID-19 sebanyak 17.549, dan yang sembuh 8.310 orang. Sementara itu, total pasien meninggal dunia 1.352 orang. Pasien dirawat mencapai 7.981 orang. Kasus suspect sebanyak 7', 1, '2020-07-17 11:13:45', '0000-00-00 00:00:00'),
(19, 'Manaker Ingatkan Pelaku Usaha Utamakan K3 Saat Masuk New Normal', 'konten-200717-faa05c3744.jpg', 'Menteri Ketenagakerjaan (Menaker), Ida Fauziyah, mengajak semua pelaku usaha berkolaborasi untuk terus mempromosikan dan menerapkan protokol Keselamatan dan Kesehatan Kerja (K3) di tempat kerja. Aturan ini memastikan agar aktivitas ekonomi berjalan aman, sehat, dan produktif di tengah pandemi Covid-19.\r\n\r\nMenurut Ida Fauziyah, masa pandemi Covid-19 merupakan momentum pembelajaran bagi semua pelaku usaha tentang pentingnya penerapan K3 secara efektif dan efisien di tempat kerja.\r\n\r\n\"Kolobaroasi bertujuan agar upaya pencegahan dan penanggulangan dampak pandemi Covid-19 dapat dilaksanakan dengan baik, diperlukan peran dan kerja sama serta kolaborasi berbagai pemangku kepentingan/Stakeholders K3 terkait,\" kata Ida Fauziyah dalam pernyataannya, Jumat (5/6/2020).\r\n\r\nDia menambahkan, K3 merupakan kunci penting keberlangsungan usaha dan perlindungan pekerja dalam rangka pencegahan dan penanggulangan Covid-19. Apabila syarat-syarat K3 dilaksanakan sesuai ketentuan peraturan perundang-undangan serta melaksanakan standar dan protokol pencegahan, maka diharapkan tempat kerja akan terhindar dari penyebaran Covid-19.\r\n\r\nDi sisi lain, kata Ida, pemerintah telah melakukan berbagai upaya pencegahan Covid-19 di perusahaan. Yakni perencanaan keberlangsungan usaha yang aman bagi pekerja, perlindungan pekerja dengan pemberian Jaminan Kecelakaan Kerja (JKK) pada kasus covid-19, peningkatan pembinaan pengawasan pencegahan penularan Covid-19, dan peningkatan kolaborasi dengan stakeholder K3 (DK3N, Lembaga K3, Universitas, ILO, BP Jamsostek, BPJS Ketenagakerjaan, Apindo, dan SP/SB).\r\n\r\n\"Kemnaker juga sudah menyusun protokol tentang rencana keberlangsungan usaha dalam menghadapi pandemi Covid-19 dan protokol pencegahan penularan Covid-19 di perusahaan. Kebijakan ini bertujuan untuk memberikan perlindungan kepada tenaga kerja dan keberlangsungan usaha pada era The New Normal nanti,\" jelas Menaker.', 1, '2020-07-17 11:18:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_list_pelanggaran`
--

CREATE TABLE `m_list_pelanggaran` (
  `id_list_pel` int(100) NOT NULL,
  `nama_list_pel` varchar(100) NOT NULL,
  `point_pel` int(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` int(100) NOT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_list_pelanggaran`
--

INSERT INTO `m_list_pelanggaran` (`id_list_pel`, `nama_list_pel`, `point_pel`, `created`, `deleted`, `updated`) VALUES
(6, 'Bekerja dengan kondisi fatigue/ stress', 10, '2020-06-26 16:05:38', 1, NULL),
(7, 'Melanggar batas kecepatan di area Pabrik', 10, '2020-06-26 16:06:10', 1, NULL),
(8, 'Tidak/ kurang menggunakan APD saat bekerja', 20, '2020-06-26 16:06:44', 1, NULL),
(9, 'Bersendau gurau dalam bekerja', 20, '2020-06-26 16:07:12', 1, NULL),
(10, 'Merokok sambil bekerja', 20, '2020-06-26 16:08:06', 1, NULL),
(11, 'Tidak membersihkan sampah yang timbul dari kegiatan yang dikerjakan', 20, '2020-06-26 16:08:33', 1, NULL),
(12, 'Tidak menggunakan full body harness saat bekerja di ketinggian', 20, '2020-06-26 16:08:47', 1, NULL),
(13, 'Menggunakan peralatan kerja yang tidak layak pakai', 20, '2020-06-26 16:08:59', 1, NULL),
(14, 'Tidak menjaga kerapian tempat kerja', 20, '2020-06-26 16:09:11', 1, NULL),
(15, 'Mengemudikan alat berat dengan menaikkan penumpang', 40, '2020-06-26 16:09:24', 1, NULL),
(16, 'Tidak mematuhi/melaksanakan prosedur kerja dengan benar', 40, '2020-06-26 16:09:38', 1, NULL),
(17, 'Membawa kendaraan bermotor di area instalasi pabrik tanpa izin', 50, '2020-06-26 16:09:50', 1, NULL),
(18, 'Merawat (maintenance) peralatan yang sedang bergerak', 50, '2020-06-26 16:10:02', 1, NULL),
(19, 'Dalam pengaruh minuman alkohol di tempat kerja', 100, '2020-06-26 16:10:18', 1, NULL),
(20, 'Mengoperasikan peralatan yang bukan wewenangnya', 100, '2020-06-26 16:10:31', 1, NULL),
(21, 'Melakukan tindak pencurian barang/peralatan milik perusahaan', 100, '2020-06-26 16:10:43', 1, NULL),
(22, 'Mengeluarkan material/peralatan tanpa disertai prosedur yang ditetapkan', 100, '2020-06-26 16:10:53', 1, NULL),
(23, 'ghhbjd', 30, '2020-07-07 22:04:41', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_mitra`
--

CREATE TABLE `m_mitra` (
  `id_mitra` int(100) NOT NULL,
  `nama_mitra` varchar(100) NOT NULL,
  `kode_mitra` varchar(100) NOT NULL,
  `telp` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` int(100) NOT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_mitra`
--

INSERT INTO `m_mitra` (`id_mitra`, `nama_mitra`, `kode_mitra`, `telp`, `email`, `created`, `deleted`, `updated`) VALUES
(1, 'PT Sentosa', 'KD0094', '2764723', 'dgha@gmail.com', '2020-06-03 23:45:20', 1, NULL),
(2, 'PT Bercahaya', 'KD00987', '7623', 'ggfgf@gmail.com', '2020-06-03 23:49:21', 1, '0000-00-00 00:00:00'),
(3, 'PT Maju Jaya', 'MJ008', '65564', 'qdurling2@bbb.org', '2020-06-23 21:59:32', 0, '0000-00-00 00:00:00'),
(4, 'PT Bercahaya Abadi', 'MJ003', '7623', 'shalhuda@gmail.com', '2020-07-07 20:30:19', 0, '0000-00-00 00:00:00'),
(5, 'PT Bercahaya', 'MJ006', '65564', 'pangkalanniaga@yahoo.co.id', '2020-07-07 22:47:25', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_pegawai`
--

CREATE TABLE `m_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nip_pegawai` varchar(100) NOT NULL,
  `telp` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `point` int(100) NOT NULL,
  `potongan` varchar(100) NOT NULL,
  `id_sanksi` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` int(100) NOT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_pegawai`
--

INSERT INTO `m_pegawai` (`id_pegawai`, `nama_pegawai`, `nip_pegawai`, `telp`, `email`, `point`, `potongan`, `id_sanksi`, `created`, `deleted`, `updated`) VALUES
(1, 'Faishal Nur Huda', 'PJA 0009', '087860201068', 'shalhuda@gmail.com', 80, '0', 0, '0000-00-00 00:00:00', 1, '2020-06-24 17:48:33'),
(3, 'Vinda Nofia Putri', 'PGA0002', '087860201068', 'vindanofia14@gmail.com', 0, '0', 0, '2020-06-02 22:11:38', 0, '2020-06-02 22:11:38'),
(4, 'Rafi Reza A', 'PJA0003', '12345', 'hagda@gmail.com', 0, '0', 0, '2020-06-03 23:06:32', 0, '0000-00-00 00:00:00'),
(5, 'Vinda Nofia', 'PGA004', '123456789', 'vindanofia14@gmail.com', 30, '0', 0, '2020-06-04 22:29:16', 1, '2020-06-20 11:15:45'),
(6, 'Rafi Reza', 'KD00978', '12345', 'pangkalanniaga@yahoo.co.id', 0, '', 0, '2020-07-07 20:26:37', 0, '2020-07-07 15:26:55'),
(7, 'Rafi Reza', 'KD00987', '1234567', 'pangkalanniaga@yahoo.co.id', 0, '', 0, '2020-07-07 22:47:01', 0, '2020-07-07 17:47:12'),
(9, 'Rafi Reza', 'PJA0100', '123', 'pangkalanniaga@yahoo.co.id', 0, '', 0, '2020-07-08 11:17:58', 0, '2020-07-08 06:18:11'),
(11, 'Dita', 'PJA0028', '7623', 'pangkalanniaga@yahoo.co.id', 0, '', 0, '2020-07-15 13:47:56', 1, NULL),
(12, 'Nama Pegawai', 'NIP Pegawai', '', '', 0, '', 0, '2020-07-22 22:13:51', 0, '2020-07-24 08:27:09'),
(13, 'Nayla', 'NY789', '', '', 0, '', 0, '2020-07-22 22:13:51', 0, '2020-07-24 08:27:14'),
(20, 'Nayla', 'hh78', '', '', 0, '', 0, '2020-07-22 22:48:25', 0, NULL),
(21, 'dila', 'dl78', '7362', 'dila@gmail.com', 0, '0', 0, '2020-07-23 12:39:30', 1, NULL),
(23, 'Telepon', 'Email', '', '', 0, '', 0, '2020-07-24 13:02:10', 0, NULL),
(24, '656', 'yyy@gmail.com', '', '', 0, '', 0, '2020-07-24 13:02:10', 0, NULL),
(41, '', '', '', '', 0, '', 0, '2020-07-24 13:20:19', 0, NULL),
(42, 'CCC', 'CC653', '3728', 'ggh@gmail.com', 0, '', 0, '2020-07-24 13:20:19', 0, NULL),
(45, 'DDD', 'DD6567', '763652', 'ggj@gmail.com', 0, '', 0, '2020-07-24 13:22:51', 0, NULL),
(46, 'HHHH', 'HT5642', '54465', 'daw@gmail.com', 0, '', 0, '2020-07-24 13:23:42', 0, NULL),
(47, 'HGF', 'hdg654', '9823864', 'hagd@gmail.com', 0, '0', 0, '2020-07-24 08:26:40', 1, NULL),
(48, 'aydgyw', 'uyw732653', '84267', 'hag@gmail.com', 0, '0', 0, '2020-07-24 08:26:40', 1, NULL),
(49, 'djhduya', 'dss625362', '32782', 'djhjgha@gmail.com', 0, '0', 0, '2020-07-24 08:26:40', 0, '2020-07-24 08:28:02'),
(53, 'Nayla Inara', 'NI5421', '377863', 'naylainara@gmail.com', 0, '0', 0, '2020-07-24 10:01:17', 1, NULL),
(54, 'Nayla Inara', 'NH6516', '377863', 'naylainara@gmail.com', 0, '0', 0, '2020-07-24 10:02:20', 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_pegawai_mitra`
--

CREATE TABLE `m_pegawai_mitra` (
  `id_pegawai_mitra` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `nama_pegawai_mitra` varchar(100) NOT NULL,
  `nip_pegawai_mitra` varchar(100) NOT NULL,
  `telp_peg_mitra` varchar(100) NOT NULL,
  `point_peg_mitra` int(11) NOT NULL,
  `potongan_peg_mitra` varchar(100) NOT NULL,
  `deleted` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_pegawai_mitra`
--

INSERT INTO `m_pegawai_mitra` (`id_pegawai_mitra`, `id_perusahaan`, `nama_pegawai_mitra`, `nip_pegawai_mitra`, `telp_peg_mitra`, `point_peg_mitra`, `potongan_peg_mitra`, `deleted`, `created`, `updated`) VALUES
(3, 2, 'Andika', 'GT638', '983264', 0, '0', 0, '2020-06-24 23:27:14', '2020-06-28 18:48:39'),
(4, 1, 'Handoko', 'ST001', '842738', 0, '0', 1, '2020-06-25 22:40:12', '0000-00-00 00:00:00'),
(5, 2, 'Erwin', 'GH007', '762652', 0, '0', 1, '2020-06-28 23:48:30', '0000-00-00 00:00:00'),
(7, 1, 'Handoko', 'G7889', '8427386787', 0, '0', 0, '2020-07-07 20:31:13', '2020-07-07 15:32:31'),
(8, 2, 'Andika', 'GT094', '983264', 40, '0', 1, '2020-07-07 20:33:13', '0000-00-00 00:00:00'),
(9, 1, 'Wendy', 'HG029302', '48782', 0, '0', 0, '2020-07-07 20:35:40', '2020-07-07 16:42:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_sanksi`
--

CREATE TABLE `m_sanksi` (
  `id_sanksi` int(11) NOT NULL,
  `nama_sanksi` varchar(100) NOT NULL,
  `point_sanksi` int(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_sanksi`
--

INSERT INTO `m_sanksi` (`id_sanksi`, `nama_sanksi`, `point_sanksi`, `created`, `deleted`, `updated`) VALUES
(1, 'Teguran', 5, '2020-06-04 22:45:56', 0, '0000-00-00 00:00:00'),
(2, 'Teguran 1', 10, '2020-06-06 13:48:11', 1, '0000-00-00 00:00:00'),
(3, 'Teguran 2', 20, '2020-06-06 13:48:40', 1, '0000-00-00 00:00:00'),
(4, 'Teguran 3 dan dilakukan TOFS', 40, '2020-06-06 13:48:51', 1, '0000-00-00 00:00:00'),
(5, 'Denda', 80, '2020-06-06 13:49:03', 1, '0000-00-00 00:00:00'),
(6, 'Surat Peringatan', 100, '2020-06-26 16:15:03', 1, '0000-00-00 00:00:00'),
(7, 'Dendaueuw', 36, '2020-07-07 22:05:46', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_sanksi_mitra`
--

CREATE TABLE `m_sanksi_mitra` (
  `id_sanksi_mitra` int(11) NOT NULL,
  `nama_sanksi_mitra` varchar(100) NOT NULL,
  `point_sanksi_mitra` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_sanksi_mitra`
--

INSERT INTO `m_sanksi_mitra` (`id_sanksi_mitra`, `nama_sanksi_mitra`, `point_sanksi_mitra`, `deleted`, `created`, `updated`) VALUES
(1, 'Teguran Lisan', 10, 1, '2020-06-24 22:44:25', '0000-00-00 00:00:00'),
(2, 'Teguran Lisan 2', 20, 1, '2020-06-24 22:44:41', '0000-00-00 00:00:00'),
(3, 'Teguran Mitra dan Dilakukan TOFS', 40, 1, '2020-06-24 22:46:33', '0000-00-00 00:00:00'),
(4, 'Denda', 80, 1, '2020-06-24 22:46:45', '0000-00-00 00:00:00'),
(5, 'Larangan kerja di Perusahaan/ Blacklist', 100, 1, '2020-06-24 22:47:06', '0000-00-00 00:00:00'),
(6, 'hjwahj', 65, 0, '2020-06-24 22:47:18', '2020-06-24 17:50:48'),
(7, 'Teguran Lisan 23', 35, 0, '2020-07-07 22:06:07', '2020-07-07 17:06:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pelanggaran_mitra`
--

CREATE TABLE `t_pelanggaran_mitra` (
  `id_pelanggaran_mitra` int(11) NOT NULL,
  `id_mitra` int(11) NOT NULL,
  `id_pegawai_mitra` int(11) NOT NULL,
  `id_list_pel` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `deskripsi` varchar(155) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `point_tpel` int(11) NOT NULL,
  `id_sanksi` int(11) NOT NULL,
  `add_by` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_pelanggaran_mitra`
--

INSERT INTO `t_pelanggaran_mitra` (`id_pelanggaran_mitra`, `id_mitra`, `id_pegawai_mitra`, `id_list_pel`, `tanggal`, `lokasi`, `deskripsi`, `foto`, `point_tpel`, `id_sanksi`, `add_by`, `created`, `deleted`, `updated_by`, `updated`) VALUES
(7, 2, 3, 12, '2020-06-28', 'Pabrik', '', 'pelanggaran-200627-ee0c9fb635.jpg', 20, 0, 1, '2020-06-28 00:17:55', 0, 1, '2020-06-27 19:42:16'),
(8, 1, 4, 8, '2020-06-28', 'Pabrik', '', 'pelanggaran-200628-517af4533e.jpg', 20, 0, 1, '2020-06-28 23:51:08', 1, 0, '0000-00-00 00:00:00'),
(9, 2, 8, 20, '2020-07-07', 'Pabrik', '', 'mitra-200707-1d49a12b05.jpg', 100, 0, 1, '2020-07-07 22:40:30', 0, 2, '2020-07-08 06:18:57'),
(10, 2, 8, 16, '2020-07-08', 'Pabrik', '', 'mitra-200708-5afef5cf56.jpg', 40, 0, 2, '2020-07-08 11:19:29', 1, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pelanggaran_pegawai`
--

CREATE TABLE `t_pelanggaran_pegawai` (
  `id_pelanggaran_peg` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_list_pel` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `lokasi` text NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  `point_tpel` int(11) NOT NULL,
  `id_sanksi` int(11) NOT NULL,
  `add_by` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_pelanggaran_pegawai`
--

INSERT INTO `t_pelanggaran_pegawai` (`id_pelanggaran_peg`, `id_pegawai`, `id_list_pel`, `tanggal`, `lokasi`, `deskripsi`, `foto`, `point_tpel`, `id_sanksi`, `add_by`, `created`, `deleted`, `updated_by`, `updated`) VALUES
(66, 1, 6, '2020-06-28 00:06:00', 'Pabrik', 'tyweu', 'pelanggaran-200627-f81258d54a.jpg', 10, 0, 1, '2020-06-28 00:12:04', 0, 1, '2020-06-28 16:36:17'),
(69, 1, 16, '2020-06-28 15:57:00', 'Pabrik', '', 'pelanggaran-200628-dc365e4316.jpg', 40, 0, 1, '2020-06-28 15:58:36', 0, 1, '2020-06-28 16:36:22'),
(70, 5, 6, '2020-06-28 21:32:00', 'Pabrik', '', 'pelanggaran-200628-44c6506cc8.jpg', 10, 0, 1, '2020-06-28 21:33:04', 0, 0, NULL),
(71, 1, 6, '2020-06-28 21:40:00', 'Pabrik', '', 'pelanggaran-200628-4450a17524.jpg', 10, 0, 1, '2020-06-28 21:41:03', 0, 1, '2020-06-28 16:43:02'),
(72, 1, 9, '2020-06-28 23:50:00', 'Pabrik', '', 'pelanggaran-200628-9d44178f39.jpg', 20, 0, 1, '2020-06-28 23:50:33', 1, 0, NULL),
(73, 1, 7, '2020-07-03 21:44:00', 'Pabrik', '', 'pelanggaran-200703-5a9b4d82a6.png', 10, 0, 1, '2020-07-03 21:45:05', 1, 0, NULL),
(74, 1, 10, '2020-07-07 20:37:00', 'Pabrik', '', 'pelanggaran-200707-2b64bc1240.jpg', 20, 0, 2, '2020-07-07 20:37:24', 0, 2, '2020-07-08 06:18:24'),
(75, 1, 7, '2020-07-07 22:27:00', 'Pabrik', '', 'pelanggaran-200707-8b50437691.jpg', 10, 0, 1, '2020-07-07 22:28:14', 0, 2, '2020-07-07 18:29:14'),
(76, 5, 6, '2020-07-08 11:18:00', 'Pabrik', '', 'pelanggaran-200708-1690256d8d.jpg', 10, 0, 2, '2020-07-08 11:18:48', 1, 0, NULL),
(77, 1, 12, '2020-07-11 23:15:00', 'Pabrik', '', 'pelanggaran-200711-18f821ca4b.jpeg', 20, 0, 1, '2020-07-11 23:16:05', 1, 0, NULL),
(78, 1, 16, '2020-07-12 10:15:00', 'Pabrik', '', 'pelanggaran-200712-462a067267.png', 40, 0, 1, '2020-07-12 10:15:33', 1, 0, NULL),
(79, 1, 13, '2020-07-16 18:14:00', 'Pabrik', '', 'pelanggaran-200716-d90c4d8fb8.jpeg', 20, 0, 2, '2020-07-16 18:14:09', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_penghargaan_mitra`
--

CREATE TABLE `t_penghargaan_mitra` (
  `id_penghargaan_mitra` int(11) NOT NULL,
  `id_mitra` int(11) NOT NULL,
  `id_pegawai_mitra` int(11) NOT NULL,
  `id_reward` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `point_penghargaan` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_penghargaan_mitra`
--

INSERT INTO `t_penghargaan_mitra` (`id_penghargaan_mitra`, `id_mitra`, `id_pegawai_mitra`, `id_reward`, `tanggal`, `lokasi`, `deskripsi`, `foto`, `point_penghargaan`, `deleted`, `created_by`, `created`, `updated_by`, `updated`) VALUES
(1, 2, 8, 3, '2020-07-18 21:29:00', 'Pabrik', '', 'apresiasi-200718-7c1b3d1307.png', 30, 0, 2, '0000-00-00 00:00:00', 2, '2020-07-18 17:08:50'),
(2, 1, 4, 3, '2020-07-18 21:29:00', 'Pabrik', '', 'apresiasi-200718-aa0adb3c87.png', 30, 0, 2, '0000-00-00 00:00:00', 2, '2020-07-18 17:09:29'),
(3, 2, 5, 3, '2020-07-18 21:39:00', 'Pabrik', '', 'apresiasi-200718-3217e809e2.jpg', 30, 0, 2, '0000-00-00 00:00:00', 2, '2020-07-18 17:11:44'),
(4, 1, 4, 4, '2020-07-18 22:12:00', 'Pabrik', '', 'apresiasi-200718-0cb50d1017.jpg', 30, 1, 2, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 1, 4, 3, '2020-07-18 22:24:00', 'Pabrik', '', 'apresiasi-200718-4ca1090638.jpg', 30, 1, 2, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_penghargaan_pegawai`
--

CREATE TABLE `t_penghargaan_pegawai` (
  `id_penghargaan_peg` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_reward` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `point_penghargaan` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_penghargaan_pegawai`
--

INSERT INTO `t_penghargaan_pegawai` (`id_penghargaan_peg`, `id_pegawai`, `id_reward`, `tanggal`, `lokasi`, `deskripsi`, `foto`, `point_penghargaan`, `deleted`, `created_by`, `created`, `updated_by`, `updated`) VALUES
(8, 1, 3, '2020-06-28 01:15:00', 'Pabrik', '', 'apresiasi-200627-3dc2062488.jpg', 30, 0, 1, '2020-06-28 01:15:13', 1, '2020-06-27 20:16:40'),
(9, 1, 3, '2020-06-28 01:19:00', 'Pabrik', '', 'apresiasi-200627-a4871652af.jpg', 30, 0, 1, '2020-06-28 01:19:15', 1, '2020-06-27 20:19:33'),
(10, 1, 3, '2020-06-28 21:41:00', 'Pabrik', '', 'apresiasi-200628-679ad53158.jpg', 30, 0, 1, '2020-06-28 21:41:29', 1, '2020-06-28 16:43:24'),
(11, 1, 3, '2020-06-28 23:51:00', 'Pabrik', '', 'apresiasi-200628-65b270e148.jpg', 30, 1, 1, '2020-06-28 23:51:42', 0, '0000-00-00 00:00:00'),
(12, 5, 3, '2020-07-08 11:19:00', 'Pabrik', '', 'apresiasi-200708-d52be05deb.jpg', 30, 0, 2, '2020-07-08 11:19:57', 2, '2020-07-08 06:20:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_role` int(11) NOT NULL COMMENT '1 = Admin, 2 = Member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `name`, `email`, `password`, `id_role`) VALUES
(1, 'admin', 'Administrator', 'administrator@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'shefaishal', 'Faishal Nur Huda', 'shalhuda@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2),
(5, 'vindanofia', 'Vinda Nofia', 'vindanofia14@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1),
(6, 'shevinda', 'Vinda Nofia Putri', 'vindanofia14@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `m_jenis_penghargaan`
--
ALTER TABLE `m_jenis_penghargaan`
  ADD PRIMARY KEY (`id_reward`);

--
-- Indeks untuk tabel `m_konten`
--
ALTER TABLE `m_konten`
  ADD PRIMARY KEY (`id_konten`);

--
-- Indeks untuk tabel `m_list_pelanggaran`
--
ALTER TABLE `m_list_pelanggaran`
  ADD PRIMARY KEY (`id_list_pel`);

--
-- Indeks untuk tabel `m_mitra`
--
ALTER TABLE `m_mitra`
  ADD PRIMARY KEY (`id_mitra`),
  ADD UNIQUE KEY `kode_mitra` (`kode_mitra`);

--
-- Indeks untuk tabel `m_pegawai`
--
ALTER TABLE `m_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `nip_pegawai` (`nip_pegawai`);

--
-- Indeks untuk tabel `m_pegawai_mitra`
--
ALTER TABLE `m_pegawai_mitra`
  ADD PRIMARY KEY (`id_pegawai_mitra`),
  ADD UNIQUE KEY `nip_pegawai_mitra` (`nip_pegawai_mitra`),
  ADD KEY `id_perusahaan` (`id_perusahaan`);

--
-- Indeks untuk tabel `m_sanksi`
--
ALTER TABLE `m_sanksi`
  ADD PRIMARY KEY (`id_sanksi`);

--
-- Indeks untuk tabel `m_sanksi_mitra`
--
ALTER TABLE `m_sanksi_mitra`
  ADD PRIMARY KEY (`id_sanksi_mitra`);

--
-- Indeks untuk tabel `t_pelanggaran_mitra`
--
ALTER TABLE `t_pelanggaran_mitra`
  ADD PRIMARY KEY (`id_pelanggaran_mitra`),
  ADD KEY `id_pegawai_mitra` (`id_pegawai_mitra`),
  ADD KEY `id_mitra` (`id_mitra`),
  ADD KEY `id_list_pel` (`id_list_pel`),
  ADD KEY `add_by` (`add_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indeks untuk tabel `t_pelanggaran_pegawai`
--
ALTER TABLE `t_pelanggaran_pegawai`
  ADD PRIMARY KEY (`id_pelanggaran_peg`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_list_pel` (`id_list_pel`),
  ADD KEY `t_pelanggaran_pegawai_ibfk_3` (`add_by`),
  ADD KEY `t_pelanggaran_pegawai_ibfk_4` (`updated_by`);

--
-- Indeks untuk tabel `t_penghargaan_mitra`
--
ALTER TABLE `t_penghargaan_mitra`
  ADD PRIMARY KEY (`id_penghargaan_mitra`),
  ADD KEY `id_mitra` (`id_mitra`),
  ADD KEY `id_pegawai_mitra` (`id_pegawai_mitra`),
  ADD KEY `id_reward` (`id_reward`);

--
-- Indeks untuk tabel `t_penghargaan_pegawai`
--
ALTER TABLE `t_penghargaan_pegawai`
  ADD PRIMARY KEY (`id_penghargaan_peg`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_reward` (`id_reward`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `m_jenis_penghargaan`
--
ALTER TABLE `m_jenis_penghargaan`
  MODIFY `id_reward` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `m_konten`
--
ALTER TABLE `m_konten`
  MODIFY `id_konten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `m_list_pelanggaran`
--
ALTER TABLE `m_list_pelanggaran`
  MODIFY `id_list_pel` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `m_mitra`
--
ALTER TABLE `m_mitra`
  MODIFY `id_mitra` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `m_pegawai`
--
ALTER TABLE `m_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `m_pegawai_mitra`
--
ALTER TABLE `m_pegawai_mitra`
  MODIFY `id_pegawai_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `m_sanksi`
--
ALTER TABLE `m_sanksi`
  MODIFY `id_sanksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `m_sanksi_mitra`
--
ALTER TABLE `m_sanksi_mitra`
  MODIFY `id_sanksi_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `t_pelanggaran_mitra`
--
ALTER TABLE `t_pelanggaran_mitra`
  MODIFY `id_pelanggaran_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `t_pelanggaran_pegawai`
--
ALTER TABLE `t_pelanggaran_pegawai`
  MODIFY `id_pelanggaran_peg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT untuk tabel `t_penghargaan_mitra`
--
ALTER TABLE `t_penghargaan_mitra`
  MODIFY `id_penghargaan_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `t_penghargaan_pegawai`
--
ALTER TABLE `t_penghargaan_pegawai`
  MODIFY `id_penghargaan_peg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `m_pegawai_mitra`
--
ALTER TABLE `m_pegawai_mitra`
  ADD CONSTRAINT `m_pegawai_mitra_ibfk_1` FOREIGN KEY (`id_perusahaan`) REFERENCES `m_mitra` (`id_mitra`);

--
-- Ketidakleluasaan untuk tabel `t_pelanggaran_mitra`
--
ALTER TABLE `t_pelanggaran_mitra`
  ADD CONSTRAINT `t_pelanggaran_mitra_ibfk_1` FOREIGN KEY (`id_pegawai_mitra`) REFERENCES `m_pegawai_mitra` (`id_pegawai_mitra`),
  ADD CONSTRAINT `t_pelanggaran_mitra_ibfk_2` FOREIGN KEY (`id_mitra`) REFERENCES `m_mitra` (`id_mitra`),
  ADD CONSTRAINT `t_pelanggaran_mitra_ibfk_3` FOREIGN KEY (`id_list_pel`) REFERENCES `m_list_pelanggaran` (`id_list_pel`);

--
-- Ketidakleluasaan untuk tabel `t_pelanggaran_pegawai`
--
ALTER TABLE `t_pelanggaran_pegawai`
  ADD CONSTRAINT `t_pelanggaran_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pelanggaran_pegawai_ibfk_2` FOREIGN KEY (`id_list_pel`) REFERENCES `m_list_pelanggaran` (`id_list_pel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_penghargaan_mitra`
--
ALTER TABLE `t_penghargaan_mitra`
  ADD CONSTRAINT `t_penghargaan_mitra_ibfk_1` FOREIGN KEY (`id_mitra`) REFERENCES `m_mitra` (`id_mitra`),
  ADD CONSTRAINT `t_penghargaan_mitra_ibfk_2` FOREIGN KEY (`id_pegawai_mitra`) REFERENCES `m_pegawai_mitra` (`id_pegawai_mitra`),
  ADD CONSTRAINT `t_penghargaan_mitra_ibfk_3` FOREIGN KEY (`id_reward`) REFERENCES `m_jenis_penghargaan` (`id_reward`);

--
-- Ketidakleluasaan untuk tabel `t_penghargaan_pegawai`
--
ALTER TABLE `t_penghargaan_pegawai`
  ADD CONSTRAINT `t_penghargaan_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id_pegawai`),
  ADD CONSTRAINT `t_penghargaan_pegawai_ibfk_2` FOREIGN KEY (`id_reward`) REFERENCES `m_jenis_penghargaan` (`id_reward`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
