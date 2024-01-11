-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 06:26 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_buku_moyai`
--
CREATE DATABASE IF NOT EXISTS `toko_buku_moyai` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `toko_buku_moyai`;

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `gambar_buku` varchar(255) NOT NULL,
  `users_id_user` int(11) NOT NULL,
  `sinopsis_buku` varchar(255) NOT NULL,
  `isi_buku` varchar(255) NOT NULL,
  `harga_buku` bigint(20) NOT NULL,
  `halaman_buku` int(11) NOT NULL,
  `stok_buku` int(11) NOT NULL,
  `tanggal_buku_terbit` date NOT NULL,
  `lebar_buku` int(11) NOT NULL,
  `panjang_buku` int(11) NOT NULL,
  `rating_buku` float NOT NULL,
  `buku_id_genre` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `gambar_buku`, `users_id_user`, `sinopsis_buku`, `isi_buku`, `harga_buku`, `halaman_buku`, `stok_buku`, `tanggal_buku_terbit`, `lebar_buku`, `panjang_buku`, `rating_buku`, `buku_id_genre`, `status`) VALUES
(2, 'Ensiklopedia Dunia Hewan untuk Pelajar dan Umum : Burung', 'bukuburung.jpg', 1, 'Mempelajari Tentang Burung Elang', 'Dunia hewan sungguh mengagumkan. Ada yang tinggal di darat, ada yang tinggal di perairan, bahkan adapula yang meskipun tinggalnya di darat, tetapi menghabiskan waktunya mengangkasa mencari makan. Tahukah kamu hewan apa itu? Ya, mereka adalah burung. Burun', 49000, 126, 44, '2019-12-04', 10, 20, 10, 7, 'Ready Stock'),
(3, 'Islam Agama Ramah Perempuan', 'bukuagama.jpg', 1, 'Buku Tentang Agama Islam', 'Orang-orang pesantren sudah terlanjur terdoktrin bahwa posisi perempuan harus berada di bawah posisi laki-laki, karena secara “kodrat”, laki-laki diberikan sesuatu yang lebih daripada perempuan. Urusan perempuan dibatasi hanya di ruang domestik (dapur, su', 90000, 396, 73, '2020-01-20', 14, 20, 8, 1, 'Ready Stock'),
(4, 'Buku Mobil Listrik', 'wuling-air-ev.jpg', 1, 'Wuling Air EV', 'Tentang Mobil Listrik', 250000, 65, 20, '2024-01-04', 20, 20, 10, 11, 'Ready Stock');

-- --------------------------------------------------------

--
-- Table structure for table `buku_trans`
--

CREATE TABLE `buku_trans` (
  `id` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku_trans`
--

INSERT INTO `buku_trans` (`id`, `id_buku`) VALUES
(5, 3),
(6, 3),
(6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_nonbuku` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `id_user`, `id_buku`, `id_nonbuku`, `qty`, `subtotal`) VALUES
(9, 2, 0, 3, 1, 24000);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id_genre` int(11) NOT NULL,
  `genre_buku` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id_genre`, `genre_buku`) VALUES
(1, 'agama islam'),
(2, 'agama kristen'),
(3, 'agama katolik'),
(4, 'agama hindu'),
(5, 'agama buddha'),
(6, 'agama konghucu'),
(7, 'fauna'),
(8, 'flora'),
(9, 'geography'),
(10, 'history'),
(11, 'technology');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `id_jenis_tipe` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lamaran_author`
--

CREATE TABLE `lamaran_author` (
  `id_lamaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `alasan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lamaran_author`
--

INSERT INTO `lamaran_author` (`id_lamaran`, `id_user`, `status`, `alasan`) VALUES
(1, 3, 'Accepted', '-');

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `id_library` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`id_library`, `id_buku`, `id_user`) VALUES
(1, 2, 1),
(2, 2, 1),
(3, 2, 1),
(4, 2, 2),
(5, 2, 2),
(6, 2, 2),
(7, 2, 3),
(8, 2, 4),
(9, 2, 4),
(10, 2, 4),
(12, 3, 2),
(13, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `listnonbuku`
--

CREATE TABLE `listnonbuku` (
  `id` int(11) NOT NULL,
  `id_nonbuku` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nonbuku_trans`
--

CREATE TABLE `nonbuku_trans` (
  `id` int(11) NOT NULL,
  `id_nonbuku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `non_buku`
--

CREATE TABLE `non_buku` (
  `id_alat_tulis` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `non_buku`
--

INSERT INTO `non_buku` (`id_alat_tulis`, `nama`, `harga`, `status`, `id_user`, `gambar`) VALUES
(1, 'Pencil', 2000, 'Ready Stock', 1, 'pencil.jpeg'),
(2, 'Penghapus', 5000, 'Ready Stock', 1, 'penghapus.jpeg'),
(3, 'Pencil Warna', 30000, 'Ready Stock', 1, 'pencilwarna.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `pre_order`
--

CREATE TABLE `pre_order` (
  `id_preorder` int(11) NOT NULL,
  `buku_id_buku` int(11) NOT NULL,
  `harga_awal` bigint(20) NOT NULL,
  `status_preorder` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `nama_role`) VALUES
(1, 'author'),
(3, 'normal customer'),
(4, 'plus customer');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `tgl_beli` timestamp NOT NULL DEFAULT current_timestamp(),
  `metode` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_user`, `qty`, `subtotal`, `tgl_beli`, `metode`, `alamat`) VALUES
(1, 2, 3, 117600, '2024-01-09 08:27:56', 'Mandiri', 'Jln Kentang no 56'),
(2, 2, 3, 117600, '2024-01-09 08:28:52', 'Mandiri', 'Jln Kentang no 56'),
(3, 2, 3, 117600, '2024-01-09 08:29:39', 'Mandiri', 'Jln Kentang no 56'),
(4, 2, 3, 117600, '2024-01-09 08:32:49', 'Mandiri', 'Jln Kentang no 56'),
(5, 2, 2, 111200, '2024-01-09 08:55:16', 'Gopay', 'jayakarta'),
(6, 2, 2, 111200, '2024-01-09 08:56:42', 'Gopay', 'jayakarta');

-- --------------------------------------------------------

--
-- Table structure for table `trans_saldo`
--

CREATE TABLE `trans_saldo` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah` bigint(20) NOT NULL,
  `metode` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_saldo`
--

INSERT INTO `trans_saldo` (`id`, `id_user`, `jumlah`, `metode`, `status`, `created_at`) VALUES
(1, 2, 20000, 'BCA', 'Top Up Saldo', '2024-01-07 09:28:25'),
(2, 2, 450000, 'BCA', 'Top Up Saldo', '2024-01-07 16:30:41'),
(3, 2, 300000, 'Black Card :D', 'Beli Member', '2024-01-08 08:19:00'),
(4, 2, 250000, 'Gopay', 'Top Up Saldo', '2024-01-08 08:29:20'),
(5, 2, 300000, 'Mandiri', 'Beli Member', '2024-01-08 08:29:51'),
(6, 2, 250000, 'BCA', 'Top Up Saldo', '2024-01-08 10:58:52'),
(7, 2, 300000, 'Gopay', 'Beli Member', '2024-01-08 10:59:06'),
(8, 2, 250000, 'BCA', 'Top Up Saldo', '2024-01-08 11:01:23'),
(9, 2, 300000, 'Gopay', 'Beli Member', '2024-01-08 11:01:36'),
(10, 2, 800000, 'BCA', 'Top Up Saldo', '2024-01-08 11:02:26'),
(11, 2, 300000, 'Mandiri', 'Beli Member', '2024-01-08 11:03:18'),
(12, 2, 300000, 'Kredit', 'Beli Member', '2024-01-08 11:04:26'),
(13, 2, 800000, 'BCA', 'Top Up Saldo', '2024-01-09 08:55:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `saldo` bigint(20) NOT NULL,
  `users_id_role` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `email`, `nama`, `tgl_lahir`, `password`, `saldo`, `users_id_role`, `status`, `username`) VALUES
(1, 'budiauthor@gmail.com', 'Budi', '1993-04-07', '$2y$12$KWxqv10yTbyB93eZg7uw7OBdxn3XglkprPvV9qEetc3PnVB1O1Bke', 50000, 1, 'active', 'Budhi'),
(2, 'yaelah@gmail.com', 'gua', '2000-05-24', '$2y$12$3puArpIkLWCC.cNKRSE8yemIr8b2CUxbML0wpaJU/xOI/yfXB7Q6W', 736000, 4, 'active', 'akumanusia'),
(3, 'gaje@gmail.com', 'gawean', '2000-07-11', '$2y$12$FyZTczcPr6bgSm3pHcMd9.dn7AHM7dYkJ/HaRnbya8O9VGrdGWw8.', 0, 3, 'active', 'gege'),
(4, 'Batu@gmail.com', 'Makhluk', '2003-06-20', '$2y$12$pGBFtA27aeUXURZKxF7A9O5N1P3z3Mf805wGlmp7RSQBPjMZMS4Lm', 0, 3, 'active', 'Alien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `users_id_user` (`users_id_user`),
  ADD KEY `buku_id_genre` (`buku_id_genre`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `lamaran_author`
--
ALTER TABLE `lamaran_author`
  ADD PRIMARY KEY (`id_lamaran`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`id_library`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `listnonbuku`
--
ALTER TABLE `listnonbuku`
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `non_buku`
--
ALTER TABLE `non_buku`
  ADD PRIMARY KEY (`id_alat_tulis`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pre_order`
--
ALTER TABLE `pre_order`
  ADD PRIMARY KEY (`id_preorder`),
  ADD KEY `buku_id_buku` (`buku_id_buku`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `trans_saldo`
--
ALTER TABLE `trans_saldo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `users_id_role` (`users_id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lamaran_author`
--
ALTER TABLE `lamaran_author`
  MODIFY `id_lamaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `id_library` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `non_buku`
--
ALTER TABLE `non_buku`
  MODIFY `id_alat_tulis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pre_order`
--
ALTER TABLE `pre_order`
  MODIFY `id_preorder` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trans_saldo`
--
ALTER TABLE `trans_saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`users_id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`buku_id_genre`) REFERENCES `genre` (`id_genre`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `lamaran_author`
--
ALTER TABLE `lamaran_author`
  ADD CONSTRAINT `lamaran_author_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `library`
--
ALTER TABLE `library`
  ADD CONSTRAINT `library_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `listnonbuku`
--
ALTER TABLE `listnonbuku`
  ADD CONSTRAINT `listnonbuku_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `non_buku`
--
ALTER TABLE `non_buku`
  ADD CONSTRAINT `non_buku_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `pre_order`
--
ALTER TABLE `pre_order`
  ADD CONSTRAINT `pre_order_ibfk_1` FOREIGN KEY (`buku_id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`users_id_role`) REFERENCES `roles` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
