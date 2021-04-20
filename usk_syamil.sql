-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2021 at 05:01 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usk_kasir`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ADD_PELANGGAN` (IN `nama` VARCHAR(100), IN `jk` ENUM('L','P'), IN `no` VARCHAR(15), IN `alamat` VARCHAR(200))  NO SQL
INSERT INTO pelanggan (nama_pelanggan, jenis_kelamin, nohp, alamat)
VALUES (nama, jk, no, alamat)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ADD_PESANAN` (IN `idPes` VARCHAR(20), IN `idMenu` INT(11), IN `idPel` INT(11), IN `jumlah` INT(11), IN `idUser` INT(11))  NO SQL
INSERT INTO pesanan (id_pesanan,id_menu,id_pelanggan,jumlah,id_user)
VALUES (idPes, idMenu, idPel, jumlah, idUser)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BAYAR_PESANAN` (IN `idPes` VARCHAR(20))  NO SQL
INSERT INTO transaksi (id_pesanan,total,bayar)
VALUES (idPes, 
        (SELECT pesanan.jumlah * menu.harga 
         FROM pesanan 
         JOIN menu ON pesanan.id_menu=menu.id_menu
         WHERE pesanan.id_pesanan=idPes),
        (SELECT pesanan.jumlah * menu.harga 
         FROM pesanan 
         JOIN menu ON pesanan.id_menu=menu.id_menu
         WHERE pesanan.id_pesanan=idPes)
       )$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_PELANGGAN` (IN `idPel` INT(11))  NO SQL
DELETE FROM pelanggan WHERE id_pelanggan = idPel$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_PESANAN` (IN `id` VARCHAR(20))  NO SQL
DELETE FROM pesanan WHERE pesanan.id_pesanan = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_MENU` ()  NO SQL
SELECT * FROM menu$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_PELANGGAN` ()  NO SQL
SELECT * FROM pelanggan$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_PESANAN` ()  NO SQL
SELECT pesanan.*, pelanggan.nama_pelanggan, menu.nama_menu, menu.harga
FROM pesanan
JOIN menu ON menu.id_menu = pesanan.id_menu
JOIN pelanggan ON pesanan.id_pelanggan = pelanggan.id_pelanggan$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_PESANAN_BY_STATUS` (IN `status` ENUM('Sudah Dibayar','Belum Dibayar'))  NO SQL
SELECT pesanan.*, pelanggan.nama_pelanggan, menu.nama_menu, menu.harga
FROM pesanan
JOIN menu ON menu.id_menu = pesanan.id_menu
JOIN pelanggan ON pesanan.id_pelanggan = pelanggan.id_pelanggan
WHERE pesanan.status_pembayaran = status$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_TOTAL_TRANSAKSI` ()  NO SQL
SELECT SUM(total) AS total_transaksi FROM transaksi$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SHOW_PELANGGAN` (IN `idPel` INT(11))  NO SQL
SELECT * FROM pelanggan WHERE id_pelanggan=idPel$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SHOW_PESANAN` (IN `id` VARCHAR(20))  NO SQL
SELECT pesanan.*, pelanggan.nama_pelanggan, menu.nama_menu, menu.harga
FROM pesanan
JOIN menu ON menu.id_menu = pesanan.id_menu
JOIN pelanggan ON pesanan.id_pelanggan = pelanggan.id_pelanggan
WHERE pesanan.id_pesanan = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_PELANGGAN` (IN `nama` VARCHAR(50), IN `jenkel` ENUM('L','P'), IN `no` VARCHAR(20), IN `alamat` VARCHAR(100), IN `idPel` INT(11))  NO SQL
UPDATE pelanggan SET 
pelanggan.nama_pelanggan = nama,
pelanggan.jenis_kelamin = jenkel,
pelanggan.nohp = no,
pelanggan.alamat = alamat
WHERE pelanggan.id_pelanggan = idPel$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_PESANAN` (IN `idMenu` INT, IN `idPel` INT, IN `jumlah` INT, IN `idUser` INT, IN `id` VARCHAR(20))  NO SQL
UPDATE pesanan SET 
pesanan.id_menu = idMenu,
pesanan.id_pelanggan = idPel,
pesanan.jumlah = jumlah,
pesanan.id_user = idUser
WHERE pesanan.id_pesanan = id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`) VALUES
(1, 'Nasi Putih', '3000'),
(2, 'Ayam Goreng', '10000'),
(3, 'Nasi Goreng', '12000');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `jenis_kelamin`, `nohp`, `alamat`) VALUES
(8, 'Budi', 'L', '09129292', 'Jakarta Barat'),
(10, 'Joko saja', 'L', '0923232sss', 'bandung Barat'),
(15, 'Muuuu', 'L', 'asas', '           asas         '),
(16, 'Anto Suaji', 'P', 'asasas', '           asasasasas         '),
(17, 'oddy', 'L', '0923232777', '  wewewewe                  ');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(20) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `waktu_pesanan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_pembayaran` enum('Belum Dibayar','Sudah Dibayar') NOT NULL DEFAULT 'Belum Dibayar'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_menu`, `id_pelanggan`, `jumlah`, `id_user`, `waktu_pesanan`, `status_pembayaran`) VALUES
('P190421199001', 1, 8, 1, 2, '2021-04-20 07:31:01', 'Belum Dibayar'),
('P190421201201', 1, 16, 2, 2, '2021-04-20 07:44:58', 'Belum Dibayar'),
('P200421070242', 1, 8, 2, 2, '2021-04-20 13:50:46', 'Sudah Dibayar'),
('P200421074618', 3, 10, 12, 2, '2021-04-20 10:18:15', 'Sudah Dibayar'),
('P200421100143', 3, 15, 4, 2, '2021-04-20 10:17:53', 'Sudah Dibayar'),
('P200421165153', 2, 8, 8, 2, '2021-04-20 14:51:53', 'Belum Dibayar');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pesanan` varchar(20) NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pesanan`, `total`, `bayar`) VALUES
(5, 'P200421100143', 48000, 48000),
(6, 'P200421074618', 144000, 144000),
(7, 'P200421070242', 6000, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('administrator','owner','kasir','waiter') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `password`, `level`) VALUES
(1, 'admin', 'password', 'administrator'),
(2, 'waiter', 'password', 'waiter'),
(3, 'kasir', 'password', 'kasir'),
(4, 'owner', 'password', 'owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
