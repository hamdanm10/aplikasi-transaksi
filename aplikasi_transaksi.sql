-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Nov 2021 pada 16.02
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_transaksi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_barang`
--

CREATE TABLE `m_barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_barang` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_barang`
--

INSERT INTO `m_barang` (`id_barang`, `kode_barang`, `nama_barang`, `harga_barang`) VALUES
(7, 'BRG-1', 'Barang A', '20000'),
(11, 'BRG-2', 'Barang B', '10000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_customer`
--

CREATE TABLE `m_customer` (
  `id_customer` int(11) NOT NULL,
  `kode_customer` varchar(10) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_customer`
--

INSERT INTO `m_customer` (`id_customer`, `kode_customer`, `nama_customer`, `telp`) VALUES
(18, 'CUST-1', 'Customer A', '(022) 2789 223');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_sales`
--

CREATE TABLE `t_sales` (
  `id_sales` int(11) NOT NULL,
  `kode_sales` varchar(15) NOT NULL,
  `tgl` datetime NOT NULL,
  `id_customer` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `diskon` decimal(10,0) NOT NULL,
  `ongkir` decimal(10,0) NOT NULL,
  `total_bayar` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_sales`
--

INSERT INTO `t_sales` (`id_sales`, `kode_sales`, `tgl`, `id_customer`, `subtotal`, `diskon`, `ongkir`, `total_bayar`) VALUES
(28, 'TR-1', '2021-11-15 00:00:00', 18, '27500', '2000', '5000', '30500'),
(29, 'TR-2', '2021-11-15 00:00:00', 18, '29000', '5000', '10000', '34000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_sales_det`
--

CREATE TABLE `t_sales_det` (
  `id_sales` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga_bandrol` decimal(10,0) NOT NULL,
  `qty` int(11) NOT NULL,
  `diskon_pct` decimal(10,0) NOT NULL,
  `diskon_nilai` decimal(10,0) NOT NULL,
  `harga_diskon` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_sales_det`
--

INSERT INTO `t_sales_det` (`id_sales`, `id_barang`, `harga_bandrol`, `qty`, `diskon_pct`, `diskon_nilai`, `harga_diskon`, `total`) VALUES
(28, 7, '20000', 1, '10', '2000', '18000', '18000'),
(28, 11, '10000', 1, '5', '500', '9500', '9500'),
(29, 7, '20000', 1, '5', '1000', '19000', '19000'),
(29, 11, '10000', 1, '0', '0', '10000', '10000');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `m_customer`
--
ALTER TABLE `m_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `t_sales`
--
ALTER TABLE `t_sales`
  ADD PRIMARY KEY (`id_sales`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indeks untuk tabel `t_sales_det`
--
ALTER TABLE `t_sales_det`
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_barang` (`id_barang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `m_customer`
--
ALTER TABLE `m_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `t_sales`
--
ALTER TABLE `t_sales`
  MODIFY `id_sales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_sales`
--
ALTER TABLE `t_sales`
  ADD CONSTRAINT `t_sales_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `m_customer` (`id_customer`);

--
-- Ketidakleluasaan untuk tabel `t_sales_det`
--
ALTER TABLE `t_sales_det`
  ADD CONSTRAINT `t_sales_det_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `t_sales` (`id_sales`),
  ADD CONSTRAINT `t_sales_det_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `m_barang` (`id_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
