-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 26, 2023 lúc 10:57 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `id_ctdh` int(11) NOT NULL,
  `id_don_hang` int(11) NOT NULL,
  `id_san_pham` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hang`
--

CREATE TABLE `don_hang` (
  `id_don_hang` int(11) NOT NULL,
  `id_nguoi_dung` int(11) NOT NULL,
  `tong_tien` int(11) NOT NULL,
  `thoi_gian` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gio_hang`
--

CREATE TABLE `gio_hang` (
  `id_gio_hang` int(11) NOT NULL,
  `id_nguoi_dung` int(11) NOT NULL,
  `id_san_pham` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `thoi_gian` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `id_nguoi_dung` int(11) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `sdt` int(11) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `gioi_tinh` varchar(10) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `thoi_gian` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `id_san_pham` int(11) NOT NULL,
  `ten_san_pham` varchar(255) NOT NULL,
  `mo_ta` text NOT NULL,
  `gia` int(11) NOT NULL,
  `mau_sac` varchar(50) DEFAULT NULL,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `luot_mua` int(11) DEFAULT NULL,
  `ton_kho` int(11) DEFAULT NULL,
  `gioi_tinh` tinyint(1) DEFAULT NULL,
  `id_danh_muc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`id_san_pham`, `ten_san_pham`, `mo_ta`, `gia`, `mau_sac`, `hinh_anh`, `luot_mua`, `ton_kho`, `gioi_tinh`, `id_danh_muc`) VALUES
(2, 'áo thu đông', '', 120000, 'rgb(0, 139, 139)', 'tshirt.png', NULL, 12, 1, 0),
(3, 'quần', '', 100000, 'rgb(169, 169, 169)', 'tshirt.png', NULL, 12, 2, 2),
(4, 'áo phao', '', 2124434535, '', 'tshirt.png', NULL, 44, 2, 2),
(5, 'áo phao', '', 2124434535, '', 'tshirt.png', NULL, 44, 2, 2),
(6, 'áo nhiệt', '', 120000, 'rgb(240, 255, 255)', 'tshirt.png', NULL, 10, 2, 2),
(7, 'áo nhiệt', '', 120000, 'rgb(240, 255, 255)', 'tshirt.png', NULL, 10, 2, 2),
(8, 'hihi', '', 120000, 'rgb(0, 128, 0)', 'tshirt.png', NULL, 342, 0, 1),
(9, 'áo nhiệt', '', 120000, 'rgb(240, 255, 255)', 'tshirt.png', NULL, 10, 2, 2),
(10, 'áo dài', '', 100000, 'rgb(165, 42, 42)', 'tshirt.png', NULL, 1443, 1, 1),
(11, 'áo dài tay', 'mysqli_real_escape_string($conn, $_POST[\'ten_san_pham\']);mysqli_real_escape_string($conn, $_POST[\'ten_san_pham\']);mysqli_real_escape_string($conn, $_POST[\'ten_san_pham\']);mysqli_real_escape_string($conn, $_POST[\'ten_san_pham\']);mysqli_real_escape_string($conn, $_POST[\'ten_san_pham\']);', 3235253, 'rgb(240, 255, 255)', 'logo.png', NULL, 3253, 1, 1),
(12, 'áo dài tay', 'mysqli_real_escape_string($conn, $_POST[\'ten_san_pham\']);mysqli_real_escape_string($conn, $_POST[\'ten_san_pham\']);mysqli_real_escape_string($conn, $_POST[\'ten_san_pham\']);mysqli_real_escape_string($conn, $_POST[\'ten_san_pham\']);mysqli_real_escape_string($conn, $_POST[\'ten_san_pham\']);', 3235253, 'rgb(240, 255, 255)', '', NULL, 3253, 1, 1),
(13, 'áo dài tay', 'mysqli_real_escape_string($conn, $_POST[\'ten_san_pham\']);mysqli_real_escape_string($conn, $_POST[\'ten_san_pham\']);mysqli_real_escape_string($conn, $_POST[\'ten_san_pham\']);mysqli_real_escape_string($conn, $_POST[\'ten_san_pham\']);mysqli_real_escape_string($conn, $_POST[\'ten_san_pham\']);', 3235253, 'rgb(240, 255, 255)', '', NULL, 3253, 1, 1),
(14, 'h', 'fgh', 43, 'rgb(169, 169, 169)', 'logo.png', NULL, 3, 1, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`id_ctdh`),
  ADD KEY `id_don_hang` (`id_don_hang`),
  ADD KEY `id_san_pham` (`id_san_pham`);

--
-- Chỉ mục cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id_don_hang`),
  ADD KEY `id_nguoi_dung` (`id_nguoi_dung`);

--
-- Chỉ mục cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`id_gio_hang`),
  ADD KEY `id_nguoi_dung` (`id_nguoi_dung`);

--
-- Chỉ mục cho bảng `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`id_nguoi_dung`);

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id_san_pham`),
  ADD KEY `id_danh_muc` (`id_danh_muc`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `id_ctdh` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id_don_hang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `id_gio_hang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  MODIFY `id_nguoi_dung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id_san_pham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_1` FOREIGN KEY (`id_don_hang`) REFERENCES `don_hang` (`id_don_hang`),
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_2` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`);

--
-- Các ràng buộc cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_2` FOREIGN KEY (`id_nguoi_dung`) REFERENCES `nguoi_dung` (`id_nguoi_dung`);

--
-- Các ràng buộc cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gio_hang_ibfk_1` FOREIGN KEY (`id_nguoi_dung`) REFERENCES `nguoi_dung` (`id_nguoi_dung`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
