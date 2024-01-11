-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Des 2023 pada 11.38
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

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
-- Struktur dari tabel `buku`
--

DROP TABLE IF EXISTS `buku`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `gambar_buku`, `users_id_user`, `sinopsis_buku`, `isi_buku`, `harga_buku`, `halaman_buku`, `stok_buku`, `tanggal_buku_terbit`, `lebar_buku`, `panjang_buku`, `rating_buku`, `buku_id_genre`, `status`) VALUES
(2, 'Ensiklopedia Dunia Hewan untuk Pelajar dan Umum : Burung', 'https://cdn.gramedia.com/uploads/items/49732/thumb_image_normal/ID_EDHP2019MTH12BR.jpg', 1, 'Mempelajari Tentang Burung Elang', 'Dunia hewan sungguh mengagumkan. Ada yang tinggal di darat, ada yang tinggal di perairan, bahkan adapula yang meskipun tinggalnya di darat, tetapi menghabiskan waktunya mengangkasa mencari makan. Tahukah kamu hewan apa itu? Ya, mereka adalah burung. Burun', 49000, 126, 45, '2019-12-04', 10, 20, 10, 7, 'Ready Stock'),
(3, 'Islam Agama Ramah Perempuan', 'https://cdn.gramedia.com/uploads/items/9786236699195.jpg', 1, 'Buku Tentang Agama Islam', 'Orang-orang pesantren sudah terlanjur terdoktrin bahwa posisi perempuan harus berada di bawah posisi laki-laki, karena secara “kodrat”, laki-laki diberikan sesuatu yang lebih daripada perempuan. Urusan perempuan dibatasi hanya di ruang domestik (dapur, su', 90000, 396, 74, '2020-01-20', 14, 20, 8, 1, 'Ready Stock');

-- --------------------------------------------------------

--
-- Struktur dari tabel `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE `genre` (
  `id_genre` int(11) NOT NULL,
  `genre_buku` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `genre`
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
-- Struktur dari tabel `jenis`
--

DROP TABLE IF EXISTS `jenis`;
CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `id_jenis_tipe` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `non_buku`
--

DROP TABLE IF EXISTS `non_buku`;
CREATE TABLE `non_buku` (
  `id_alat_tulis` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nonbuku_id_jenis` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pre_order`
--

DROP TABLE IF EXISTS `pre_order`;
CREATE TABLE `pre_order` (
  `id_preorder` int(11) NOT NULL,
  `buku_id_buku` int(11) NOT NULL,
  `harga_awal` bigint(20) NOT NULL,
  `status_preorder` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id_role`, `nama_role`) VALUES
(1, 'author'),
(2, 'customer service'),
(3, 'normal customer'),
(4, 'plus customer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id_trans` int(11) NOT NULL,
  `users_id_user` int(11) NOT NULL,
  `buku_id_buku` int(11) NOT NULL,
  `tgl_trans` date NOT NULL,
  `harga_pembelian` bigint(20) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `email`, `nama`, `tgl_lahir`, `password`, `saldo`, `users_id_role`, `status`, `username`) VALUES
(1, 'budiauthor@gmail.com', 'Budi', '1993-04-07', 'budi123', 50000, 1, 'Hidup', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `users_id_user` (`users_id_user`),
  ADD KEY `buku_id_genre` (`buku_id_genre`);

--
-- Indeks untuk tabel `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `non_buku`
--
ALTER TABLE `non_buku`
  ADD PRIMARY KEY (`id_alat_tulis`);

--
-- Indeks untuk tabel `pre_order`
--
ALTER TABLE `pre_order`
  ADD PRIMARY KEY (`id_preorder`),
  ADD KEY `buku_id_buku` (`buku_id_buku`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_trans`),
  ADD KEY `users_id_user` (`users_id_user`),
  ADD KEY `buku_id_buku` (`buku_id_buku`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `users_id_role` (`users_id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `non_buku`
--
ALTER TABLE `non_buku`
  MODIFY `id_alat_tulis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pre_order`
--
ALTER TABLE `pre_order`
  MODIFY `id_preorder` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_trans` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`users_id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`buku_id_genre`) REFERENCES `genre` (`id_genre`);

--
-- Ketidakleluasaan untuk tabel `pre_order`
--
ALTER TABLE `pre_order`
  ADD CONSTRAINT `pre_order_ibfk_1` FOREIGN KEY (`buku_id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`users_id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`buku_id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`users_id_role`) REFERENCES `roles` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
drop table lamaran;
create table lamaran(
    `id_lamaran` int(11) not null AUTO_INCREMENT PRIMARY KEY,
    `id_user` int(11) not null,
    `status` varchar(255) not null,
    `alasan` varchar(255) not null,
    foreign key(`id_user`) references users(`id_user`)
);

drop table if exists trans_saldo;
create table trans_saldo (
  `id` int(11) not null AUTO_INCREMENT PRIMARY KEY,
  `id_user` int(11) not null,
  `jumlah` bigint not null,
  `metode` varchar(255) not null,
  `status` varchar(255) not null,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

drop table if exists cart;
create table cart (
  `id` int(11) not null AUTO_INCREMENT PRIMARY KEY,
  `id_user` int(11) not null,
  `id_buku` int(11) not null,
  `id_nonbuku` int(11) not null,
  `qty` int(11) not null,
  `subtotal` int(11) not null,
  foreign key(`id_user`) references users(`id_user`)
);

drop table if exists library;

create table library (
  `id_library` int(11) not null AUTO_INCREMENT PRIMARY KEY,
  `id_buku` int(11) not null,
  `id_user` int(11) not null,
  foreign key(`id_user`) references users(`id_user`)
);

drop table if exists transaksi;

create table if not exists transaksi(
  `id` int(11) not null AUTO_INCREMENT PRIMARY KEY,
  `id_user` int(11) not null,
  `qty` int(11) not null,
  `subtotal` int(11) not null,
  `metode` varchar(255) not null,
  `tgl_beli` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  foreign key(`id_user`) references users(`id_user`)
);

drop table if exists buku_trans;
create table buku_trans(
  `id` int(11) not null,
  `id_buku` int(11) not null
);

drop table if exists nonbuku_trans;
create table nonbuku_trans(
  `id` int(11) not null,
  `id_nonbuku` int(11) not null
);

drop table if exists listnonbuku;

create table listnonbuku (
  `id` int(11) not null,
  `id_nonbuku` int(11) not null,
  `id_user` int(11) not null,
  foreign key(`id_user`) references users(`id_user`)
);