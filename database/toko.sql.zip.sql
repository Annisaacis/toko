-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2022 at 07:34 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `nama_pelanggan` varchar(50) NOT NULL DEFAULT '0',
  `alamat_pelanggan` varchar(200) NOT NULL DEFAULT '0',
  `password` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `username`, `nama_pelanggan`, `alamat_pelanggan`, `password`) VALUES
(3, 'ariyouu', 'Ari Octa', 'Jl. Jenderal Sudirman No. 232', '12345'),
(4, 'andimar', 'Andi Mar', 'Kolam Kiri Dalam RT.05', '12345'),
(5, 'user_1', 'user_1', 'Jakarta Pusat', 'user_1'),
(6, 'user_2', 'user_2', 'Jakarta Timur', 'user_2'),
(7, 'user_3', 'user_3', 'Jakarta Pusat', 'user_3'),
(8, 'ajigondres', 'Aji Gondres', 'Jl. Kopri No. 4', '12345'),
(9, 'test', 'test', 'jl.test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `tanggal_pembelian` datetime DEFAULT NULL,
  `total_pembelian` int(11) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `pembayaran` varchar(50) NOT NULL,
  `status` enum('Menunggu Konfirmasi','Dikirim','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `tanggal_pembelian`, `total_pembelian`, `tahun`, `pembayaran`, `status`) VALUES
(9, 3, '2021-02-10 01:57:00', 460000, 2021, 'Bank Transfer', 'Selesai'),
(10, 3, '2021-02-10 02:00:00', 150000, 2021, 'Bank Transfer', 'Selesai'),
(11, 4, '2022-02-10 02:01:00', 240000, 2022, 'Bank Transfer', 'Dikirim'),
(12, 3, '2022-07-13 04:42:00', 70000, 2022, 'Bank Transfer', 'Selesai'),
(21, 9, '2022-07-22 12:11:00', 120000, 2022, 'Bank Transfer', 'Selesai'),
(22, 9, '2022-06-22 12:12:00', 120000, 2022, 'Cash', 'Selesai'),
(23, 9, '2022-07-22 12:13:00', 120000, 2022, 'Cash', 'Selesai'),
(24, 9, '2022-07-22 12:13:00', 70000, 2022, 'Cash', 'Dikirim'),
(25, 9, '2022-07-29 12:50:00', 120000, 2022, 'Bank Transfer', 'Dikirim');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`) VALUES
(14, 9, 18, 1),
(15, 9, 19, 1),
(16, 9, 20, 1),
(17, 9, 16, 2),
(18, 10, 16, 1),
(19, 10, 20, 1),
(20, 11, 17, 1),
(21, 11, 19, 1),
(31, 21, 18, 1),
(32, 22, 18, 1),
(33, 23, 18, 1),
(34, 24, 16, 1),
(35, 25, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL DEFAULT '0',
  `unit` varchar(10) NOT NULL DEFAULT '0',
  `harga_produk` int(11) NOT NULL DEFAULT 0,
  `foto` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `unit`, `harga_produk`, `foto`) VALUES
(16, 'Abu Batu', 'ton', 70000, 'batu_abu.jpg'),
(17, 'Batu Split 1 - 2 cm', 'ton', 120000, 'Batu-Split-1-2-1200x900.jpg'),
(18, 'Batu Split 2 - 3 cm', 'ton', 120000, 'pengertian-dan-ukuran-batu-split-1200x900.jpg'),
(19, 'Batu Split 0 - 5 cm', 'ton', 120000, '2.-BATU-SPLIT.jpg'),
(20, 'Pasir', 'ton', 80000, 'pasir.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL DEFAULT 0,
  `stok_produk` int(11) NOT NULL DEFAULT 0,
  `produk_terjual` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `id_produk`, `stok_produk`, `produk_terjual`) VALUES
(1, 16, 9, 2),
(2, 17, 8, 4),
(3, 18, 0, 6),
(4, 19, 10, 2),
(5, 20, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id_unit` int(11) NOT NULL,
  `unit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id_unit`, `unit`) VALUES
(1, 'ton'),
(2, 'pcs'),
(3, 'ml'),
(4, 'gram'),
(5, 'kg'),
(6, 'meter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `pembelian.id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`),
  ADD KEY `pembelian_produk.pembelian` (`id_pembelian`),
  ADD KEY `pembelian_produk.id_produk` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `stok.id_produk` (`id_produk`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian.id_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD CONSTRAINT `pembelian_produk.id_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_produk.pembelian` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok.id_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
