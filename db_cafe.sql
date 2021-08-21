-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2021 at 11:21 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `nama_product` varchar(200) NOT NULL,
  `harga_satuan` varchar(200) NOT NULL,
  `nama_customer` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `payment_method` varchar(200) NOT NULL,
  `tgl_transaksi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `id_user`, `id_product`, `nama_product`, `harga_satuan`, `nama_customer`, `alamat`, `quantity`, `total_harga`, `payment_method`, `tgl_transaksi`) VALUES
(7, 24, 24, 'Caramel Drinks', '15000', 'Muhammad Syafwan Ardiansyah', 'Kp Bangbayang RT05/03', 4, 60000, 'GoPay', '3 June 2021'),
(8, 24, 29, 'Breakfast Sausage', '30000', 'Muhammad Syafwan Ardiansyah', 'Kp Bangbayang', 2, 60000, 'Dana', '3 June 2021'),
(9, 30, 31, 'Choco Chips', '12000', 'Kinton Cafe', 'Dimana', 3, 36000, 'OVO', '3 June 2021'),
(10, 29, 27, 'Nasi Goreng', '20000', 'Muhammad Syafwan Ardiansyah Testing2', 'Kp Bangbayang RT05/03 Desa Bangbayang Kecamatan Cicurug Kabupaten Sukabumi Provinsi Jawa Barat, Indonesia, Asia Tenggara, Asia, Globe', 2, 40000, 'Dana', '4 June 2021'),
(11, 29, 26, 'Salad', '18000', 'Muhammad Syafwan Ardiansyah Testing2', 'regbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbreigbreiuregbre', 1, 18000, 'OVO', '4 June 2021'),
(12, 29, 29, 'Breakfast Sausage', '30000', 'Muhammad Syafwan Ardiansyah Testing2', 'gregeggregergergergergergergergergreg', 4, 120000, 'GoPay', '4 June 2021'),
(15, 29, 25, 'Pasta', '25000', 'Muhammad Syafwan Ardiansyah Testing2', 'Cicurug', 1, 25000, 'Dana', '4 June 2021'),
(16, 33, 26, 'Salad', '18000', 'Tatang', 'Mars', 1, 18000, 'OVO', '4 June 2021'),
(17, 29, 26, 'Salad', '18000', 'Muhammad Syafwan Ardiansyah Testing2', 'Testing1', 1, 18000, 'GoPay', '4 June 2021'),
(18, 24, 30, 'Pizza Cheese', '55000', 'Muhammad Syafwan Ardiansyah', 'Dimana aja', 1, 55000, 'GoPay', '4 June 2021'),
(19, 24, 27, 'Nasi Goreng', '20000', 'Muhammad Syafwan Ardiansyah', 'Bulan', 2, 40000, 'OVO', '5 June 2021'),
(20, 24, 31, 'Choco Chips', '12000', 'Muhammad Syafwan Ardiansyah', 'Testing', 1, 12000, 'Dana', '5 June 2021'),
(21, 24, 26, 'Salad', '18000', 'Muhammad Syafwan Ardiansyah', 'Testing 3', 1, 18000, 'OVO', '6 June 2021'),
(22, 24, 26, 'Salad', '18000', 'Muhammad Syafwan Ardiansyah', 'testing', 2, 36000, 'Dana', '7 June 2021'),
(23, 38, 27, 'Nasi Goreng', '20000', 'Bang Udin', 'test', 1, 20000, 'OVO', '16 June 2021'),
(24, 39, 25, 'Pasta', '25000', 'Cafe Kinton', 'Kp Test RT000/000 Desa Test', 1, 25000, 'GoPay', '18 June 2021');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `nama_product` varchar(200) NOT NULL,
  `harga` int(11) NOT NULL,
  `tgl_tambah` varchar(200) NOT NULL,
  `terjual` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `gambar`, `nama_product`, `harga`, `tgl_tambah`, `terjual`, `deskripsi`) VALUES
(24, '60acd9d8bb148.jpg', 'Caramel Drinks', 15000, '25 May 2021', 4, 'Caramel drink adalah minuman caramel yang sangat cocok diminum saat kumpul-kumpul'),
(25, '60acda2350a86.jpg', 'Pasta', 25000, '25 May 2021', 4, 'Pasta adalah makanan yang baik dikonsumsi saat mood'),
(26, '60acf22a41b33.jpg', 'Salad', 18000, '25 May 2021', 6, 'Salad adalah makanan campuran buah-buahan yang dicampuri susu diatasnya'),
(27, '60ad241d94072.jpg', 'Nasi Goreng', 20000, '25 May 2021', 5, 'Nah nasi goreng ini juga main menu kita lhoo'),
(28, '60ad2462b83bd.jpg', 'Sweet Strawberry', 12000, '25 May 2021', 0, 'Sweet Strawberry adalah menu drink kita yang dari strawberry asli'),
(29, '60ad249126bd6.jpg', 'Breakfast Sausage', 30000, '25 May 2021', 6, 'Menu Kali ini adalah menu yang khusus atau dibuat untuk breakfast'),
(30, '60ad24d9b5a80.jpg', 'Pizza Cheese', 55000, '25 May 2021', 1, 'Pizza Cheese adalah pizza menu yang enak untuk kumpul-kumpul'),
(31, '60ad25019676f.jpg', 'Choco Chips', 12000, '25 May 2021', 4, 'Choco Chips ini adalah minuman yang ditaburi dengan chips yang renyah'),
(33, '60c9cdcf2a7fd.jpg', 'Pancake', 30000, '16 June 2021', 0, 'Pancake ini memiliki rasa coklat dengan hiasan buah strawberry'),
(34, '60c9cdfae34a5.jpg', 'Sate Ayam', 13000, '16 June 2021', 0, 'Sate Ayam dengan taburan saus kacang, sangat cocok disantap dengan nasi yang hangat'),
(35, '60c9ce37e506d.jpg', 'Rendang', 22000, '16 June 2021', 0, 'Rendang daging sapi dengan bumbu yang sangat lezat'),
(36, '60c9ce5f8e695.jpg', 'Klepon', 3500, '16 June 2021', 0, 'Klepon isi gula merah dengan ditaburi kelapa parut'),
(37, '60c9ce9d2ac22.jpg', 'Mie Ayam', 16000, '16 June 2021', 0, 'Mie Ayam komplit dengan isian sayur dan lain lain'),
(38, '60c9cec7b23a6.jpg', 'Burger', 20000, '16 June 2021', 0, 'Burger komplit dengan isian sayur, daging, saus dan lain lain'),
(39, '60c9ceed063e7.jpg', 'Bakso', 20000, '16 June 2021', 0, 'Bakso dengan kuah bening dengan cita rasa yang lezat'),
(40, '60c9cf38d8f8e.jpg', 'Pudding', 7500, '16 June 2021', 0, 'Pudding dengan saus yang manis ditambah dengan krim'),
(41, '60c9cf881373f.jpg', 'Martabak', 52000, '16 June 2021', 0, 'Martabak manis yang sangat cocok ditemani dengan kopi atau susu'),
(42, '60c9cfaa3e23b.jpg', 'Bubble Tea', 25000, '16 June 2021', 0, 'Minuman segar dan sangat cocok diminum pada saat siang hari  '),
(43, '60cc63676fa9a.jpg', 'Sup', 15000, '18 June 2021', 0, 'Sup yang nikmat ketika dihidangkan di sore hari');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `tgl_buat` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  `job_desc` varchar(200) NOT NULL,
  `rating` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nama_lengkap`, `username`, `password`, `tgl_buat`, `status`, `role`, `job_desc`, `rating`) VALUES
(24, 'Muhammad Syafwan Ardiansyah', 'syafwan000', '$2y$10$XKhn2I6EGoH21Z7fjK.wSe7EIsrqVjqdgtGJanvTDmbjZZ/irKGny', '19 April 2021', 'Aktif', 'Admin', 'Owner', 'Puas'),
(25, 'Akun Demo', 'demo', '$2y$10$Y9B.cxUIjrXLrO0/FstNae7.JNEniKvgaSDGoZuoqClGAiLyNcEfK', '19 April 2021', 'Aktif', 'Customer', '-', '-'),
(27, 'Rayhan Rizki Putra', 'rayhan', '$2y$10$ng6YV2e7UkfkxkAmj8SareBG1HtW0KzuhmFFMK7878gb6VH5dU.gu', '23 April 2021', 'Aktif', 'Admin', 'Owner', '-'),
(28, 'Miko Dwi Oktafian', 'miko', '$2y$10$qtdFEGPkMDCRzkGSENN17eDJ4r4NQNMvKjRVQeeTWT/Fq5zHFTqmW', '8 May 2021', 'Aktif', 'Admin', 'Owner', '-'),
(29, 'Muhammad Syafwan Ardiansyah Testing2', 'syafwantest2', '$2y$10$L0fZ70glXM.XoI/0sEKr8O2ELxV9Xx03YlrRT9CQ52wUDhm1tLYWa', '9 May 2021', 'Aktif', 'Customer', '-', 'Puas'),
(30, 'Kinton Cafe', 'kinton', '$2y$10$RMH2jGKsfg.IaSo2kW7BqeUPmPHBz0SYyIlhGWrY4gVfIHxWe2JGG', '10 May 2021', 'Aktif', 'Admin', 'CEO', 'Puas'),
(31, 'Budi', 'budi', '$2y$10$4adAHaP6LPIq3q6LwFtRteunbPXC9NI3Eq6FeF3V3bKmSl1CCcgju', '10 May 2021', 'Aktif', 'Admin', 'Customer Manager', '-'),
(32, 'Ucup', 'ucup', '$2y$10$a3emxouFrx2z7fA8w9zenOVNZ0MTOOqlElkScszZFZQAU972mBgMC', '10 May 2021', 'Aktif', 'Admin', 'Product Manager', '-'),
(33, 'Tatang', 'tatang', '$2y$10$UICoAh48XqQs8U6b.Jvs7uM5HsUz83v8xNA/AWKMl9AL/1IY0cPU6', '10 May 2021', 'Aktif', 'Admin', 'Staff', '-'),
(34, 'Udin', 'udin', '$2y$10$2ELCJAxYTr5ppI8KepM/Ue5LlF5/I2dG8Re.UvSv9IzYpJMHcPiBS', '25 May 2021', 'Aktif', 'Customer', '-', '-'),
(37, 'testing', 'testing', '$2y$10$zuyCmvAaEVNhUYW/9saWO.j6sGhpEMOptDWIB2Qmn6qWk0r2rMxjS', '6 June 2021', 'Nonaktif', 'Customer', '-', '-'),
(38, 'Bang Udin', 'udin000', '$2y$10$qmSeS8NbuGq0srkVMaDTXuIP0BXOoC3UV24H37Fb7AsbLP/4Dw3Zu', '16 June 2021', 'Aktif', 'Customer', '-', '-'),
(39, 'Cafe Kinton', 'cafekinton00', '$2y$10$g3ydwmMjoLozYStHEAeSOevWofobfMPg.1n5HA.tSquOUu/RjFLgm', '18 June 2021', 'Nonaktif', 'Customer', '-', 'Puas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`id_user`),
  ADD KEY `idProduct` (`id_product`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `idProduct` FOREIGN KEY (`id_product`) REFERENCES `tbl_product` (`id`),
  ADD CONSTRAINT `idUser` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
