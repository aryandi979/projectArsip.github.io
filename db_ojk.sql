-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2022 at 07:25 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ojk`
--

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id_document` int(11) NOT NULL,
  `Nama_Berkas` varchar(255) NOT NULL,
  `Tahun` int(11) NOT NULL,
  `Kode_Klasifikasi` varchar(255) NOT NULL,
  `Lokasi` varchar(255) NOT NULL,
  `File` varchar(255) DEFAULT NULL,
  `Ruangan` int(11) NOT NULL,
  `Rak` int(11) NOT NULL,
  `Dus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id_document`, `Nama_Berkas`, `Tahun`, `Kode_Klasifikasi`, `Lokasi`, `File`, `Ruangan`, `Rak`, `Dus`) VALUES
(1, 'test', 2021, 'PB.01.02', '01.02.03', 'http://localhost/ojkarsip/uploads/files/Pembukaan_Unit_Layanan_PT_Gadai_Mas_NTB_2021.PDF', 1, 2, '03'),
(6, 'test', 2021, 'pb.02.03', '01.02.03', 'http://localhost/ojkarsip/uploads/files/1202144064 Registrasi _ Telkom University.pdf', 1, 2, '03'),
(8, 'BPR mataram', 2021, 'PB.01.02', '01.02.03', 'http://localhost/ojkarsip/uploads/files/Pembukaan_Unit_Layanan_PT_Gadai_Mas_NTB_2021.PDF', 1, 2, '03');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(255) DEFAULT NULL,
  `password_expire_date` datetime DEFAULT '2022-08-20 00:00:00',
  `password_reset_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `Username`, `Password`, `Email`, `login_session_key`, `email_status`, `password_expire_date`, `password_reset_key`) VALUES
(1, 'admin', '$2y$10$i0Ii.UXmFwLh2RcUsgI/gOoMzYt9Xaaq.0Br.yJ8Te.lU77pEfy0a', 'admin@gmail.com', NULL, NULL, '2022-08-20 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id_document`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id_document` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
