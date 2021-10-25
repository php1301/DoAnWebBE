SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET SQL_MODE='ALLOW_INVALID_DATES';
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_quanlytimviec`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `CongTys`
--

CREATE TABLE `CongTys` (
  `id` int(11) NOT NULL,
  `tenCongTy` varchar(100) NOT NULL COMMENT 'tên công ty',
  `logo` varchar(100) NOT NULL COMMENT 'lô gô của công ty',
  `banner` varchar(100) DEFAULT NULL COMMENT 'banner của công ty',
  `email` varchar(100) NOT NULL COMMENT 'email của công ty',
  `sdt` int(11) NOT NULL COMMENT 'số điện thoại',
  `diaChi` varchar(100) NOT NULL COMMENT 'địa chỉ',
  `id_kv` int(11) NOT NULL COMMENT 'id khu vực',
  `id_nn` int(11) DEFAULT NULL,
  `mota_cty` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `CongTys`
--

INSERT INTO `CongTys` (`id`, `tenCongTy`, `logo`, `banner`, `email`, `sdt`, `diaChi`, `id_kv`, `id_nn`, `mota_cty`, `created_at`, `updated_at`) VALUES
(43, 'AC Group', 'AC Group.jpg', 'acgroup.jpg', 'ABC@cty.com', 359229731, '123 đà nẵng', 7, 5, 'AC Group phát triển và cung cấp các giải pháp, dịch vụ trong lĩnh vực công nghệ thông tin được thành lập từ năm 2018. Đến nay, AC Group đã đạt được vị trí nhất định trên thị trường, sản phẩm của công ty được biết đến bởi sự linh hoạt, tính ứng dụng cao cho khách hàng. Bên cạnh đó, với đội ngũ nhân viên trẻ, năng động, chuyên nghiệp và sáng tạo, chúng tôi đã tạo ra sản phẩm mới, giá trị mới trong lĩnh vực ứng dụng công nghệ thông tin vào quản lý và điều hành tác nghiệp.', '2021-01-18 06:49:06', '2021-01-20 04:08:27'),
(46, 'Kargo 365', 'Kargo 365.jpg', 'kargo365.jpg', 'hanoi@cty.com', 23456789, '123 hà nội', 7, 5, 'Kargo 365, được thành lập ngày 11/11/2019, là công ty phát triển hạ tầng công nghệ giúp kết nối các công ty vận tải xuyên biên giới quản lý hoạt động hàng ngày hiệu quả, tối ưu khả năng trao đổi và chia sẻ tài nguyên (hàng, container và xe) qua đó dễ dàng cắt giảm chi phí, mở rộng quy mô và tăng doanh thu.', '2021-01-06 13:19:25', '2021-01-06 13:19:25'),
(47, 'FPT', 'fpt.jpg', 'fpt.jpg', 'ABC@cty.com', 23456789, '123 đà nẵng', 6, 5, 'Là thành viên thuộc Tập đoàn công nghệ hàng đầu Việt Nam FPT, Công ty Cổ phần Viễn thông FPT (tên gọi tắt là FPT Telecom) hiện là một trong những nhà cung cấp dịch vụ viễn thông và Internet có uy tín và được khách hàng yêu mến tại Việt Nam và Khu vực.', '2021-01-06 13:19:31', '2021-01-06 13:19:31'),
(48, 'BIDV', 'BIDV.jpg', 'bidv.jpg', 'ABC@cty.com', 23456789, '123 đà nẵng', 5, 9, 'Qua 63 năm xây dựng và trư­ởng thành, Ngân hàng Đầu tư và Phát triển Việt Nam đã đạt được những thành tựu rất quan trọng, góp phần đắc lực cùng toàn ngành Ngân hàng thực hiện chính sách tiền tệ quốc gia và phát triển kinh tế xã hội của đất nư­ớc. Bước vào kỷ nguyên mới, kỷ nguyên của công nghệ và tri thức, với hành trang truyền thống 55 năm phát triển, Ngân hàng Đầu tư­ và Phát triển Việt Nam tự tin h­ướng tới những mục tiêu và ư­ớc vọng to lớn hơn trở thành một Tập đoàn Tài chính Ngân hàng có uy tín trong n­ước, trong khu vực và vươn ra thế giới.   ', '2021-01-06 13:19:36', '2021-01-06 13:19:36'),
(49, 'EZ Solution', 'EZ solution.jpg', '', 'hanoi@cty.com', 23456789, '123 đà nẵng', 6, 19, NULL, '2021-01-04 21:18:04', '2021-01-04 21:18:04'),
(55, 'VPBank', 'vp bank.jpg', 'vpbank.jpg', 'php@cty.com', 359229731, '123 đà nẵng', 6, 9, 'Ngân hàng TMCP Việt Nam Thịnh Vượng (trước đây là Ngân hàng TMCP Các Doanh nghiệp Ngoài Quốc Doanh, viết tắt VPBank) là một ngân hàng ở Việt Nam được thành lập ngày 12 tháng 08 năm 1993. Sau 21 năm hoạt động, VPBank đã nâng vốn điều lệ lên 6.347 tỷ đồng, phát triển mạng lưới lên hơn 200 điểm giao dịch, với đội ngũ trên 7.000 cán bộ nhân viên.\r\nLà thành viên của nhóm các ngân hàng lớn hàng đầu Việt Nam (G12), VPBank đã triển khai chiến lược tăng trưởng trong giai đoạn 2012 - 2017 với sự hỗ trợ của công ty tư vấn McKinsey. Với chiến lược này, VPBank nỗ lực tăng trưởng hữu cơ trong các phân khúc khách hàng mục tiêu, khẩn trương xây dựng các hệ thống nền tảng để phục vụ tăng trưởng, và chủ động theo dõi các cơ hội trên thị trường.\r\nVPBank giành được các giải thưởng: Ngân hàng thanh toán xuất sắc nhất do Citibank, Ngân hàng New York trao tặng; giải thưởng Ngân hàng có chất lượng dịch vụ được hài lòng nhất; Thương hiệu quốc gia 2012; Top 500 doanh nghiệp lớn nhất Việt Nam.   ', '2021-01-17 20:28:48', '2021-01-17 20:28:48'),
(59, 'CÔNG TY CP ĐẦU TƯ VÀ PHÁT TRIỂN GIÁO DỤC THẾ GIỚI KỸ THUẬT', 'cty giáo dục.jpg', 'giaoduc.jpg', 'giaoduc@gmail.com', 359229731, '3 Đường Nguyễn Văn Thương Hồ Chí Minh', 5, 23, 'Được thành lập từ năm 2013, sau hơn 5 năm hoạt động, TWEDU đang dần trở thành một trong những công ty đầu tư và phát triển giáo dục hàng đầu Việt Nam.Là hệ thống trường mầm non mang tiêu chuẩn quốc tế đáp ứng đầy đủ cơ sở vật chất hiện đại, đội ngũ ban cố vấn giàu kinh nghiệm. Trường mầm non Tổ Ong Vàng là một trong số các trường mầm non hiếm hoi mang các tiêu chuẩn giảng dạy nước ngoài vào áp dụng tai Việt Nam.', '2021-01-24 04:27:40', '2021-01-25 05:09:44'),
(60, 'Công ty TNHH thương mại và dịch vụ Hải Minh -Phòng khám Vrehab', 'y tế.jpg', 'yte.jpg', 'yte@gmail.com', 285736475, '22 Bùi Thị Xuân, Phường 2, Quận Tân Bình, Hồ Chí Minh', 5, 22, 'Phòng khám Vrehab thành lập trên nền tảng của Công ty TNHH thương mại và dịch vụ Hải Minh hoạt động chuyên sâu cung cấp giải pháp thiết bị VLTL-PHCN từ năm 2010.\r\nVới hơn 10 năm kinh nghiệm và đang là công ty hàng đầu trong lĩnh vực cung cấp thiết bị Phục hồi chức năng với nhiều giải pháp hiện đại mang lại hiệu quả điều trị nhanh và duy trì kết quả lâu dài. Các thiết bị cung cấp bởi Hải Minh hiện đang có mặt trên khắp 64 tỉnh thành một số được xuất khẩu sang các nước trong khu vực Đông Nam Á.', '2021-01-25 03:06:45', '2021-01-25 04:44:40'),
(61, 'Công Ty Cổ Phần ITC Việt Nam', 'kinhdoanh.jpg', 'kinhdoanh.jpg', 'kinhdoanh@gmail.com', 285736475, 'Số 123 Nguyễn Khoái, Quận Hai Bà Trưng, Hà Nội', 7, 6, 'CÔNG TY CỔ PHẦN I.T.C VIỆT NAM được thành lập bởi những chuyên viên dầy kinh nghiệm về lĩnh vực Bảo hộ lao động – Dụng cụ cầm tay – Thiết bị Công nghiệp. I.T.C VIỆT NAM hiểu rõ nhu cầu của khách hàng nên bổ xung thương xuyên sản các sản phẩm giúp khách hàng có nhiều sự lựa chọn phong phú. Quý khách có thể tìm thấy nhiều sản phẩm cùng lúc, nhanh nhất, chính xác nhất. I.T.C VIỆT NAM đã và đang khẳng định một doanh nghiệp có năng lực và uy tín hàng đầu Việt Nam.', '2021-01-25 05:40:38', '2021-01-25 05:41:25'),
(62, 'Công ty TNHH Đầu Tư Nghiên Cứu Và Phát Triển Phần Mềm Việt Nam', 'marketing.jpg', 'marketing.jpg', 'marketing@gmail.com', 285736475, 'Tầng 14, Tháp C, Tòa nhà Hồ Gươm Plaza, 102 Trần Phú, Hà Đông, Hà Nội', 7, 8, 'Với tiêu chí: “Đơn giản – Hiệu quả – Uy tín” Top Marketing hy vọng sẽ đem lại nhiều lợi ích cho Khách hàng. Mục tiêu của chúng t Sứ mệnh:“ Sứ mệnh của chúng tôi là trở thành một công ty kinh doanh phần mềm marketing, sáng tạo và phát triển những công cụ marketing mới nhằm đem lại hiệu quả cao nhất cho khách hàng.” Định hướng phát triển của công ty: – Ngày càng tăng tốc độ phát triển trên mọi chỉ tiêu: doanh số, nhân lực, giá trị thương hiệu, số lượng sản phẩm (phần mềm marke ting, quảng cáo online, các sản phẩm trong nghành CNTT …) – Phát huy và nâng cao thế mạnh sẵn có của công ty về bán hàng, thiết kế phần mềm và phát triển phần mềm,…lên một tầm cao mới để đáp ứng với những nhu cầu ngày càng cao của khách hàng. Với mong muốn được phục vụ các quý khách hàng ngày càng chu đáo hơn, chúng tôi luôn sẵn sàng tiếp nhận và biết ơn mọi sự góp ý của khách hàng', '2021-01-25 05:52:49', '2021-01-25 05:53:24');


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `KhuVucs`
--

CREATE TABLE `KhuVucs` (
  `id_kv` int(11) NOT NULL COMMENT 'khóa chính',
  `tenKhuVuc` varchar(100) NOT NULL COMMENT 'tên khu vực',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `KhuVucs`
--

INSERT INTO `KhuVucs` (`id_kv`, `tenKhuVuc`, `created_at`, `updated_at`) VALUES
(5, 'Hồ chí minh', '2020-12-28 08:20:56', '2021-01-24 04:05:35'),
(6, 'Đà nẵng', '2020-12-28 08:20:56', '2020-12-28 08:20:56'),
(7, 'Hà nội', '2020-12-28 08:20:56', '2021-01-21 11:49:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Luus`
--

CREATE TABLE `Luus` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_vl` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `Luus`
--

INSERT INTO `Luus` (`id`, `id_user`, `id_vl`, `created_at`, `updated_at`) VALUES
(2, 58, 102, '2021-01-25 07:26:43', '2021-01-25 07:26:43'),
(3, 51, 102, '2021-01-30 19:57:17', '2021-01-30 19:57:17'),
(4, 59, 102, '2021-02-01 21:37:20', '2021-02-01 21:37:20'),
(5, 64, 102, '2021-02-01 21:38:00', '2021-02-01 21:38:00'),
(6, 64, 102, '2021-02-01 21:38:00', '2021-02-01 21:38:00');


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `NganhNghes`
--

CREATE TABLE `NganhNghes` (
  `id_nn` int(11) NOT NULL COMMENT 'khóa chính',
  `tenNganhNghe` varchar(100) NOT NULL COMMENT 'tên ngành nghề',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `NganhNghes`
--

INSERT INTO `NganhNghes` (`id_nn`, `tenNganhNghe`, `created_at`, `updated_at`) VALUES
(5, 'Công nghệ thông tin', '2020-12-29 09:42:52', '2021-01-09 09:49:51'),
(6, 'Kinh doanh', '2020-12-29 09:42:52', '2021-01-20 21:46:31'),
(8, 'Marketing', '2021-01-05 06:11:07', '2021-01-05 06:11:07'),
(9, 'Hành chính/Nhân sự', '2021-01-05 06:11:07', '2021-01-05 06:11:07'),
(12, 'Khách sạn/Nhà hàng', '2021-01-05 06:14:36', '2021-01-05 06:14:36'),
(13, 'Kỹ thuật', '2021-01-05 06:14:36', '2021-01-05 06:14:36'),
(15, 'Kiến trúc', '2021-01-05 06:14:36', '2021-01-05 06:14:36'),
(17, 'Lao động phổ thông', '2021-01-20 21:36:28', '2021-01-20 21:47:08'),
(18, 'Thương mại', '2021-01-20 21:38:46', '2021-01-20 21:48:06'),
(19, 'Phát triển thị trường\r\n', '2021-01-21 05:35:13', '2021-01-21 05:35:13'),
(20, 'Kế toán', '2021-01-21 05:43:15', '2021-01-21 05:43:15'),
(21, 'Back - End\r\n', '2021-01-21 05:51:16', '2021-01-21 05:51:16'),
(22, 'Y tế', '2021-01-25 11:44:07', '2021-01-25 11:44:07'),
(23, 'Giáo dục', '2021-01-25 11:44:07', '2021-01-25 11:44:07'),
(24, 'Tư vấn/Chăm sóc khách hàng', '2021-01-25 12:57:04', '2021-01-25 12:57:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `NhaTuyenDungs`
--

CREATE TABLE `NhaTuyenDungs` (
  `id` int(11) NOT NULL COMMENT 'id',
  `id_user` int(11) NOT NULL COMMENT 'id user',
  `id_cty` int(11) NOT NULL COMMENT 'id công ty',
  `tenNhaTuyenDung` varchar(100) NOT NULL COMMENT 'tên người đăng ký',
  `chucVuNhaTuyenDung` varchar(100) NOT NULL COMMENT 'chức vụ người đăng ký',
  `sdtNhaTuyenDung` int(11) NOT NULL COMMENT 'số điện thoại người đăng ký',
  `diachi_ndk` varchar(100) NOT NULL COMMENT 'địa chỉ người đăng ký',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `NhaTuyenDungs`
--

INSERT INTO `NhaTuyenDungs` (`id`, `id_user`, `id_cty`, `tenNhaTuyenDung`, `chucVuNhaTuyenDung`, `sdtNhaTuyenDung`, `diachi_ndk`, `created_at`, `updated_at`) VALUES
(43, 43, 43, 'Sơn', 'Admin', 359229731, 'đà nẵng', '2020-12-29 03:57:01', '2021-01-20 04:08:27'),
(46, 46, 46, 'Sơn1', 'Admin', 123456, 'đà nẵng', '2021-01-04 21:14:39', '2021-01-04 21:14:39'),
(47, 47, 47, 'Sơn', 'Admin', 123456, 'đà nẵng', '2021-01-04 21:16:11', '2021-01-04 21:16:11'),
(48, 48, 48, 'Sơn', 'Admin', 123456, 'đà nẵng', '2021-01-04 21:17:25', '2021-01-04 21:17:25'),
(49, 49, 49, 'Sơn', 'Admin', 123456, 'đà nẵng', '2021-01-04 21:18:04', '2021-01-04 21:18:04'),
(55, 55, 55, 'Sơn', 'Admin', 359229731, 'đà nẵng', '2021-01-17 20:28:48', '2021-01-17 20:28:48'),
(59, 59, 59, 'Sơn', 'Admin', 359229731, 'quảng nam', '2021-01-24 04:27:40', '2021-01-25 05:09:44'),
(60, 60, 60, 'Sơn', 'Admin', 359229731, 'quảng nam', '2021-01-25 03:06:45', '2021-01-25 04:44:40'),
(61, 61, 61, 'Sơn', 'Admin', 359229731, 'quảng nam', '2021-01-25 05:40:38', '2021-01-25 05:40:38'),
(62, 62, 62, 'Sơn', 'Admin', 359229731, 'quảng nam', '2021-01-25 05:52:49', '2021-01-25 05:52:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `UngTuyens`
--

CREATE TABLE `UngTuyens` (
  `id` int(11) NOT NULL COMMENT 'id',
  `id_user` int(11) NOT NULL COMMENT 'id user',
  `id_ntd` int(11) NOT NULL COMMENT 'id nhà tuyển dụng',
  `id_vl` int(11) NOT NULL COMMENT 'id việc làm',
  `trangThai` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `UngTuyens`
--

INSERT INTO `UngTuyens` (`id`, `id_user`, `id_ntd`, `id_vl`, `trangThai`, `created_at`, `updated_at`) VALUES
(51, 51, 43, 92, 0, '2021-01-20 04:08:59', '2021-01-20 04:08:59'),
(54, 58, 61, 100, 0, '2021-01-25 06:49:45', '2021-01-25 06:49:45'),
(55, 58, 62, 102, 0, '2021-01-25 07:15:25', '2021-01-25 07:15:25'),
(56, 51, 62, 102, 0, '2021-01-30 19:57:24', '2021-01-30 19:57:24'),
(57, 64, 62, 102, 0, '2021-02-01 21:29:12', '2021-02-01 21:29:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `UngViens`
--

CREATE TABLE `UngViens` (
  `id` int(11) NOT NULL COMMENT 'id',
  `id_user` int(11) NOT NULL COMMENT 'id user',
  `hinhAnh` varchar(100) DEFAULT NULL COMMENT 'hình ảnh',
  `gioiTinh` varchar(100) NOT NULL COMMENT 'giới tính',
  `ngaySinh` date DEFAULT NULL COMMENT 'ngày sinh',
  `sdt` int(11) DEFAULT NULL COMMENT 'số điện thoại',
  `diaChi` varchar(100) DEFAULT NULL COMMENT 'địa chỉ',
  `kinhNghiem` varchar(100) DEFAULT NULL COMMENT 'kinh nghiệm',
  `luonghientai` varchar(100) DEFAULT NULL COMMENT 'lương hiện tại',
  `luongmongmuon` varchar(100) DEFAULT NULL COMMENT 'lương mong muốn',
  `viTri` varchar(100) DEFAULT NULL COMMENT 'vị trí công việc',
  `loaihinh` varchar(100) DEFAULT NULL COMMENT 'loại công viêc ',
  `bangCap` varchar(100) DEFAULT NULL COMMENT 'bằng cấp',
  `khuvuc` varchar(100) DEFAULT NULL COMMENT 'khu vực làm việc ',
  `ghichu` text DEFAULT NULL COMMENT 'giới tiệu bản thân',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `UngViens`
--

INSERT INTO `UngViens` (`id`, `id_user`, `hinhAnh`, `gioiTinh`, `ngaySinh`, `sdt`, `diaChi`, `kinhNghiem`, `luonghientai`, `luongmongmuon`, `viTri`, `loaihinh`, `bangCap`, `khuvuc`, `ghichu`, `created_at`, `updated_at`) VALUES
(51, 51, 'TUM.jpg', 'Nam', '2021-01-30', 359230000, 'quảng nam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-09 00:20:18', '2021-01-09 00:20:18'),
(58, 58, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-24 10:45:47', '2021-01-24 10:45:47'),
(63, 63, 'd4bcc46e371e194b20854acd1ba3a86b.jpg', 'Nam', '2021-01-05', 359229731, 'Đà nẵng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-28 01:51:51', '2021-01-28 01:51:51'),
(64, 64, 'icon-basket.jpg', 'Nam', '2021-02-01', 359229731, 'quảng nam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-01 21:28:15', '2021-02-01 21:28:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--
DROP TABLE `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'tên ',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'email',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'mật khẩu',
  `level` int(11) NOT NULL COMMENT '1 ứng viên\r\n2 nhà tuyển dụng\r\n3 admin\r\n',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(28, 'Phạm Hoàng Phúc', 'kingbossfacebook.com@gmail.com', NULL, '$2y$10$0go3XWldNAV1orW6KCDjNeWZxn6/gC4nwp3LNDDDOp9OgudHX6oWC', 3, NULL, '2020-12-27 23:24:56', '2021-01-05 04:46:45'),
(43, 'ACB', 'ACB@gmai.com', NULL, '$2y$10$5QxnwwnWR88VH7qzY7yXUOTWmSml1kJrfyM13G5prNayz7k2UIH4C', 2, NULL, '2020-12-29 03:57:01', '2020-12-29 03:57:01'),
(46, 'Hà nội', 'hanoi@gmai.com', NULL, '$2y$10$fIjCBGqqq03DiXjwicQrZ.gCHVAtT.XuZx6TduiUHfCmHO4m2g7R6', 2, NULL, '2021-01-04 21:14:39', '2021-01-04 21:14:39'),
(47, 'ACB', 'admin@gmail.com', NULL, '$2y$10$8Ves4MOV0UEneAFG7KbWn.bb9zC6Jf5RpYXwgc3NHRP70SV71lfHa', 2, NULL, '2021-01-04 21:16:11', '2021-01-04 21:16:11'),
(48, 'ACB', 'hanoi123@gmai.com', NULL, '$2y$10$53Qrs6MnBlbzR16RWXJyGeIKiQgBq4FJs29QrAe1cOxZgA98F48WS', 2, NULL, '2021-01-04 21:17:25', '2021-01-04 21:17:25'),
(49, 'ACB', 'hanoi1234@gmai.com', NULL, '$2y$10$e74vxqTBY04/PcYZoH8fneJSbt7kO9zIp98m/TZF8TtwMm7zLLZkK', 2, NULL, '2021-01-04 21:18:04', '2021-01-04 21:18:04'),
(51, 'Phạm Hoàng Phúc', 'uv1@gmail.com', NULL, '$2y$10$sqyNWLZ5bF4Vls98FjBOfumtcOOuqfuPQIE4fM4jlC8qdys5WYLk2', 1, NULL, '2021-01-09 00:20:18', '2021-01-09 00:20:18'),
(55, 'phph', 'php@gmai.com', NULL, '$2y$10$DyHPAZmks81S9YkQHIxE2.egxR0u9w4r2kJPvBnZ0HSgmKp8eyOtG', 2, NULL, '2021-01-17 20:28:48', '2021-01-17 20:28:48'),
(58, 'Phạm Hoàng Phúc', 'trunghau_246@yahoo.com', NULL, '$2y$10$03v4zPJvcMG7gPhVfTiBlOWbsf2XuHe/OSnAEGs37eZeqww2B3jsq', 1, NULL, '2021-01-24 03:14:03', '2021-01-24 03:14:03'),
(59, 'CÔNG TY CP ĐẦU TƯ VÀ PHÁT TRIỂN GIÁO DỤC THẾ GIỚI KỸ THUẬT', 'giaoduc@gmail.com', NULL, '$2y$10$U0Kqj7Z3D9YtwXhs8EOpfewFe2QRCkK3TxozD9kkKpNFCuvaDj4hu', 2, NULL, '2021-01-24 04:27:40', '2021-01-24 04:27:40'),
(60, 'Công ty TNHH thương mại và dịch vụ Hải Minh -Phòng khám Vrehab', 'yte@gmail.com', NULL, '$2y$10$xU5Xenz4B5k6C/oMZzipoeroeDhp.8uwJvBBqIl9xMB8j1Pamo.2G', 2, NULL, '2021-01-25 03:06:45', '2021-01-25 03:10:22'),
(61, 'Công Ty Cổ Phần ITC Việt Nam', 'kinhdoanh@gmail.com', NULL, '$2y$10$ceK4SFEsuanTt1bB6Weuoe1Dw.a9aldRFDmgSs/gHkPMKG2pop9.K', 2, NULL, '2021-01-25 05:40:38', '2021-01-25 05:40:38'),
(62, 'Công ty TNHH Đầu Tư Nghiên Cứu Và Phát Triển Phần Mềm Việt Nam', 'marketing@gmail.com', NULL, '$2y$10$We0dXM5YAeMArDIBcXoYA.b81.uvk1wdwhOE.3CBnBPpuDvaVEe3O', 2, NULL, '2021-01-25 05:52:49', '2021-01-25 05:52:49'),
(63, 'Phạm Hoàng Phúc', 'son@gmail.com', NULL, '$2y$10$RNeijHC8nC/cLdlzgJGz9ek7TtInFgN4x9LQ68BaCqNppgEotvv1C', 1, NULL, '2021-01-28 01:51:51', '2021-01-28 01:51:51'),
(64, 'Phạm Hoàng Phúc', 'son123@gmail.com', NULL, '$2y$10$S7s08aXYS7Afa/Sv22tt8eykA5zFIccdbjd88lsUmvahGqNG2m8pW', 1, NULL, '2021-02-01 21:28:15', '2021-02-01 21:28:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ViecLams`
--

CREATE TABLE `ViecLams` (
  `id` int(11) NOT NULL COMMENT 'id',
  `tenVIecLam` varchar(100) NOT NULL COMMENT 'tên việc làm',
  `id_cty` int(11) DEFAULT NULL COMMENT 'id công ty',
  `id_nn` int(100) NOT NULL COMMENT 'id ngành nghề',
  `id_kv` int(11) NOT NULL COMMENT 'id khu vực',
  `ngayDang` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ngày đăng',
  `ngayhethang` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ngày hết hạn',
  `mucLuong` float NOT NULL COMMENT 'mức lương',
  `tinhChat` varchar(100) NOT NULL COMMENT 'tính chất công việc',
  `moTa` text NOT NULL COMMENT 'mô tả',
  `yeuCau` text NOT NULL COMMENT 'yêu cầu',
  `soLuong` int(11) NOT NULL COMMENT 'số lượng',
  `diaChi` varchar(100) NOT NULL COMMENT 'địa chỉ làm việc',
  `bangCap` varchar(100) NOT NULL COMMENT 'bằng cấp',
  `kinhNghiem` varchar(100) NOT NULL COMMENT 'kinh nghiệm',
  `viTri` varchar(100) NOT NULL COMMENT 'vị trí công việc',
  `chucVu` varchar(100) NOT NULL COMMENT 'chức vụ ',
  `gioiTinh` varchar(100) DEFAULT NULL COMMENT 'giới tính',
  `tuoi` varchar(100) DEFAULT NULL COMMENT 'tuổi',
  `trangThai` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ViecLams`
--

INSERT INTO `ViecLams` (`id`, `tenVIecLam`, `id_cty`, `id_nn`, `id_kv`, `ngayDang`, `ngayhethang`, `mucLuong`, `tinhChat`, `moTa`, `yeuCau`, `soLuong`, `diaChi`, `bangCap`, `kinhNghiem`, `viTri`, `chucVu`, `gioiTinh`, `tuoi`, `trangThai`, `created_at`, `updated_at`) VALUES
(88, 'ACGROUP TUYỂN DỤNG VỊ TRÍ LEADER SALE', 43, 19, 7, '2021-01-04 10:09:09', '2021-01-06', 1234, 'Toàn thời gian', '<ul><li>&middot; Điều h&agrave;nh hoạt động h&agrave;ng ng&agrave;y của team telesale, theo d&otilde;i, gi&aacute;m s&aacute;t c&aacute;c th&agrave;nh vi&ecirc;n ho&agrave;n th&agrave;nh KPI, đ&aacute;nh gi&aacute; hiệu quả c&ocirc;ng việc. &middot;</li><li>Lập kế hoạch kinh doanh h&agrave;ng th&aacute;ng, qu&yacute;, năm của team tr&igrave;nh BGĐ xem x&eacute;t; x&eacute;t duyệt kế hoạch v&agrave; đ&aacute;nh gi&aacute; kết quả l&agrave;m việc của từng nh&acirc;n vi&ecirc;n kinh doanh đối với kế hoạch th&aacute;ng, tuần; chịu tr&aacute;ch nhiệm về hiệu quả hoạt động chung của team v&agrave; của từng nh&acirc;n vi&ecirc;n cấp dưới; &middot; L&ecirc;n kịch bản telesales ph&ugrave; hợp cho từng chiến dịch v&agrave; triển khai hoạt động Telesales đạt hiệu quả v&agrave; đ&uacute;ng định hướng chiến lược &middot;</li><li>Duy tr&igrave; v&agrave; bảo đảm dữ liệu hoạt động của Telesales được li&ecirc;n tục &middot; Quản l&yacute;, đ&agrave;o tạo, t&aacute;i đ&agrave;o tạo, tạo động lực l&agrave;m việc v&agrave; ph&aacute;t triển kỹ năng nh&acirc;n vi&ecirc;n, đảm bảo c&aacute;c th&agrave;nh vi&ecirc;n nắm bắt v&agrave; thực hiện tốt c&ocirc;ng việc &middot;</li><li>Phối hợp với c&aacute;c ph&ograve;ng ban xử l&yacute; th&ocirc;ng tin, &yacute; kiến g&oacute;p &yacute;, giải đ&aacute;p thắc mắc của kh&aacute;ch h&agrave;ng &middot;</li><li>Theo d&otilde;i chỉ số kinh doanh, thực hiện b&aacute;o c&aacute;o kinh doanhtheo định kỳ / bất thường; &middot;</li><li>T&igrave;m hiểu c&aacute;c sản phẩm, ng&agrave;nh h&agrave;ng, h&igrave;nh thức kinh doanh mới c&oacute; tiềm năng v&agrave; đề xuất với BGĐ c&aacute;c hướng ph&aacute;t triển ph&ugrave; hợp v&agrave; hiệu quả. &middot;</li><li>C&aacute;c c&ocirc;ng t&aacute;c kh&aacute;c theo ph&acirc;n c&ocirc;ng của cấp tr&ecirc;n</li></ul>', '<ul><li>&middot; C&oacute; &iacute;t nhất 3 năm kinh nghiệm quản l&yacute;, đ&agrave;o tạo team &middot;</li><li>Ưu ti&ecirc;n ứng vi&ecirc;n c&oacute; kinh nghiệm trong lĩnh vực: t&agrave;i ch&iacute;nh, gi&aacute;o dục,... &middot;</li><li>C&oacute; kỹ năng giao tiếp tốt, giọng n&oacute;i dễ nghe, th&agrave;nh thạo tin học văn ph&ograve;ng. &middot;</li><li>Khả năng giải quyết vấn đề v&agrave; &aacute;p lực trong c&ocirc;ng việc cao.</li></ul>', 2, '505 Đường Minh Khai, Vĩnh Tuy, Hai Bà Trưng,Hồ chí minh', 'Cao đẳng', '3', 'Nhân viên/Chuyên viên', 'Thực tập sinh đào tạo', 'Nam', '18 - 30', 1, '2021-01-04 03:09:09', '2021-02-01 19:31:01'),
(89, 'Họa sỹ thiết kế Digita', 48, 5, 7, '2021-01-05 04:30:43', '2021-01-28', 22222, 'Toàn thời gian', 'ABCZYX', 'ABCXYZ', 2, 'Hà nội', 'Cao đẳng', 'Tôi chưa có kinh nghiệm', 'Nhân viên/Chuyên viên', 'Nhân viên đào tạo', 'không yêu cầu', '18 - 30', 1, '2021-01-04 21:30:43', '2021-01-04 21:30:52'),
(90, 'Trưởng Phòng Kế Toán', 43, 20, 7, '2021-01-04 10:09:09', '2021-01-06', 1234, 'Toàn thời gian', '<ul><li><strong>- Tham mưu cho BĐH về ch&iacute;nh s&aacute;ch ph&aacute;p luật (am hiểu v&agrave; cập nhật thường xuy&ecirc;n) Tổ chức hệ thống sổ s&aacute;ch, phương ph&aacute;p kế to&aacute;n ph&ugrave; hợp với y&ecirc;u cầu của luật ph&aacute;p hiện h&agrave;nh.</strong></li><li><strong>-&nbsp; X&acirc;y dựng c&aacute;c quy tr&igrave;nh, quy định nghiệp vụ đ&aacute;p ứng theo hệ thống sổ s&aacute;ch v&agrave; phương ph&aacute;p hạch to&aacute;n kế to&aacute;n X&acirc;y dựng quy tr&igrave;nh, thủ tục kiểm k&ecirc;, gi&aacute;m s&aacute;t hoạt động kinh doanh.</strong></li><li><strong>-&nbsp; Thiết lập định dạng hệ thống b&aacute;o c&aacute;o nghiệp vụ Tập hợp số liệu, l&ecirc;n kế hoạch lợi nhuận năm.</strong></li><li><strong>-&nbsp; Điều chỉnh số liệu kế hoạch lợi nhuận qu&yacute; C&aacute;c c&ocirc;ng việc thuộc thẩm quyền quản l&yacute; v&agrave; quản l&yacute; bộ phận</strong></li></ul>', '<ul><li><strong>- Nam/Nữ từ 30 tuổi trở l&ecirc;n</strong></li><li><strong>-&nbsp; ĐH trở l&ecirc;n chuy&ecirc;n ng&agrave;nh t&agrave;i ch&iacute;nh, kế to&aacute;n</strong></li><li><strong>-&nbsp; C&oacute; &iacute;t nhất 5 năm kinh nghiệm Kế to&aacute;n trưởng, hoặc &iacute;t nhất 3 năm kinh nghiệm kế to&aacute;n trưởng cho doanh nghiệp về kinh doanh thương mại</strong></li></ul>', 2, '505 Đường Minh Khai, Vĩnh Tuy, Hai Bà Trưng,Hồ chí minh', 'Đại học', '3', 'Nhân viên/Chuyên viên', 'Nhân viên đào tạo', 'Nam', '18 - 30', 1, '2021-01-04 03:09:09', '2021-02-01 19:39:52'),
(91, 'Backend Engineer', 46, 5, 5, '2021-01-18 03:56:43', '2021-01-19', 1234, 'Toàn thời gian', ' Working with team members\r\n\r\n Researching new technology & sharing your knowledge.\r\n\r\n Collaborating with the front-end developers and other team members to establish objectives and design more functional, cohesive codes to enhance the user experience.\r\n\r\n Developing ideas for new programs, products, or features by monitoring industry developments and trends.', ' Have experience in Java Spring Boot, ReactJS, MySQL, Redis.\r\n\r\n Have 1.5+ year experience in Java development.\r\n\r\n Have at least a bachelor degree in computer programming, computer science, or a related field.\r\n\r\n Have strong understanding of the web development cycle, programming techniques and tools.\r\n\r\n Have good knowledge at OOP.\r\n\r\n Focus on efficiency, user experience, and process improvement.\r\n\r\n Be able to work independently or with a group.', 2, '12 Nam Kỳ Khởi Nghĩa, Nguyễn Thái Bình, Quận 1', 'Đại học', '1', 'Nhân viên/Chuyên viên', 'Thực tập sinh đào tạo', 'nam', '18 - 30', 1, '2021-01-17 20:56:43', '2021-01-19 03:42:26'),
(92, 'Senior Backend Engineer', 46, 5, 5, '2021-01-19 10:44:49', '2021-01-12', 124, 'Toàn thời gian', ' Front-end development skills: 3+ ReactJS, HTML/JavaScript, Cascading Style Sheets (CSS), JQuery\r\n Server-side component design skills: Object-Oriented Design with Java EE 6 and up, 4+ Spring/SpringBoot/SpringBatch, common frameworks such as Maven, JUnit, Log4J,\r\nMockito.\r\n Usability\r\n SQL development for MySQL,\r\n WebSphere deployment.\r\n Git, BitBucket, TeamCity, Jenkins automation\r\n Experience in MongoDB, Redis, Kafka', ' Focus on efficiency, user experience, and process improvement.\r\n Ability to work independently or with a group.\r\n Must demonstrate the experience and ability to work without technical oversight and to lead and/or supervise a team of specialists.\r\n Must possess superior oral and written communication skills in order to clearly and effectively convey issues and ideas to team members, management and customers', 2, '12 Nam Kỳ Khởi Nghĩa, Nguyễn Thái Bình, Quận 1', 'Cao đẳng', '1', 'Nhân viên/Chuyên viên', 'Nhân viên đào tạo', 'Không yêu cầu', '18 - 30', 1, '2021-01-19 03:44:49', '2021-01-19 03:45:46'),
(94, 'Giáo Viên Mầm Non', 59, 23, 5, '2021-01-24 11:42:04', '2021-01-30', 2000, 'Làm theo giờ', '<ul><li>- Chịu tr&aacute;ch nhiệm đ&oacute;n v&agrave; trả trẻ h&agrave;ng ng&agrave;y khi phụ huynh đưa, đ&oacute;n trẻ; - Chuẩn bị ph&ograve;ng học h&agrave;ng ng&agrave;y sạch sẽ trước khi trẻ v&agrave;o học;</li><li>- Cho trẻ ăn, uống, chơi, nghỉ v&agrave; ngủ đ&uacute;ng theo chương tr&igrave;nh chăm s&oacute;c chung do Nh&agrave; trường đề ra;</li><li>- Giảng dạy v&agrave; tổ chức cho trẻ học, chơi theo chương tr&igrave;nh, nội dung gi&aacute;o dục đ&atilde; được Nh&agrave; trường ph&ecirc; duyệt;</li><li>- Phối hợp, g&oacute;p &yacute; x&acirc;y dựng v&agrave; soạn thảo chương tr&igrave;nh gi&aacute;o dục c&ugrave;ng Nh&agrave; trường;</li><li>- Phối hợp với c&aacute;c gi&aacute;o vi&ecirc;n kh&aacute;c trong hoạt động gi&aacute;o dục trẻ;</li><li>- Đảm bảo an to&agrave;n th&acirc;n thể, sức khỏe v&agrave; tinh thần của trẻ tại Nh&agrave; trường; chủ động thực hiện c&aacute;c biện ph&aacute;p cần thiết để đảm bảo an to&agrave;n cho trẻ trong từng trường hợp;</li><li>- Tham gia c&aacute;c hoạt động học v&agrave; chơi ngo&agrave;i trời hoặc ngoại kh&oacute;a c&ugrave;ng trẻ;</li><li>- Đ&aacute;nh gi&aacute; về hoạt động học tập v&agrave; r&egrave;n luyện của trẻ;</li><li>- Thực hiện c&aacute;c nhiệm vụ chuy&ecirc;n m&ocirc;n theo y&ecirc;u cầu c&ocirc;ng ty v&agrave; hiệu trưởng.</li><li>- Hợp t&aacute;c với c&aacute;c bộ phận kh&aacute;c theo y&ecirc;u cầu của c&ocirc;ng ty v&agrave; nh&agrave; trường.</li></ul>', '<ul><li>- Chi nh&aacute;nh 1: (Wilton) 71/3 Nguyễn Văn Thương, p25, quận B&igrave;nh Thạnh ( Thuộc hệ thống trường mầm non quốc tế TGB)</li><li>- Chi nh&aacute;nh 2:30 B&ugrave;i Thị Xu&acirc;n , p2, Quận T&acirc;n B&igrave;nh.( Thuộc hệ thống trường mầm non quốc tế TGB)</li><li>- Chi nh&aacute;nh 3: (The Park) khu 12, Nguyễn Hữu Thọ, Huy&ecirc;n Nh&agrave; B&egrave; (Trường mầm non Tổ Ong V&agrave;ng)</li></ul>', 1, '3 Đường Nguyễn Văn Thương, Phường 25, Bình Thạnh', 'Đại học', '1', 'Nhân viên/Chuyên viên', 'Chuyên viên đào tạo', 'Nữ', '18-30', 1, '2021-01-24 04:42:04', '2021-02-01 19:56:22'),
(95, 'Nhân Viên Chăm Sóc Y Tế', 59, 22, 5, '2021-01-24 11:45:02', '2021-01-30', 1000, 'Toàn thời gian', '- Thực hiện cân đo định kì cho trẻ hàng tháng, quý. Tổng hợp báo cáo cân đo, vẽ biểu đồ.\r\n\r\n- Kết hợp với Trạm y tế xã khám sức khỏe định kì cho trẻ mầm non và tiểu học\r\n\r\n- Cập nhật danh sách thực tế của trẻ từng ngày để theo dõi sức khỏe.\r\n\r\n- Vệ sinh tủ thuốc và phòng làm việc.\r\n\r\n- Lưu mẫu thực phẩm và tổng hợp lưu mẫu thức ăn trong ngày theo mẫu. Tổng hợp lưu mẫu thực phẩm trong tháng.\r\n\r\n- Nhận thuốc từ phụ huynh gởi và phát thuốc cho trẻ đúng giờ\r\n\r\n- Theo dõi và xử lý các trẻ bị bệnh đột xuất. Lên kế hoạch và hướng dẫn phòng bệnh theo mùa.\r\n\r\n- Kiểm tra tủ thuốc và bổ sung thuốc. Báo cáo số lượng thuốc nhập tồn trong tháng. Tổng hợp danh sách trẻ và giáo viên sử dụng thuốc trong tháng.\r\n\r\n- Hỗ trợ giáo viên giám sát trẻ trong giờ bơi.\r\n\r\n- Sử dụng các công cụ hỗ trợ, máy móc đúng chức năng vận hành.\r\n\r\n- Hỗ trợ các công việc khác khi được phân công.\r\n\r\n- Hỗ trợ giáo viên trong các giờ học bơi và hoạt động ngoài trời của bé\r\n\r\nĐịa điểm làm việc: (Chi nhánh trường mầm non Tổ Ong Vàng và hệ thống trường mầm non quốc tế TGB)\r\n\r\n- Chi nhánh 1: (Wilton) 1W Điện Biên Phủ, p25, quận Bình Thạnh\r\n- Chi nhánh 2: (The Park) khu 12, Nguyễn Hữu Thọ, Huyên Nhà Bè\r\n- Chi nhánh 3: 30 BTX, p2, Quận Tân Bình.\r\n- Chi nhánh 4: Quận 9.', '- Trình độ học vấn chuyên môn về y tế , bằng trung cấp trở lên\r\n\r\n- Ưu tiên 1 năm kinh nghiệm trong lĩnh vực tương đương\r\n\r\n- Giới tính : Nữ, không yêu cầu độ tuổi\r\n\r\n- Chăm chỉ, nhiệt tình , có trách nhiệm trong công việc, yêu thương trẻ nhỏ', 1, '1W Điện Biên Phủ, phường 25, Quận Bình Thạnh', 'Đại học', 'Không yêu cầu', 'Nhân viên/Chuyên viên', 'Nhân viên đào tạo', 'Không yêu cầu', '18-30', 1, '2021-01-24 04:45:02', '2021-01-25 05:11:34'),
(96, 'Tư Vấn Kiêm Thủ Quỹ', 59, 20, 5, '2021-01-24 11:47:20', '2021-01-30', 1500, 'Toàn thời gian', '<ul><li>Tư vấn &amp; Quản l&yacute; danh s&aacute;ch học sinh</li><li>- Tư vấn tuyển sinh. - Giải đ&aacute;p thắc mắc của phụ huynh.</li><li>- Quản l&yacute;, cập nhật danh s&aacute;ch học sinh, hồ sơ học sinh, danh s&aacute;ch phụ huynh học sinh, kiểm tra đối chiếu với Ph&ograve;ng kế to&aacute;n khi c&oacute; y&ecirc;u cầu.</li><li>- Hằng ng&agrave;y cập nhật số lượng học sinh, b&aacute;o c&aacute;o danh s&aacute;ch học sinh với BGH trường.</li><li>- Quản l&yacute; ng&agrave;y nghỉ ph&eacute;p của học sinh.</li><li>- Hằng ng&agrave;y lập danh s&aacute;ch đưa đ&oacute;n học sinh.</li><li>- L&agrave;m hồ sơ nghỉ học, c&aacute;c thủ tục cần thiết khi học sinh nghỉ học.</li><li>- Đăng k&yacute; giải quyết c&aacute;c chế độ Bảo hiểm tai nạn cho học sinh.</li><li>- Gọi điện tư vấn v&agrave; chăm s&oacute;c kh&aacute;ch h&agrave;ng khi học sinh nghỉ hẳn hoặc nghỉ d&agrave;i hạn hoặc khi trường c&oacute; c&aacute;c ch&iacute;nh s&aacute;ch mới &aacute;p dụng cho học sinh. Thủ Quỹ</li><li>- Thu tiền dựa tr&ecirc;n phiếu thu; Kiểm tra c&aacute;c chứng từ li&ecirc;n quan, k&egrave;m theo phiếu đề nghị thanh to&aacute;n, đảm bảo t&iacute;nh đ&uacute;ng quy đinh chi của c&ocirc;ng ty trước khi thực hiện chi tiền mặt; Cuối ng&agrave;y lập bảng b&aacute;o c&aacute;o doanh thu tổng hợp c&aacute;c chi ph&iacute; h&agrave;nh ch&iacute;nh, quỹ tiền mặt nộp cho Kế to&aacute;n chi nh&aacute;nh (gọi tắt l&agrave; kế to&aacute;n).</li><li>- Địa điểm l&agrave;m việc: Chi nh&aacute;nh 6: Chung cư Ehome S, Ph&uacute; Hữu, Quận 9 Chi nh&aacute;nh 7: Đường số 11, Thảo Điền, Quận 2</li></ul>', '<ol><li>Tr&igrave;nh độ học vấn chuy&ecirc;n m&ocirc;n - Cao đẳng trở l&ecirc;n chuy&ecirc;n ng&agrave;nh Quản trị kinh doanh, kinh tế.</li><li>Kỹ năng l&agrave;m việc - Giao tiếp, truyền đạt, ph&aacute;t &acirc;m chuẩn. - L&agrave;m việc nh&oacute;m - Lập kế hoạch &amp; quản l&yacute; thời gian</li><li>&nbsp;Kinh nghiệm - C&oacute; &iacute;t nhất 01 năm trở l&ecirc;n.</li><li>T&iacute;nh c&aacute;ch c&aacute; nh&acirc;n - Y&ecirc;u thương, t&ocirc;n trọng trẻ. - Năng động, kh&eacute;o tay, cẩn thận, trung thực c&oacute; tr&aacute;ch nhiệm với c&ocirc;ng việc được giao. - Quan hệ đ&uacute;ng mực, ho&agrave; nh&atilde; với trẻ, đồng nghiệp v&agrave; những người xung quanh.</li><li>&nbsp;Thể chất &amp; sức khoẻ - Tốt</li><li>Giới t&iacute;nh - Nữ</li><li>&nbsp;Độ tuổi - Bất kỳ</li></ol>', 1, 'EHome S Phú Hữu, Khu Phố 2, Phú Hữu, Quận 9', 'Cao đẳng', '2', 'Nhân viên/Chuyên viên', 'Nhân viên đào tạo', 'Không yêu cầu', '18-30', 1, '2021-01-24 04:47:20', '2021-02-01 19:55:00'),
(97, 'Quản Lý Hệ Thống Mầm Non', 59, 23, 5, '2021-01-25 10:02:09', '2021-01-30', 3000, 'Toàn thời gian', '<ul><li>- Chịu tr&aacute;ch nhiệm quản l&yacute; (gần như vai tr&ograve; hiệu trưởng tại đ&acirc;y), gi&aacute;m s&aacute;t về c&ocirc;ng t&aacute;c chuy&ecirc;n m&ocirc;n, bảo đảm chất lượng gi&aacute;o dụcv&agrave; dịch vụ của trường</li><li>- Tham dự c&aacute;c cuộc họp của Ph&ograve;ng GD, tiếp đ&oacute;n, l&agrave;m việc với c&aacute;c cơ quan chức năng.</li><li>- Quản trị nh&acirc;n sự: Gi&aacute;m s&aacute;t/ đ&aacute;nh gi&aacute; hiệu quả c&ocirc;ng việc của nh&acirc;n vi&ecirc;n; lập kế hoạch &amp; bảo đảm nguồn nh&acirc;n lực lu&ocirc;n đầy đủ, đạt hiệu quả cao; đ&agrave;o tạo, ph&aacute;t triển nh&acirc;n vi&ecirc;n theo m&ocirc; h&igrave;nh chuẩn.</li><li>- Tổ chức v&agrave; quản l&yacute; c&aacute;c hoạt động h&agrave;ng ng&agrave;y của nh&agrave; trường, giải quyết mọi vấn đề ph&aacute;t sinh trong phạm vi hoạt động của trường - Chịu tr&aacute;ch nhiệm thực hiện c&aacute;c quy định, quy tr&igrave;nh của nh&agrave; trường v&agrave; thủ tục của Nh&agrave; trường, đảm bảo để tất cả trẻ em trong trường lu&ocirc;n được gi&aacute;m s&aacute;t v&agrave; tham gia mọi hoạt động trong một m&ocirc;i trường an to&agrave;n, theo chương tr&igrave;nh đ&atilde; được ph&ecirc; duyệt v&agrave; ph&ugrave; hợp với sứ mệnh của nh&agrave; trường</li><li>- Thể hiện xuất sắc vai tr&ograve; người điều h&agrave;nh v&agrave; người quản l&yacute;, chịu tr&aacute;ch nhiệm lập kế hoạch, ph&aacute;t triển v&agrave; gi&aacute;m s&aacute;t việc thực hiện chương tr&igrave;nh gi&aacute;o dục, c&aacute;c hoạt động ngoại kho&aacute;, quản l&yacute; hiệu quả v&agrave; to&agrave;n diện mọi nguồn lực được giao</li><li>- C&oacute; khả năng th&iacute;ch ứng với những thay đổi v&agrave; thực hiện c&aacute;c nhiệm vụ kh&aacute;c nếu được giao ph&oacute;.</li><li>- Ki&ecirc;m nhiệm gi&aacute;m đốc mảng chăm s&oacute;c kh&aacute;ch h&agrave;ng :Đại diện c&ocirc;ng ty chia sẻ trong c&aacute;c sự kiện d&agrave;nh cho phụ huynh.</li><li>-Tham gia v&agrave; thực hiện c&aacute;c training d&agrave;nh cho tư vấn</li><li>-Đại diện nh&agrave; trường lắng nghe v&agrave; giải quyết c&aacute;c mối quan hệ với phụ huynh</li></ul>', '<ul><li>- Tốt nghiệp đại học chuy&ecirc;n ng&agrave;nh kinh tế, quản trị kinh doanh v&agrave; c&aacute;c ng&agrave;nh nghề c&oacute; li&ecirc;n quan.</li><li>- C&oacute; kinh nghiệm &iacute;t nhất 5 năm trong lĩnh vực quản l&yacute; về mảng gi&aacute;o dục: trung t&acirc;m ngoại ngữ, mầm non,...</li></ul>', 1, 'Bình Thạnh, Hồ Chí Minh', 'Đại học', '5', 'Nhân viên/Chuyên viên', 'Chuyên viên đào tạo', 'Không yêu cầu', '18-30', 1, '2021-01-25 03:02:09', '2021-02-01 19:53:00'),
(98, 'Nhân Viên Hành Chính', 59, 23, 5, '2021-01-25 10:04:09', '2021-02-03', 1500, 'Toàn thời gian', '<ul><li>- Thực hiện c&aacute;c c&ocirc;ng t&aacute;c h&agrave;nh ch&iacute;nh</li><li>- Mua b&aacute;n, cấp ph&aacute;t, theo d&otilde;i qu&aacute; tr&igrave;nh sử dụng, quản l&yacute; t&agrave;i sản C&ocirc;ng ty bao gồm: &middot;</li><li>Trang thiết bị chuy&ecirc;n d&ugrave;ng, thiết bị dạy v&agrave; học,&hellip; &middot;</li><li>Trang thiết bị H&agrave;nh ch&iacute;nh: m&aacute;y t&iacute;nh, m&aacute;y fax, m&aacute;y in &hellip; &middot;</li><li>Trang thiết bị hạ tầng: quạt, đ&egrave;n, &hellip;</li><li>- Tổng hợp v&agrave; tr&igrave;nh k&yacute; danh s&aacute;ch sử dụng văn ph&ograve;ng phẩm của c&aacute;c Ph&ograve;ng ban/Bộ phận.</li><li>- Đặt mua đồ d&ugrave;ng cho trường (VD: đồ chơi, ghế tập ăn, quạt, thảm, ....), đồ d&ugrave;ng b&aacute;n tr&uacute;-vệ sinh (bột giặt, nước tẩy, giấy ...) , VPP mỗi th&aacute;ng, đồ d&ugrave;ng cho dự &aacute;n của c&aacute;c lớp trong th&aacute;ng (đồ thủ c&ocirc;ng, hoa quả, rau củ, dầu ăn, bột m&igrave;,.....),</li><li>- Quản l&yacute; v&agrave; cấp ph&aacute;t đồng phục, trang phục BHLĐ nh&acirc;n vi&ecirc;n theo đ&uacute;ng quy định C&ocirc;ng ty.</li><li>- Lưu trữ t&agrave;i liệu v&agrave; hồ sơ C&ocirc;ng ty.</li><li>- Lưu v&agrave; bảo quản hồ sơ, t&agrave;i liệu của ph&ograve;ng theo quy định.</li><li>- Đặt nước uống cho c&aacute;c ph&ograve;ng ban.</li><li>- Quản l&yacute; t&agrave;i sản C&ocirc;ng ty, kiểm k&ecirc; v&agrave; d&aacute;n m&atilde; t&agrave;i sản theo định kỳ 3 th&aacute;ng/1 lần. Theo d&otilde;i v&agrave; b&aacute;o c&aacute;o t&agrave;i sản khi c&oacute; y&ecirc;u cầu mua từ c&aacute;c ph&ograve;ng ban. Thanh l&yacute; c&aacute;c t&agrave;i sản hư hỏng theo đ&uacute;ng quy tr&igrave;nh. - Đảm bảo hệ thống đ&egrave;n, m&aacute;y lạnh lu&ocirc;n hoạt động để đ&aacute;p ứng y&ecirc;u cầu c&ocirc;ng việc của c&aacute;c ph&ograve;ng ban.</li><li>- Kiểm tra c&ocirc;ng t&aacute;c vệ sinh văn ph&ograve;ng đảm bảo m&ocirc;i trường l&agrave;m việc lu&ocirc;n sạch sẽ v&agrave; th&ocirc;ng tho&aacute;ng. 2 Thực hiện c&aacute;c nhiệm vụ kh&aacute;c</li><li>- Theo d&otilde;i v&agrave; b&aacute;o c&aacute;o t&agrave;i sản khi c&oacute; y&ecirc;u cầu mua từ c&aacute;c ph&ograve;ng ban. Lập b&aacute;o c&aacute;o định kỳ h&agrave;ng th&aacute;ng.</li><li>- B&aacute;o c&aacute;o c&aacute;c c&ocirc;ng việc được giao kh&aacute;c.</li><li>- Hỗ trợ, thực hiện việc tổ chức c&aacute;c sự kiện của C&ocirc;ng ty theo chỉ đạo của cấp quản l&yacute;.</li><li>- Thực hiện c&aacute;c c&ocirc;ng việc ph&aacute;t sinh kh&aacute;c theo sự ph&acirc;n c&ocirc;ng của cấp tr&ecirc;n.</li></ul>', '<ul><li>- Tr&igrave;nh độ học vấn chuy&ecirc;n m&ocirc;n</li><li>- Tốt nghiệp Cao đẳng trở l&ecirc;n, chuy&ecirc;n ng&agrave;nh H&agrave;nh ch&iacute;nh, Kinh tế, Luật hoặc c&aacute;c ng&agrave;nh kh&aacute;c c&oacute; li&ecirc;n quan Kỹ năng l&agrave;m việc</li><li>- Giao tiếp. - Ph&acirc;n t&iacute;ch, giải quyết vấn đề. - Đ&agrave;m ph&aacute;n v&agrave; thương lượng.</li><li>- Soạn thảo v&agrave; tr&igrave;nh b&agrave;y văn bản h&agrave;nh ch&iacute;nh.</li><li>- Quản l&yacute; chi ph&iacute; h&agrave;nh ch&iacute;nh.</li><li>- Chịu &aacute;p lực cao trong c&ocirc;ng việc.</li><li>- Kinh nghiệm - C&oacute; &iacute;t nhất 6 th&aacute;ng kinh nghiệm ở vị tr&iacute; tương đương. - - T&iacute;nh c&aacute;ch c&aacute; nh&acirc;n - Trung thực, cẩn thận, chu đ&aacute;o. - Tận tụy. - Th&acirc;n thiện.</li></ul>', 2, '12 Đường Nguyễn Hữu Thọ, Phước Kiển, Nhà Bè, Hồ Chí Minh', 'Cao đẳng', '1', 'Nhân viên/Chuyên viên', 'Nhân viên đào tạo', 'Không yêu cầu', '18-30', 1, '2021-01-25 03:04:09', '2021-02-01 19:51:21'),
(99, 'Kỹ Thuật Viên Vật Lý Trị Liệu', 60, 22, 5, '2021-01-25 10:22:56', '2021-02-03', 1000, 'Toàn thời gian', '<ul><li>- Thực hiện theo đ&uacute;ng ph&aacute;c đồ điều trị của b&aacute;c sĩ</li><li>- Niềm nở, vui vẻ thăm hỏi với kh&aacute;ch h&agrave;ng trong suốt qu&aacute; tr&igrave;nh điều trị</li><li>- Tư vấn th&ecirc;m cho kh&aacute;ch h&agrave;ng về c&aacute;c vấn đề bệnh l&yacute; li&ecirc;n quan cần thiết</li><li>- Thực hiện đ&uacute;ng v&agrave; đầy đủ quy tr&igrave;nh điều trị của ph&ograve;ng kh&aacute;m - Cập nhật đầy đủ c&aacute;c th&ocirc;ng tin điều trị của kh&aacute;ch h&agrave;ng tr&ecirc;n phần mềm quản l&yacute; ph&ograve;ng kh&aacute;m</li><li>- Hướng dẫn bệnh nh&acirc;n c&aacute;c phương ph&aacute;p tư thế tự tập luyện tại nh&agrave; sau c&aacute;c buổi điều trị</li><li>- Đưa đ&oacute;n bệnh nh&acirc;n l&ecirc;n xuống ph&ograve;ng điều trị</li><li>- Giải đ&aacute;p c&aacute;c thắc mắc của bệnh nh&acirc;n li&ecirc;n quan đến chuy&ecirc;n m&ocirc;n v&agrave; bệnh l&yacute; đang điều trị.</li><li>- Thực hiện một số việc sự vụ kh&aacute;c do Gi&aacute;m đốc chi nh&aacute;nh chỉ đạo - K&yacute; đầy đủ c&aacute;c phiếu y&ecirc;u cầu điều trị tr&ecirc;n phần mềm quản l&yacute;.</li><li>- Gọi điện chăm s&oacute;c kh&aacute;ch h&agrave;ng sau điều trị.</li><li>- Tắt mở c&aacute;c thiết bị điện của ph&ograve;ng đều trị đ&uacute;ng giờ, đ&uacute;ng quy định tr&aacute;nh l&atilde;ng ph&iacute;.</li></ul>', '<ul><li>- Tr&igrave;nh độ tối thiểu: Chứng chỉ nghể li&ecirc;n quan ng&agrave;nh vật l&yacute; trị liệu- Phục hồi chức năng.</li><li>- Chuy&ecirc;n ng&agrave;nh: Vật l&yacute; trị liệu - Phục hồi chức năng - Chứng chỉ: Ưu ti&ecirc;n c&oacute; chứng chỉ h&agrave;nh nghề</li><li>- Kinh nghiệm:=1 năm.</li><li>- Kiến thức: Linh hoạt ứng xử c&aacute;c t&igrave;nh huống ph&aacute;t sinh trong tiếp x&uacute;c, hướng dẫn người đến điều trị bệnh tận t&igrave;nh, chu đ&aacute;o.</li><li>- Kỹ năng: C&oacute; tố chất v&agrave; ngoại h&igrave;nh ph&ugrave; hợp, giao tiếp tốt, chuy&ecirc;n m&ocirc;n tốt.</li><li>- Ti&ecirc;u chuẩn kh&aacute;c: Trung thực, ham học hỏi.</li></ul>', 1, '22 Bùi Thị Xuân, Phường 2, Quận Tân Bình, Hồ Chí Minh', 'Cao đẳng', '1', 'Nhân viên/Chuyên viên', 'Nhân viên đào tạo', 'Không yêu cầu', '18-30', 1, '2021-01-25 03:22:56', '2021-02-01 19:48:56'),
(100, 'Kế Toán Nội Bộ Tổng Hợp', 61, 20, 7, '2021-01-25 12:42:46', '2021-01-30', 1000, 'Toàn thời gian', '<ul><li>&nbsp;- Theo d&otilde;i Thu- Chi nội bộ bao gồm lưu trữ chứng từ v&agrave; Hạch to&aacute;n v&agrave;o phần mềm Misa - Nhập &ndash;xuất h&agrave;ng h&oacute;a, xuất h&oacute;a đơn điện tử</li><li>- Kiểm so&aacute;t- b&aacute;o c&aacute;o c&ocirc;ng nợ kh&aacute;ch h&agrave;ng, nh&agrave; cung cấp</li><li>- Lưu trữ H&oacute;a đơn,chứng từ, giao dịch ng&acirc;n h&agrave;ng (sử dụng internetbanking) - Lập BCTC nội bộ h&agrave;ng th&aacute;ng- qu&yacute; theo y&ecirc;u cầu của cấp tr&ecirc;n - Biết ph&acirc;n t&iacute;ch số liệu, b&aacute;o c&aacute;o để tham mưu cho cấp tr&ecirc;n</li></ul>', '<ul><li>-Tốt nghiệp từ Cao đẳng trở l&ecirc;n c&aacute;c chuy&ecirc;n ng&agrave;nh li&ecirc;n quan tới T&agrave;i ch&iacute;nh, Kế to&aacute;n, Quản trị kinh doanh&hellip;</li><li>- Th&agrave;nh thạo tin học Văn Ph&ograve;ng, biết sử dụng Misa l&agrave; một lợi thế.</li><li>- Nhanh nhẹn, cẩn thận v&agrave; c&oacute; thể l&agrave;m việc độc lập.</li><li>- C&aacute;c khả năng ph&acirc;n t&iacute;ch số liệu v&agrave; tổng hợp b&aacute;o c&aacute;o</li><li>- Thời gian l&agrave;m việc: S&aacute;ng từ 8h-12h ; Chiều 1h30-5h30 từ thứ 2 đến s&aacute;ng thứ 7</li></ul>', 1, '123 Nguyễn Khoái, Hai Bà Trưng', 'Cao đẳng', '2', 'Nhân viên/Chuyên viên', 'Nhân viên đào tạo', 'Không yêu cầu', '18-30', 1, '2021-01-25 05:42:46', '2021-02-01 19:46:55'),
(101, 'Nhân Viên Tư Vấn Phần Mềm', 62, 24, 7, '2021-01-25 12:55:15', '2021-02-01', 1000, 'Toàn thời gian', '<ul><li>- Sử dụng Phần mềm gửi email v&agrave; phần mềm gửi tin nhắn của c&ocirc;ng ty để t&igrave;m kiếm kh&aacute;ch h&agrave;ng.</li><li>- Gọi điện thoại tư vấn cho kh&aacute;ch h&agrave;ng đ&atilde; Demo sản phẩm của c&ocirc;ng ty.</li><li>- Thương lượng, thỏa thuận, k&yacute; kết hợp đồng giữa c&ocirc;ng ty với kh&aacute;ch h&agrave;ng.</li><li>- Duy tr&igrave;, củng cố mối li&ecirc;n hệ với kh&aacute;ch h&agrave;ng, cập nhật th&ocirc;ng tin v&agrave; giữ li&ecirc;n lạc với kh&aacute;ch h&agrave;ng</li><li>- L&agrave;m việc trực tiếp với Quản l&yacute; kinh doanh.</li><li>- Thời gian l&agrave;m việc: 8h00-11h30; 13h30-17h00 (L&agrave;m việc 7 tiếng/1 ng&agrave;y) Từ thứ 2 đến hết s&aacute;ng thứ 7. Nghỉ chiều thứ 7 &ndash; chủ nhật v&agrave; c&aacute;c ng&agrave;y lễ theo quy định của nh&agrave; nước.</li></ul>', '<ul><li>- Kh&ocirc;ng y&ecirc;u cầu kinh nghiệm;</li><li>- Ưu ti&ecirc;n ứng vi&ecirc;n khối ng&agrave;nh kinh tế, c&ocirc;ng nghệ th&ocirc;ng tin;</li><li>- Kỹ năng l&agrave;m việc độc lập v&agrave; phối hợp với tập thể tốt; - Kỹ năng tr&igrave;nh b&agrave;y, thương lượng, thuyết phục kh&aacute;ch h&agrave;ng tốt;</li><li>- C&oacute; tinh thần cầu tiến, năng động, hỗ trợ đồng nghiệp;</li><li>- C&oacute; laptop c&aacute; nh&acirc;n</li></ul>', 1, '102 Trần Phú, Mộ Lao, Hà Đông, Hà Nội', 'Cao đẳng', 'Không yêu cầu', 'Nhân viên/Chuyên viên', 'Nhân viên đào tạo', 'Không yêu cầu', '18-30', 1, '2021-01-25 05:55:15', '2021-02-01 19:42:59'),
(102, 'Telesales Phần Mềm', 62, 24, 7, '2021-01-25 12:56:26', '2021-02-04', 1000, 'Toàn thời gian', '<ul><li>- Sử dụng Phần mềm gửi email v&agrave; phần mềm gửi tin nhắn của c&ocirc;ng ty để t&igrave;m kiếm kh&aacute;ch h&agrave;ng.</li><li>- Gọi điện thoại tư vấn cho kh&aacute;ch h&agrave;ng đ&atilde; Demo sản phẩm của c&ocirc;ng ty.</li><li>- Thương lượng, thỏa thuận, k&yacute; kết hợp đồng giữa c&ocirc;ng ty với kh&aacute;ch h&agrave;ng.</li><li>- Duy tr&igrave;, củng cố mối li&ecirc;n hệ với kh&aacute;ch h&agrave;ng, cập nhật th&ocirc;ng tin v&agrave; giữ li&ecirc;n lạc với kh&aacute;ch h&agrave;ng</li><li>- L&agrave;m việc trực tiếp với Quản l&yacute; kinh doanh.</li><li>- Thời gian l&agrave;m việc: 8h00-11h30; 13h30-17h00 (L&agrave;m việc 7 tiếng/1 ng&agrave;y) Từ thứ 2 đến hết s&aacute;ng thứ 7. Nghỉ chiều thứ 7 &ndash; chủ nhật v&agrave; c&aacute;c ng&agrave;y lễ theo quy định của nh&agrave; nước.</li></ul>', '<ul><li>- Kh&ocirc;ng y&ecirc;u cầu kinh nghiệm;</li><li>- Ưu ti&ecirc;n ứng vi&ecirc;n khối ng&agrave;nh kinh tế, c&ocirc;ng nghệ th&ocirc;ng tin;</li><li>- Kỹ năng l&agrave;m việc độc lập v&agrave; phối hợp với tập thể tốt;</li><li>- Kỹ năng tr&igrave;nh b&agrave;y, thương lượng, thuyết phục kh&aacute;ch h&agrave;ng tốt;</li><li>- C&oacute; tinh thần cầu tiến, năng động, hỗ trợ đồng nghiệp;</li><li>- C&oacute; laptop c&aacute; nh&acirc;n</li></ul>', 1, '102 Trần Phú, Mộ Lao, Hà Đông, Hà Nội', 'Cao đẳng', 'Không yêu cầu', 'Nhân viên/Chuyên viên', 'Nhân viên đào tạo', 'Không yêu cầu', '18-30', 1, '2021-01-25 05:56:26', '2021-02-01 19:43:44');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `CongTys`
--
ALTER TABLE `CongTys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kv` (`id_kv`),
  ADD KEY `id_nn` (`id_nn`);


--
-- Chỉ mục cho bảng `KhuVucs`
--
ALTER TABLE `KhuVucs`
  ADD PRIMARY KEY (`id_kv`);

--
-- Chỉ mục cho bảng `Luus`
--
ALTER TABLE `Luus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_vl`),
  ADD KEY `id_vl` (`id_vl`);

--
-- Chỉ mục cho bảng `NganhNghes`
--
ALTER TABLE `NganhNghes`
  ADD PRIMARY KEY (`id_nn`);

--
-- Chỉ mục cho bảng `NhaTuyenDungs`
--
ALTER TABLE `NhaTuyenDungs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_cty` (`id_cty`);

--
-- Chỉ mục cho bảng `UngTuyens`
--
ALTER TABLE `UngTuyens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_ntd`,`id_vl`),
  ADD KEY `id_vl` (`id_vl`),
  ADD KEY `id_ntd` (`id_ntd`);

--
-- Chỉ mục cho bảng `UngViens`
--
ALTER TABLE `UngViens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `ViecLams`
--
ALTER TABLE `ViecLams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nn` (`id_nn`),
  ADD KEY `id_cty` (`id_cty`),
  ADD KEY `id_kv` (`id_kv`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `KhuVucs`
--
ALTER TABLE `KhuVucs`
  MODIFY `id_kv` int(11) NOT NULL AUTO_INCREMENT COMMENT 'khóa chính', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `Luus`
--
ALTER TABLE `Luus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `NganhNghes`
--
ALTER TABLE `NganhNghes`
  MODIFY `id_nn` int(11) NOT NULL AUTO_INCREMENT COMMENT 'khóa chính', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `UngTuyens`
--
ALTER TABLE `UngTuyens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT cho bảng `ViecLams`
--
ALTER TABLE `ViecLams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=103;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `CongTys`
--
ALTER TABLE `CongTys`
  ADD CONSTRAINT `ctis_ibfk_1` FOREIGN KEY (`id_kv`) REFERENCES `KhuVucs` (`id_kv`),
  ADD CONSTRAINT `ctis_ibfk_2` FOREIGN KEY (`id_nn`) REFERENCES `NganhNghes` (`id_nn`);

--
-- Các ràng buộc cho bảng `Luus`
--
ALTER TABLE `Luus`
  ADD CONSTRAINT `luus_ibfk_1` FOREIGN KEY (`id_vl`) REFERENCES `ViecLams` (`id`),
  ADD CONSTRAINT `luus_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `NhaTuyenDungs`
--
ALTER TABLE `NhaTuyenDungs`
  ADD CONSTRAINT `nhatuyendungs_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `nhatuyendungs_ibfk_3` FOREIGN KEY (`id_cty`) REFERENCES `CongTys` (`id`);

--
-- Các ràng buộc cho bảng `UngTuyens`
--
ALTER TABLE `UngTuyens`
  ADD CONSTRAINT `UngTuyens_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `UngTuyens_ibfk_2` FOREIGN KEY (`id_vl`) REFERENCES `ViecLams` (`id`),
  ADD CONSTRAINT `UngTuyens_ibfk_3` FOREIGN KEY (`id_ntd`) REFERENCES `NhaTuyenDungs` (`id`);

--
-- Các ràng buộc cho bảng `UngViens`
--
ALTER TABLE `UngViens`
  ADD CONSTRAINT `UngViens_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `ViecLams`
--
ALTER TABLE `ViecLams`
  ADD CONSTRAINT `ViecLams_ibfk_1` FOREIGN KEY (`id_cty`) REFERENCES `CongTys` (`id`),
  ADD CONSTRAINT `ViecLams_ibfk_2` FOREIGN KEY (`id_nn`) REFERENCES `NganhNghes` (`id_nn`),
  ADD CONSTRAINT `ViecLams_ibfk_3` FOREIGN KEY (`id_kv`) REFERENCES `KhuVucs` (`id_kv`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
