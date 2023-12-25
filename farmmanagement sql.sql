-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 01:04 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_highlight` varchar(255) NOT NULL,
  `blog_description` varchar(255) NOT NULL,
  `blog_image` varchar(255) NOT NULL,
  `blog_image1` varchar(255) NOT NULL,
  `blog_image2` varchar(255) NOT NULL,
  `blog_image3` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `user_id`, `blog_title`, `blog_highlight`, `blog_description`, `blog_image`, `blog_image1`, `blog_image2`, `blog_image3`, `date`) VALUES
(1, 1, 'Big farming Org', 'Transition To Agriculture Where We Put Back More Into The Environment Than Is Taken Out. Discover The Latest Trends And Innovations For A Sustainable Future.', 'Transition To Agriculture Where We Put Back More Into The Environment Than Is Taken Out. Discover The Latest Trends And Innovations For A Sustainable Future.Transition To Agriculture Where We Put Back More Into The Environment Than Is Taken Out. Discover ', '944481gozha-net-xDrxJCdedcI-unsplash.jpg', '944481timothy-eberly-XemjjFd_4qE-unsplash.jpg', '944481frances-gunn-QcBAZ7VREHQ-unsplash.jpg', '944481timothy-eberly-XemjjFd_4qE-unsplash.jpg', '2023-06-04 02:30:09'),
(2, 2, 'New Organic Program', 'Farming is the act or process of working the ground, planting seeds, and growing edible plants. You can also describe raising animals for milk or meat.', 'Farming is the act or process of working the ground, planting seeds, and growing edible plants. You can also describe raising animals for milk or meat.Farming is the act or process of working the ground, planting seeds, and growing edible plants. You can ', '563312gozha-net-xDrxJCdedcI-unsplash.jpg', '563312frances-gunn-QcBAZ7VREHQ-unsplash.jpg', '563312timothy-eberly-XemjjFd_4qE-unsplash.jpg', '563312david-holifield-uidpH617Fb8-unsplash.jpg', '2023-06-04 02:33:29'),
(5, 3, 'Advanced Farming System Applicable in Nepal', ' Essential Farm Tools for Modern Agricultural Practices', 'As a farm tools supplier, understanding the needs and challenges of modern agriculture is vital. By providing valuable insights on essential tools and equipment, you can position yourself as a trusted partner in farmers. Remember, informed farmers are emp', '133291markus-winkler-d7HpYPBAPQY-unsplash.jpg', '133291arno-senoner-xlgyyV89W_M-unsplash.jpg', '133291andy-li-CpsTAUPoScw-unsplash.jpg', '133291markus-winkler-d7HpYPBAPQY-unsplash.jpg', '2023-06-04 02:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_category` varchar(200) NOT NULL,
  `product_price` int(40) NOT NULL,
  `quantity` int(100) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`product_id`, `ip_address`, `product_title`, `product_category`, `product_price`, `quantity`, `product_image`) VALUES
(11, '::1', 'Pulsur', 'Bike', 180000, 7, '677679AdelieWPD_EN-US5175747404_UHD.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL,
  `category_for` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_title`, `category_for`) VALUES
(1, 'Vegetables', 'Farmer'),
(2, 'Fruits', 'Farmer'),
(3, 'Farm Machines', 'Supplier'),
(4, 'Fertilizers', 'Supplier'),
(5, 'Seed', 'Supplier'),
(6, 'Milk', 'Farmer'),
(7, 'Oil', 'Farmer'),
(8, 'Bike', 'Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `tole` varchar(100) NOT NULL,
  `appartment` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `amount_due` int(11) NOT NULL,
  `total_products` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `reply_id` int(100) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `blog_id` int(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complete_orders`
--

CREATE TABLE `complete_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `invoice_number` int(100) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `quantity` int(10) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` int(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone` int(10) NOT NULL,
  `contact_image` varchar(255) NOT NULL,
  `type` varchar(15) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farmer_products`
--

CREATE TABLE `farmer_products` (
  `product_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_after_price` int(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_highlight` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `product_title` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` int(50) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `user_id`, `owner_id`, `product_id`, `invoice_number`, `product_title`, `quantity`, `product_image`, `product_price`, `ip_address`, `status`, `date`) VALUES
(1, 1, 7, 3, 6, 1303934902, 'Gehu seed', 5, '247104pexels-pixabay-163882 (1).jpg', 710, '::1', 'complete', '2023-06-03 16:29:31'),
(2, 1, 7, 2, 7, 1303934902, 'Tomato', 4, '625764pexels-rauf-allahverdiyev-1367242.jpg', 360, '::1', 'complete', '2023-06-03 16:29:31'),
(3, 1, 7, 4, 8, 1303934902, 'Broccoli', 4, '245772annie-spratt-m1t-RJ1iCIU-unsplash.jpg', 576, '::1', 'complete', '2023-06-03 16:29:31'),
(4, 2, 1, 2, 7, 111796268, 'Tomato', 11, '625764pexels-rauf-allahverdiyev-1367242.jpg', 1100, '::1', 'pending', '2023-06-03 16:36:08'),
(5, 3, 5, 1, 2, 20393480, 'Apple', 4, '409272pexels-maria-lindsey-content-creator-1536365.jpg', 1056, '::1', 'complete', '2023-06-04 03:01:02'),
(6, 3, 5, 2, 7, 20393480, 'Tomato', 5, '625764pexels-rauf-allahverdiyev-1367242.jpg', 450, '::1', 'complete', '2023-06-04 03:01:02'),
(7, 4, 11, 2, 7, 60368528, 'Tomato', 1, '625764pexels-rauf-allahverdiyev-1367242.jpg', 100, '::1', 'pending', '2023-08-06 06:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `order_pending`
--

CREATE TABLE `order_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_pending`
--

INSERT INTO `order_pending` (`order_id`, `user_id`, `invoice_number`, `quantity`, `product_id`, `order_status`) VALUES
(1, 7, 1303934902, 3, 0, 'complete'),
(2, 1, 111796268, 1, 7, 'pending'),
(3, 5, 20393480, 2, 0, 'complete'),
(4, 11, 60368528, 1, 7, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `plan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_title` varchar(100) NOT NULL,
  `plan_price` int(40) NOT NULL,
  `plan_after_price` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `plan_category` varchar(100) NOT NULL,
  `plan_description` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`plan_id`, `user_id`, `plan_title`, `plan_price`, `plan_after_price`, `address`, `plan_category`, `plan_description`, `date`) VALUES
(1, 2, 'Daily Plan', 110, 100, 'Kathmandu', 'daily', 'a', '2023-06-04 03:08:17'),
(2, 2, 'Monthly', 2000, 1900, 'Kathmandu', 'monthly', 'a', '2023-06-04 03:09:30'),
(3, 4, 'Super Faida', 200, 190, 'Baitadi', 'weekly', 'a', '2023-06-04 03:12:28'),
(4, 4, 'Super Faida', 1500, 1400, 'Baitadi', 'double weekly', 'd', '2023-06-04 03:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `produ`
--

CREATE TABLE `produ` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produ`
--

INSERT INTO `produ` (`product_id`, `product_title`, `product_price`) VALUES
(1, 'djshd', 67),
(2, 'djshd', 67),
(3, 'djshd', 67),
(4, 'djshd', 67),
(5, 'djshd', 67),
(6, 'djshd', 67),
(7, 'djshd', 67),
(8, '.s323.', 43),
(9, '.d.', 344),
(10, '.dfmdf.', 343),
(11, '.eree.', 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `discount` int(10) NOT NULL,
  `product_after_price` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_highlight` varchar(255) NOT NULL,
  `product_descript` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `location` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `user_id`, `product_title`, `product_keywords`, `quantity`, `product_price`, `discount`, `product_after_price`, `product_category`, `product_description`, `product_highlight`, `product_descript`, `product_image`, `product_image1`, `product_image2`, `product_image3`, `date`, `location`, `type`, `status`) VALUES
(1, '1', 'Orange', 'fresh,orange,sweet,local', 100, '100', 10, '', 'Fruits', 'Orange is a round citrus fruit known for its vibrant orange color, juicy pulp, and sweet-tangy flavor. It belongs to the citrus family and is rich in vitamin C and other essential nutrients. Oranges are widely consumed fresh, as well as used in juices, de', 'Fresh orange of himalayas.', '', '289855pexels-erlian-zakia-2912621.jpg', '289855pexels-wolven-stein-10403084.jpg', '289855pexels-adel-krim-14486319.jpg', '289855pexels-quang-nguyen-vinh-2135677.jpg', '2023-06-03 09:23:19', 'Kathmandu', '', 'true'),
(2, '1', 'Apple', 'Fruit ,Apple, tree, Edible, Red, Green, Yellow ,Sweet, Tart, Juicy, Crunchy, Core, Seeds, Orchard, Harvest, Cider, Pie, Snack, Healthy, Vitamin C, Fiber', 50, '300', 12, '', 'Fruits', 'The exterior of an apple is smooth and often shiny, with a thin, edible skin that can range from vibrant red to pale green or yellow. The flesh inside is firm, juicy, and can vary in color from white to creamy yellow. At the core of the apple.\r\n', 'Apples are a type of fruit that grow on apple trees, scientifically known as Malus domestica. They come in various colors, including shades of red, green, and yellow. Apples are known for their crisp texture, juicy flesh, and a range of flavors that can b', '', '409272pexels-maria-lindsey-content-creator-1536365.jpg', '409272pexels-tom-swinnen-574919.jpg', '409272pexels-mareefe-672101.jpg', '409272pexels-suzy-hazelwood-1510392.jpg', '2023-06-01 09:28:51', 'Kathmandu', '', 'true'),
(3, '2', 'Banana', 'Fruit Banana tree Yellow Peel Edible Sweet Tropical Soft Long Curved Potassium Fiber Healthy Snack Smoothie Dessert Vitamin B6 Energy Bunch Plantain', 60, '120', 5, '', 'Fruits', '\r\nBananas are one of the most widely consumed fruits around the world. They come from the banana tree, scientifically known as Musa, and are known for their distinctive elongated shape and vibrant yellow color when ripe. Bananas have a soft and creamy tex', ' Bananas are one of the most widely consumed fruits around the world. They come from the banana tree, scientifically known as Musa, and are known for their distinctive elongated shape and vibrant yellow color .', '', '877636175168Bananas-on-a-Tree-SS-1773077507.jpg', '877636188391banana_banner.jpg', '877636395977Bananas-on-a-Tree-SS-1773077507.jpg', '87763674232811300169_l-scaled.webp', '2023-06-03 09:47:32', 'Kathmandu', 'normal', 'true'),
(4, '3', 'TAFE Tractor', 'TAFE  Tractor manufacturer Agricultural machinery Farm equipment Implements Farming Agriculture Rural Power Efficiency Performance Durability Versatility Engine Horsepower PTO  Transmission Four-wheel drive  Implements and attachments Crop cultivation', 0, '100000', 7, '', 'Farm Machines', 'TAFE (Tractors and Farm Equipment Limited) is a renowned tractor manufacturer known for its high-quality agricultural machinery and farm equipment. TAFE tractors are designed to meet the diverse needs of farmers and are widely used in the agricultural sec', '​New Holland has improved its popular T5 tractor range', '', '3409644234.bigstock-224148484.jpg', '3409644234.Diesel tractor.jpeg', '3409644234.images.jfif', '340964990585tractoe.jpg', '2023-06-03 11:54:10', 'Sindhupalchok', '', 'true'),
(5, '3', 'Fertilizer Sprayer', 'Fertilizer sprayer Agricultural equipment Crop nutrition Precision farming Crop protection Liquid fertilizers Crop spraying Nozzles Tank capacity Boom sprayers Knapsack sprayers Backpack sprayers Sprayer pump Application rate Herbicides Pesticides Adjusta', 0, '2000', 11, '', 'Fertilizers', 'A fertilizer sprayer is a specialized agricultural equipment used for the application of fertilizers to crops. It is designed to efficiently and accurately spray liquid fertilizers onto the fields, promoting crop nutrition and enhancing crop growth.', 'Fertilizer sprayers are often equipped with adjustable pressure settings, allowing farmers to control the spray intensity and application rate according to specific crop and soil requirements.', '', '803877674073A-bag-of-fertilizer-in-the-field-1.jpg', '803877674073Organic-Fertilizer-Materials.jpg', '803877674073pexels-antony-trivet-12925600-e1661301515478.jpg', '803877674073types-of-fertilizer.jpg', '2023-06-03 12:08:40', 'Sindhupalchok', '', 'true'),
(6, '3', 'Gehu seed', 'Seeds Germination Planting packets', 0, '150', 5, '', 'Seed', 'Seed companies, agricultural organizations, and researchers often engage in Seed Highlight efforts to create awareness and promote the use of specific seeds. This can involve conducting trials, demonstrating the performance and benefits of particular seed', 'Seed Highlight refers to the practice of emphasizing or showcasing specific seeds or seed varieties for their unique qualities, characteristics, or significance. This can be done through various means, including promotion, marketing, research, and educati', '', '247104pexels-pixabay-163882 (1).jpg', '247104pexels-raine-nectar-418682.jpg', '247104pexels-pixabay-533982.jpg', '247104pexels-david-bartus-435471.jpg', '2023-06-03 12:17:35', 'Sindhupalchok', '', 'true'),
(7, '2', 'Tomato', 'Vegetable Solanaceae family Red Juicy Pulp Seeds Sliced Fresh Salad Sauce Paste Canning Cooking Heirloom Cherry tomatoes Beefsteak tomatoes Determinate Indeterminate Lycopene', 400, '100', 10, '', 'Vegetables', 'Tomato is a popular fruit that is commonly classified and used as a vegetable in culinary contexts. It belongs to the Solanaceae family and is scientifically known as Solanum lycopersicum. Tomatoes are native to western South America and are now cultivate', 'Tomato is a popular fruit that is commonly classified and used as a vegetable in culinary contexts. It belongs to the Solanaceae family and is scientifically known as Solanum lycopersicum.', '', '625764pexels-rauf-allahverdiyev-1367242.jpg', '625764pexels-pixabay-161512.jpg', '625764pexels-markus-spiske-965740.jpg', '625764pexels-roman-odintsov-6342170.jpg', '2023-06-01 13:01:11', 'Kathmandu', 'huge', 'true'),
(8, '4', 'Broccoli', 'Vegetable Cruciferous Green Florets Stalk Nutrition Vitamins Minerals Fiber', 100, '160', 10, '', 'Vegetables', 'Broccoli is particularly valued for its health benefits. It is a good source of vitamin C, vitamin K, folate, and potassium. It also contains compounds known as glucosinolates, which have been linked to potential anticancer properties and other health ben', ' Broccoli is a popular green vegetable that belongs to the cruciferous family. It has a distinct appearance, with a tight cluster of small, green florets attached to a thick, edible stalk. Broccoli is known for its high nutritional value and is rich in vi', '', '245772annie-spratt-m1t-RJ1iCIU-unsplash.jpg', '245772hans-ripa-4cEmT3AsoVc-unsplash.jpg', '245772mockup-graphics-ZSEwydleOAc-unsplash.jpg', '245772mockup-graphics-l55IGtwI8mI-unsplash.jpg', '2023-06-03 12:41:30', 'Baitadi', 'normal', 'true'),
(9, '4', 'Carrots', 'Vegetable Root Orange Crunchy Sweet Beta-carotene Vitamin-A Fiber Antioxidants Nutritious Healthy Snack', 105, '60', 5, '', 'Vegetables', 'Carrots are known for their high content of beta-carotene, which the body converts into vitamin A. They are also a good source of dietary fiber, antioxidants, and other essential nutrients. Carrots can be enjoyed raw as a crunchy snack or added to a varie', ' Carrots are root vegetables that are widely recognized for their bright orange color and distinctive flavor. ', '', '370574david-holifield-uidpH617Fb8-unsplash.jpg', '370574nick-fewings-IZq1FV87qpM-unsplash.jpg', '370574david-holifield-uidpH617Fb8-unsplash.jpg', '370574k8-GHRT9j21m2M-unsplash.jpg', '2023-06-03 12:45:39', 'Baitadi', 'normal', 'true'),
(10, '4', 'Chili', 'Spice Pepper Capsaicin Heat Scoville scale Red Green Spiciness Flavor Hot', 200, '50', 3, '', 'Vegetables', 'Chili peppers are used in various cuisines around the world, including Mexican, Thai, Indian, and many others. They can be used fresh, dried, or in the form of chili powder to add heat and flavor to dishes such as salsas, curries, stir-fries, and marinade', 'Chili peppers are known for their fiery flavor and ability to add heat to various dishes. The compound responsible for their spiciness is capsaicin. ', '', '498824steve-johnson-L2xhGmPmMNs-unsplash.jpg', '498824daria-nepriakhina-iklSF5-kvIw-unsplash.jpg', '498824alexander-schimmeck-JA3FrZ5IEK8-unsplash.jpg', '498824mockup-graphics-nZUQgW0FVnc-unsplash.jpg', '2023-06-03 13:01:20', 'Baitadi', 'huge', 'true'),
(11, '3', 'Pulsur', 'cc, 300cc, bike', 0, '200000', 10, '', 'Bike', '300cc', 'Fresh', '', '677679AdelieWPD_EN-US5175747404_UHD.jpg', '677679ArkadiaPark_EN-US3604031201_UHD.jpg', '677679BalloonsTurkey_EN-US8385517143_UHD.jpg', '677679BathCircus_EN-US1560951776_UHD.jpg', '2023-11-26 11:50:11', 'Sindhupalchok', '', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category` varchar(40) NOT NULL,
  `service` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `plan_id`, `user_id`, `category`, `service`) VALUES
(1, 1, 2, 'daily', '1 Ltr. Pure Milk'),
(2, 1, 2, 'daily', 'Coriender Leaves'),
(3, 2, 2, 'monthly', '1 Ltr. Pure Milk'),
(4, 2, 2, 'monthly', '2 Eggs per day'),
(5, 2, 2, 'monthly', 'Sharp 6:00 AM delivery'),
(6, 2, 2, 'monthly', 'Online Payment'),
(7, 2, 2, 'monthly', 'Coriender Leaves'),
(8, 3, 4, 'weekly', '1 Ltr. Pure Milk'),
(9, 3, 4, 'weekly', 'Coriender Leaves'),
(10, 3, 4, 'weekly', '2 Eggs'),
(11, 3, 4, 'weekly', 'Sharp 6:00 AM delivery'),
(12, 4, 4, 'double weekly', '1 Ltr. Pure Milk'),
(13, 4, 4, 'double weekly', 'Online Payment');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `total_products`, `invoice_number`, `order_date`, `order_status`) VALUES
(1, 7, 8230, 3, '1303934902', '2023-06-03 16:29:31', 'complete'),
(2, 1, 990, 1, '111796268', '2023-06-03 16:36:08', 'pending'),
(3, 5, 6024, 2, '20393480', '2023-06-04 03:01:02', 'complete'),
(4, 11, 90, 1, '60368528', '2023-08-06 06:11:10', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_rating`
--

CREATE TABLE `user_rating` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `rating` varchar(20) NOT NULL,
  `review` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_rating`
--

INSERT INTO `user_rating` (`id`, `product_id`, `user_id`, `username`, `role`, `rating`, `review`, `image`, `status`, `date`) VALUES
(1, 7, 7, 'Jeevan shrestha', 'consumer', '4', 'tomatoes are highly regarded for their delightful taste, versatility, and nutritional value. Whether enjoyed fresh or cooked, they bring brightness and a burst of flavor to countless recipes.', '17970389pexels-markus-spiske-965740.jpg', 1, '2023-06-03 16:32:40'),
(2, 2, 5, 'Arjun Jhukal', 'consumer', '4', 'When it comes to fruit, few things can rival the crisp sweetness and natural beauty of an apple. Apples have been enjoyed for centuries, and their popularity continues to grow. In this review, we will delve into the delightful world of apples, exploring t', '46622806pexels-maria-lindsey-content-creator-1536365.jpg', 1, '2023-06-04 03:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` int(200) NOT NULL,
  `role` varchar(100) NOT NULL,
  `role_company_name` varchar(200) NOT NULL,
  `address` varchar(100) NOT NULL,
  `Area` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `terms` varchar(100) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `additional_experience` varchar(255) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `send_email` varchar(100) NOT NULL,
  `otp` int(20) NOT NULL,
  `verify_status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `email`, `phone`, `role`, `role_company_name`, `address`, `Area`, `password`, `user_image`, `terms`, `experience`, `additional_experience`, `user_ip`, `send_email`, `otp`, `verify_status`) VALUES
(1, 'Farm Mart', 'support@digitalfarm.com', 986253525, 'admin', 'Farm Mart', 'Kathmandu', 'Saraswotinagar', '$2y$12$nnw5H2llb3jZB.QclzgCTuwoZAXwSX0W/5MlIh3NMiR3foY5Svmuy', 'logos.png', 'true', '', '', '::1', 'true', 88605, 1),
(2, 'Jeevan Shrestha', 'sthaj1986@gmail.com', 986327367, 'farmer', 'Fm Agro', 'Kathmandu', 'Budhanilkantha', '$2y$12$s/f3T5.yySanqubA5Zy4Geh6YeftkheU2bXBmT3Vm5XBZs4/VS2Re', 'pexels-mark-stebnicki-9798988.jpg', 'true', '', '', '::1', 'true', 88605, 1),
(3, 'Prabeen Shrestha', 'raz@gmail.com', 983253232, 'supplier', 'Rajendra Suppliers', 'Sindhupalchok', 'abc', '$2y$12$OJY5j.LAMmwrRegCpnNF6e0z25SqZrW1u/s.83u8OuueOrKpc.rfK', 'pexels-pixabay-236705.jpg', 'true', '', '', '::1', 'true', 72801, 1),
(4, 'Harish Bhatta', 'harish@gmail.com', 982735259, 'farmer', 'Baitadi Farm', 'Baitadi', 'Sivanath', '$2y$12$2on76cKv/HUvbOCOMsYwiuPObHa.vfh5cRCsxOe16Okhr9HoXUxhu', '161018ChacoCulture_EN-US8179442556_UHD.jpg', 'true', '', '', '::1', 'true', 88605, 1),
(5, 'Arjun Jhukal', 'jhukal@gmail.com', 983273526, 'consumer', '', 'Kathmandu', 'Naya Banaswor', '$2y$12$jCm3QBvNog4IdGdha1UOR.hiIqUIg.s1I3nbXWMtw1A0Ry.ASrsE6', 'christin-hume-Hcfwew744z4-unsplash.jpg', 'true', '', '', '::1', 'true', 68341, 8),
(6, 'jskdask', 'sajilobazzar@gmail.com', 983746374, 'consumer', 'abc', 'Kathmandu', 'abc', '$2y$12$z6lpORJSgjgJUAKUuuoS/.uXRaKDKIEm0T19NDk3kzjTgIuXd94se', 'windows-C6T6vr1sQI0-unsplash.jpg', 'true', '', '', '::1', 'true', 88605, 1),
(7, 'Jeevan shrestha', 'shresthaj1986@gmail.com', 983734679, 'consumer', 'jeevan', 'Kathmandu', 'Chabahil', '$2y$12$HDWuaZcVvlMnvx4Y9hvRe.7Nrqe4WN0e2ldRett/QPAdEZxE6oWbS', 'stanley-dai-73OZYNjVoNI-unsplash.jpg', 'true', '', '', '::1', 'true', 88605, 1),
(11, 'Jdsjhd', 'jhukal9@gmail.com', 2147483647, 'farmer', 'dsdjsh', 'Kathmandu', 'kjhje', '$2y$12$NkHFUkR/8mqf0GkTwk5Q8.s9o5SVhN2CKZTAB04S9.SbSYYIGhJQ6', 'Untitled design.png', 'true', '', '', '::1', 'true', 88605, 1),
(12, 'd', 'sajilobazzarshs@gmail.com', 2147483647, 'consumer', 'W', 'Kathmandu', 'W', '$2y$12$MejU7ArilbNSnofqq/lNpenxqLZxMWu81kRG8.y0JGKk.c9MUOqCi', 'BallyvooneyCove_EN-US7329921498_UHD.jpg', 'true', '', '', '::1', 'true', 88605, 1),
(13, 'Prabhin', 'prab@gmail.com', 2147483647, 'consumer', 'a', 'Kathmandu', 'a', '$2y$12$hX17BSq/qi/huSMIuXh0S.E7PweCReY2N9Oh2cunporrT4HmS0H9a', 'BalloonsTurkey_EN-US8385517143_UHD.jpg', 'true', '', '', '::1', 'true', 88605, 0),
(14, 'Hem', 'sajilobazzargyt@gmail.com', 2147483647, 'consumer', 's', 'Kathmandu', 's', '$2y$12$s/ylhJz0gjHmQdOmSGlUe.TlvXw5yC70Uy0tduIKCOMXiuW/cvFlW', 'BalloonsTurkey_EN-US8385517143_UHD.jpg', 'true', '', '', '::1', 'true', 88605, 0);

-- --------------------------------------------------------

--
-- Table structure for table `view_orders`
--

CREATE TABLE `view_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `invoice_number` int(100) NOT NULL,
  `amount_due` int(11) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `total_products` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `farmer_products`
--
ALTER TABLE `farmer_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_pending`
--
ALTER TABLE `order_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `produ`
--
ALTER TABLE `produ`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_rating`
--
ALTER TABLE `user_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `view_orders`
--
ALTER TABLE `view_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmer_products`
--
ALTER TABLE `farmer_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produ`
--
ALTER TABLE `produ`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_rating`
--
ALTER TABLE `user_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `view_orders`
--
ALTER TABLE `view_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
