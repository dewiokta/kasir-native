-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2023 at 10:08 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `no_transaksi` varchar(50) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `ukuran` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `subtotal` varchar(50) NOT NULL,
  `bayar` varchar(50) NOT NULL,
  `kembalian` varchar(50) NOT NULL,
  `kurangan` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `tanggal_bayar` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(11) NOT NULL,
  `no_transaksi` varchar(50) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `ukuran` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `subtotal` varchar(50) NOT NULL,
  `bayar` varchar(50) NOT NULL,
  `kembalian` varchar(50) NOT NULL,
  `kurangan` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `tanggal_bayar` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `no_transaksi`, `nama_customer`, `nama_barang`, `ukuran`, `harga`, `jumlah`, `subtotal`, `bayar`, `kembalian`, `kurangan`, `tanggal`, `tanggal_bayar`, `status`) VALUES
(34, 'SP041202', 'fasdfhb', 'fjadfbaj', 'fjasfba', '20000', '1', '20000', '30000', '0', '0', '02-April-2023', '02-April-2023', 'Lunas'),
(35, 'SP041202', 'fasdfhb', 'dmasdn', 'djasbd', '5000', '2', '10000', '30000', '0', '0', '02-April-2023', '02-April-2023', 'Lunas'),
(36, 'SP081954', 'fido', 'banner ', '2x1 m', '25000', '1', '25000', '10000', '', '0', '02-April-2023', '03-April-2023', 'Lunas'),
(37, 'SP072841', 'hani', 'banner', '2x1 m', '20000', '1', '20000', '10000', '', '0', '03-April-2023', '12-April-2023', 'Lunas'),
(38, 'SP104840', 'dina', 'sticker', '3x3 cm', '3000', '2', '6000', '1000', '', '0', '03-April-2023', '11-April-2023', 'Lunas'),
(39, 'SP105555', 'dani', 'ddsad', 'dad', '20000', '1', '20000', '10000', '', '10000', '04-April-2023', '07-April-2023', 'Lunas'),
(42, 'SP105711', 'fina', 'banner', '2x1 m', '25000', '1', '25000', '10000', '', '0', '04-April-2023', '07-April-2023', 'Lunas'),
(43, 'SP120118', 'dalsdkj', 'skripsi', 'a4', '20000', '1', '20000', '30000', '10000', '0', '11-April-2023', '11-April-2023', 'Lunas'),
(44, 'SP013741', 'dgdfg', 'bcvbc', '234', '30000', '1', '30000', '10000', '', '0', '11-April-2023', '11-April-2023', 'Lunas'),
(45, 'SP014020', 'tutu', 'tkjkkj', 'gkajsbg', '30000', '1', '30000', '10000', '', '0', '10-April-2023', '11-April-2023', 'Lunas'),
(46, 'SP014722', 'tuti', 'banner', '3x2m', '40000', '1', '40000', '10000', '', '0', '11-April-2023', '11-April-2023', 'Lunas'),
(47, 'SP014722', 'tuti', 'undangan', '10x5cm', '2000', '10', '20000', '10000', '', '0', '11-April-2023', '11-April-2023', 'Lunas'),
(49, 'SP015518', 'tina', 'banner', '2x1 m', '20000', '1', '20000', '20000', '', '0', '11-April-2023', '12-April-2023', 'Lunas'),
(50, 'SP015518', 'tina', 'stiker', '3x3 cm', '2000', '10', '20000', '20000', '', '0', '11-April-2023', '12-April-2023', 'Lunas'),
(51, 'SP123154', 'fifi', 'banner', '2x1 m', '20000', '1', '20000', '0', '0', '20000', '12-April-2023', '12-April-2023', 'Belum Bayar'),
(52, 'SP124007', 'nia', 'stiker', '3x3 cm', '2000', '10', '20000', '40000', '', '0', '12-April-2023', '12-April-2023', 'Lunas'),
(53, 'SP124007', 'nia', 'undangan', '5x9 cm', '1000', '20', '20000', '40000', '', '0', '12-April-2023', '12-April-2023', 'Lunas'),
(55, 'SP124702', 'didi', 'stiker', '3x3 cm', '2000', '20', '40000', '20000', '0', '20000', '12-April-2023', '12-April-2023', 'DP');

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan`
--

CREATE TABLE `pendapatan` (
  `id_pendapatan` int(11) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `tanggal`, `keterangan`, `jumlah`) VALUES
(4, '16 March 2023', 'beli kertas', '150000'),
(5, '11 April 2023', 'beli kertas 4a 1 rim', '300000'),
(6, '11 April 2023', 'beli kertas A4 1 rim', '300000'),
(7, '11-April-2023', 'beli kertas stiker', '150000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `pendapatan`
--
ALTER TABLE `pendapatan`
  MODIFY `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
