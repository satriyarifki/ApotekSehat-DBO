-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2021 at 01:32 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apoteksehat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(225) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `nohp_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `keterangan`) VALUES
(1, 'Batuk', 'untuk gejala penyakit flu, meriang, demam ringan'),
(2, 'Kontrasepsi oral', '1. Untuk pertama kali penggunaan pasien harus ke dokter terlebih dahulu (penggunaan pertama dengan resep dokter)\r\n2. Obat yang diserahkan hanya satu siklus\r\n3. Kontrol kedokter tiap 6 bulan sekali'),
(3, 'obat Saluran cerna', 'Indikasi: mual/muntah\r\n, muntah berkepanjangan pasien dianjurkan agar kontrol ke dokter'),
(4, 'obat saluran napas', 'obat untuk gangguan pernafasan seperti sesak nafas'),
(5, 'Obat Topikal Kulit', 'untuk gangguan kulit seperti gatal, iritasi, jamur, algergi dll.'),
(6, 'Obat mulut dan tenggorokan', 'gangguan / ketidaknyamanan mulut dan kerongkongan');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `kode_obat` int(11) NOT NULL,
  `nama_obat` varchar(225) NOT NULL,
  `keterangan` varchar(225) NOT NULL,
  `harga_obat` int(20) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`kode_obat`, `nama_obat`, `keterangan`, `harga_obat`, `id_kategori`) VALUES
(1, 'Ultraflu', 'obat flu', 5000, 1),
(2, 'Mixagrip Flu', 'untuk penyakit flu', 3000, 1),
(3, 'Lynestrenol', '1 siklus', 20000, 2),
(4, 'Ethinylestradiol – Norgestrel', '1 siklus', 23000, 2),
(5, 'Metoklopramid', '(anti Mual) Maksimal 20 tablet', 10000, 3),
(6, 'Bisakodil Suppo', '(konstipasi) Maksimal 3 suppo', 11000, 3),
(7, 'Hexetidin', '(tenggorokan) Maksimal 1 botol', 18000, 6),
(8, 'Triamcinolone acetonide', '(sariawan berat)\r\nMaksimal 1 tube', 13000, 6),
(9, 'Salbutamol', '(asma) Maksimal 20 tablet; sirup 1 botol', 45000, 4),
(10, 'karbosistein', '(mikotilin) Maksimal 20 tablet; sirup 1 botol', 37000, 4),
(11, 'Nistatin', '(infeksi jamur lokal)\r\nMaksimal 1 tube', 10000, 5),
(12, 'Betametason', '(alergi dan peradangan kulit)\r\nMaksimal 1 tube', 12000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pembeli` varchar(225) NOT NULL,
  `nohp_pembeli` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `id_user`, `nama_pembeli`, `nohp_pembeli`, `alamat`) VALUES
(128, 12, 'dinda jangan marah-marah', '08567382638', 'jalan ikan kembung no 47'),
(129, 12, 'dinda jangan marah-marah', '087788654765', 'Jalan. Ikan kembung no.99'),
(130, 12, 'Dinda Jangan Marah-Marah', '081132243354', 'Jalan. Katak Beradik no.17');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_obat` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `jumlah_obat` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_obat`, `id_pembeli`, `jumlah_obat`, `total_bayar`) VALUES
(108, 5, 128, 2, 20000),
(109, 5, 128, 2, 20000),
(110, 9, 128, 2, 90000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'siswi', 'caf1a3dfb505ffed0d024130f58c5cfa'),
(2, 'satriya', 'caf1a3dfb505ffed0d024130f58c5cfa'),
(8, 'cahya', '$2y$10$00spJQheJUNoABw1ikLb3.xoqPh7z8iyJefZw/eJcoG7yiEx70SlK'),
(9, 'rudi', 'e10adc3949ba59abbe56e057f20f883e'),
(10, 'irfan', '$2y$10$id9a0ANsbIp/bkyoP/kjruoi9EwjVgFXLak/9b8XAZAAJNeFxCWg2'),
(11, 'ahmad', '$2y$10$NYeKwgFq5dFdYtbqgyfrt.Lh89lZgadcPLgF9BEY0wHsdKNf.qcMq'),
(12, 'dinda', '4d335a189a740b71d8814777c8aa8df4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`kode_obat`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pembeli` (`id_pembeli`),
  ADD KEY `kode_obat` (`kode_obat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `kode_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `id_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `id_pembeli` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`),
  ADD CONSTRAINT `kode_obat` FOREIGN KEY (`kode_obat`) REFERENCES `obat` (`kode_obat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
