-- --------------------------------------------------------
-- Máy chủ:                      127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Phiên bản:           12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for my_store
CREATE DATABASE IF NOT EXISTS `my_store` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `my_store`;

-- Dumping structure for table my_store.account
CREATE TABLE IF NOT EXISTS `account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.account: ~11 rows (approximately)
INSERT INTO `account` (`id`, `username`, `fullname`, `password`, `role`) VALUES
	(1, 'longgg', 'long', '$2y$12$4DY/kLF90ORRgDB.d1GwRejsrs5pCx/qVQu51tj9P4T9hXPuQbTAi', 'user'),
	(2, 'longggg', 'htr', '$2y$12$2Sf6o/URKCJVOVVEKIL.q.Ff58xzKehtc4E/f.0IkfjJWouc6dYri', 'user'),
	(3, 'l', 'll', '$2y$12$j/3oK9HnltrjWhLcpviL4./ciwdBuoGBWZHzUV55ffw/u/smqxEpC', 'user'),
	(4, 'w', 'w', '$2y$12$b4ZAo/SroMlf6iy2DgDpAOIdDCEk/VLkioTDOAL98iFzry2PDy8lW', 'user'),
	(5, 'lonng', 'long', '$2y$12$NO7YHu5qfC83HrdyIXKjXe6V5oGE.xNiUfYHBxiuPzJwYbBurpky.', 'user'),
	(6, 'ww', 'long', '$2y$12$USiXV6exMcRaiRDkTkmoDOdXlXA7NBoSv4s5VoFjpTqvYqMctAQ/G', 'user'),
	(7, 'a', 'a', '$2y$12$99xytb6x2IoAtyJ16Jm9JupyoIGvBSiUiYEilIm.mhCtSpe908IoK', 'user'),
	(8, 'aaa', 'a', '$2y$12$uH6Re3G03ToYZjgjWcD1kOdlCFsmbEEbtkE70zSE/fzggDSoHI6Ee', 'user'),
	(9, 'lông', 'l', '$2y$12$XxTrvuzBO/9YigcoODvl/uWsKr6r0tIIzrejWNo1Ot/LzefLfhjge', 'user'),
	(10, 'acc', 'acc', '$2y$12$tQ3gHN1N5ZB5ghdLL6Q6IuCQqLUGl/Er484NfLeE14Nu1kSeAjKOq', 'admin'),
	(11, 'accc', 'long', '$2y$12$T74v8gn7PZ5i6uGva2has.w74X4upiWwaQEIrEYA0MHLKkycKMvBe', 'admin');

-- Dumping structure for table my_store.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.category: ~7 rows (approximately)
INSERT INTO `category` (`id`, `name`, `description`) VALUES
	(1, 'Phone', 'Danh mục các loại điện thoại'),
	(2, 'Laptop', 'Danh mục các loại laptop'),
	(3, 'Tablet', 'Danh mục các loại máy tính bảng'),
	(4, 'Accessory', 'Danh mục phụ kiện điện tử'),
	(5, 'Headphone', 'Danh mục các thiết bị tai nghe'),
	(8, 'Tivi', 'coi siêu đã sắt nét');

-- Dumping structure for table my_store.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.orders: ~4 rows (approximately)
INSERT INTO `orders` (`id`, `name`, `phone`, `address`, `created_at`) VALUES
	(1, 'longhf', '54236546', 'gbvrg ', '2025-03-10 03:05:36'),
	(2, 'éa', '54236546', 'wef', '2025-03-10 03:28:11'),
	(3, 'samsung', '54236546', 'fsfweg', '2025-03-10 03:29:21'),
	(4, 'fazsdcsv', '54236546', 'ưtf', '2025-03-10 03:52:09');

-- Dumping structure for table my_store.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.order_details: ~6 rows (approximately)
INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
	(1, 1, 7, 4, 34523.00),
	(2, 2, 9, 1, 1344.00),
	(3, 2, 7, 1, 34523.00),
	(4, 3, 7, 1, 34523.00),
	(5, 4, 7, 4, 34523.00),
	(6, 4, 9, 1, 1344.00);

-- Dumping structure for table my_store.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.product: ~19 rows (approximately)
INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `category_id`) VALUES
	(10, 'TV', 'sony', 3245.00, 'uploads/ẻg.PNG', 8),
	(11, 'tai nghe', 'êm tai', 35235.00, 'uploads/Casdfpture.PNG', 5),
	(12, 'Macbook', 'xịn xò', 2345354.00, 'uploads/Cưefrapture.PNG', 2),
	(14, 'xiaomi 14T', 'xịn', 130000.00, 'uploads/s.PNG', 1),
	(16, 'samsung', 'xịn', 13500.00, 'uploads/ư.PNG', 1),
	(17, 'airpod', 'xịn', 5000.00, 'uploads/ff.png', 5),
	(18, 'soundcore r50i nc', 'xịn', 520.00, 'uploads/Screenshot 2025-03-23 211625.png', 5),
	(20, 'tai nghe samsung', 'xịn', 1000.00, 'uploads/Screenshot 2025-03-23 211711.png', 5),
	(21, 'Củ sạc iPhone', '20W', 500000.00, 'uploads/f.PNG', 4),
	(22, 'Củ sạc Samsung', 'xịn', 500000.00, 'uploads/bdebnden.PNG', 4),
	(23, 'dây sạc Anker', 'xịn', 200000.00, 'uploads/dfbdfb (1).PNG', 4),
	(24, 'Sạc dự phòng Anker', 'xịn', 300000.00, 'uploads/dfbdfb (2).PNG', 4),
	(25, 'iPad', 'xịn', 2000000.00, 'uploads/bfdb.PNG', 3),
	(26, 'redmi', 'xịn', 453.00, 'uploads/ebgdfn.PNG', 3),
	(27, 'samsung', 'máy tính bảng', 356567.00, 'uploads/ebdfb.PNG', 3),
	(28, 'Acer', 'nitro 5', 23444.00, 'uploads/sfsdf.PNG', 2),
	(31, 'apple watch', 'đa chức năng', 165000.00, 'uploads/Screenshot 2025-03-21 230258.png', 4),
	(37, 'Samsung galaxi fit13', 'sang, xịn, bền', 3000000.00, 'uploads/Screenshot 2025-03-23 211918.png', 4),
	(45, 'Oppo', 'Reno7', 40000.00, 'aaa.png', 1),
	(46, 'Oppo', 'Reno7', 40000.00, NULL, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
