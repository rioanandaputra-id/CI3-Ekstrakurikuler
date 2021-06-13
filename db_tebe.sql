-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2021 pada 00.35
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tebe`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `identitas_sekolah`
--

CREATE TABLE `identitas_sekolah` (
  `id_identitas_sekolah` int(5) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `npsn` varchar(50) NOT NULL,
  `nss` varchar(50) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `kode_pos` int(7) NOT NULL,
  `no_telpon` varchar(15) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kabupaten_kota` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `website` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `identitas_sekolah`
--

INSERT INTO `identitas_sekolah` (`id_identitas_sekolah`, `nama_sekolah`, `npsn`, `nss`, `alamat_sekolah`, `kode_pos`, `no_telpon`, `kelurahan`, `kecamatan`, `kabupaten_kota`, `provinsi`, `website`, `email`) VALUES
(1, 'SMK N 7 BANDAR LAMPUNG', '1234', '1234', 'Jl. Pendidikan', 35131, '07215610689', 'Sukarame', 'Sukarame', 'Bandar Lampung', 'Lampung', 'http://localhost/ekskul-master', 'smkn7bandarlampung@yahoo.co.id');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_agama`
--

CREATE TABLE `tbl_agama` (
  `kode_agama` int(5) NOT NULL,
  `agama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_agama`
--

INSERT INTO `tbl_agama` (`kode_agama`, `agama`) VALUES
(1, 'Islam'),
(2, 'Katholik'),
(3, 'Protestan'),
(4, 'Hindu'),
(5, 'Buddha'),
(6, 'Konghuzu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ekskul`
--

CREATE TABLE `tbl_ekskul` (
  `kode_ekskul` int(5) NOT NULL,
  `nama_ekskul` varchar(255) NOT NULL,
  `kode_pegawai` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ekskul`
--

INSERT INTO `tbl_ekskul` (`kode_ekskul`, `nama_ekskul`, `kode_pegawai`) VALUES
(1, 'Basket', 4),
(2, 'Paskibra', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ekskul_gallery`
--

CREATE TABLE `tbl_ekskul_gallery` (
  `kode_ekskul_gallery` int(5) NOT NULL,
  `kode_ekskul` int(5) NOT NULL,
  `foto_ekskul` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `oleh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ekskul_gallery`
--

INSERT INTO `tbl_ekskul_gallery` (`kode_ekskul_gallery`, `kode_ekskul`, `foto_ekskul`, `tanggal`, `nama_kegiatan`, `oleh`) VALUES
(1, 1, 'foto_gallery/20210613152541-Screenshot_2 (1).jpg', '2021-06-13', 'Ngitung', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ekskul_jabatan`
--

CREATE TABLE `tbl_ekskul_jabatan` (
  `kode_ekskul_jabatan` int(5) NOT NULL,
  `nama_jabatan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ekskul_jabatan`
--

INSERT INTO `tbl_ekskul_jabatan` (`kode_ekskul_jabatan`, `nama_jabatan`) VALUES
(1, 'Anggota'),
(2, 'Ketua');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ekskul_lomba`
--

CREATE TABLE `tbl_ekskul_lomba` (
  `kode_ekskul_lomba` int(5) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `kode_ekskul` int(5) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `tgl_tutup` date NOT NULL,
  `tgl_lomba` date NOT NULL,
  `penyelenggara` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `tingkat` varchar(255) NOT NULL,
  `file_lomba` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ekskul_lomba`
--

INSERT INTO `tbl_ekskul_lomba` (`kode_ekskul_lomba`, `nama_kegiatan`, `kode_ekskul`, `tgl_daftar`, `tgl_tutup`, `tgl_lomba`, `penyelenggara`, `lokasi`, `tingkat`, `file_lomba`) VALUES
(1, 'lomba', 1, '2021-06-13', '2021-06-15', '2021-06-26', 'sekolah', 'lapangan', 'sekolah', ''),
(4, 'lomba 2', 2, '2021-06-13', '2021-06-15', '2021-06-26', 'sekolah', 'lapangan', 'sekolah', ''),
(5, 'lomba 3', 1, '2021-06-13', '2021-06-15', '2021-06-26', 'sekolah', 'lapangan', 'sekolah', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ekskul_lomba_daftar`
--

CREATE TABLE `tbl_ekskul_lomba_daftar` (
  `id_ekskul_lomba_daftar` int(11) NOT NULL,
  `kode_ekskul_lomba` int(11) NOT NULL,
  `kode_siswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_ekskul_lomba_daftar`
--

INSERT INTO `tbl_ekskul_lomba_daftar` (`id_ekskul_lomba_daftar`, `kode_ekskul_lomba`, `kode_siswa`) VALUES
(8, 1, 1),
(9, 1, 17),
(10, 1, 17),
(11, 1, 1),
(12, 1, 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ekskul_penilaian`
--

CREATE TABLE `tbl_ekskul_penilaian` (
  `kode_ekskul_penilaian` int(5) NOT NULL,
  `kode_siswa` int(5) NOT NULL,
  `kode_ekskul` int(5) NOT NULL,
  `nilai_ekskul` float NOT NULL,
  `tahun_ajaran` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ekskul_penilaian`
--

INSERT INTO `tbl_ekskul_penilaian` (`kode_ekskul_penilaian`, `kode_siswa`, `kode_ekskul`, `nilai_ekskul`, `tahun_ajaran`) VALUES
(1, 1, 2, 90, '2020/2021'),
(4, 17, 1, 99, '2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ekskul_siswa`
--

CREATE TABLE `tbl_ekskul_siswa` (
  `kode_ekskul_siswa` int(5) NOT NULL,
  `kode_siswa` int(5) NOT NULL,
  `kode_ekskul_jabatan` int(5) NOT NULL,
  `kode_ekskul` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ekskul_siswa`
--

INSERT INTO `tbl_ekskul_siswa` (`kode_ekskul_siswa`, `kode_siswa`, `kode_ekskul_jabatan`, `kode_ekskul`) VALUES
(5, 1, 1, 1),
(6, 17, 2, 1),
(7, 1, 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_gedung`
--

CREATE TABLE `tbl_gedung` (
  `kode_gedung` int(5) NOT NULL,
  `nama_gedung` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_gedung`
--

INSERT INTO `tbl_gedung` (`kode_gedung`, `nama_gedung`) VALUES
(1, 'Gedung A'),
(2, 'Gedung B'),
(3, 'Gedung C');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `kode_jabatan` int(5) NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jabatan`
--

INSERT INTO `tbl_jabatan` (`kode_jabatan`, `nama_jabatan`) VALUES
(1, 'Admin'),
(2, 'Guru'),
(3, 'Pembina'),
(4, 'Ketua Jurusan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `kode_jurusan` int(5) NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL,
  `bidang_keahlian` varchar(255) NOT NULL,
  `kompetensi_umum` varchar(255) NOT NULL,
  `kompetensi_khusus` varchar(255) NOT NULL,
  `kode_pegawai` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`kode_jurusan`, `nama_jurusan`, `bidang_keahlian`, `kompetensi_umum`, `kompetensi_khusus`, `kode_pegawai`) VALUES
(1, 'IPA', '-', '-', '-', 3),
(2, 'IPS', '-', '-', '-', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kelamin`
--

CREATE TABLE `tbl_kelamin` (
  `kode_kelamin` int(5) NOT NULL,
  `kelamin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kelamin`
--

INSERT INTO `tbl_kelamin` (`kode_kelamin`, `kelamin`) VALUES
(1, 'Laki-Laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `kode_kelas` int(5) NOT NULL,
  `kode_pegawai` int(5) NOT NULL,
  `kode_jurusan` int(5) NOT NULL,
  `kode_ruangan` int(5) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`kode_kelas`, `kode_pegawai`, `kode_jurusan`, `kode_ruangan`, `nama_kelas`) VALUES
(1, 5, 1, 1, 'XII TKJ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `kode_pegawai` int(5) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'foto_pegawai/default.jpg',
  `tempat_lahir` varchar(200) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `alamat` text NOT NULL,
  `telpon` varchar(20) NOT NULL,
  `kode_jabatan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`kode_pegawai`, `nip`, `nik`, `nama`, `foto`, `tempat_lahir`, `tanggal_lahir`, `username`, `email`, `password`, `alamat`, `telpon`, `kode_jabatan`) VALUES
(1, '123', '123', 'Tubagus', 'foto_pegawai/default.jpg', 'admin', '2021-05-21', 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', '123', 1),
(3, '234', '234', 'Beri', 'foto_pegawai/default.jpg', 'kajur', '2021-05-21', 'kajur', 'kajur@kajur.com', 'fa2a64d863ff8a83fee0b8fafd292d26', 'kajur', '1234', 4),
(4, '456', '456', 'Iqbal', 'foto_pegawai/default.jpg', 'pembina', '2021-05-21', 'pembina', 'pembina@pembina.pembina', '377a610343a9812be993e0e755b2e00f', 'pembina', '123', 3),
(5, '678', '678', 'Rio', 'foto_pegawai/default.jpg', 'guru', '2021-05-08', 'guru', 'guru@guru.guru', '77e69c137812518e359196bb2f5e9bb9', 'guru', '2322', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ruangan`
--

CREATE TABLE `tbl_ruangan` (
  `kode_ruangan` int(5) NOT NULL,
  `nama_ruangan` varchar(255) NOT NULL,
  `kode_gedung` int(5) NOT NULL,
  `lantai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ruangan`
--

INSERT INTO `tbl_ruangan` (`kode_ruangan`, `nama_ruangan`, `kode_gedung`, `lantai`) VALUES
(1, 'Ruang C', 3, 1),
(4, 'Ruang A', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `kode_siswa` int(5) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode_kelamin` int(5) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kode_agama` int(5) NOT NULL,
  `telpon` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `kode_kelas` int(5) NOT NULL,
  `angkatan` year(4) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'foto_siswa/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`kode_siswa`, `nisn`, `nama`, `kode_kelamin`, `tempat_lahir`, `tanggal_lahir`, `kode_agama`, `telpon`, `username`, `email`, `password`, `alamat`, `kode_kelas`, `angkatan`, `foto`) VALUES
(1, '2345', 'Dani Sanjaya', 1, 'siswa1', '2021-05-25', 1, '1234', 'siswa1', 'siswa1@gmail.com', '013f0f67779f3b1686c604db150d12ea', 'siswa1', 1, 2022, 'foto_siswa/20210521131442-20210514-tertiaries-afc9d36d9150a1633a12be596ff67e9f.png'),
(17, '2345', 'Gusti Anggoro', 1, 'siswa2', '2021-05-25', 1, '1234', 'siswa2', 'siswa2@gmail.com', '331633a246a4e1ceefc9539a71fcd124', 'siswa2', 1, 2022, 'foto_siswa/20210521131442-20210514-tertiaries-afc9d36d9150a1633a12be596ff67e9f.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_aktivitas`
--

CREATE TABLE `users_aktivitas` (
  `id_users_aktivitas` int(10) NOT NULL,
  `identitas` varchar(50) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `browser` varchar(50) NOT NULL,
  `os` varchar(50) NOT NULL,
  `status` int(5) NOT NULL,
  `jam` time NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users_aktivitas`
--

INSERT INTO `users_aktivitas` (`id_users_aktivitas`, `identitas`, `ip_address`, `browser`, `os`, `status`, `jam`, `tanggal`) VALUES
(1, '1', '114.4.215.85', 'Chrome 90.0.4430.212', 'Windows 10', 1, '12:10:51', '2021-05-21'),
(2, '1', '114.4.215.85', 'Chrome 90.0.4430.212', 'Windows 10', 0, '13:14:23', '2021-05-21'),
(3, '1', '114.4.83.57', 'Chrome 91.0.4472.101', 'Windows 10', 1, '22:04:45', '2021-06-11'),
(4, '1', '114.4.83.57', 'Chrome 91.0.4472.101', 'Windows 10', 0, '22:07:12', '2021-06-11'),
(5, '1', '114.4.83.57', 'Chrome 91.0.4472.101', 'Windows 10', 1, '22:09:18', '2021-06-11'),
(6, '1', '114.4.83.57', 'Chrome 91.0.4472.101', 'Windows 10', 0, '22:10:22', '2021-06-11'),
(7, '4', '114.4.83.57', 'Chrome 91.0.4472.101', 'Windows 10', 3, '22:11:31', '2021-06-11'),
(8, '1', '114.4.83.57', 'Chrome 91.0.4472.101', 'Windows 10', 1, '22:13:03', '2021-06-11'),
(9, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '22:02:59', '2021-06-12'),
(10, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '22:23:40', '2021-06-12'),
(11, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '22:28:42', '2021-06-12'),
(12, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '22:29:16', '2021-06-12'),
(13, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '14:42:37', '2021-06-13'),
(14, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '15:16:06', '2021-06-13'),
(15, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '15:22:23', '2021-06-13'),
(16, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '15:22:51', '2021-06-13'),
(17, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '15:23:35', '2021-06-13'),
(18, '4', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 3, '15:33:04', '2021-06-13'),
(19, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '15:34:19', '2021-06-13'),
(20, '4', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 3, '15:35:03', '2021-06-13'),
(21, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '15:37:42', '2021-06-13'),
(22, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '15:37:56', '2021-06-13'),
(23, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '15:52:52', '2021-06-13'),
(24, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '15:54:50', '2021-06-13'),
(25, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '15:55:10', '2021-06-13'),
(26, '5', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 2, '15:55:53', '2021-06-13'),
(27, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '16:23:48', '2021-06-13'),
(28, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '17:22:25', '2021-06-13'),
(29, '4', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 3, '17:59:07', '2021-06-13'),
(30, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '18:25:41', '2021-06-13'),
(31, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '18:30:53', '2021-06-13'),
(32, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '18:42:41', '2021-06-13'),
(33, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '18:44:21', '2021-06-13'),
(34, '5', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 2, '19:26:23', '2021-06-13'),
(35, '4', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 3, '19:28:21', '2021-06-13'),
(36, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '20:35:57', '2021-06-13'),
(37, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '20:37:14', '2021-06-13'),
(38, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '21:22:09', '2021-06-13'),
(39, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '21:24:41', '2021-06-13'),
(40, '4', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 3, '21:45:42', '2021-06-13'),
(41, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '21:46:29', '2021-06-13'),
(42, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '21:52:46', '2021-06-13'),
(43, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '23:47:05', '2021-06-13'),
(44, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '00:18:49', '2021-06-14'),
(45, '17', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '00:56:30', '2021-06-14'),
(46, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '01:53:30', '2021-06-14'),
(47, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '03:19:00', '2021-06-14'),
(48, '4', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 3, '03:19:46', '2021-06-14'),
(49, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '04:36:06', '2021-06-14'),
(50, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '04:42:14', '2021-06-14'),
(51, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '04:44:14', '2021-06-14'),
(52, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '04:45:35', '2021-06-14'),
(53, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '04:45:58', '2021-06-14'),
(54, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '04:48:00', '2021-06-14'),
(55, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '04:51:28', '2021-06-14'),
(56, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '04:53:15', '2021-06-14'),
(57, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '05:04:06', '2021-06-14'),
(58, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '05:04:29', '2021-06-14'),
(59, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '05:06:07', '2021-06-14'),
(60, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '05:10:54', '2021-06-14'),
(61, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '05:11:51', '2021-06-14'),
(62, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '05:14:38', '2021-06-14'),
(63, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '05:17:01', '2021-06-14'),
(64, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 0, '05:17:32', '2021-06-14'),
(65, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '05:18:07', '2021-06-14'),
(66, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '05:19:11', '2021-06-14'),
(67, '1', '::1', 'Chrome 91.0.4472.101', 'Windows 10', 1, '05:19:29', '2021-06-14');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `identitas_sekolah`
--
ALTER TABLE `identitas_sekolah`
  ADD PRIMARY KEY (`id_identitas_sekolah`);

--
-- Indeks untuk tabel `tbl_agama`
--
ALTER TABLE `tbl_agama`
  ADD PRIMARY KEY (`kode_agama`);

--
-- Indeks untuk tabel `tbl_ekskul`
--
ALTER TABLE `tbl_ekskul`
  ADD PRIMARY KEY (`kode_ekskul`),
  ADD KEY `kode_pegawai` (`kode_pegawai`);

--
-- Indeks untuk tabel `tbl_ekskul_gallery`
--
ALTER TABLE `tbl_ekskul_gallery`
  ADD PRIMARY KEY (`kode_ekskul_gallery`),
  ADD KEY `kode_ekskul` (`kode_ekskul`);

--
-- Indeks untuk tabel `tbl_ekskul_jabatan`
--
ALTER TABLE `tbl_ekskul_jabatan`
  ADD PRIMARY KEY (`kode_ekskul_jabatan`);

--
-- Indeks untuk tabel `tbl_ekskul_lomba`
--
ALTER TABLE `tbl_ekskul_lomba`
  ADD PRIMARY KEY (`kode_ekskul_lomba`),
  ADD KEY `kode_ekskul` (`kode_ekskul`);

--
-- Indeks untuk tabel `tbl_ekskul_lomba_daftar`
--
ALTER TABLE `tbl_ekskul_lomba_daftar`
  ADD PRIMARY KEY (`id_ekskul_lomba_daftar`),
  ADD KEY `kode_ekskul_lomba` (`kode_ekskul_lomba`),
  ADD KEY `kode_siswa` (`kode_siswa`);

--
-- Indeks untuk tabel `tbl_ekskul_penilaian`
--
ALTER TABLE `tbl_ekskul_penilaian`
  ADD PRIMARY KEY (`kode_ekskul_penilaian`),
  ADD KEY `kode_ekskul` (`kode_ekskul`),
  ADD KEY `kode_siswa` (`kode_siswa`);

--
-- Indeks untuk tabel `tbl_ekskul_siswa`
--
ALTER TABLE `tbl_ekskul_siswa`
  ADD PRIMARY KEY (`kode_ekskul_siswa`),
  ADD KEY `kode_ekskul` (`kode_ekskul`),
  ADD KEY `kode_ekskul_jabatan` (`kode_ekskul_jabatan`),
  ADD KEY `kode_siswa` (`kode_siswa`);

--
-- Indeks untuk tabel `tbl_gedung`
--
ALTER TABLE `tbl_gedung`
  ADD PRIMARY KEY (`kode_gedung`);

--
-- Indeks untuk tabel `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`kode_jabatan`);

--
-- Indeks untuk tabel `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`kode_jurusan`),
  ADD KEY `kode_pegawai` (`kode_pegawai`);

--
-- Indeks untuk tabel `tbl_kelamin`
--
ALTER TABLE `tbl_kelamin`
  ADD PRIMARY KEY (`kode_kelamin`);

--
-- Indeks untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`kode_kelas`),
  ADD KEY `kode_pegawai` (`kode_pegawai`),
  ADD KEY `kode_jurusan` (`kode_jurusan`),
  ADD KEY `kode_ruangan` (`kode_ruangan`);

--
-- Indeks untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`kode_pegawai`),
  ADD KEY `kode_jabatan` (`kode_jabatan`);

--
-- Indeks untuk tabel `tbl_ruangan`
--
ALTER TABLE `tbl_ruangan`
  ADD PRIMARY KEY (`kode_ruangan`),
  ADD KEY `kode_gedung` (`kode_gedung`);

--
-- Indeks untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`kode_siswa`),
  ADD KEY `kode_agama` (`kode_agama`),
  ADD KEY `kode_kelamin` (`kode_kelamin`),
  ADD KEY `kode_kelas` (`kode_kelas`);

--
-- Indeks untuk tabel `users_aktivitas`
--
ALTER TABLE `users_aktivitas`
  ADD PRIMARY KEY (`id_users_aktivitas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_agama`
--
ALTER TABLE `tbl_agama`
  MODIFY `kode_agama` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_ekskul`
--
ALTER TABLE `tbl_ekskul`
  MODIFY `kode_ekskul` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_ekskul_gallery`
--
ALTER TABLE `tbl_ekskul_gallery`
  MODIFY `kode_ekskul_gallery` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_ekskul_jabatan`
--
ALTER TABLE `tbl_ekskul_jabatan`
  MODIFY `kode_ekskul_jabatan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_ekskul_lomba`
--
ALTER TABLE `tbl_ekskul_lomba`
  MODIFY `kode_ekskul_lomba` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_ekskul_lomba_daftar`
--
ALTER TABLE `tbl_ekskul_lomba_daftar`
  MODIFY `id_ekskul_lomba_daftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_ekskul_penilaian`
--
ALTER TABLE `tbl_ekskul_penilaian`
  MODIFY `kode_ekskul_penilaian` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_ekskul_siswa`
--
ALTER TABLE `tbl_ekskul_siswa`
  MODIFY `kode_ekskul_siswa` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_gedung`
--
ALTER TABLE `tbl_gedung`
  MODIFY `kode_gedung` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  MODIFY `kode_jabatan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  MODIFY `kode_jurusan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_kelamin`
--
ALTER TABLE `tbl_kelamin`
  MODIFY `kode_kelamin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `kode_kelas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `kode_pegawai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_ruangan`
--
ALTER TABLE `tbl_ruangan`
  MODIFY `kode_ruangan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `kode_siswa` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `users_aktivitas`
--
ALTER TABLE `users_aktivitas`
  MODIFY `id_users_aktivitas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_ekskul`
--
ALTER TABLE `tbl_ekskul`
  ADD CONSTRAINT `tbl_ekskul_ibfk_1` FOREIGN KEY (`kode_pegawai`) REFERENCES `tbl_pegawai` (`kode_pegawai`);

--
-- Ketidakleluasaan untuk tabel `tbl_ekskul_gallery`
--
ALTER TABLE `tbl_ekskul_gallery`
  ADD CONSTRAINT `tbl_ekskul_gallery_ibfk_1` FOREIGN KEY (`kode_ekskul`) REFERENCES `tbl_ekskul` (`kode_ekskul`);

--
-- Ketidakleluasaan untuk tabel `tbl_ekskul_lomba`
--
ALTER TABLE `tbl_ekskul_lomba`
  ADD CONSTRAINT `tbl_ekskul_lomba_ibfk_1` FOREIGN KEY (`kode_ekskul`) REFERENCES `tbl_ekskul` (`kode_ekskul`);

--
-- Ketidakleluasaan untuk tabel `tbl_ekskul_lomba_daftar`
--
ALTER TABLE `tbl_ekskul_lomba_daftar`
  ADD CONSTRAINT `tbl_ekskul_lomba_daftar_ibfk_1` FOREIGN KEY (`kode_ekskul_lomba`) REFERENCES `tbl_ekskul_lomba` (`kode_ekskul_lomba`),
  ADD CONSTRAINT `tbl_ekskul_lomba_daftar_ibfk_2` FOREIGN KEY (`kode_siswa`) REFERENCES `tbl_siswa` (`kode_siswa`);

--
-- Ketidakleluasaan untuk tabel `tbl_ekskul_penilaian`
--
ALTER TABLE `tbl_ekskul_penilaian`
  ADD CONSTRAINT `tbl_ekskul_penilaian_ibfk_1` FOREIGN KEY (`kode_ekskul`) REFERENCES `tbl_ekskul` (`kode_ekskul`),
  ADD CONSTRAINT `tbl_ekskul_penilaian_ibfk_2` FOREIGN KEY (`kode_siswa`) REFERENCES `tbl_siswa` (`kode_siswa`);

--
-- Ketidakleluasaan untuk tabel `tbl_ekskul_siswa`
--
ALTER TABLE `tbl_ekskul_siswa`
  ADD CONSTRAINT `tbl_ekskul_siswa_ibfk_1` FOREIGN KEY (`kode_ekskul`) REFERENCES `tbl_ekskul` (`kode_ekskul`),
  ADD CONSTRAINT `tbl_ekskul_siswa_ibfk_2` FOREIGN KEY (`kode_ekskul_jabatan`) REFERENCES `tbl_ekskul_jabatan` (`kode_ekskul_jabatan`),
  ADD CONSTRAINT `tbl_ekskul_siswa_ibfk_3` FOREIGN KEY (`kode_siswa`) REFERENCES `tbl_siswa` (`kode_siswa`);

--
-- Ketidakleluasaan untuk tabel `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD CONSTRAINT `tbl_jurusan_ibfk_1` FOREIGN KEY (`kode_pegawai`) REFERENCES `tbl_pegawai` (`kode_pegawai`);

--
-- Ketidakleluasaan untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD CONSTRAINT `tbl_kelas_ibfk_1` FOREIGN KEY (`kode_pegawai`) REFERENCES `tbl_pegawai` (`kode_pegawai`),
  ADD CONSTRAINT `tbl_kelas_ibfk_2` FOREIGN KEY (`kode_jurusan`) REFERENCES `tbl_jurusan` (`kode_jurusan`),
  ADD CONSTRAINT `tbl_kelas_ibfk_3` FOREIGN KEY (`kode_ruangan`) REFERENCES `tbl_ruangan` (`kode_ruangan`);

--
-- Ketidakleluasaan untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD CONSTRAINT `tbl_pegawai_ibfk_1` FOREIGN KEY (`kode_jabatan`) REFERENCES `tbl_jabatan` (`kode_jabatan`);

--
-- Ketidakleluasaan untuk tabel `tbl_ruangan`
--
ALTER TABLE `tbl_ruangan`
  ADD CONSTRAINT `tbl_ruangan_ibfk_1` FOREIGN KEY (`kode_gedung`) REFERENCES `tbl_gedung` (`kode_gedung`);

--
-- Ketidakleluasaan untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD CONSTRAINT `tbl_siswa_ibfk_1` FOREIGN KEY (`kode_agama`) REFERENCES `tbl_agama` (`kode_agama`),
  ADD CONSTRAINT `tbl_siswa_ibfk_2` FOREIGN KEY (`kode_kelamin`) REFERENCES `tbl_kelamin` (`kode_kelamin`),
  ADD CONSTRAINT `tbl_siswa_ibfk_3` FOREIGN KEY (`kode_kelas`) REFERENCES `tbl_kelas` (`kode_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
