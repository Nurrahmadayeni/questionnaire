-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2017 at 07:18 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(100) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jkl` enum('pria','wanita') DEFAULT NULL,
  `id_user` int(100) DEFAULT NULL,
  `id_fak` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `jkl`, `id_user`, `id_fak`) VALUES
('1249209209', 'Bujing Susantiq', 'wanita', 15, 12),
('1515151515', 'john', 'pria', 3, 13),
('1721100212', 'dewi', 'wanita', 10, 12);

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fak` int(100) NOT NULL,
  `nama_fak` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fak`, `nama_fak`) VALUES
(1, 'Fakultas Kedokteran'),
(2, 'Fakultas Hukum'),
(3, 'Fakultas Pertanian'),
(4, 'Fakultas Teknik'),
(5, 'Fakultas Ekonomi'),
(6, 'Fakultas Kedokteran Gigi'),
(7, 'Fakultas Ilmu Budaya'),
(8, 'Fakultas Matematika dan IPA'),
(9, 'Fakultas Imu-Ilmu Sosial dan Politik'),
(10, 'Fakultas Kesehatan Masyarakat'),
(11, 'Fakultas Keperawatan'),
(12, 'Fakultas Psikologi'),
(13, 'Fakultas Ilmu Komputer dan Teknologi Informasi'),
(14, 'Fakultas Farmasi'),
(15, 'Sekola Pascasarjana');

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `id_krs` int(11) NOT NULL,
  `nim` varchar(100) NOT NULL,
  `id_matkul` varchar(100) NOT NULL,
  `thn_ajaran` varchar(100) NOT NULL,
  `semester` enum('genap','ganjil') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`id_krs`, `nim`, `id_matkul`, `thn_ajaran`, `semester`) VALUES
(1, '121402036', '1', '2015', 'genap'),
(2, '121402036', '2', '2016', 'ganjil'),
(3, '121402036', '3', '2016', 'genap'),
(4, '120101016', '4', '2016', 'genap'),
(5, '121402036', '5', '2016', 'genap'),
(6, '121402022', '1', '2016', 'genap'),
(7, '121402022', '2', '2016', 'genap'),
(8, '121402022', '3', '2016', 'genap'),
(9, '121402022', '4', '2016', 'genap'),
(10, '121402022', '5', '2016', 'genap'),
(11, '120309022', '6', '2016', 'genap'),
(12, '120309022', '7', '2016', 'genap'),
(13, '120309022', '8', '2016', 'genap'),
(14, '120309022', '9', '2016', 'genap'),
(15, '120309022', '10', '2016', 'genap'),
(16, '120309022', '11', '2016', 'genap'),
(17, '120309022', '12', '2016', 'genap'),
(18, '120309026', '8', '2016', 'genap'),
(19, '120309026', '9', '2016', 'genap'),
(20, '120309026', '10', '2016', 'genap'),
(21, '120309026', '11', '2016', 'genap'),
(22, '120309026', '12', '2016', 'genap');

-- --------------------------------------------------------

--
-- Table structure for table `mat_kul`
--

CREATE TABLE `mat_kul` (
  `id_matkul` int(100) NOT NULL,
  `nama_matkul` varchar(255) NOT NULL,
  `id_fak` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mat_kul`
--

INSERT INTO `mat_kul` (`id_matkul`, `nama_matkul`, `id_fak`) VALUES
(1, 'Dasar - Dasar Web', 13),
(2, 'Dasar - Dasar Pemrograman', 13),
(3, 'Object Oriented Programming', 13),
(4, 'Pemrograman Internet', 13),
(5, 'Pemrograman Java', 13),
(7, 'Pemrograman Mobile', 13),
(8, 'Teori Dasar dan Aplikasi Psikologi : Industri dan Organisasi', 12),
(9, 'Teori Dasar dan Aplikasi Psikologi Pendidikan', 12),
(10, 'Metode Riset Psikologi : Survei', 12),
(11, 'Psikologi Perilaku Kerja', 12),
(12, 'Pendidikan Anak Usia Dini', 12);

-- --------------------------------------------------------

--
-- Table structure for table `mhs`
--

CREATE TABLE `mhs` (
  `nim` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jkl` enum('pria','wanita') DEFAULT NULL,
  `id_user` int(100) DEFAULT NULL,
  `id_fak` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mhs`
--

INSERT INTO `mhs` (`nim`, `nama`, `jkl`, `id_user`, `id_fak`) VALUES
('120309022', 'Galih', 'pria', 14, 12),
('120309026', 'Fahmi Eka Putra', 'pria', 8, 12),
('121402022', 'Nurrahmadayeni', 'wanita', 1, 13),
('121402036', 'Endang Windarsih', 'wanita', 2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nik` varchar(100) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jkl` enum('pria','wanita') DEFAULT NULL,
  `id_user` int(100) DEFAULT NULL,
  `id_unit` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nik`, `nama`, `jkl`, `id_user`, `id_unit`) VALUES
('12822928289', 'ompai', 'pria', 4, 21),
('133333', 'tri', 'pria', 9, 20);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(100) NOT NULL,
  `skala` int(10) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `skala`, `profile`, `value`) VALUES
(1, 4, 'bagus', 'Sangat Kurang Bagus, Kurang Bagus, Bagus, Sangat Bagus'),
(2, 4, 'cepat', 'Sangat Kurang Cepat, Kurang Cepat, Cepat, Sangat Cepat '),
(3, 4, 'setuju', 'Sangat Kurang Setuju, Kurang Setuju, Setuju, Sangat Setuju'),
(4, 5, 'bagus', 'Sangat Kurang Bagus, Kurang Bagus, Sedang,  Bagus, Sangat Bagus'),
(5, 5, 'cepat', 'Sangat Kurang Cepat, Kurang Cepat, Sedang, Cepat, Sangat Cepat '),
(6, 5, 'setuju', 'Sangat Kurang Setuju, Kurang Setuju, Sedang, Setuju, Sangat Setuju'),
(7, 6, 'bagus', 'Sangat-Sangat Kurang Bagus, Sangat Kurang Bagus, Kurang Bagus, Bagus, Sangat Bagus, Sangat-Sangat Bagus'),
(8, 6, 'cepat', 'Sangat-Sangat Tidak Cepat, Sangat Kurang Cepat, Kurang Cepat, Cepat, Sangat Cepat, Sangat-Sangat Cepat'),
(9, 6, 'setuju', 'Sangat-Sangat Kurang Setuju, Sangat Kurang Setuju, Kurang Setuju, Setuju, Sangat Setuju, Sangat-Sangat Setuju');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id_q` int(100) NOT NULL,
  `id_survey` int(100) DEFAULT NULL,
  `id_profile` int(100) NOT NULL,
  `question` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id_q`, `id_survey`, `id_profile`, `question`) VALUES
(1, 1, 1, 'Tanya 1'),
(2, 1, 2, 'Tanya 2'),
(3, 1, 3, 'Tanya 3'),
(4, 2, 4, 'tanya umum 1'),
(5, 2, 5, 'tanya umum 2'),
(6, 2, 6, 'tanya umum 3'),
(7, 3, 7, 'tanya psikologi 1'),
(8, 3, 9, 'tanya psikologi 2'),
(9, 4, 4, 'Survey umum Psikologi 1'),
(10, 4, 5, 'Survey umum Psikologi 2'),
(11, 6, 5, 'Tanya akademik 1'),
(12, 6, 4, 'tanya akademik 2'),
(13, 6, 6, 'tanya akademik 3');

-- --------------------------------------------------------

--
-- Table structure for table `quest_user`
--

CREATE TABLE `quest_user` (
  `id` int(11) NOT NULL,
  `id_user` int(100) DEFAULT NULL,
  `id_survey` int(100) DEFAULT NULL,
  `id_q` int(100) DEFAULT NULL,
  `id_matkul` varchar(100) DEFAULT NULL,
  `answer` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id_survey` int(100) NOT NULL,
  `id_owner` int(100) NOT NULL,
  `objective` int(100) DEFAULT NULL,
  `matakuliah` int(10) NOT NULL,
  `tittle` text,
  `start_date` date DEFAULT NULL,
  `due_date` date NOT NULL,
  `mhs` int(10) NOT NULL,
  `dsn` int(10) NOT NULL,
  `pgw` int(10) NOT NULL,
  `skala` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id_survey`, `id_owner`, `objective`, `matakuliah`, `tittle`, `start_date`, `due_date`, `mhs`, `dsn`, `pgw`, `skala`) VALUES
(1, 21, 21, 1, 'Survey fasilkomTI', '2017-04-15', '2017-05-07', 1, 0, 0, 4),
(2, 21, 21, 0, 'Survey UMUM', '2017-04-15', '2017-05-14', 1, 1, 1, 5),
(3, 20, 20, 1, 'Sruvey Psikologi', '2017-04-22', '2017-05-21', 1, 0, 0, 6),
(4, 20, 20, 0, 'Survey Psikologi Umum', '2017-04-22', '2017-05-14', 1, 1, 1, 5),
(5, 1, 20, 1, 'Survey Akademik Matakuliah', '2017-04-15', '2017-05-14', 1, 0, 0, 5),
(6, 1, 21, 1, 'Survey Akademik Matakuliah', '2017-04-15', '2017-05-14', 1, 0, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `id_unit` int(100) NOT NULL,
  `nama_unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`id_unit`, `nama_unit`) VALUES
(1, 'Biro Akademik'),
(2, 'Biro Kemahasiswaan dan Kealumnian'),
(3, 'Biro Keuangan'),
(4, 'Biro Pemeliharaan dan Pengembangan Aset'),
(5, 'Biro Penelitian Pengabdian Kepada Masyarakat'),
(6, 'Biro Sistem Informasi Perencanaan dan Pengembangan'),
(7, 'Biro Sumber Daya Manusia'),
(8, 'Sekretariat Universitas'),
(9, 'Fakultas Kedokteran'),
(10, 'Fakultas Hukum'),
(11, 'Fakultas Pertanian'),
(12, 'Fakultas Teknik'),
(13, 'Fakultas Ekonomi'),
(14, 'Fakultas Kedokteran Gigi'),
(15, 'Fakultas Ilmu Budaya'),
(16, 'Fakultas Matematika dan IPA'),
(17, 'Fakultas Imu-Ilmu Sosial dan Politik'),
(18, 'Fakultas Kesehatan Masyarakat'),
(19, 'Fakultas Keperawatan'),
(20, 'Fakultas Psikologi'),
(21, 'Fakultas Ilmu Komputer dan Teknologi Informasi'),
(22, 'Fakultas Farmasi'),
(23, 'Sekola Pascasarjana'),
(24, 'Lembaga Penelitian'),
(25, 'Lembaga Pengabdian Kepada Masyarakat'),
(26, 'Perpustakaan Universitas'),
(27, 'Pusat Sistem Informasi'),
(28, 'Rumah Sakit Universitas');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(100) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` enum('super','unit','fakultas','dsn','pgw','mhs') NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `status`) VALUES
(1, 'ani', '827ccb0eea8a706c4c34a16891f84e7b', 'mhs', 0),
(2, 'endang', '827ccb0eea8a706c4c34a16891f84e7b', 'mhs', 0),
(3, 'john', '827ccb0eea8a706c4c34a16891f84e7b', 'dsn', 0),
(4, 'ompai', '827ccb0eea8a706c4c34a16891f84e7b', 'pgw', 0),
(5, 'fasilkomti', '827ccb0eea8a706c4c34a16891f84e7b', 'fakultas', 21),
(6, 'akademik', '827ccb0eea8a706c4c34a16891f84e7b', 'unit', 1),
(7, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'super', 0),
(8, 'fahmi', '827ccb0eea8a706c4c34a16891f84e7b', 'mhs', 0),
(9, 'tri', '827ccb0eea8a706c4c34a16891f84e7b', 'pgw', 0),
(10, 'dewi', '827ccb0eea8a706c4c34a16891f84e7b', 'dsn', 0),
(11, 'kedokteran', '827ccb0eea8a706c4c34a16891f84e7b', 'fakultas', 9),
(12, 'psikologi', '827ccb0eea8a706c4c34a16891f84e7b', 'fakultas', 20),
(13, 'hukum', '827ccb0eea8a706c4c34a16891f84e7b', 'fakultas', 10),
(14, 'galih', '827ccb0eea8a706c4c34a16891f84e7b', 'mhs', 0),
(15, 'bujing', '827ccb0eea8a706c4c34a16891f84e7b', 'dsn', 0),
(16, 'ombale', '827ccb0eea8a706c4c34a16891f84e7b', 'pgw', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fak`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id_krs`);

--
-- Indexes for table `mat_kul`
--
ALTER TABLE `mat_kul`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indexes for table `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_q`);

--
-- Indexes for table `quest_user`
--
ALTER TABLE `quest_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id_survey`);

--
-- Indexes for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id_krs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `mat_kul`
--
ALTER TABLE `mat_kul`
  MODIFY `id_matkul` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id_q` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `quest_user`
--
ALTER TABLE `quest_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id_survey` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `id_unit` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
