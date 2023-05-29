-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 29, 2023 lúc 05:23 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `do_an`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Tên danh mục',
  `type` tinyint(3) DEFAULT 0 COMMENT 'Loại danh mục: 0 - Product, 1 - News',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'Tên file ảnh danh mục',
  `description` text DEFAULT NULL COMMENT 'Mô tả chi tiết cho danh mục',
  `status` tinyint(3) DEFAULT 0 COMMENT 'Trạng thái danh mục: 0 - Inactive, 1 - Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo danh mục',
  `updated_at` datetime DEFAULT NULL COMMENT 'Ngày cập nhật cuối'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `avatar`, `description`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Nike', 0, '', '', 1, '2023-05-29 00:09:26', NULL),
(6, 'Reebok', 0, '', '', 1, '2023-05-29 00:10:03', NULL),
(7, 'Adidas', 0, '', '', 1, '2023-05-29 00:10:09', NULL),
(10, 'Converse', 0, '', '', 1, '2023-05-29 00:37:09', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL COMMENT 'Id của danh mục mà tin tức thuộc về, là khóa ngoại liên kết với bảng categories',
  `name` varchar(255) NOT NULL COMMENT 'Tiêu đề tin tức',
  `summary` varchar(255) DEFAULT NULL COMMENT 'Mô tả ngắn cho tin tức',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'Tên file ảnh tin tức',
  `content` text DEFAULT NULL COMMENT 'Mô tả chi tiết cho sản phẩm',
  `status` tinyint(3) DEFAULT 0 COMMENT 'Trạng thái danh mục: 0 - Inactive, 1 - Active',
  `seo_title` varchar(255) DEFAULT NULL COMMENT 'Từ khóa seo cho title',
  `seo_description` varchar(255) DEFAULT NULL COMMENT 'Từ khóa seo cho phần mô tả',
  `seo_keywords` varchar(255) DEFAULT NULL COMMENT 'Các từ khóa seo',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
  `updated_at` datetime DEFAULT NULL COMMENT 'Ngày cập nhật cuối'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'Id của user trong trường hợp đã login và đặt hàng, là khóa ngoại liên kết với bảng users',
  `fullname` varchar(255) DEFAULT NULL COMMENT 'Tên khách hàng',
  `address` varchar(255) DEFAULT NULL COMMENT 'Địa chỉ khách hàng',
  `mobile` int(11) DEFAULT NULL COMMENT 'SĐT khách hàng',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email khách hàng',
  `note` text DEFAULT NULL COMMENT 'Ghi chú từ khách hàng',
  `price_total` int(11) DEFAULT NULL COMMENT 'Tổng giá trị đơn hàng',
  `payment_status` tinyint(2) DEFAULT NULL COMMENT 'Trạng thái đơn hàng: 0 - Chưa thành toán, 1 - Đã thành toán',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo đơn',
  `updated_at` datetime DEFAULT NULL COMMENT 'Ngày cập nhật cuối'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `address`, `mobile`, `email`, `note`, `price_total`, `payment_status`, `created_at`, `updated_at`) VALUES
(22, NULL, 'Nguyễn Bằng Vượng', 'Hoàng Mai, Hà Nội', 359102898, 'vuongn6800@gmail.com', 'Gọi trước khi ship', 7740000, 0, '2023-05-29 00:47:54', NULL),
(23, NULL, 'Linh Chi', 'Cầy Giấy, Hà Nội', 913090769, 'linhchi168201@gmail.com', 'Ship càng sớm càng tốt', 3940000, 0, '2023-05-29 00:49:12', NULL),
(24, NULL, 'Nguyen Ha Anh', '119 hoang mai', 359102898, 'vuongn12345@gmail.com', 'q', 5250000, 0, '2023-05-29 02:01:31', NULL),
(25, NULL, 'Nguyễn Tuấn Tùng', 'Phú Quốc', 65896584, 'tuantung@gmail.com', 'Ship nhanh', 4700000, 0, '2023-05-29 03:09:45', NULL),
(26, NULL, 'Nguyen bang vuong 1', '119 hoang mai', 359102898, 'vuongn6800@gmail.com', '8888', 3289000, 0, '2023-05-29 03:18:59', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL COMMENT 'Id của order tương ứng, là khóa ngoại liên kết với bảng orders',
  `product_id` int(11) NOT NULL,
  `product_name` varchar(150) DEFAULT NULL COMMENT 'Tên sp tại thời điểm đặt hàng',
  `product_price` int(11) DEFAULT NULL COMMENT 'Giá sản phẩm tương ứng tại thời điểm đặt hàng',
  `quantity` int(11) DEFAULT NULL COMMENT 'Số lượng sản phẩm tương ứng tại thời điểm đặt hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `quantity`) VALUES
(21, 22, 36, 'Nike Dunk Low SE Lottery Pack Malachite Green', 5490000, 1),
(22, 22, 34, 'Nike Blazer Mid Jumbo University Blue', 2250000, 1),
(23, 23, 54, 'Chuck Taylor All Star Low \'Peony Pink\'', 990000, 1),
(24, 23, 43, 'NMD R2 PK', 2950000, 1),
(25, 24, 52, 'One Star Ox', 1750000, 3),
(26, 25, 52, 'One Star Ox', 1750000, 1),
(27, 25, 43, 'NMD R2 PK', 2950000, 1),
(28, 26, 30, 'Nike Blazer Mid \'77 Vintage', 1499000, 1),
(29, 26, 31, 'React Element 87 Red Orbit', 1790000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL COMMENT 'Id của danh mục mà sản phẩm thuộc về, là khóa ngoại liên kết với bảng categories',
  `title` varchar(255) DEFAULT NULL COMMENT 'Tên sản phẩm',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'Tên file ảnh sản phẩm',
  `price` int(11) DEFAULT NULL COMMENT 'Giá sản phẩm',
  `amount` int(11) DEFAULT NULL COMMENT 'Số lượng sản phẩm trong kho',
  `summary` varchar(255) DEFAULT NULL COMMENT 'Mô tả ngắn cho sản phẩm',
  `content` text DEFAULT NULL COMMENT 'Mô tả chi tiết cho sản phẩm',
  `status` tinyint(3) DEFAULT 0 COMMENT 'Trạng thái danh mục: 0 - Inactive, 1 - Active',
  `seo_title` varchar(255) DEFAULT NULL COMMENT 'Từ khóa seo cho title',
  `seo_description` varchar(255) DEFAULT NULL COMMENT 'Từ khóa seo cho phần mô tả',
  `seo_keywords` varchar(255) DEFAULT NULL COMMENT 'Các từ khóa seo',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
  `updated_at` datetime DEFAULT NULL COMMENT 'Ngày cập nhật cuối'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `title`, `avatar`, `price`, `amount`, `summary`, `content`, `status`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
(30, 3, 'Nike Blazer Mid \'77 Vintage', '1685319338-product-blazer.jpg', 1499000, 50, '', '', 1, '', '', '', '2023-05-29 00:15:38', NULL),
(31, 3, 'React Element 87 Red Orbit', '1685319365-product-react.jpg', 1790000, 10, '', '', 1, '', '', '', '2023-05-29 00:16:05', NULL),
(32, 3, 'Jordan 1 Mid Banned 2020 ', '1685319491-product-jordan_one_mid.jpg', 4050000, 30, '', '', 1, '', '', '', '2023-05-29 00:18:11', NULL),
(33, 3, 'Air Jordan 1 Mid ‘Hyper Royal’ ', '1685319517-product-jordan_one_mid_air.jpg', 3900000, 10, '', '', 1, '', '', '', '2023-05-29 00:18:37', NULL),
(34, 3, 'Nike Blazer Mid Jumbo University Blue', '1685319565-product-nike_blazer_jumbo.jpg', 2250000, 10, '', '', 1, '', '', '', '2023-05-29 00:19:25', '2023-05-29 07:19:31'),
(35, 3, 'Nike Air Force 1 07 All White', '1685319629-product-air_force.jpg', 2349000, 10, '', '', 1, '', '', '', '2023-05-29 00:20:29', NULL),
(36, 3, 'Nike Dunk Low SE Lottery Pack Malachite Green', '1685319698-product-dunk_low_se.jpg', 5490000, 5, '', '', 1, '', '', '', '2023-05-29 00:21:38', NULL),
(37, 3, 'Nike Blazer Low \'77 Jumbo \'White Black\'', '1685319753-product-junbo.jpg', 2890000, 5, '', '', 1, '', '', '', '2023-05-29 00:22:33', NULL),
(38, 3, 'Nike Air Max 90 Terrascape', '1685319792-product-air_max.jpg', 3550000, 10, '', '', 1, '', '', '', '2023-05-29 00:23:12', NULL),
(39, 7, 'Stan Smith - Xám/Trắng', '1685319946-product-stan.jpg', 1750000, 5, '', '', 1, '', '', '', '2023-05-29 00:25:46', NULL),
(40, 7, 'Superstar Slipon W', '1685319973-product-super.jpg', 1850000, 10, '', '', 1, '', '', '', '2023-05-29 00:26:13', NULL),
(41, 7, 'Swift Run - Trắng/Trắng', '1685320000-product-swift.jpg', 1850000, 15, '', '', 1, '', '', '', '2023-05-29 00:26:40', NULL),
(42, 7, 'Pureboost Trainer ', '1685320037-product-pure.jpg', 2150000, 1, '', '', 1, '', '', '', '2023-05-29 00:27:17', NULL),
(43, 7, 'NMD R2 PK', '1685320061-product-nmd.jpg', 2950000, 2, '', '', 1, '', '', '', '2023-05-29 00:27:41', NULL),
(44, 6, 'Reebok Club C', '1685320316-product-clubc.jpg', 1290000, 5, '', '', 1, '', '', '', '2023-05-29 00:31:56', NULL),
(45, 6, 'Aztrek', '1685320363-product-az.jpg', 2350000, 3, '', '', 1, '', '', '', '2023-05-29 00:32:43', NULL),
(49, 10, 'One Star Ox', '1685320687-product-1.jpg', 1750000, 12, '', '', 1, '', '', '', '2023-05-29 00:38:07', NULL),
(51, 10, 'One Star Ox', '1685320737-product-3.jpg', 1750000, 10, '', '', 1, '', '', '', '2023-05-29 00:38:57', NULL),
(52, 10, 'One Star Ox', '1685320741-product-2.jpg', 1750000, 10, '', '', 1, '', '', '', '2023-05-29 00:39:01', NULL),
(53, 10, 'Chuck 70', '1685320780-product-4.jpg', 1590000, 5, '', '', 1, '', '', '', '2023-05-29 00:39:40', NULL),
(54, 10, 'Chuck Taylor All Star Low \'Peony Pink\'', '1685320813-product-6.jpg', 990000, 5, '', '', 1, '', '', '', '2023-05-29 00:40:13', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL COMMENT 'Tên đăng nhập',
  `password` varchar(255) DEFAULT NULL COMMENT 'Mật khẩu đăng nhập',
  `first_name` varchar(255) DEFAULT NULL COMMENT 'Fist name',
  `last_name` varchar(255) DEFAULT NULL COMMENT 'Last name',
  `phone` int(11) DEFAULT NULL COMMENT 'SĐT user',
  `address` varchar(255) DEFAULT NULL COMMENT 'Địa chỉ user',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email của user',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'File ảnh đại diện',
  `jobs` varchar(255) DEFAULT NULL COMMENT 'Nghề nghiệp',
  `last_login` datetime DEFAULT NULL COMMENT 'Lần đăng nhập gần đây nhất',
  `facebook` varchar(255) DEFAULT NULL COMMENT 'Link facebook',
  `status` tinyint(3) DEFAULT 0 COMMENT 'Trạng thái danh mục: 0 - Inactive, 1 - Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
  `updated_at` datetime DEFAULT NULL COMMENT 'Ngày cập nhật cuối'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `phone`, `address`, `email`, `avatar`, `jobs`, `last_login`, `facebook`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$Sai32K3OW6Vn42pUqI/R9eTJId3GPgAMpYKgRv95fQ88YCh0WzmxW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-19 08:12:00', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
