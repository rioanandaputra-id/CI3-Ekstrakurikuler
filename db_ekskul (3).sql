-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 20 Mar 2021 pada 01.35
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ekskul`
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
(1, 'SMA NEGERI 7 BANDAR LAMPUNG', '10301989', '4232322', 'JL. PRABOWO, S.Kom, M.Kom', 26175, '0751-190285', 'Linggar Jati', 'TANJUNG ', 'BANDAR LAMPUNG', 'LAMPUNG', 'SMK7NBDL.SCH.ID', 'dankrez48@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_agama`
--

CREATE TABLE `tbl_agama` (
  `kode_agama` varchar(5) NOT NULL,
  `agama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_agama`
--

INSERT INTO `tbl_agama` (`kode_agama`, `agama`) VALUES
('001', 'Islam'),
('002', 'Katholik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ekskul`
--

CREATE TABLE `tbl_ekskul` (
  `kode_ekskul` varchar(5) NOT NULL,
  `nama_ekskul` varchar(255) NOT NULL,
  `kode_pegawai` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ekskul`
--

INSERT INTO `tbl_ekskul` (`kode_ekskul`, `nama_ekskul`, `kode_pegawai`) VALUES
('1', 'PRAMUKA', '3'),
('2', 'PMR', '2'),
('3', 'KIR', '1');

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
(25, 2, 'foto_gallery/WhatsApp Image 2021-03-17 at 01.28.59.jpeg', '2021-03-19', 'aaaa', ''),
(26, 1, 'foto_gallery/20210320060856-WhatsApp Image 2021-03-17 at 01.25.07.jpeg', '2021-03-20', 'wqwqw', '');

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
(1, 'Ketua');

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
(8, 'lomba', 2, '2021-03-25', '2021-03-26', '2021-03-31', 'sekolah', 'lapangan', 'sekolah11111qwqwqw', '20210320064302-Ajuan S29d Semester 2 MA Mathlaul Anwar Labuhan Ratu (2).xlsx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ekskul_penilaian`
--

CREATE TABLE `tbl_ekskul_penilaian` (
  `kode_ekskul_penilaian` int(5) NOT NULL,
  `kode_siswa` int(5) NOT NULL,
  `kode_ekskul` int(5) NOT NULL,
  `nilai_ekskul` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ekskul_penilaian`
--

INSERT INTO `tbl_ekskul_penilaian` (`kode_ekskul_penilaian`, `kode_siswa`, `kode_ekskul`, `nilai_ekskul`) VALUES
(1, 23433, 2, 11),
(2, 23433, 1, 22);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ekskul_siswa`
--

CREATE TABLE `tbl_ekskul_siswa` (
  `kode_ekskul_siswa` int(5) NOT NULL,
  `kode_siswa` varchar(5) NOT NULL,
  `kode_ekskul_jabatan` varchar(5) NOT NULL,
  `kode_ekskul` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_gedung`
--

CREATE TABLE `tbl_gedung` (
  `kode_gedung` varchar(10) NOT NULL,
  `nama_gedung` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_gedung`
--

INSERT INTO `tbl_gedung` (`kode_gedung`, `nama_gedung`) VALUES
('001', 'Gedung A'),
('002', 'Gedung B'),
('003', 'Gedung C'),
('004', 'Gedung D');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `kode_jabatan` varchar(5) NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jabatan`
--

INSERT INTO `tbl_jabatan` (`kode_jabatan`, `nama_jabatan`) VALUES
('1', 'Admin'),
('2', 'Guru'),
('3', 'Pembina'),
('4', 'Ketua Jurusan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `kode_jurusan` varchar(10) NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL,
  `bidang_keahlian` varchar(150) NOT NULL,
  `kompetensi_umum` varchar(150) NOT NULL,
  `kompetensi_khusus` varchar(150) NOT NULL,
  `kode_pegawai` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`kode_jurusan`, `nama_jurusan`, `bidang_keahlian`, `kompetensi_umum`, `kompetensi_khusus`, `kode_pegawai`) VALUES
('001', 'IPA', '-', '-', '-', '1'),
('002', 'IPS', '-', '-', '-', '1'),
('003', 'MATEMATIKA', '-', '-', '-', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kelamin`
--

CREATE TABLE `tbl_kelamin` (
  `kode_kelamin` varchar(5) NOT NULL,
  `kelamin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kelamin`
--

INSERT INTO `tbl_kelamin` (`kode_kelamin`, `kelamin`) VALUES
('001', 'Laki-Laki'),
('002', 'Perempuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `kode_kelas` int(5) NOT NULL,
  `kode_pegawai` varchar(5) NOT NULL,
  `kode_jurusan` varchar(5) NOT NULL,
  `kode_ruangan` varchar(5) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`kode_kelas`, `kode_pegawai`, `kode_jurusan`, `kode_ruangan`, `nama_kelas`) VALUES
(3, '1', '003', '002', 'XII 1');

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
  `kode_jabatan` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`kode_pegawai`, `nip`, `nik`, `nama`, `foto`, `tempat_lahir`, `tanggal_lahir`, `username`, `email`, `password`, `alamat`, `telpon`, `kode_jabatan`) VALUES
(1, '1234', '1234', 'MOHAMMED TOHA', 'foto_pegawai/20210308161857-chicken_dribbble-removebg-preview.png', 'BANDAR LAMPUNG', '1976-03-08', 'kajur', 'toha@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Jl. Melayu1', '0898989898', '4'),
(2, '1', '2', '1', 'foto_pegawai/default.jpg', '1', '2021-03-18', 'admin', '1212@2323', '21232f297a57a5a743894a0e4a801fc3', 'swdsd', '343434', '1'),
(3, '123', '133', 'Pembina', 'foto_pegawai/20210320052640-WhatsApp Image 2021-03-17 at 01.25.07.jpeg', 'erer', '2021-03-20', 'pembina', '11@22.2', '21232f297a57a5a743894a0e4a801fc3', '3434', '32323', '3'),
(4, '24234', '234234', '234234', 'foto_pegawai/20210320062657-ok0.ts', '234324', '2021-03-20', 'guru', 'weqwe@32323.2323', 'd41d8cd98f00b204e9800998ecf8427e', 'wqeqwe', '2323', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ruangan`
--

CREATE TABLE `tbl_ruangan` (
  `kode_ruangan` varchar(10) NOT NULL,
  `nama_ruangan` varchar(255) NOT NULL,
  `kode_gedung` varchar(10) NOT NULL,
  `lantai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ruangan`
--

INSERT INTO `tbl_ruangan` (`kode_ruangan`, `nama_ruangan`, `kode_gedung`, `lantai`) VALUES
('001', 'Ruang A', '001', 1),
('002', 'Ruang B', '001', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `kode_siswa` int(5) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode_kelamin` varchar(5) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kode_agama` varchar(5) NOT NULL,
  `telpon` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `kode_kelas` varchar(5) NOT NULL,
  `angkatan` year(4) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'foto_siswa/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`kode_siswa`, `nisn`, `nama`, `kode_kelamin`, `tempat_lahir`, `tanggal_lahir`, `kode_agama`, `telpon`, `username`, `email`, `password`, `alamat`, `kode_kelas`, `angkatan`, `foto`) VALUES
(23434, '2323', '2323', '001', '2323', '2021-03-27', '001', '1', '1', '11@22.2', '8d5891b55ccb5f5809559d62af779ae306d2f39b23e0d2508a11e8140b049f003e4004e6f5189b5513d56c1ba75074f9efba4a02b7ab92db43496f426e46075e', '1', '3', 2020, 'foto_siswa/default.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(5) NOT NULL,
  `username` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `password` text COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telpon` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `jabatan` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'sekolah',
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `email`, `no_telpon`, `jabatan`, `level`, `aktif`) VALUES
(1, 'admin', 'ff594f8cf10ca2e3ad4279375f0d0e688a7eca861000e7ecc63ae4b105c8be7bcb57e8c1172ea460c462c6f715508dc356fd964cf41644682db1feffd466769a', 'Administrator', 'admin@sman3bukittinggi.sch.id', '081267771344', 'Kepala IT', 'superuser', 'Y');

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
(18, '1', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 3, '02:26:40', '2021-03-20'),
(17, '1', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 3, '02:25:42', '2021-03-20'),
(19, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '02:35:45', '2021-03-20'),
(20, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '02:57:14', '2021-03-20'),
(21, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '02:58:15', '2021-03-20'),
(22, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '02:59:11', '2021-03-20'),
(23, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '03:44:25', '2021-03-20'),
(24, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '03:45:01', '2021-03-20'),
(25, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '03:45:59', '2021-03-20'),
(26, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '03:53:52', '2021-03-20'),
(27, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '03:54:05', '2021-03-20'),
(28, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '03:55:39', '2021-03-20'),
(29, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '03:58:33', '2021-03-20'),
(30, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '03:59:16', '2021-03-20'),
(31, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '04:04:52', '2021-03-20'),
(32, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '04:05:57', '2021-03-20'),
(33, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '04:07:39', '2021-03-20'),
(34, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '04:08:16', '2021-03-20'),
(35, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '04:14:09', '2021-03-20'),
(36, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '04:14:40', '2021-03-20'),
(37, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '04:15:29', '2021-03-20'),
(38, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '04:15:35', '2021-03-20'),
(39, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '04:17:37', '2021-03-20'),
(40, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '04:18:21', '2021-03-20'),
(41, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '04:23:15', '2021-03-20'),
(42, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '04:24:01', '2021-03-20'),
(43, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '04:24:20', '2021-03-20'),
(44, '23433', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 0, '04:24:33', '2021-03-20'),
(45, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '05:19:33', '2021-03-20'),
(46, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '05:22:22', '2021-03-20'),
(47, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '05:27:24', '2021-03-20'),
(48, '3', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 3, '05:29:47', '2021-03-20'),
(49, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '05:33:44', '2021-03-20'),
(50, '3', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 3, '05:34:00', '2021-03-20'),
(51, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '06:23:20', '2021-03-20'),
(52, '3', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 3, '06:23:30', '2021-03-20'),
(53, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '06:25:28', '2021-03-20'),
(54, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '06:31:17', '2021-03-20'),
(55, '2', '::1', 'Chrome 89.0.4389.90', 'Windows 10', 1, '06:32:19', '2021-03-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `identitas_sekolah`
--
ALTER TABLE `identitas_sekolah`
  ADD PRIMARY KEY (`id_identitas_sekolah`);

--
-- Indexes for table `tbl_agama`
--
ALTER TABLE `tbl_agama`
  ADD PRIMARY KEY (`kode_agama`);

--
-- Indexes for table `tbl_ekskul`
--
ALTER TABLE `tbl_ekskul`
  ADD PRIMARY KEY (`kode_ekskul`);

--
-- Indexes for table `tbl_ekskul_gallery`
--
ALTER TABLE `tbl_ekskul_gallery`
  ADD PRIMARY KEY (`kode_ekskul_gallery`);

--
-- Indexes for table `tbl_ekskul_jabatan`
--
ALTER TABLE `tbl_ekskul_jabatan`
  ADD PRIMARY KEY (`kode_ekskul_jabatan`);

--
-- Indexes for table `tbl_ekskul_lomba`
--
ALTER TABLE `tbl_ekskul_lomba`
  ADD PRIMARY KEY (`kode_ekskul_lomba`);

--
-- Indexes for table `tbl_ekskul_penilaian`
--
ALTER TABLE `tbl_ekskul_penilaian`
  ADD PRIMARY KEY (`kode_ekskul_penilaian`);

--
-- Indexes for table `tbl_ekskul_siswa`
--
ALTER TABLE `tbl_ekskul_siswa`
  ADD PRIMARY KEY (`kode_ekskul_siswa`);

--
-- Indexes for table `tbl_gedung`
--
ALTER TABLE `tbl_gedung`
  ADD PRIMARY KEY (`kode_gedung`);

--
-- Indexes for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`kode_jabatan`);

--
-- Indexes for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`kode_jurusan`);

--
-- Indexes for table `tbl_kelamin`
--
ALTER TABLE `tbl_kelamin`
  ADD PRIMARY KEY (`kode_kelamin`);

--
-- Indexes for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`kode_kelas`);

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`kode_pegawai`);

--
-- Indexes for table `tbl_ruangan`
--
ALTER TABLE `tbl_ruangan`
  ADD PRIMARY KEY (`kode_ruangan`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`kode_siswa`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `users_aktivitas`
--
ALTER TABLE `users_aktivitas`
  ADD PRIMARY KEY (`id_users_aktivitas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `identitas_sekolah`
--
ALTER TABLE `identitas_sekolah`
  MODIFY `id_identitas_sekolah` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_ekskul_gallery`
--
ALTER TABLE `tbl_ekskul_gallery`
  MODIFY `kode_ekskul_gallery` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `tbl_ekskul_jabatan`
--
ALTER TABLE `tbl_ekskul_jabatan`
  MODIFY `kode_ekskul_jabatan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_ekskul_lomba`
--
ALTER TABLE `tbl_ekskul_lomba`
  MODIFY `kode_ekskul_lomba` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_ekskul_penilaian`
--
ALTER TABLE `tbl_ekskul_penilaian`
  MODIFY `kode_ekskul_penilaian` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_ekskul_siswa`
--
ALTER TABLE `tbl_ekskul_siswa`
  MODIFY `kode_ekskul_siswa` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `kode_kelas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `kode_pegawai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `kode_siswa` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23435;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `users_aktivitas`
--
ALTER TABLE `users_aktivitas`
  MODIFY `id_users_aktivitas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
