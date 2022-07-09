-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2022 at 09:37 AM
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
-- Database: `ldtshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `description`, `status`) VALUES
(1, 'Samsung', 'Samsung Electro-Mechanics, established in 1973 as a major electronics component manufacturer, headquartered in Suwon, Gyeonggi-do, Korea, listed on the Korean stock exchange', 1),
(2, 'Oppo', 'Oppo is a Chinese Android mobile phone manufacturer, based in Dongguan, Guangdong, a subsidiary of BBK Electronics.', 1),
(3, 'Nokia', 'Nokia Corporation is a multinational telecommunications corporation headquartered in Keilaniemi, Espoo, Finland.  As the world\'s largest mobile phone manufacturer focusing on fixed and wireless telecommunications products', 1),
(4, 'Iphone', 'iPhone is a famous American brand of Apple, with powerful configuration, stylish design, exclusive Retina display, ultra-sharp camera system, ... loved by many customers.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `username_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `username_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail`
--

CREATE TABLE `cart_detail` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_detail`
--

INSERT INTO `cart_detail` (`id`, `cart_id`, `product_id`, `quantity`) VALUES
(30, 6, 1, 1),
(31, 4, 15, 1),
(32, 4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cus_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `username`, `roles`, `password`, `cus_name`, `gender`, `address`, `telephone`, `email`, `date`, `status`) VALUES
(1, 'admin', '[\"ROLE_ADMIN\"]', '$2y$13$7ccT6skWCGi4wtq5rJv9s.1zqN3kLtO2cI4SfQyzabkITd7HLJqAq', 'Luong Gia Luan', 0, 'Can Tho', '0827777777', 'admin@gmail.com', '2002-04-07', 1),
(2, 'dam200280', '[\"ROLE_USER\"]', '$2y$13$7a1GG/1uTZGN8xJL48JtYeysvNVRctinEztD0xofaHWqeyPXPQRoi', 'Vo Thi Nha Dam', 1, 'Can Tho', '0828282828', 'damvtngcc200280@gmail.com', '2002-01-01', 1),
(3, 'thu200109', '[\"ROLE_USER\"]', '$2y$13$Qyh8GHskFeiRL00Sr0bkCuxKhNanBAIphKQqACmqNNNw5ejx5LJLO', 'Le Anh Thu', 1, 'Can Tho', '0810910920', 'thulagcc200109@gmail.com', '2002-01-01', 1),
(4, 'vana', '[\"ROLE_USER\"]', '$2y$13$Yeru6T6cYqQ2KSYDbFlZ3.0IEq3CqWSRraVYEnIQw4gDdyRPd5h8S', 'Nguyen Van A', 0, 'Can Tho', '0123456789', 'nguyenvana@gmail.com', '2000-02-01', 1),
(5, 'adung', '[\"ROLE_USER\"]', '$2y$13$yqBYLPA/2OBnSLh9SdpqzOMvqOFWwqbcW0sm1wKSd/0y2hS.2ah2y', 'Tran A Dung', 0, 'Can Tho', '0912345678', 'tranadung@gmail.com', '1999-07-09', 1),
(6, 'thic', '[\"ROLE_USER\"]', '$2y$13$7o8J.XKwLhK2DhaAmLPw7.idOws9otRIjJsEmomkgOVHmCH910Dy6', 'Nguyen Thi C', 1, 'Can Tho', '0912312332', 'nguyenthic@gmail.com', '1997-08-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220627162324', '2022-06-27 18:24:21', 864),
('DoctrineMigrations\\Version20220628103307', '2022-06-28 12:33:40', 5817),
('DoctrineMigrations\\Version20220628150354', '2022-06-28 17:04:51', 1995),
('DoctrineMigrations\\Version20220630021650', '2022-06-30 04:18:21', 315),
('DoctrineMigrations\\Version20220705162813', '2022-07-05 18:28:21', 436),
('DoctrineMigrations\\Version20220706032725', '2022-07-06 05:27:38', 751),
('DoctrineMigrations\\Version20220708013958', '2022-07-08 03:40:50', 243);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `username_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Packing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `username_id`, `order_date`, `delivery_date`, `address`, `payment`, `status`) VALUES
(20, 2, '2022-07-07', '2022-07-09', 'Can Tho', 628, 'Delivered'),
(21, 3, '2022-07-08', '2022-07-09', 'Can Tho', 1249, 'Delivered'),
(22, 4, '2022-07-08', '2022-07-09', 'Can Tho', 4497, 'Delivered'),
(23, 5, '2022-07-09', NULL, 'Can Tho', 4096, 'Packing'),
(24, 6, '2022-07-09', NULL, 'Can Tho', 1999, 'Packing');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int(11) NOT NULL,
  `order_id_id` int(11) NOT NULL,
  `product_id_id` int(11) NOT NULL,
  `pro_quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `order_id_id`, `product_id_id`, `pro_quantity`, `price`, `total`) VALUES
(18, 20, 5, 1, '399', '399'),
(19, 20, 7, 1, '229', '229'),
(20, 21, 13, 1, '1249', '1249'),
(21, 22, 1, 1, '2699', '2699'),
(22, 22, 11, 2, '899', '1798'),
(23, 23, 2, 2, '1599', '3198'),
(24, 23, 4, 1, '599', '599'),
(25, 23, 8, 1, '299', '299'),
(26, 24, 14, 1, '1999', '1999');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `date`, `quantity`, `image`, `brand_id`, `status`) VALUES
(1, 'Samsung Galaxy Z Fold3 5G 256GB - Black', '2699', 'The future unfolds, with the Galaxy Z Fold3 5G, and its array of outstanding new features, including S Pen support. Immerse yourself in the unfolded 7.6” Infinity Flex Display, with silky-smooth 120Hz scrolling, then fold the screen for a one-handed smartphone experience, and a compact size. Maximise your productivity with Multi-View, letting you view and use multiple apps at once.', '2022-07-02', 50, '6d631558f76784311ea528f57d0572cf.png', 1, 1),
(2, 'Samsung Galaxy Z Flip3 5G 128GB - Black', '1599', 'The Galaxy Z Flip3 5G brings superb features, in a sleek, ultra-pocketable and newly robust design. Never miss a detail on the silky-smooth', '2022-01-01', 50, '03b0b8a970f89a836616a26907893611.png', 1, 1),
(3, 'Samsung Galaxy A73 5G - Awesome Grey', '849', 'Excel with the Galaxy A73 5G. For viewing and image-capture excellence, the A73 5G delivers a powerful 6.7-inch 120Hz Super AMOLED+ Display and a 108MP Camera, so you can capture every detail - and with bigger pixels you can take bright pictures even at night. Also featuring awesome 5G speed, up to two-days\' battery life and IP67 water resistance, Galaxy A73 5G is the most advanced A series phone you can get', '2022-01-01', 50, 'c8cf2a008d25dd0cedaab15227985e74.png', 1, 1),
(4, 'OPPO A94 5G - Cosmo Blue', '599', 'Get ahead in speed with the A94 5G. The 48MP AI Quad Camera includes Ultra Night Video among its many features. Get the full picture with the 6.4” FHD+ Super AMOLED Screen. Processing will be a breeze with 8GB RAM and 128GB of internal storage, while 4300mAh Battery with 30W VOOC Flash Charge keeps you powered up. Access your favourite content even quicker via 5G', '2022-01-01', 50, '1174d5c9d463d72d58e053013b242018.png', 2, 1),
(5, 'OPPO A54 5G - Fluid Black', '399', 'Anticipate the future and experience the power of the OPPO A54 5G. View life on the 6.5” FHD+ 90Hz Hyper-colour screen, and capture life for yourself with the 48MP AI Quad camera. Equipped with 4GB RAM and 64GB of internal storage, the A54 powers on thanks to its 5000mAh large battery, while the dual SIM lets you take two phone numbers with you in this 5G Ready device', '2022-01-01', 50, '368509e9f357586b374b64a64da1daa7.png', 2, 1),
(6, 'Oppo A16s - Pearl Blue', '289', 'Turn heads and show off your unique style with the A16s’ slim, ergonomic design. The 6.5” screen is not only large, but also adapts to your lighting environment to keep your eyes comfortable. Stay online day and night with the 5000mAh long-lasting battery. Capture your picture-perfect moments with the AI Triple Camera.', '2022-01-01', 50, 'd2dea168a71b40c10f7bbd9efb83fd53.png', 2, 1),
(7, 'Nokia C21 Plus - Warm Grey', '229', 'Nokia C21 Plus keeps on giving, delivering Nokia’s signature durability in a sleek design with a dazzling 6.5” display that’s perfect for discovering a world of smartphone possibilities – streaming, swiping, scrolling and sharing from wherever you are. Supporting all this are two years of quarterly security updates as standard, while the huge battery life, lasting days from just one charge, lets you do more of what you love for longer.', '2022-01-01', 50, '222a1afde13726d3b136fa82eb68a0ea.png', 3, 1),
(8, 'Nokia G21 - Nordic Blue', '299', 'Enjoy more of what you love for longer, on a bigger, brighter screen. Nokia G21 combines a breath-taking 50 MP camera featuring AI imaging technology with a phenomenal three year warranty and multi-day battery-life for seamless performance', '2022-01-01', 50, 'daecc13149263b7ae6bf5a32bdbfadb2.png', 3, 1),
(9, 'Nokia C01 Plus - Blue', '159', 'Nokia C01 Plus is a phone to rely on. It boasts a great battery life and durable build so you can enjoy your phone for longer. Watch your favourite shows on the sharp HD+ display, and capture your precious memories, day and night, on the front and rear HDR cameras with flash.', '2022-01-01', 48, '0c28aad10ae9dc081316313fa39e936e.png', 3, 1),
(10, 'iPhone 13 Pro 128GB - Alpine Green', '1799', 'iPhone 13 Pro. The biggest Pro camera system upgrade ever. Super Retina XDR display with ProMotion for a faster, more responsive feel. Lightning-fast A15 Bionic chip. Superfast 5G. Durable design, and a huge leap in battery life.', '2022-01-01', 50, 'bda04310415c5af35c3730dcb8b7dd0a.png', 4, 1),
(11, 'iPhone 11 64GB - Black', '899', 'Shoot 4K video, beautiful portraits and sweeping landscapes with the all-new dual-camera system. Capture your best low-light photos with Night mode. See true-to-life colour in your photos, videos and games on the 6.1-inch Liquid Retina display. Experience unprecedented performance with A13 Bionic for gaming, augmented reality and photography. Do more and charge less with all-day battery life. And worry less with water resistance up to 2 metres for 30 minutes', '2022-01-01', 50, 'b4f73d95c0845693fef0ed13af5ba543.png', 4, 1),
(12, 'iPhone SE (Gen 3) 64GB - Midnight', '799', 'Lightning-fast A15 Bionic chip and fast 5G.1 Big-time battery life and a superstar camera. Plus, the toughest glass in a smartphone and a Home button with secure Touch ID', '2022-01-01', 50, '453cf4585ff18951bc552110e0e67e87.png', 4, 1),
(13, 'iPhone 13 mini 128GB - Pink', '1249', 'iPhone 13 mini. The most advanced dual-camera system ever on iPhone. Lightning-fast A15 Bionic chip. A leap in battery life. Durable design. Superfast 5G. And a brighter Super Retina XDR display', '2022-07-01', 50, '47a2829da280014f514c15cf2d164023.png', 4, 1),
(14, 'iPhone 13 Pro Max 128GB - Sierra Blue', '1999', 'iPhone 13 Pro Max. The biggest Pro camera system upgrade ever. Super Retina XDR display with ProMotion for a faster, more responsive feel. Lightning-fast A15 Bionic chip. Superfast 5G. Durable design, and the best battery life ever in an iPhone.', '2022-07-01', 50, '3247929f4cc075f6074628be99c97899.png', 4, 1),
(15, 'iPhone 13 128GB - Green', '1429', 'iPhone 13. The most advanced dual-camera system ever on iPhone. Lightning-fast A15 Bionic chip. A big leap in battery life. Durable design. Superfast 5G. And a brighter Super Retina XDR display', '2022-07-01', 50, 'f013e24be88074c2137484ff39f579a4.png', 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_BA388B7ED766068` (`username_id`);

--
-- Indexes for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_20821DCC1AD5CDBF` (`cart_id`),
  ADD KEY `IDX_20821DCC4584665A` (`product_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_81398E09F85E0677` (`username`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E52FFDEEED766068` (`username_id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8F964642FCDAEAAA` (`order_id_id`),
  ADD KEY `IDX_8F964642DE18E50B` (`product_id_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD44F5D008` (`brand_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart_detail`
--
ALTER TABLE `cart_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_BA388B7ED766068` FOREIGN KEY (`username_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD CONSTRAINT `FK_20821DCC1AD5CDBF` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `FK_20821DCC4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_E52FFDEEED766068` FOREIGN KEY (`username_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `FK_8F964642DE18E50B` FOREIGN KEY (`product_id_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_8F964642FCDAEAAA` FOREIGN KEY (`order_id_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD44F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
