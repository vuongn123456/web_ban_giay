-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 12:04 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `do_an`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
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
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `avatar`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nike', 0, '1684482715-kisspng-thermometer-temperature-portable-network-graphics-measuring-png-icons-and-graphics-png-repo-free-p-5cb9e41ed33a89.9039044915556864308652.jpg', '', 1, '2023-05-19 07:51:55', NULL),
(2, 'Reebok', 0, '', '', 1, '2023-05-19 14:29:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
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
-- Table structure for table `orders`
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
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `address`, `mobile`, `email`, `note`, `price_total`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Nguyenbang vuong', '119 hoang mai', 359102898, 'vuongn6800@gmail.com', 'a', 64240000, 0, '2023-05-23 07:04:34', NULL),
(2, NULL, 'Nguyenbang vuong', '119 hoang mai', 359102898, 'vuongn6800@gmail.com', 'a', 64240000, 0, '2023-05-23 07:06:14', NULL),
(3, NULL, 'Nguyenbang vuong', 'Số nhà 118a , Ngõ 254 Minh Khai, Hà Nội', 359102898, 'vuongn6800@gmail.com', 'asdad', 100, 0, '2023-05-23 07:16:05', NULL),
(4, NULL, 'Nguyenbang vuong', 'Số nhà 118a , Ngõ 254 Minh Khai, Hà Nội', 359102898, 'vuongn6800@gmail.com', 'asdad', 100, 0, '2023-05-23 07:18:10', NULL),
(5, NULL, 'Nguyenbang vuong', 'Số nhà 118a , Ngõ 254 Minh Khai, Hà Nội', 359102898, 'vuongn6800@gmail.com', '333', 1000100, 0, '2023-05-23 13:56:58', NULL),
(6, NULL, 'Nguyenbang vuong', '119 hoang mai', 359102898, 'vuongn6800@gmail.com', '6', 55880000, 0, '2023-05-23 14:00:00', NULL),
(7, NULL, 'Nguyenbang vuong', '119 hoang mai', 359102898, 'vuongn6800@gmail.com', 'qqqq', 1000000, 0, '2023-05-23 14:54:20', NULL),
(8, NULL, 'Linh chi', 'bac giang', 359102898, 'vuongn6800@gmail.com', 'aaaaa', 2337000, 0, '2023-05-23 15:11:24', NULL),
(9, NULL, 'Nguyenbang vuong', '119 hoang mai', 359102898, 'vuongn9999@gmail.com', 'a', 2337000, 0, '2023-05-23 15:12:44', NULL),
(10, NULL, 'Nguyenbang vuong', '119 hoang mai', 359102898, 'vuongn9999@gmail.com', 'a', 2337000, 0, '2023-05-23 15:25:17', NULL),
(11, NULL, 'Nguyenbang vuong 1', '119 hoang mai1111', 359102898, 'vuongn123456@gmail.com', 'ok', 2337000, 0, '2023-05-23 16:12:57', NULL),
(12, NULL, 'Nguyenbang vuong2', '119 hoang mai2', 359102898, 'vuongn6800@gmail.com', 'aaaaa', 3337000, 0, '2023-05-23 16:40:16', NULL),
(13, NULL, 'Nguyenbang vuong2', '119 hoang mai2', 359102898, 'vuongn6800@gmail.com', 'aaaaa', 3337000, 0, '2023-05-23 16:42:16', NULL),
(14, NULL, 'Nguyenbang vuong', '119 hoang mai', 359102898, '', '', 27940000, 0, '2023-05-25 13:24:15', NULL),
(15, NULL, 'Nguyenbang vuong', '119 hoang mai', 359102898, 'vuongn9999@gmail.com', 'aaaa', 100000, 0, '2023-05-25 13:26:13', NULL),
(16, NULL, 'Nguyenbang vuong', '119 hoang mai', 359102898, 'linhchi168201@gmail.com', 'aaa', 1000000, 0, '2023-05-25 13:26:54', NULL),
(17, NULL, 'Nguyenbang vuong', '119 hoang mai', 359102898, 'vuongn6800@gmail.com', '`111111', 27940100, 0, '2023-05-25 14:02:19', NULL),
(18, NULL, 'Nguyenbang vuong', '119 hoang mai', 359102898, 'vuongn6800@gmail.com', 'aa', 27940000, 0, '2023-05-27 09:58:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
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
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `quantity`) VALUES
(2, 7, 3, 'Nike trvit', 100, 1),
(3, 10, 7, 'Reebook01', 1000000, 1),
(4, 10, 10, 'Reebook04', 1337000, 1),
(5, 11, 7, 'Reebook01', 1000000, 1),
(6, 11, 10, 'Reebook04', 1337000, 1),
(7, 12, 7, 'Reebook01', 1000000, 2),
(8, 12, 10, 'Reebook04', 1337000, 1),
(9, 13, 7, 'Reebook01', 1000000, 2),
(10, 13, 10, 'Reebook04', 1337000, 1),
(11, 14, 4, 'Nike 01', 27940000, 1),
(12, 15, 9, 'Reebook03', 100000, 1),
(13, 16, 7, 'Reebook01', 1000000, 1),
(14, 17, 3, 'Nike trvit', 100, 1),
(15, 17, 4, 'Nike 01', 27940000, 1),
(16, 18, 4, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
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
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `title`, `avatar`, `price`, `amount`, `summary`, `content`, `status`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
(3, 1, 'Nike trvit', '1684501177-product-fb7eda3c-5ac8-4d05-a18f-1c2c5e82e36e.jpg', 100, 0, '', '', 1, '', '', '', '2023-05-19 09:23:45', '2023-05-19 20:44:04'),
(4, 1, 'Nike 01', '1684501107-product-pngtree-cartoon-thermometer-icon-download-image_2292413.png', 27940000, 0, '', '', 1, '', '', '', '2023-05-19 09:25:24', '2023-05-19 20:06:34'),
(5, 1, 'Nike 02', '1684501116-product-pngtree-cartoon-thermometer-icon-download-image_2292413.jpg', 64240000, 0, '', '', 1, '', '', '', '2023-05-19 09:25:36', '2023-05-19 20:06:41'),
(6, 1, 'Nike 03', '1684501130-product-fb7eda3c-5ac8-4d05-a18f-1c2c5e82e36e.jpg', 13370000, 0, '', '', 1, '', '', '', '2023-05-19 09:25:48', '2023-05-19 19:58:50'),
(7, 2, 'Reebook01', '1684508784-product-fb7eda3c-5ac8-4d05-a18f-1c2c5e82e36e.jpg', 1000000, 0, '', '', 1, '', '', '', '2023-05-19 15:06:24', '2023-05-19 22:09:59'),
(8, 2, 'Reebook02', '1684508798-product-648cloudwithrain2_100737.png', 13370000, 0, '', '', 1, '', '', '', '2023-05-19 15:06:38', '2023-05-19 22:10:02'),
(9, 2, 'Reebook03', '1684508811-product-fb7eda3c-5ac8-4d05-a18f-1c2c5e82e36e.jpg', 100000, 0, '', '', 1, '', '', '', '2023-05-19 15:06:51', '2023-05-19 22:10:06'),
(10, 2, 'Reebook04', '1684508830-product-fb7eda3c-5ac8-4d05-a18f-1c2c5e82e36e.jpg', 1337000, 0, '', '', 1, '', '', '', '2023-05-19 15:07:10', '2023-05-19 22:10:10'),
(11, 1, 'Nike 05', '1684509768-product-fb7eda3c-5ac8-4d05-a18f-1c2c5e82e36e.jpg', 13370000, 0, '', '', 1, '', '', '', '2023-05-19 15:22:48', NULL),
(12, 1, 'Nike 06', '1684509783-product-fb7eda3c-5ac8-4d05-a18f-1c2c5e82e36e.jpg', 21560000, 0, '', '', 1, '', '', '', '2023-05-19 15:23:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `phone`, `address`, `email`, `avatar`, `jobs`, `last_login`, `facebook`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$Sai32K3OW6Vn42pUqI/R9eTJId3GPgAMpYKgRv95fQ88YCh0WzmxW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-05-19 08:12:00', NULL),
(2, 'admin1', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-05-20 04:50:05', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
