-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 28, 2023 lúc 10:38 AM
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
-- Cơ sở dữ liệu: `demo_shop2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `id_ctdh` int(11) NOT NULL,
  `id_don_hang` int(11) NOT NULL,
  `id_san_pham` int(11) NOT NULL,
  `mau_sac` int(11) NOT NULL,
  `kich_thuoc` varchar(50) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`id_ctdh`, `id_don_hang`, `id_san_pham`, `mau_sac`, `kich_thuoc`, `so_luong`, `gia`) VALUES
(9, 9, 10, 28, 'XL', 6, -60000),
(10, 9, 12, 24, 'XL', 3, 660000),
(11, 9, 20, 24, 'XL', 1, 203000),
(12, 9, 12, 24, 'M', 5, 1140000),
(13, 9, 13, 46, 'M', 10, 2640000),
(14, 9, 13, 44, 'M', 1, 210000),
(15, 9, 23, 86, 'M', 1, 500000),
(16, 10, 16, 62, 'M', 1, 260000),
(17, 11, 23, 86, 'M', 1, 500000),
(18, 12, 25, 90, 'XL', 1, 200000),
(19, 13, 25, 90, 'XL', 1, 200000),
(20, 14, 10, 28, 'L', 1, 65000),
(21, 15, 12, 24, 'M', 4, 840000),
(22, 15, 25, 90, 'XL', 1, 200000),
(23, 20, 25, 90, 'XL', 1, 200000),
(24, 22, 9, 24, 'L', 1, 60000),
(25, 23, 25, 90, 'XL', 1, 200000),
(26, 24, 25, 90, 'XL', 1, 200000),
(27, 28, 25, 90, 'XL', 1, 200000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_san_pham`
--

CREATE TABLE `chi_tiet_san_pham` (
  `id_ctsp` int(11) NOT NULL,
  `id_san_pham` int(11) NOT NULL,
  `id_kich_thuoc` int(11) DEFAULT NULL,
  `id_mau_sac` int(11) DEFAULT NULL,
  `so_luong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_san_pham`
--

INSERT INTO `chi_tiet_san_pham` (`id_ctsp`, `id_san_pham`, `id_kich_thuoc`, `id_mau_sac`, `so_luong`) VALUES
(17, 9, 2, 22, 3),
(18, 9, 3, 24, 3),
(19, 10, 3, 26, 3),
(20, 10, 4, 28, 5),
(21, 12, 1, 30, 33),
(22, 12, 2, 32, 13),
(23, 12, 4, 24, 23),
(24, 13, 1, 24, 12),
(25, 13, 2, 44, 12),
(26, 13, 1, 46, 4),
(27, 14, 1, 48, 14),
(28, 14, 1, 50, 25),
(29, 15, 2, 52, 13),
(30, 15, 4, 54, 19),
(31, 15, 3, 56, 29),
(32, 16, 1, 58, 25),
(33, 16, 2, 60, 14),
(34, 16, 1, 62, 5),
(35, 17, 1, 64, 159),
(36, 17, 1, 66, 25),
(37, 17, 4, 68, 26),
(38, 18, 1, 70, 16),
(39, 19, 2, 72, 19),
(40, 19, 3, 74, 26),
(41, 20, 3, 76, 15),
(42, 20, 4, 24, 16),
(43, 21, 2, 24, 19),
(44, 22, 2, 82, 13),
(45, 22, 4, 84, 19),
(46, 23, 2, 86, 25),
(47, 24, 2, 88, 26),
(48, 25, 4, 90, 26);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_muc`
--

CREATE TABLE `danh_muc` (
  `id_danh_muc` int(11) NOT NULL,
  `ten_danh_muc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_muc`
--

INSERT INTO `danh_muc` (`id_danh_muc`, `ten_danh_muc`) VALUES
(1, 'Áo'),
(2, 'Quần'),
(3, 'Mũ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hang`
--

CREATE TABLE `don_hang` (
  `id_don_hang` int(11) NOT NULL,
  `id_nguoi_dung` int(11) NOT NULL,
  `tong_tien` int(11) NOT NULL,
  `thoi_gian` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `thanh_toan` tinyint(4) NOT NULL,
  `trang_thai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `don_hang`
--

INSERT INTO `don_hang` (`id_don_hang`, `id_nguoi_dung`, `tong_tien`, `thoi_gian`, `thanh_toan`, `trang_thai`) VALUES
(9, 2, 5653000, '2023-11-28 15:41:49', 0, 0),
(10, 2, 260000, '2023-11-28 15:42:23', 0, 2),
(11, 2, 500000, '2023-11-28 15:47:25', 1, 1),
(12, 2, 200000, '2023-11-28 15:55:34', 0, 1),
(13, 2, 200000, '2023-11-28 15:56:49', 1, 1),
(14, 2, 65000, '2023-11-28 16:08:27', 1, 1),
(15, 2, 1100000, '2023-11-28 16:20:45', 1, 1),
(16, 2, -60000, '2023-11-28 16:21:17', 1, 1),
(17, 2, 200000, '2023-11-28 16:23:35', 0, 1),
(18, 2, 200000, '2023-11-28 16:23:41', 1, 1),
(19, 2, 200000, '2023-11-28 16:23:46', 0, 1),
(20, 2, 200000, '2023-11-28 16:25:36', 0, 1),
(21, 2, -60000, '2023-11-28 16:25:58', 0, 1),
(22, 2, 60000, '2023-11-28 16:26:23', 0, 1),
(23, 2, 200000, '2023-11-28 16:26:51', 1, 1),
(24, 2, 200000, '2023-11-28 16:28:35', 0, 1),
(25, 2, 200000, '2023-11-28 16:32:00', 0, 1),
(26, 2, 200000, '2023-11-28 16:32:05', 0, 1),
(27, 2, 200000, '2023-11-28 16:32:30', 0, 1),
(28, 2, 200000, '2023-11-28 16:32:49', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gio_hang`
--

CREATE TABLE `gio_hang` (
  `id_gio_hang` int(11) NOT NULL,
  `id_nguoi_dung` int(11) NOT NULL,
  `id_san_pham` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `mau_sac` int(11) NOT NULL,
  `kich_thuoc` varchar(50) NOT NULL,
  `thoi_gian` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `gio_hang`
--

INSERT INTO `gio_hang` (`id_gio_hang`, `id_nguoi_dung`, `id_san_pham`, `so_luong`, `mau_sac`, `kich_thuoc`, `thoi_gian`) VALUES
(36, 2, 12, 1, 24, 'XL', '2023-11-28 16:33:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kich_thuoc`
--

CREATE TABLE `kich_thuoc` (
  `id_kich_thuoc` int(11) NOT NULL,
  `kich_thuoc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `kich_thuoc`
--

INSERT INTO `kich_thuoc` (`id_kich_thuoc`, `kich_thuoc`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, 'XXL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mau_sac`
--

CREATE TABLE `mau_sac` (
  `id_mau_sac` int(11) NOT NULL,
  `ma_mau_sac` varchar(50) NOT NULL,
  `ten_mau_sac` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mau_sac`
--

INSERT INTO `mau_sac` (`id_mau_sac`, `ma_mau_sac`, `ten_mau_sac`) VALUES
(22, '#93f0ea', 'Xanh'),
(23, '#93f0ea', 'Xanh'),
(24, '#000000', 'Đen'),
(25, '#000000', 'Đen'),
(26, '#caf2e6', 'Xanh nhạt'),
(27, '#caf2e6', 'Xanh nhạt'),
(28, '#e7cbcb', 'Hồng'),
(29, '#e7cbcb', 'Hồng'),
(30, '#add4e1', 'Xanh dương'),
(31, '#add4e1', 'Xanh dương'),
(32, '#dca7a7', 'Hồng'),
(33, '#dca7a7', 'Hồng'),
(34, '#000000', 'Đen'),
(35, '#000000', 'Đen'),
(36, '#add4e1', 'Xanh dương'),
(37, '#add4e1', 'Xanh dương'),
(38, '#dca7a7', 'Hồng'),
(39, '#dca7a7', 'Hồng'),
(40, '#000000', 'Đen'),
(41, '#000000', 'Đen'),
(42, '#000000', 'Đen'),
(43, '#000000', 'Đen'),
(44, '#e49d6a', 'Cam'),
(45, '#e49d6a', 'Cam'),
(46, '#e59d6a', 'Cam'),
(47, '#e59d6a', 'Cam'),
(48, '#01505f', 'xanh'),
(49, '#01505f', 'xanh'),
(50, '#014f5b', 'Xanh'),
(51, '#014f5b', 'Xanh'),
(52, '#141d2c', 'Xanh Đen'),
(53, '#141d2c', 'Xanh Đen'),
(54, '#131c29', 'Xanh Đen'),
(55, '#131c29', 'Xanh Đen'),
(56, '#141d2a', 'Xanh Đen'),
(57, '#141d2a', 'Xanh Đen'),
(58, '#c8c9c4', 'Xám'),
(59, '#c8c9c4', 'Xám'),
(60, '#cdcec9', 'Xám'),
(61, '#cdcec9', 'Xám'),
(62, '#1d2d47', 'Xanh Đậm'),
(63, '#1d2d47', 'Xanh Đậm'),
(64, '#eff1f3', 'Trắng'),
(65, '#eff1f3', 'Trắng'),
(66, '#afded9', 'Xanh nhạt'),
(67, '#afded9', 'Xanh nhạt'),
(68, '#aededa', 'Xanh nhạt'),
(69, '#aededa', 'Xanh nhạt'),
(70, '#e9dad3', 'Be'),
(71, '#e9dad3', 'Be'),
(72, '#ab9d97', 'Be'),
(73, '#ab9d97', 'Be'),
(74, '#ae8c83', 'Be'),
(75, '#ae8c83', 'Be'),
(76, '#263f54', 'Xanh'),
(77, '#263f54', 'Xanh'),
(78, '#000000', 'Đen'),
(79, '#000000', 'Đen'),
(80, '#000000', 'Đen'),
(81, '#000000', 'Đen'),
(82, '#8fb7ce', 'Xanh'),
(83, '#8fb7ce', 'Xanh'),
(84, '#21466a', 'Xanh đậm'),
(85, '#21466a', 'Xanh đậm'),
(86, '#74000a', 'Đỏ'),
(87, '#74000a', 'Đỏ'),
(88, '#b7b882', 'Vàng'),
(89, '#b7b882', 'Vàng'),
(90, '#d61c32', 'Đỏ'),
(91, '#d61c32', 'Đỏ'),
(92, '#000000', '4'),
(93, '#000000', '4');

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

--
-- Đang đổ dữ liệu cho bảng `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`id_nguoi_dung`, `ten`, `email`, `password`, `sdt`, `ngay_sinh`, `gioi_tinh`, `dia_chi`, `thoi_gian`) VALUES
(2, 'PHIhI', 'p@gmail.com', '$2y$10$rTJlbcax/TRLee8L.MZto.HtnQ4G5zChiSVF08RpOZi1sUdnDW/Be', 345758757, '2003-01-02', 'Nữ', '20/HTM,14 HTM,Mai Dịch,Cầu Giấy', '2023-11-26 17:40:32'),
(3, 'h@gmail.com', 'h@gmail.com', '$2y$10$STFYLbjgwI5JFlQOba5CuOVA0z0lWMazfTQ0A0kRHTbN8Hn7nQ0Hq', NULL, NULL, NULL, NULL, '2023-11-26 17:44:25'),
(4, 'pg', 'f@gmail.com', '$2y$10$pgFhDhxqOI63XYskOt7n5OTUwVtpqY1zMYHpbmbfPMcD3A3AI.bLS', NULL, NULL, NULL, NULL, '2023-11-26 17:44:50'),
(5, 'phi@gmail.com', 'phi@gmail.com', '$2y$10$9hTF58.VjbG48A5TgxiItOa2jsLPLLCvHb7HK5PGoTAiDiPgHo0J6', NULL, NULL, NULL, NULL, '2023-11-26 17:45:43'),
(6, '', 'hi@gmail.com', '$2y$10$T7rDykEEJLHPHcvDPJdP.uJ895irUPxSJHwLSArQ8TqBhetSEUm7u', NULL, NULL, NULL, NULL, '2023-11-26 17:49:36'),
(7, 'phi', 'hdsdgdi@gmail.com', '$2y$10$uzsZITeoyoZApOLiqWWp7.R2s.IZPtekTbj2D/Xv4LILiWqQT0zVG', NULL, NULL, NULL, NULL, '2023-11-26 17:53:42'),
(8, 'dsg', 'hdgdi@gmail.com', '$2y$10$dIUyBgBTGkrspByOVVgHK./krAquwGPZg8aeDPt/WIy8pQaeEe6Y.', NULL, NULL, NULL, NULL, '2023-11-26 17:55:54'),
(9, 'hihi', 'aa@gmail.com', '$2y$10$T1DmA7lsCqmHpP3MNGEpu.nETIkLe4HeQfrSaVAFuXqOV7kundIpe', NULL, NULL, NULL, NULL, '2023-11-26 20:22:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `id_san_pham` int(11) NOT NULL,
  `ten_san_pham` varchar(255) NOT NULL,
  `mo_ta` text NOT NULL,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `gia` int(11) NOT NULL,
  `luot_mua` int(11) DEFAULT NULL,
  `ton_kho` int(11) DEFAULT NULL,
  `do_tuoi` tinyint(1) NOT NULL,
  `gioi_tinh` tinyint(1) DEFAULT NULL,
  `id_danh_muc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`id_san_pham`, `ten_san_pham`, `mo_ta`, `hinh_anh`, `gia`, `luot_mua`, `ton_kho`, `do_tuoi`, `gioi_tinh`, `id_danh_muc`) VALUES
(9, 'Áo khoác chần bông nữ', 'Áo khoác chần bông siêu nhẹ nữ, giữ ấm tốt. Phom dáng gọn gàng, hiện đại, có thể gấp gọn vào túi tặng kèm. Mũ áo có khóa rời đa năng, tiên lợi. Màu sắc phong phú, phù hợp được nhiều lứa tuổi, dễ dàng mix đồ.\r\nVải ít bám bẩn, dễ vệ sinh.\r\nVải ít nhăn nhàu và dễ làm phẳng lại.\r\nCó khả năng cản gió, giữ ấm tốt.', 'vh1ua21t.png', 120000, NULL, 6, 2, 2, 1),
(10, 'Áo len bé gái cổ tròn vai bồng', 'Áo len dày cổ tròn, vai bồng, có gân ngang ngực', '1clmllqj.png', 125000, NULL, 8, 1, 2, 1),
(11, 'Áo nỉ nữ bo gấu có hình in', 'Áo nỉ dáng basic cổ tròn, thiết kế bo gấu tạo sự thoải mái khi mặc, kết hợp với các chi tiết đồ họa đơn giản tạo điểm nhấn cho sản phẩm.', 'g3h7lfff.png', 120000, NULL, NULL, 2, 2, 1),
(12, 'Áo nỉ nữ bo gấu có hình in', 'Áo nỉ dáng basic cổ tròn, thiết kế bo gấu tạo sự thoải mái khi mặc, kết hợp với các chi tiết đồ họa đơn giản tạo điểm nhấn cho sản phẩm.', 'g3h7lfff.png', 225000, NULL, 69, 2, 2, 1),
(13, 'Combo 2 áo body bé trai cổ tròn', 'Áo body bé trai chất liệu rib cotton pha, phom dáng body cổ tròn giữ ấm tốt trong mùa đông. Phù hợp với nhiều hoàn cảnh sử dụng.', 'ef1ats79.png', 270000, NULL, 28, 1, 1, 1),
(14, 'Áo phông dài tay bé trai cotton USA phối màu', 'Áo phông bé trai', 'un2zmsba.png', 120000, NULL, 39, 1, 1, 1),
(15, 'Áo nỉ nam có hình in', 'Áo được thiết kế vừa vặn, thoải mái, tiện lợi trong mọi hoạt động. Áo phù hợp để mặc thường ngày, dễ dàng phối layer tạo nhiếu set thời trang đa phong cách (lịch sự, ấn tượng, trẻ trung....)\r\nSự kết hợp của 2 thành phần sợi polyester và cotton giúp sản phẩm giữ form dáng tốt nhưng vẫn đảm bảo độ xốp và thoáng khí. Màu sắc bền đẹp và độ bền của sản phẩm cao.', '3hb0sl0q.png', 225000, NULL, 61, 2, 1, 1),
(16, 'Áo nỉ nam cổ tròn basic', 'Áo được thiết kế vừa vặn, thoải mái, tiện lợi trong mọi hoạt động. Áo phù hợp để mặc thường ngày, dễ dàng phối layer tạo nhiếu set thời trang đa phong cách (lịch sự, ấn tượng, trẻ trung....)\r\nSự kết hợp của 2 thành phần sợi cotton và polyester giúp sản phẩm giữ form dáng tốt nhưng vẫn đảm bảo độ xốp và thoáng khí. Màu sắc bền đẹp và độ bền của sản phẩm cao.', '0kbw4ke9.png', 320000, NULL, 44, 2, 1, 1),
(17, 'Áo polo dài tay bé trai lacoste', 'Áo polo dài tay phom dáng regular, chất liệu lacoste pha mềm mại, khỏe khoắn, phù hợp cho bé đi học đi chơi.', 'chf57bob.png', 125000, NULL, 210, 1, 1, 1),
(18, 'Áo nỉ nữ basic cổ tròn', 'Áo nỉ dài tay dáng regular, thiết kế đơn giản, mặc thoải mái và dễ kết hợp với nhiều loại trang phục.\r\nChất liệu 100% polyester.', 'zq5uoqqq.png', 169000, NULL, 16, 2, 2, 1),
(19, 'Áo blazer dạ nữ dáng ngắn', 'Áo khoác dạ kẻ nữ 2 lớp cổ vest dáng ngắn.\r\nSự kết hợp của thành phần wool và polyester giúp sản phẩm giữ phom dáng tốt nhưng vẫn đảm bảo mềm mại và ấm áp.', 'mokhurn8.png', 599000, NULL, 45, 2, 2, 1),
(20, 'Quần jeans nam dáng ôm', 'Quần jeans chất liệu cotton pha, cạp thường cài cúc, phom ôm.', 'jhshvi79.png', 263000, NULL, 31, 2, 1, 2),
(21, 'Quần jeans nam có khóa dáng ôm', 'Quần jeans chất liệu cotton co giãn, cạp thường cài cúc, có khoá, dáng ôm.', 'hzjzsdie.png', 152900, NULL, 19, 2, 1, 1),
(22, 'Bộ mặc nhà nam cotton áo cộc tay quần soóc', 'Bộ mặc nhà chất liệu 100% cotton, áo cổ tròn tay cộc, quần soóc dệt thoi cạp chun.', '31wnlalr.png', 298900, NULL, 32, 2, 1, 1),
(23, 'Váy liền bé gái chất liệu nhung cổ kiểu', 'Váy nhung cổ kiểu bé gái, các chi tiết rúm bèo mang lại sự nữ tính cho bé gái. Chất liệu nhung rất mềm mại phù hợp với thời tiết giao mùa.\r\nChất liệu nhung mềm mại, giữ ấm tốt phù hợp với thời tiết se lạnh.', 'vzy3zbit.png', 560000, NULL, 25, 1, 2, 1),
(24, 'Váy liền bé gái cotton USA cộc tay in hình Marie', 'Mô tả\r\nVáy liền cộc tay bé gái in mèo Marie. Chi tiết bèo gấu nữ tính, phù hợp với nhiều hoàn cảnh sử dụng.Form regular cùng chất liệu 100%cotton mang lại cảm giác thoải mái và dễ chịu cả ngày.\r\nChất liệu 100% cotton:- Ưu điểm NL: Thân thiện với môi trường. Độ bền tốt. Thấm hút tốt, thoáng mát, không gây hại cho sức khỏe. Thoáng mát khi mặc.', '1o5rpq0h.png', 265000, NULL, 26, 1, 2, 1),
(25, 'Quần soóc denim bé trai cotton cạp chun có túi', 'Quần soóc denim bé trai cotton cạp chun có túi.\r\nChất liệu cotton.', '17rpm6em.png', 260000, NULL, 26, 1, 1, 1);

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
-- Chỉ mục cho bảng `chi_tiet_san_pham`
--
ALTER TABLE `chi_tiet_san_pham`
  ADD PRIMARY KEY (`id_ctsp`),
  ADD KEY `id_kich_thuoc` (`id_kich_thuoc`),
  ADD KEY `id_mau_sac` (`id_mau_sac`),
  ADD KEY `id_san_pham` (`id_san_pham`);

--
-- Chỉ mục cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`id_danh_muc`);

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
-- Chỉ mục cho bảng `kich_thuoc`
--
ALTER TABLE `kich_thuoc`
  ADD PRIMARY KEY (`id_kich_thuoc`);

--
-- Chỉ mục cho bảng `mau_sac`
--
ALTER TABLE `mau_sac`
  ADD PRIMARY KEY (`id_mau_sac`);

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
  MODIFY `id_ctdh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_san_pham`
--
ALTER TABLE `chi_tiet_san_pham`
  MODIFY `id_ctsp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id_don_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `id_gio_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `kich_thuoc`
--
ALTER TABLE `kich_thuoc`
  MODIFY `id_kich_thuoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `mau_sac`
--
ALTER TABLE `mau_sac`
  MODIFY `id_mau_sac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT cho bảng `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  MODIFY `id_nguoi_dung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id_san_pham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
-- Các ràng buộc cho bảng `chi_tiet_san_pham`
--
ALTER TABLE `chi_tiet_san_pham`
  ADD CONSTRAINT `chi_tiet_san_pham_ibfk_1` FOREIGN KEY (`id_mau_sac`) REFERENCES `mau_sac` (`id_mau_sac`),
  ADD CONSTRAINT `fk_ctsp_kich_thuoc` FOREIGN KEY (`id_kich_thuoc`) REFERENCES `kich_thuoc` (`id_kich_thuoc`),
  ADD CONSTRAINT `fk_ctsp_san_pham` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`);

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

--
-- Các ràng buộc cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `fk_san_pham_danh_muc` FOREIGN KEY (`id_danh_muc`) REFERENCES `danh_muc` (`id_danh_muc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
