-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2026 at 02:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2526_16db`
--

-- --------------------------------------------------------

--
-- Table structure for table `user-cristal`
--

CREATE TABLE `user-cristal` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user-cristal`
--

INSERT INTO `user-cristal` (`id`, `username`, `nama_lengkap`, `kelas`, `jabatan`, `jenis_kelamin`, `alamat`, `password`, `role`) VALUES
(1, 'Rauf', 'Rauf Putra Gunawan', 'XI TJKT 2', 'Anggota Baru', 'Laki-laki', 'Bandung\r\n', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(21, 'awan', 'Awan aja', 'XI TJKT 2', 'Pengurus', 'Laki-laki', 'bandung', '202cb962ac59075b964b07152d234b70', 'user'),
(23, 'admin2', 'Budi', 'XI TJKT 2', 'Wakil Ketua', 'Laki-laki', 'Indonesia', '202cb962ac59075b964b07152d234b70', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user-cristal`
--
ALTER TABLE `user-cristal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user-cristal`
--
ALTER TABLE `user-cristal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
