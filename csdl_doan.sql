-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 27 août 2025 à 07:37
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `csdl_doan`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `fullname`) VALUES
(1, 'admin', 'admin', 'Quản trị viên');

-- --------------------------------------------------------

--
-- Structure de la table `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `MaCT` int(11) NOT NULL,
  `MaDH` int(11) DEFAULT NULL,
  `MaSP` int(11) DEFAULT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `DonGia` decimal(15,2) DEFAULT NULL,
  `NgayDatHang` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`MaCT`, `MaDH`, `MaSP`, `SoLuong`, `DonGia`, `NgayDatHang`) VALUES
(9, NULL, 4, 1, 24650000.00, '2025-08-25 20:49:57'),
(10, NULL, 18, 1, 40000000.00, '2025-08-25 20:56:23');

-- --------------------------------------------------------

--
-- Structure de la table `donhang`
--

CREATE TABLE `donhang` (
  `MaDH` int(11) NOT NULL,
  `MaKH` int(11) DEFAULT NULL,
  `NgayDat` date DEFAULT NULL,
  `TrangThai` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKH` int(11) NOT NULL,
  `HoTen` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `SoDienThoai` varchar(20) DEFAULT NULL,
  `DiaChi` text DEFAULT NULL,
  `MatKhau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `khachhang`
--

INSERT INTO `khachhang` (`MaKH`, `HoTen`, `Email`, `SoDienThoai`, `DiaChi`, `MatKhau`) VALUES
(12042005, 'Vũ Văn Huân', 'vuhuan123890@gmail.com', '0918841790', 'Nam Định', '123456'),
(12042006, 'Vũ Huân', 'vuvanhuan123890@gmail.com', '0375198064', 'Nam Đinh', 'huan12042005'),
(12042010, 'Vũ Huân', 'iamhuan205@gmail.com', '0918841790', 'Ninh Bình', 'huan2005');

-- --------------------------------------------------------

--
-- Structure de la table `nhasanxuat`
--

CREATE TABLE `nhasanxuat` (
  `MaNSX` int(11) NOT NULL,
  `TenNSX` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `nhasanxuat`
--

INSERT INTO `nhasanxuat` (`MaNSX`, `TenNSX`) VALUES
(1, 'Apple');

-- --------------------------------------------------------

--
-- Structure de la table `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` int(11) NOT NULL,
  `TenSP` varchar(255) NOT NULL,
  `Gia` decimal(15,2) NOT NULL,
  `Anh` varchar(255) DEFAULT NULL,
  `MoTa` text DEFAULT NULL,
  `MaNSX` int(11) DEFAULT NULL,
  `NgayNhap` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `Gia`, `Anh`, `MoTa`, `MaNSX`, `NgayNhap`) VALUES
(1, 'iPhone 13 Chính hãng VN/A', 10020000.00, 'image/Screenshot 2025-01-18 204052.png', 'iPhone 13 được Apple ra mắt vào ngày 14 tháng 9 năm 2021', 1, '2025-08-20 20:52:07'),
(2, 'iPhone 16 PRM Chính hãng VN/A', 27500000.00, 'image/Screenshot_2025-01-16-09-39-46-429_com.android.chrome-edit.jpg', 'Điện thoại cao cấp của Apple năm 2023', 1, '2025-08-20 20:52:07'),
(3, 'iPhone 14 Chính hãng LL/A', 15550000.00, 'image/Screenshot 2025-01-18 204241.png', 'iPhone 14 (cùng các mẫu 14 Plus, 14 Pro, 14 Pro Max) được Apple ra mắt vào ngày 7 tháng 9 năm 2022 tại sự kiện \"Far Out\". Sau đó, dòng sản phẩm này đã được mở bán tại Việt Nam vào ngày 14 tháng 10 năm 2022. ', 1, '2025-08-20 20:52:07'),
(4, 'iPhone 16 Plus Chính hãng VN/A', 24650000.00, 'image/Screenshot 2025-01-16 111226.png', 'iPhone 16 Plus và các phiên bản khác trong dòng iPhone 16 bắt đầu được mở bán trên toàn cầu từ ngày 20 tháng 9 năm 2024 và có mặt tại Việt Nam từ ngày 27 tháng 9 năm 2024. ', 1, '2025-08-20 20:52:07'),
(5, 'iPhone 14 Pro Chính hãng VN/A', 24850000.00, 'image/Screenshot 2025-01-18 204355.png', 'iPhone 14 Pro và iPhone 14 Pro Max là bộ đôi điện thoại thông minh thuộc dòng iPhone được Apple ra mắt vào ngày 7 tháng 9 năm 2022, cùng với bộ đôi iPhone 14 và iPhone 14 Plus.', 1, '2025-08-20 20:52:07'),
(6, 'Phone 12 Chính hãng VN/A', 9900000.00, 'image/Screenshot 2025-01-17 134016.png', 'iPhone 12 được Apple ra mắt vào năm 2020, cụ thể là vào ngày 13 tháng 10 năm 2020 trong sự kiện \"Hi, Speed\". Dòng iPhone 12 bao gồm iPhone 12 Mini, iPhone 12, iPhone 12 Pro và iPhone 12 Pro Max. ', 1, '2025-08-20 20:52:07'),
(7, 'Xiaomi Redmi K70 Ultra Box', 9290000.00, 'image/Screenshot 2025-01-17 134605.png', 'Xiaomi Redmi K70 Ultra ra mắt vào năm 2024, cụ thể là ngày 19 tháng 7 năm 2024 tại Trung Quốc. Đây là một sự kiện ra mắt lớn của Xiaomi trong năm, giới thiệu không chỉ Redmi K70 Ultra mà còn các sản phẩm khác như Xiaomi MIX Fold 4 và Xiaomi MIX Flip. ', 1, '2025-08-20 20:52:07'),
(8, 'Xiaomi Redmi Note 12 Turbo ', 6790000.00, 'image/Screenshot 2025-01-17 141014.png', 'Redmi Note 12 Turbo được ra mắt vào ngày 28 tháng 3 năm 2023', 1, '2025-08-20 20:52:07'),
(9, 'Samsung Galaxy S24 Ultra (5G) 12GB 256GB Chính Hãng', 22990000.00, 'image/Screenshot 2025-01-17 233528.png', 'Galaxy S24 Ultra được ra mắt ngày 17/01/2024 và lên kệ toàn cầu từ 24/01/2024. Hiện tại, sản phẩm đã có mặt rộng rãi tại các đại lý chính hãng ở Việt Nam.', 1, '2025-08-20 20:52:07'),
(10, 'Xiaomi 14T Pro ', 14790000.00, 'image/Screenshot 2025-01-17 234115.png', 'Xiaomi 14T Pro được ra mắt lần đầu tiên vào năm 2024, cụ thể là ngày 26 tháng 9 năm 2024 tại thị trường Việt Nam và nhiều thị trường khác trên toàn cầu. Sự kiện ra mắt này cũng bao gồm cả phiên bản Xiaomi 14T', 1, '2025-08-20 20:52:07'),
(11, 'Oppo Reno 10 Pro (5G)', 9990000.00, 'image/Screenshot 2025-01-18 203437.png', 'OPPO Reno10 Pro (5G) được ra mắt vào ngày 24 tháng 5 năm 2023 tại thị trường Trung Quốc. Sau đó, sản phẩm này tiếp tục được ra mắt tại thị trường quốc tế và các quốc gia khác trong năm 2023. ', 1, '2025-08-20 20:52:07'),
(12, 'Oppo Find X8', 19990000.00, 'image/Screenshot 2025-01-18 203801.png', 'OPPO Find X8 ra mắt chính thức tại Việt Nam vào ngày 21 tháng 11 năm 2024.\r\n \r\nSự kiện ra mắt này diễn ra đồng thời tại Việt Nam và thị trường toàn cầu, mang dòng flagship cao cấp nhất của OPPO đến gần hơn với người dùng. ', 1, '2025-08-20 20:52:07'),
(13, 'Vivo X200 Pro Mini', 16990000.00, 'image/Screenshot 2025-01-18 204703.png', 'Công ty Trung Quốc vừa ra mắt Vivo X200 Pro Mini cùng với các mẫu X200 khác trong sự kiện tối hôm nay (14/10/2024). Theo đó, đây sẽ là chiếc điện thoại cao cấp màn hình nhỏ nhất mà Vivo từng tạo ra.', 1, '2025-08-20 20:52:07'),
(14, 'Huawei Mate 20X (5G)', 16950000.00, 'image/Screenshot 2025-01-18 205051.png', 'Huawei Mate 20X (5G) ra mắt vào tháng 6 năm 2019 tại thị trường quốc tế, sau đó chính thức lên kệ và mở bán tại Trung Quốc vào ngày 26 tháng 7 năm 2019. ', 1, '2025-08-20 20:52:07'),
(15, 'Honor 80 Pro', 12350000.00, 'image/Screenshot 2025-01-18 205354.png', 'Điện thoại Honor 80 Pro ra mắt vào ngày 26 tháng 12 năm 2022 trong sự kiện ra mắt sản phẩm mới của Honor tại Trung Quốc, cùng với Honor 80 GT và Honor Pad V8 Pro. ', 1, '2025-08-20 20:52:07'),
(18, 'Iphone 17 PROMAX', 40000000.00, 'img/600_iphone-17-pro-max-512gb-specs-thumb-600x600.jpg', NULL, NULL, '2025-08-20 20:52:10'),
(19, 'OPPO Reno14 F 5G 8GB 256GB', 10300000.00, 'img/oppo-reno14-f-w.webp', NULL, NULL, '2025-08-20 20:52:11');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`MaCT`),
  ADD KEY `MaDH` (`MaDH`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Index pour la table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MaDH`),
  ADD KEY `MaKH` (`MaKH`);

--
-- Index pour la table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MaKH`);

--
-- Index pour la table `nhasanxuat`
--
ALTER TABLE `nhasanxuat`
  ADD PRIMARY KEY (`MaNSX`);

--
-- Index pour la table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `MaNSX` (`MaNSX`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `MaCT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `MaDH` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12042011;

--
-- AUTO_INCREMENT pour la table `nhasanxuat`
--
ALTER TABLE `nhasanxuat`
  MODIFY `MaNSX` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`MaDH`) REFERENCES `donhang` (`MaDH`),
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Contraintes pour la table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`);

--
-- Contraintes pour la table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MaNSX`) REFERENCES `nhasanxuat` (`MaNSX`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
