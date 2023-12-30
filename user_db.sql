-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Des 2023 pada 02.15
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_type` enum('admin','user') NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `name`, `email`, `password`, `user_type`, `reset_token`, `id`) VALUES
(1, 'amir', 'amir21@gmail.com', '$2y$10$f3vivzRfjkxeKFJY5nIbkOa.viGEDeaVB89NuHkAl8IPdAfAvTzVi', 'admin', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_type` enum('admin','user') NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `name`, `email`, `password`, `user_type`, `reset_token`, `id`) VALUES
(1, 'reffifauzi', 'reffifauzi@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', NULL, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `create_at`, `update_at`) VALUES
(34, 'SSD MidasForce', 350000, '/store/1702622897-b83fa6e768b1ed9b49d7a9a31d0cfced-midasforce.jpg', '2023-12-15 06:48:17', NULL),
(35, 'SSD SATA', 290000, '/store/1703729232-a7e6c129ccda4a3cca99452d315777f6-sata.jpg', '2023-12-28 02:07:12', NULL),
(36, 'SSD VENOM', 300000, '/store/1703729284-49b4b27eb6d607f9a9014d4f8d5d048a-ssd.jpg', '2023-12-28 02:08:04', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `service_requests`
--

CREATE TABLE `service_requests` (
  `id_pesan` int(50) NOT NULL,
  `merk` enum('acer','advan','asus','dell','hp','lenovo','msi','samsung') NOT NULL,
  `foto` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(20) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `price` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `service_requests`
--

INSERT INTO `service_requests` (`id_pesan`, `merk`, `foto`, `detail`, `create_at`, `token`, `tanggal`, `jam`, `nama_lengkap`, `telepon`, `status`, `price`) VALUES
(180, 'acer', 'path/to/uploaded/files/1703735733-81a00e658151bb9b70737141472bc765-speaker tidak bunyi.jpeg', 'speaker tidak bunyi', '2023-12-28 03:55:33', '658cf1a120c09', '2023-12-28', '06.00 - 09.00', 'reffi fauzi', '088213456445', 'pending', 0),
(182, 'asus', 'path/to/uploaded/files/1703735851-da2903a90ebac9f4231b4286a08c2713-baterai tidak mengisi.jpg', 'baterai tidak mengisi', '2023-12-28 03:57:31', '658cf20f847a2', '2023-12-29', '06.00 - 09.00', 'nizar zul islami', '088213456271', 'accepted', 0),
(183, 'lenovo', 'path/to/uploaded/files/1703735876-c09c0989953bfa2d5c316d4365b4c2bf-keyboard tidak bisa ditekan.jpeg', 'keyboard tidak bisa ditekan', '2023-12-28 03:57:56', '658cf22b4e1d6', '2023-12-30', '06.00 - 09.00', 'amir syahrul ramadhan', '088213456271', 'sedang_proses', 125000),
(184, 'hp', 'path/to/uploaded/files/1703735910-3a80e779b74b07c1abb89ab02dec3929-port usb tidak berfugsi.jpeg', 'port usb tidak berfungsi', '2023-12-28 03:58:30', '658cf2444eb4e', '2023-12-31', '06.00 - 09.00', 'nizar zul islami', '088213456271', 'pesanan_selesai', 150000);

--
-- Trigger `service_requests`
--
DELIMITER $$
CREATE TRIGGER `merk_after_insert` AFTER INSERT ON `service_requests` FOR EACH ROW BEGIN
    IF NEW.merk = 'acer' THEN
        INSERT INTO tbl_acer (merk, foto, detail, token, create_at)
        VALUES (NEW.id_pesan, NEW.merk, NEW.foto, NEW.detail, NEW.token, NEW.create_at);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `service_merk_after_insert` AFTER INSERT ON `service_requests` FOR EACH ROW BEGIN
    IF NEW.merk = 'acer' THEN
        INSERT INTO tbl_acer (merk, foto, detail, token, create_at)
        VALUES (NEW.id_pesan, NEW.merk, NEW.foto, NEW.detail, NEW.token, NEW.create_at);
    ELSEIF NEW.merk = 'advan' THEN
        INSERT INTO tbl_advan (merk, foto, detail, token, create_at)
        VALUES (NEW.id_pesan, NEW.merk, NEW.foto, NEW.detail, NEW.token, NEW.create_at);
    ELSEIF NEW.merk = 'asus' THEN
        INSERT INTO tbl_asus (merk, foto, detail, token, create_at)
        VALUES (NEW.id_pesan, NEW.merk, NEW.foto, NEW.detail, NEW.token, NEW.create_at);
    ELSEIF NEW.merk = 'dell' THEN
        INSERT INTO tbl_dell (merk, foto, detail, token, create_at)
        VALUES (NEW.id_pesan, NEW.merk, NEW.foto, NEW.detail, NEW.token, NEW.create_at);
    ELSEIF NEW.merk = 'hp' THEN
        INSERT INTO tbl_hp (merk, foto, detail, token, create_at)
        VALUES (NEW.id_pesan, NEW.merk, NEW.foto, NEW.detail, NEW.token, NEW.create_at); 
    ELSEIF NEW.merk = 'lenovo' THEN
        INSERT INTO tbl_lenovo (merk, foto, detail, token, create_at)
        VALUES (NEW.id_pesan, NEW.merk, NEW.foto, NEW.detail, NEW.token, NEW.create_at);
    ELSEIF NEW.merk = 'msi' THEN
        INSERT INTO tbl_msi (merk, foto, detail, token, create_at)
        VALUES (NEW.id_pesan, NEW.merk, NEW.foto, NEW.detail, NEW.token, NEW.create_at);
    ELSEIF NEW.merk = 'samsung' THEN
        INSERT INTO tbl_samsung (merk, foto, detail, token, create_at)
        VALUES (NEW.id_pesan, NEW.merk, NEW.foto, NEW.detail, NEW.token, NEW.create_at);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_acer`
--

CREATE TABLE `tbl_acer` (
  `id_acer` int(11) NOT NULL,
  `merk` enum('acer','advan','asus','dell','hp','lenovo','msi','samsung') NOT NULL,
  `foto` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `token` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pesan` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_advan`
--

CREATE TABLE `tbl_advan` (
  `id_advan` int(11) NOT NULL,
  `merk` enum('acer','advan','asus','dell','hp','lenovo','msi','samsung') NOT NULL,
  `foto` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `token` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pesan` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_asus`
--

CREATE TABLE `tbl_asus` (
  `id_asus` int(11) NOT NULL,
  `merk` enum('acer','advan','asus','dell','hp','lenovo','msi','samsung') NOT NULL,
  `foto` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `token` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pesan` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_dell`
--

CREATE TABLE `tbl_dell` (
  `id_dell` int(11) NOT NULL,
  `merk` enum('acer','advan','asus','dell','hp','lenovo','msi','samsung') NOT NULL,
  `foto` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `token` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pesan` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hp`
--

CREATE TABLE `tbl_hp` (
  `id_hp` int(11) NOT NULL,
  `merk` enum('acer','advan','asus','dell','hp','lenovo','msi','samsung') NOT NULL,
  `foto` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `token` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pesan` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_lenovo`
--

CREATE TABLE `tbl_lenovo` (
  `id_lenovo` int(11) NOT NULL,
  `merk` enum('acer','advan','asus','dell','hp','lenovo','msi','samsung') NOT NULL,
  `foto` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `token` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pesan` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_msi`
--

CREATE TABLE `tbl_msi` (
  `id_msi` int(11) NOT NULL,
  `merk` enum('acer','advan','asus','dell','hp','lenovo','msi','samsung') NOT NULL,
  `foto` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `token` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pesan` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_samsung`
--

CREATE TABLE `tbl_samsung` (
  `id_samsung` int(11) NOT NULL,
  `merk` enum('acer','advan','asus','dell','hp','lenovo','msi','samsung') NOT NULL,
  `foto` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `token` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pesan` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_form`
--

CREATE TABLE `user_form` (
  `id` int(50) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_type` enum('admin','user') NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `user_type`, `reset_token`) VALUES
(1, 'amir', 'amir21@gmail.com', '$2y$10$f3vivzRfjkxeKFJY5nIbkOa.viGEDeaVB89NuHkAl8IPdAfAvTzVi', 'admin', NULL),
(8, 'nizar', 'nizar@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', NULL),
(9, 'amir', 'amirramadhan768@gmail.com', '4e72fc71d6afe049572655387d0f5346', 'user', 'b729683d6106b32c5d9884f364d4591a'),
(11, 'reffifauzi', 'reffifauzi@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', NULL);

--
-- Trigger `user_form`
--
DELIMITER $$
CREATE TRIGGER `register_after_insert` AFTER INSERT ON `user_form` FOR EACH ROW BEGIN
    IF NEW.user_type = 'admin' THEN
        INSERT INTO admin (id, name, email, password, user_type, reset_token)
        VALUES (NEW.id, NEW.name, NEW.email, NEW.password, NEW.user_type, NEW.reset_token);
    ELSEIF NEW.user_type = 'user' THEN
        INSERT INTO pelanggan (id, name, email, password, user_type, reset_token)
        VALUES (NEW.id, NEW.name, NEW.email, NEW.password, NEW.user_type, NEW.reset_token);
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `FK-admin_form` (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `FK-user` (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `tbl_acer`
--
ALTER TABLE `tbl_acer`
  ADD PRIMARY KEY (`id_acer`),
  ADD KEY `FK-tbl_acer` (`id_pesan`);

--
-- Indeks untuk tabel `tbl_advan`
--
ALTER TABLE `tbl_advan`
  ADD PRIMARY KEY (`id_advan`),
  ADD KEY `FK-tbl_advan` (`id_pesan`);

--
-- Indeks untuk tabel `tbl_asus`
--
ALTER TABLE `tbl_asus`
  ADD PRIMARY KEY (`id_asus`),
  ADD KEY `FK-tbl_asus` (`id_pesan`);

--
-- Indeks untuk tabel `tbl_dell`
--
ALTER TABLE `tbl_dell`
  ADD PRIMARY KEY (`id_dell`),
  ADD KEY `FK-tbl_dell` (`id_pesan`);

--
-- Indeks untuk tabel `tbl_hp`
--
ALTER TABLE `tbl_hp`
  ADD PRIMARY KEY (`id_hp`),
  ADD KEY `FK-tbl_hp` (`id_pesan`);

--
-- Indeks untuk tabel `tbl_lenovo`
--
ALTER TABLE `tbl_lenovo`
  ADD PRIMARY KEY (`id_lenovo`),
  ADD KEY `FK-tbl_lenovo` (`id_pesan`);

--
-- Indeks untuk tabel `tbl_msi`
--
ALTER TABLE `tbl_msi`
  ADD PRIMARY KEY (`id_msi`),
  ADD KEY `FK-tbl_msi` (`id_pesan`);

--
-- Indeks untuk tabel `tbl_samsung`
--
ALTER TABLE `tbl_samsung`
  ADD PRIMARY KEY (`id_samsung`),
  ADD KEY `FK-tbl_samsung` (`id_pesan`);

--
-- Indeks untuk tabel `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id_pesan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT untuk tabel `tbl_acer`
--
ALTER TABLE `tbl_acer`
  MODIFY `id_acer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_advan`
--
ALTER TABLE `tbl_advan`
  MODIFY `id_advan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_asus`
--
ALTER TABLE `tbl_asus`
  MODIFY `id_asus` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_dell`
--
ALTER TABLE `tbl_dell`
  MODIFY `id_dell` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_hp`
--
ALTER TABLE `tbl_hp`
  MODIFY `id_hp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_lenovo`
--
ALTER TABLE `tbl_lenovo`
  MODIFY `id_lenovo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_msi`
--
ALTER TABLE `tbl_msi`
  MODIFY `id_msi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_samsung`
--
ALTER TABLE `tbl_samsung`
  MODIFY `id_samsung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK-admin_form` FOREIGN KEY (`id`) REFERENCES `user_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `FK-user` FOREIGN KEY (`id`) REFERENCES `user_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_acer`
--
ALTER TABLE `tbl_acer`
  ADD CONSTRAINT `FK-tbl_acer` FOREIGN KEY (`id_pesan`) REFERENCES `service_requests` (`id_pesan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_advan`
--
ALTER TABLE `tbl_advan`
  ADD CONSTRAINT `FK-tbl_advan` FOREIGN KEY (`id_pesan`) REFERENCES `service_requests` (`id_pesan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_asus`
--
ALTER TABLE `tbl_asus`
  ADD CONSTRAINT `FK-tbl_asus` FOREIGN KEY (`id_pesan`) REFERENCES `service_requests` (`id_pesan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_dell`
--
ALTER TABLE `tbl_dell`
  ADD CONSTRAINT `FK-tbl_dell` FOREIGN KEY (`id_pesan`) REFERENCES `service_requests` (`id_pesan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_hp`
--
ALTER TABLE `tbl_hp`
  ADD CONSTRAINT `FK-tbl_hp` FOREIGN KEY (`id_pesan`) REFERENCES `service_requests` (`id_pesan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_lenovo`
--
ALTER TABLE `tbl_lenovo`
  ADD CONSTRAINT `FK-tbl_lenovo` FOREIGN KEY (`id_pesan`) REFERENCES `service_requests` (`id_pesan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_msi`
--
ALTER TABLE `tbl_msi`
  ADD CONSTRAINT `FK-tbl_msi` FOREIGN KEY (`id_pesan`) REFERENCES `service_requests` (`id_pesan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_samsung`
--
ALTER TABLE `tbl_samsung`
  ADD CONSTRAINT `FK-tbl_samsung` FOREIGN KEY (`id_pesan`) REFERENCES `service_requests` (`id_pesan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
