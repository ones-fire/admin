-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 08:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` enum('hadir','sakit','ijin','absen') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `nama_dokumen` varchar(100) DEFAULT NULL,
  `dokumen_path` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nip` varchar(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO guru (id, nip, nama, jenis_kelamin, tanggal_lahir, alamat, jabatan, password) VALUES
(0, '1234567890', 'Administrator guru', 'laki-laki', '1990-01-01', '-', 'Administrator Lab', 'password admin guru untuk web ini'),
('1234567890', 'John Doe', 'laki-laki', '1990-01-01', 'Jl. Contoh 1', 'Guru Besar', 'password1'),
('2345678901', 'Jane Doe', 'perempuan', '1995-02-15', 'Jl. Contoh 2', 'Guru Muda', 'password2'),
('3456789012', 'Bob Smith', 'laki-laki', '1985-03-20', 'Jl. Contoh 3', 'Guru Ahli', 'password3'),
('4567890123', 'Alice Johnson', 'perempuan', '1992-04-10', 'Jl. Contoh 4', 'Guru Junior', 'password4'),
('5678901234', 'David Wilson', 'laki-laki', '1988-05-05', 'Jl. Contoh 5', 'Guru Senior', 'password5'),
('6789012345', 'Eva Brown', 'perempuan', '1998-06-25', 'Jl. Contoh 6', 'Guru Utama', 'password6'),
('7890123456', 'Chris Davis', 'laki-laki', '1980-07-30', 'Jl. Contoh 7', 'Guru Spesialis', 'password7'),
('8901234567', 'Mia Lee', 'perempuan', '1987-08-12', 'Jl. Contoh 8', 'Guru Pendamping', 'password8'),
('9012345678', 'Ryan Miller', 'laki-laki', '1993-09-18', 'Jl. Contoh 9', 'Guru Kontrak', 'password9'),
('0123456789', 'Sophie Taylor', 'perempuan', '1982-10-22', 'Jl. Contoh 10', 'Guru Magang', 'password10');


-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `admin` (`id`, `nama`, `password`) VALUES
(0, 'Administrator','password yang ada pada web ini');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nisn` varchar(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') DEFAULT NULL,
  `kelas` enum('1','2','3','4','5','6') DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

INSERT INTO siswa (id, nisn, nama, jenis_kelamin, kelas, alamat, tanggal_lahir, password)
VALUES
  (1, '20210001', 'John Doe', 'laki-laki', '1', 'Jalan ABC No. 123', '2005-01-01', 'password1'),
  (2, '20190002', 'Jane Smith', 'perempuan', '2', 'Jalan XYZ No. 456', '2006-02-02', 'password2'),
  (3, '20220003', 'David Johnson', 'laki-laki', '3', 'Jalan DEF No. 789', '2007-03-03', 'password3'),
  (4, '20180004', 'Sarah Williams', 'perempuan', '4', 'Jalan UVW No. 1011', '2008-04-04', 'password4'),
  (5, '20230005', 'Michael Brown', 'laki-laki', '5', 'Jalan GHI No. 1213', '2009-05-05', 'password5'),
  (6, '20170006', 'Emily Davis', 'perempuan', '6', 'Jalan RST No. 1415', '2010-06-06', 'password6'),
  (7, '20240007', 'Daniel Wilson', 'laki-laki', '1', 'Jalan JKL No. 1617', '2011-07-07', 'password7'),
  (8, '20160008', 'Olivia Taylor', 'perempuan', '2', 'Jalan MNO No. 1819', '2012-08-08', 'password8'),
  (9, '20250009', 'James Anderson', 'laki-laki', '3', 'Jalan PQR No. 2021', '2013-09-09', 'password9'),
  (10, '20150010', 'Sophia Thomas', 'perempuan', '4', 'Jalan STU No. 2223', '2014-10-10', 'password10');

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumen_ibfk_1` (`siswa_id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
