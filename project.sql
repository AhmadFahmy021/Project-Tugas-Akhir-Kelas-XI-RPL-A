-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 27, 2023 at 02:00 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `idkamar` int NOT NULL,
  `nokamar` int NOT NULL,
  `deskripsi` text NOT NULL,
  `tarif` int NOT NULL,
  `passwordwifi` varchar(15) NOT NULL,
  `idstatus` int NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`idkamar`, `nokamar`, `deskripsi`, `tarif`, `passwordwifi`, `idstatus`) VALUES
(5, 12, 'kamar ini banyak yang mencari', 400000, 'kamar12', 1),
(6, 13, 'daadadaddad', 300000, 'kamar13', 1),
(7, 14, 'awqewqewqewq', 400000, 'kamar14', 1),
(8, 15, 'wqeweqeqw', 400000, 'kamar15', 1),
(9, 16, 'wqwewqe', 300000, 'kamar16', 1),
(10, 1, 'Kamar ini agak luas dari kamar yang biasa', 600000, 'kamar22', 1),
(12, 2, 'kamar nyamann', 500000, 'kamar2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `idpembayaran` int NOT NULL,
  `nama` varchar(60) NOT NULL,
  `telepon` varchar(19) NOT NULL,
  `masuk` date NOT NULL,
  `idkamar` int NOT NULL,
  `lama` int NOT NULL,
  `idstatus` int NOT NULL,
  `bayar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`idpembayaran`, `nama`, `telepon`, `masuk`, `idkamar`, `lama`, `idstatus`, `bayar`) VALUES
(1, 'Ahmad Fahmy', '081252512160', '2022-12-31', 6, 10, 3, '2023-11-22'),
(2, 'fahmy', '12131', '2022-11-30', 9, 10, 4, '2022-11-22'),
(3, 'Ahmad Fahmy Ghifariel ', '081252512088', '2121-11-11', 5, 12, 4, NULL),
(4, 'namy', '67676', '2022-11-26', 8, 1, 4, NULL),
(5, 'nabil2', '081252512160', '2022-11-30', 12, 10, 3, '2028-11-22'),
(6, 'trisqi', '156899', '2022-11-24', 8, 10, 4, NULL),
(7, 'Ahmad Fahmy Ghifariel ', '081252512088', '2022-12-23', 10, 10, 4, NULL),
(8, 'Ahmad Fahmy ', '081252512160', '2022-12-31', 7, 2, 4, NULL),
(9, 'Ahmadfahmy2', '8796645868465', '2022-12-10', 10, 10, 4, NULL),
(10, 'Ahmadfahmy2', '8796645868465', '2022-12-10', 10, 10, 4, NULL),
(11, 'dsds', '8796645868465', '2022-12-17', 8, 12, 4, NULL),
(12, 'dsds', '8796645868465', '2022-12-17', 8, 12, 4, NULL),
(13, 'dad', '088803855786', '1222-02-12', 12, 10, 4, NULL),
(14, 'dsadsad', '2222', '2022-12-31', 5, 12, 4, NULL),
(15, 'seqwe', '11111', '2022-12-16', 12, 12, 4, NULL),
(16, 'sasas', '08125251216', '2022-12-28', 12, 9, 4, NULL),
(17, 'sasas', '08125251216', '2022-12-23', 6, 3, 4, NULL),
(18, 'sqqwqww', '081252512088', '2022-12-17', 9, 8, 4, NULL),
(19, 'sqqwqww', '081252512088', '2022-12-17', 9, 8, 4, NULL),
(20, 'sqqwqww', '081252512088', '2022-12-17', 9, 8, 4, NULL),
(21, 'sqqwqww', '081252512088', '2022-12-17', 9, 8, 4, NULL),
(22, 'sqqwqww', '081252512088', '2022-12-17', 9, 8, 4, NULL),
(23, 'sqqwqww', '081252512088', '2022-12-17', 5, 12, 4, NULL),
(24, 'dsds', '081252512088', '2022-12-22', 5, 8, 4, NULL),
(25, 'dsds', '081252512088', '2022-12-22', 5, 8, 4, NULL),
(26, 'ewew', '223232', '2022-12-10', 6, 11, 4, NULL),
(27, 'fsfdfd', '2212', '2022-12-24', 9, 9, 4, NULL),
(28, 'fsfdfd', '2212', '2022-12-24', 9, 9, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penghuni`
--

CREATE TABLE `penghuni` (
  `idpenghuni` int NOT NULL,
  `namapenghuni` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(70) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `kampus` varchar(90) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `masuk` date NOT NULL,
  `idkamar` int NOT NULL,
  `sandi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penghuni`
--

INSERT INTO `penghuni` (`idpenghuni`, `namapenghuni`, `alamat`, `kota`, `telepon`, `kampus`, `foto`, `masuk`, `idkamar`, `sandi`) VALUES
(1, 'Ahmad Fahmy', 'ewwe', 'Jombang', '081252512160', 'ewew2', '637e0acf01445.jpg', '2022-12-31', 6, 'IVHUvaAW'),
(2, 'fahmy', 'dsd', 'dsds', '12131', 'ub', '637c4b0828bd8.jpg', '2022-11-30', 9, 'wVSfNIAb'),
(3, 'Ahmad Fahmy Ghifariel ', 'sasa', 'sasa', '081252512088', 'sasa', '637da4b1a6e7d.jpg', '2121-11-11', 5, 'ZagDGzdR'),
(4, 'namy', 'ngoro', 'dsds', '67676', 'ub', '637def94ccad7.jpeg', '2022-11-26', 8, 'uDdJBSvM'),
(5, 'nabil2', 'dau', 'malang', '081252512160', 'UB', '6384263c0774f.jpg', '2022-11-30', 12, 'XuAMlpSI'),
(6, 'trisqi', 'yuio', 'batu', '156899', 'Unervisitas Brawijaya', '63874fefe7a6a.jpg', '2022-11-24', 8, 'VcqMKYZd'),
(7, 'Ahmad Fahmy Ghifariel ', 'jmg', 'Jombang', '081252512088', 'Universitas Indonesia', '63892def2f837.jpg', '2022-12-23', 10, 'XKPmvbYs'),
(8, 'Ahmad Fahmy ', 'frfr', 'Mojokerto', '081252512160', 'Universitas Indonesia', '63898776c4b03.jpg', '2022-12-31', 6, 'tRhagPJW'),
(9, 'Ahmadfahmy2', 'asasas', 'sasa', '8796645868465', 'sasa', '63930cf50ef23.jpg', '2022-12-10', 10, 'crNgqiSC'),
(10, 'Ahmadfahmy2', 'asasas', 'sasa', '8796645868465', 'sasa', '63930d15bf89e.jpg', '2022-12-10', 10, 'crNgqiSC'),
(11, 'dsds', 'dsdsds', 'dsds', '8796645868465', 'ds', '63930d2d125ed.jpg', '2022-12-17', 8, 'zGXUeCNo'),
(12, 'dsds', 'dsdsds', 'dsds', '8796645868465', 'ds', '63930d4800ed6.jpg', '2022-12-17', 8, 'qOPcGslo'),
(13, 'dad', 'dsds', 'Jombang', '088803855786', 'ewew', '63930d6b4a138.jpg', '1222-02-12', 12, 'tkuOENSW'),
(14, 'dsadsad', 'dsadsa', 'dsadsa', '2222', 'dsad', '63930e2f1a76a.jpg', '2022-12-31', 5, 'soMPrJGS'),
(15, 'seqwe', 'eewewe', 'ewew', '11111', 'ewew', '63930e536518d.jpg', '2022-12-16', 12, 'IlNqWnsg'),
(16, 'sasas', 'sasa', 'sasa', '08125251216', 'sasa', '63930efd96826.jpg', '2022-12-28', 12, 'UWGrZiod'),
(17, 'sasas', 'sasa', 'sasa', '08125251216', 'sasasa', '63930f25b27ac.jpg', '2022-12-23', 6, 'oKDhlTHe'),
(18, 'sqqwqww', 'wqw', 'wqwq', '081252512088', 'wqw', '63931bb402f7d.jpg', '2022-12-17', 9, 'jrXeULZM'),
(19, 'sqqwqww', 'wqw', 'wqwq', '081252512088', 'wqw', '63931bc8da1c9.jpg', '2022-12-17', 9, 'jrXeULZM'),
(20, 'sqqwqww', 'wqw', 'wqwq', '081252512088', 'wqw', '63931bda72a16.jpg', '2022-12-17', 9, 'jrXeULZM'),
(21, 'sqqwqww', 'wqw', 'wqwq', '081252512088', 'wqw', '63931c0462bf4.jpg', '2022-12-17', 9, 'PZIjntoA'),
(22, 'sqqwqww', 'wqw', 'wqwq', '081252512088', 'wqw', '63931d752ce53.jpg', '2022-12-17', 9, 'wQrkiVZD'),
(23, 'sqqwqww', 'wqw', 'wqwq', '081252512088', 'wqw', '63931d8663eb7.jpg', '2022-12-17', 5, 'wQrkiVZD'),
(24, 'dsds', 'dsds', 'dsds', '081252512088', 'dsds', '63931e13432d1.jpg', '2022-12-22', 5, 'ACvYJmTb'),
(25, 'dsds', 'dsds', 'dsds', '081252512088', 'dsds', '63931e2607568.jpg', '2022-12-22', 5, 'ACvYJmTb'),
(26, 'ewew', 'ewew', 'ewew', '223232', 'ewew', '63931e5730c17.jpg', '2022-12-10', 6, 'eHRWOfPa'),
(27, 'fsfdfd', 'sasfdfdffd', 'sasa', '2212', 'dffdfsfd', '63931e928c871.jpg', '2022-12-24', 9, 'emwVZhFL'),
(28, 'fsfdfd', 'sasfdfdffd', 'sasa', '2212', 'dffdfsfddsds', '63931ef54178c.jpg', '2022-12-24', 9, 'emwVZhFL');

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `idsewa` int NOT NULL,
  `idpenghuni` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`idsewa`, `idpenghuni`) VALUES
(1, 8),
(2, 8),
(3, 8),
(4, 8),
(5, 8),
(6, 8),
(7, 8),
(8, 8),
(9, 8),
(10, 8),
(11, 8),
(12, 8),
(13, 8),
(14, 8),
(15, 8);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `idstatus` int NOT NULL,
  `status` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`idstatus`, `status`) VALUES
(1, 'Berpenghuni'),
(2, 'Tidak Berpenghuni'),
(3, 'Lunas'),
(4, 'Belum Lunas'),
(5, 'Waktu Tenggat');

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `iduser` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `sandi` varchar(255) NOT NULL,
  `level` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`iduser`, `nama`, `email`, `foto`, `sandi`, `level`) VALUES
(1, 'Ahmad Fahmi', 'ahmadfahmyga21@gmail.com', '637e0acf01445.jpg', '$2y$10$LWEAWuvnchfDSzLN0saBke0hMztjjcP/GLJjkNzGIEWQRmz9j4RvC', 'admin'),
(2, 'Ahmad Fahmy ', 'ahmadfahmyga219@gmail.com', '', '$2y$10$U2SA2.agf7cpSXZH1A638eZq/OhRuhAWb2a.l6m6Kg3o9rchLNEnG', 'user'),
(5, 'nabil2', 'abimana@gmail.com', '6384263c0774f.jpg', '$2y$10$pzEcxC4iZozU1MWQw.jZcOY42r6gpX7c9A9t9V3CQHj2rM5PmYcZa', 'user'),
(6, 'Ahmad Fahmy ', 'fahmy21@gmail.com', '', '$2y$10$Pc.NVT2S6qqnrOiMcvgsv.3.URSnFQXlPE9Ppl9j//iQu2Xp/IZ1G', 'user'),
(7, 'Ahmad Fahmy Ghifariel Akbar', 'admin@gmail.com', '639284deae297.jpg', '$2y$10$WnQOputI0wWwPYkMc31nvumOzjlfkh0PXO9rkUG55VcaUVfYdU5O.', 'user'),
(8, 'Ahmad Fahmy ', 'admin2@gmail.com', '63898776c4b03.jpg', '$2y$10$hiAYIVLtyFoNIc32ujJNz.mauDXJx9sYglyC1mvGTwjflM8WJy3Yy', 'user'),
(9, 'Ahmad Fahmy ', 'admin1@gmail.com', '637e9db89ae34.jpg', '$2y$10$mhIW9sLwdzb7DgAnmJMCxukeCbzB0kmYgae71n0K1uih1lTYQdQWS', 'user'),
(10, 'Ahmad Fahmy Ghifariel ', 'fahmy22@gmail.com', '', '$2y$10$48ao7qSXgzhqxL4rUs/W4OWfXD6Gc9YcMftovGHub2qDrsoM309TK', 'user'),
(11, 'trisqi', 'trisqi@tr', 'user.png', '$2y$10$Pe2qzGGjmk6GZIa3YoovcegGTwfGEyxXM7d1P0k/CsBuM992/m6V.', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`idkamar`),
  ADD KEY `idstatus` (`idstatus`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`idpembayaran`),
  ADD KEY `idkamar` (`idkamar`,`idstatus`),
  ADD KEY `idstatus` (`idstatus`);

--
-- Indexes for table `penghuni`
--
ALTER TABLE `penghuni`
  ADD PRIMARY KEY (`idpenghuni`),
  ADD KEY `idkamar` (`idkamar`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`idsewa`),
  ADD KEY `idpenghuni` (`idpenghuni`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`idstatus`);

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `idkamar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `idpembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `penghuni`
--
ALTER TABLE `penghuni`
  MODIFY `idpenghuni` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `idsewa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `idstatus` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`idstatus`) REFERENCES `status` (`idstatus`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`idkamar`) REFERENCES `kamar` (`idkamar`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`idstatus`) REFERENCES `status` (`idstatus`);

--
-- Constraints for table `penghuni`
--
ALTER TABLE `penghuni`
  ADD CONSTRAINT `penghuni_ibfk_1` FOREIGN KEY (`idkamar`) REFERENCES `kamar` (`idkamar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
