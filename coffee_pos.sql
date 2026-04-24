-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2026 at 09:11 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffee_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint UNSIGNED DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `model`, `model_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, NULL, 'created', 'User', 1, NULL, '{\"id\": 1, \"name\": \"Admin\", \"role\": \"admin\", \"email\": \"admin@brancoffee.com\", \"created_at\": \"2026-04-23 02:21:40\", \"updated_at\": \"2026-04-23 02:21:40\"}', '127.0.0.1', 'Symfony', '2026-04-22 19:21:40'),
(2, NULL, 'created', 'User', 2, NULL, '{\"id\": 2, \"name\": \"Camden O\'Connell\", \"email\": \"sandra45@example.org\", \"created_at\": \"2026-04-23 02:27:26\", \"updated_at\": \"2026-04-23 02:27:26\", \"email_verified_at\": \"2026-04-23 02:27:25\"}', '127.0.0.1', 'Symfony', '2026-04-22 19:27:26'),
(3, NULL, 'created', 'User', 3, NULL, '{\"id\": 3, \"name\": \"Maximillia Greenholt Sr.\", \"email\": \"schinner.laurie@example.org\", \"created_at\": \"2026-04-23 02:27:26\", \"updated_at\": \"2026-04-23 02:27:26\", \"email_verified_at\": \"2026-04-23 02:27:26\"}', '127.0.0.1', 'Symfony', '2026-04-22 19:27:26'),
(4, NULL, 'created', 'User', 4, NULL, '{\"id\": 4, \"name\": \"Fletcher Johnston\", \"email\": \"ernestina89@example.com\", \"created_at\": \"2026-04-23 02:27:26\", \"updated_at\": \"2026-04-23 02:27:26\", \"email_verified_at\": \"2026-04-23 02:27:26\"}', '127.0.0.1', 'Symfony', '2026-04-22 19:27:26'),
(5, NULL, 'created', 'User', 5, NULL, '{\"id\": 5, \"name\": \"Dr. Devon Murray\", \"email\": \"cfeil@example.com\", \"created_at\": \"2026-04-23 02:27:26\", \"updated_at\": \"2026-04-23 02:27:26\", \"email_verified_at\": \"2026-04-23 02:27:26\"}', '127.0.0.1', 'Symfony', '2026-04-22 19:27:26'),
(6, NULL, 'created', 'User', 6, NULL, '{\"id\": 6, \"name\": \"Prof. Vernon Collier\", \"email\": \"tkiehn@example.net\", \"created_at\": \"2026-04-23 02:27:26\", \"updated_at\": \"2026-04-23 02:27:26\", \"email_verified_at\": \"2026-04-23 02:27:26\"}', '127.0.0.1', 'Symfony', '2026-04-22 19:27:26'),
(7, NULL, 'created', 'User', 7, NULL, '{\"id\": 7, \"name\": \"Kelsi Reinger\", \"email\": \"loyal98@example.org\", \"created_at\": \"2026-04-23 02:27:26\", \"updated_at\": \"2026-04-23 02:27:26\", \"email_verified_at\": \"2026-04-23 02:27:26\"}', '127.0.0.1', 'Symfony', '2026-04-22 19:27:26'),
(8, NULL, 'created', 'User', 8, NULL, '{\"id\": 8, \"name\": \"Holden Miller\", \"email\": \"qhammes@example.net\", \"created_at\": \"2026-04-23 02:27:26\", \"updated_at\": \"2026-04-23 02:27:26\", \"email_verified_at\": \"2026-04-23 02:27:26\"}', '127.0.0.1', 'Symfony', '2026-04-22 19:27:26'),
(9, NULL, 'created', 'User', 9, NULL, '{\"id\": 9, \"name\": \"Gretchen Gerhold\", \"email\": \"vthompson@example.com\", \"created_at\": \"2026-04-23 02:27:26\", \"updated_at\": \"2026-04-23 02:27:26\", \"email_verified_at\": \"2026-04-23 02:27:26\"}', '127.0.0.1', 'Symfony', '2026-04-22 19:27:26'),
(10, NULL, 'created', 'User', 10, NULL, '{\"id\": 10, \"name\": \"Prince Schuppe\", \"email\": \"leola88@example.com\", \"created_at\": \"2026-04-23 02:27:26\", \"updated_at\": \"2026-04-23 02:27:26\", \"email_verified_at\": \"2026-04-23 02:27:26\"}', '127.0.0.1', 'Symfony', '2026-04-22 19:27:26'),
(11, NULL, 'created', 'User', 11, NULL, '{\"id\": 11, \"name\": \"Curtis Hahn PhD\", \"email\": \"rrath@example.org\", \"created_at\": \"2026-04-23 02:27:26\", \"updated_at\": \"2026-04-23 02:27:26\", \"email_verified_at\": \"2026-04-23 02:27:26\"}', '127.0.0.1', 'Symfony', '2026-04-22 19:27:26'),
(12, NULL, 'created', 'Product', 1, NULL, '{\"id\": 1, \"sku\": \"SKU-9526-MT\", \"name\": \"Triple Cappuccino #7165\", \"image\": null, \"stock\": 31, \"is_active\": true, \"min_stock\": 7, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 10, \"sell_price\": 25600, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 8, \"description\": \"Est quas non consequuntur velit quia ab.\", \"purchase_price\": 12381}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(13, NULL, 'created', 'Product', 2, NULL, '{\"id\": 2, \"sku\": \"SKU-2506-PB\", \"name\": \"Seasonal Muffin #5807\", \"image\": null, \"stock\": 10, \"is_active\": false, \"min_stock\": 12, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 1, \"sell_price\": 29300, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 2, \"description\": \"Doloremque at corporis et asperiores ullam fugit placeat deleniti quaerat.\", \"purchase_price\": 14965}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(14, NULL, 'created', 'Product', 3, NULL, '{\"id\": 3, \"sku\": \"SKU-7568-ID\", \"name\": \"Original Salad #9440\", \"image\": null, \"stock\": 87, \"is_active\": true, \"min_stock\": 15, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 8, \"sell_price\": 22200, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 5, \"description\": \"In officia necessitatibus nulla et in accusamus voluptatum nesciunt est sit beatae odio minima et.\", \"purchase_price\": 11248}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(15, NULL, 'created', 'Product', 4, NULL, '{\"id\": 4, \"sku\": \"SKU-0577-WN\", \"name\": \"Double Toast #7393\", \"image\": null, \"stock\": 66, \"is_active\": true, \"min_stock\": 9, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 10, \"sell_price\": 34600, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 8, \"description\": \"Mollitia saepe omnis beatae recusandae numquam hic ut voluptas et non odit sint.\", \"purchase_price\": 21070}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(16, NULL, 'created', 'Product', 5, NULL, '{\"id\": 5, \"sku\": \"SKU-5606-GX\", \"name\": \"Double Matcha Latte #2041\", \"image\": null, \"stock\": 24, \"is_active\": false, \"min_stock\": 11, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 7, \"sell_price\": 32500, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 3, \"description\": \"Et iure aut ea expedita consectetur veritatis cum occaecati.\", \"purchase_price\": 15280}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(17, NULL, 'created', 'Product', 6, NULL, '{\"id\": 6, \"sku\": \"SKU-5003-YO\", \"name\": \"House Croissant #2956\", \"image\": null, \"stock\": 31, \"is_active\": true, \"min_stock\": 14, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 6, \"sell_price\": 26600, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 7, \"description\": \"Id autem id laudantium qui qui quod iusto.\", \"purchase_price\": 16716}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(18, NULL, 'created', 'Product', 7, NULL, '{\"id\": 7, \"sku\": \"SKU-4877-ZJ\", \"name\": \"Original Americano #2467\", \"image\": null, \"stock\": 88, \"is_active\": true, \"min_stock\": 9, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 2, \"sell_price\": 22400, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 1, \"description\": \"Velit quibusdam voluptatem consequatur ut est architecto ipsum iure.\", \"purchase_price\": 13258}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(19, NULL, 'created', 'Product', 8, NULL, '{\"id\": 8, \"sku\": \"SKU-6154-OF\", \"name\": \"House Chamomile Tea #4217\", \"image\": null, \"stock\": 46, \"is_active\": true, \"min_stock\": 8, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 10, \"sell_price\": 26200, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 6, \"description\": \"Quam consequatur omnis quod voluptatibus minima nobis dolor iste sunt voluptatem rerum.\", \"purchase_price\": 17484}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(20, NULL, 'created', 'Product', 9, NULL, '{\"id\": 9, \"sku\": \"SKU-2700-ZG\", \"name\": \"Triple Waffle #1760\", \"image\": null, \"stock\": 18, \"is_active\": true, \"min_stock\": 3, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 7, \"sell_price\": 18000, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 3, \"description\": \"Sed voluptatem ea dolorem ut dignissimos nihil nulla optio quis facere accusantium voluptas.\", \"purchase_price\": 10650}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(21, NULL, 'created', 'Product', 10, NULL, '{\"id\": 10, \"sku\": \"SKU-4319-QA\", \"name\": \"Original Toast #2173\", \"image\": null, \"stock\": 30, \"is_active\": true, \"min_stock\": 8, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 2, \"sell_price\": 35500, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 6, \"description\": \"Omnis magni voluptas illo omnis odit aliquid.\", \"purchase_price\": 24830}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(22, NULL, 'created', 'Product', 11, NULL, '{\"id\": 11, \"sku\": \"SKU-7308-ZN\", \"name\": \"Signature Americano #1851\", \"image\": null, \"stock\": 6, \"is_active\": true, \"min_stock\": 3, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 9, \"sell_price\": 18100, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 4, \"description\": \"Quibusdam atque voluptatibus rerum laborum ut quod.\", \"purchase_price\": 10654}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(23, NULL, 'created', 'Product', 12, NULL, '{\"id\": 12, \"sku\": \"SKU-3268-GM\", \"name\": \"Original Sandwich #4794\", \"image\": null, \"stock\": 0, \"is_active\": true, \"min_stock\": 10, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 5, \"sell_price\": 23700, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 1, \"description\": \"In a est ipsum ad itaque qui vel fugit et ea veniam.\", \"purchase_price\": 12131}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(24, NULL, 'created', 'Product', 13, NULL, '{\"id\": 13, \"sku\": \"SKU-7512-CX\", \"name\": \"Classic Cold Brew #8564\", \"image\": null, \"stock\": 97, \"is_active\": true, \"min_stock\": 3, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 7, \"sell_price\": 41200, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 6, \"description\": \"Rem dolor sequi ut iure minima voluptates itaque enim dolores commodi perspiciatis fuga quos.\", \"purchase_price\": 20892}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(25, NULL, 'created', 'Product', 14, NULL, '{\"id\": 14, \"sku\": \"SKU-4565-PL\", \"name\": \"Triple Americano #9809\", \"image\": null, \"stock\": 15, \"is_active\": true, \"min_stock\": 3, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 1, \"sell_price\": 16800, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 6, \"description\": \"Eius dolorum eos labore non sunt quia voluptates nisi voluptas et dolorum.\", \"purchase_price\": 11003}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(26, NULL, 'created', 'Product', 15, NULL, '{\"id\": 15, \"sku\": \"SKU-5170-ZT\", \"name\": \"Iced Cheesecake #5492\", \"image\": null, \"stock\": 85, \"is_active\": true, \"min_stock\": 15, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 10, \"sell_price\": 11100, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 2, \"description\": \"Sapiente voluptatem recusandae ducimus voluptate quia eveniet et nostrum.\", \"purchase_price\": 7849}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(27, NULL, 'created', 'Product', 16, NULL, '{\"id\": 16, \"sku\": \"SKU-5150-BG\", \"name\": \"Special Salad #7265\", \"image\": null, \"stock\": 29, \"is_active\": true, \"min_stock\": 3, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 3, \"sell_price\": 31200, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 6, \"description\": \"Quam velit tempora quod consequatur non et iure.\", \"purchase_price\": 14511}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(28, NULL, 'created', 'Product', 17, NULL, '{\"id\": 17, \"sku\": \"SKU-2502-JN\", \"name\": \"Limited Espresso #1273\", \"image\": null, \"stock\": 59, \"is_active\": true, \"min_stock\": 12, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 9, \"sell_price\": 19600, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 1, \"description\": \"Aut repellendus ut aliquam sint ut tenetur voluptas laudantium est.\", \"purchase_price\": 9715}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(29, NULL, 'created', 'Product', 18, NULL, '{\"id\": 18, \"sku\": \"SKU-4918-TY\", \"name\": \"Seasonal Chamomile Tea #4790\", \"image\": null, \"stock\": 91, \"is_active\": true, \"min_stock\": 11, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 10, \"sell_price\": 29600, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 6, \"description\": \"Illo excepturi consequatur quasi dolor sit aut sit ex nisi quia.\", \"purchase_price\": 14793}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(30, NULL, 'created', 'Product', 19, NULL, '{\"id\": 19, \"sku\": \"SKU-4896-OX\", \"name\": \"Hot Cheesecake #8401\", \"image\": null, \"stock\": 5, \"is_active\": true, \"min_stock\": 12, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 7, \"sell_price\": 45200, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 5, \"description\": \"Vel nihil exercitationem dolore voluptatem tempora culpa.\", \"purchase_price\": 23689}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(31, NULL, 'created', 'Product', 20, NULL, '{\"id\": 20, \"sku\": \"SKU-0373-FM\", \"name\": \"Iced Waffle #3835\", \"image\": null, \"stock\": 6, \"is_active\": true, \"min_stock\": 11, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 1, \"sell_price\": 16800, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 2, \"description\": \"Non libero ut illo aliquid et ea omnis.\", \"purchase_price\": 10583}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(32, NULL, 'created', 'Product', 21, NULL, '{\"id\": 21, \"sku\": \"SKU-6626-II\", \"name\": \"Double Croissant #6461\", \"image\": null, \"stock\": 9, \"is_active\": true, \"min_stock\": 12, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 2, \"sell_price\": 24700, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 7, \"description\": \"Quo ut laudantium dolorem minus rem fugiat minima hic labore laudantium quam.\", \"purchase_price\": 16454}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(33, NULL, 'created', 'Product', 22, NULL, '{\"id\": 22, \"sku\": \"SKU-4945-JX\", \"name\": \"Double Cappuccino #7038\", \"image\": null, \"stock\": 91, \"is_active\": true, \"min_stock\": 5, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 5, \"sell_price\": 17200, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 7, \"description\": \"Impedit voluptatum sed voluptatem aspernatur reiciendis dolorem rerum natus voluptatem sit debitis natus et.\", \"purchase_price\": 8394}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(34, NULL, 'created', 'Product', 23, NULL, '{\"id\": 23, \"sku\": \"SKU-8010-GX\", \"name\": \"Iced Chamomile Tea #3729\", \"image\": null, \"stock\": 70, \"is_active\": true, \"min_stock\": 4, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 10, \"sell_price\": 24000, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 8, \"description\": \"Repellendus voluptatem natus numquam illum molestias voluptatem laborum eum.\", \"purchase_price\": 16109}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(35, NULL, 'created', 'Product', 24, NULL, '{\"id\": 24, \"sku\": \"SKU-8656-HZ\", \"name\": \"Double Espresso #4245\", \"image\": null, \"stock\": 32, \"is_active\": true, \"min_stock\": 10, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 10, \"sell_price\": 24800, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 1, \"description\": \"Voluptate vitae vel aut unde quidem porro voluptas enim.\", \"purchase_price\": 12410}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(36, NULL, 'created', 'Product', 25, NULL, '{\"id\": 25, \"sku\": \"SKU-9509-LZ\", \"name\": \"Signature Earl Grey #5344\", \"image\": null, \"stock\": 41, \"is_active\": true, \"min_stock\": 3, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 9, \"sell_price\": 24300, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 1, \"description\": \"Esse fugit quia non occaecati aut tenetur officiis facilis debitis.\", \"purchase_price\": 14732}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(37, NULL, 'created', 'Product', 26, NULL, '{\"id\": 26, \"sku\": \"SKU-5616-ZM\", \"name\": \"Original Salad #9070\", \"image\": null, \"stock\": 17, \"is_active\": true, \"min_stock\": 3, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 7, \"sell_price\": 18300, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 1, \"description\": \"Rerum numquam quis aperiam quia numquam rem dolores minima deleniti.\", \"purchase_price\": 9885}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(38, NULL, 'created', 'Product', 27, NULL, '{\"id\": 27, \"sku\": \"SKU-7255-SY\", \"name\": \"House Latte #3408\", \"image\": null, \"stock\": 22, \"is_active\": true, \"min_stock\": 7, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 5, \"sell_price\": 36500, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 3, \"description\": \"Sed mollitia natus quo aut atque nostrum et dolorem voluptatum.\", \"purchase_price\": 17443}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(39, NULL, 'created', 'Product', 28, NULL, '{\"id\": 28, \"sku\": \"SKU-3200-HU\", \"name\": \"Original Toast #6936\", \"image\": null, \"stock\": 52, \"is_active\": true, \"min_stock\": 6, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 2, \"sell_price\": 17600, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 6, \"description\": \"Quos adipisci voluptatibus ducimus voluptatem est omnis soluta fugiat ducimus dolore.\", \"purchase_price\": 9808}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(40, NULL, 'created', 'Product', 29, NULL, '{\"id\": 29, \"sku\": \"SKU-4717-YV\", \"name\": \"Original Muffin #2783\", \"image\": null, \"stock\": 80, \"is_active\": true, \"min_stock\": 11, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 7, \"sell_price\": 37800, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 1, \"description\": \"Eligendi hic cupiditate labore sint consequatur dolorem.\", \"purchase_price\": 20239}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(41, NULL, 'created', 'Product', 30, NULL, '{\"id\": 30, \"sku\": \"SKU-1929-BY\", \"name\": \"Limited Salad #2857\", \"image\": null, \"stock\": 83, \"is_active\": true, \"min_stock\": 13, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 10, \"sell_price\": 37600, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 8, \"description\": \"Illum tempore voluptates mollitia vero accusamus et harum.\", \"purchase_price\": 22930}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(42, NULL, 'created', 'Product', 31, NULL, '{\"id\": 31, \"sku\": \"SKU-2961-SU\", \"name\": \"Iced Macchiato #5564\", \"image\": null, \"stock\": 30, \"is_active\": true, \"min_stock\": 10, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 8, \"sell_price\": 15000, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 1, \"description\": \"Pariatur consectetur ut velit rerum iste sapiente dolore nihil aperiam deserunt a reprehenderit voluptates.\", \"purchase_price\": 8774}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(43, NULL, 'created', 'Product', 32, NULL, '{\"id\": 32, \"sku\": \"SKU-5283-EV\", \"name\": \"Original Frappe #7881\", \"image\": null, \"stock\": 47, \"is_active\": true, \"min_stock\": 4, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 8, \"sell_price\": 27100, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 2, \"description\": \"Nobis delectus similique ex id dolorum vero officia quo labore.\", \"purchase_price\": 15072}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(44, NULL, 'created', 'Product', 33, NULL, '{\"id\": 33, \"sku\": \"SKU-9534-EG\", \"name\": \"House Cold Brew #5624\", \"image\": null, \"stock\": 54, \"is_active\": true, \"min_stock\": 10, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 4, \"sell_price\": 30400, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 2, \"description\": \"Nobis nobis tempore dolorem fugit eos accusamus doloremque veritatis aliquam veniam esse molestiae sit.\", \"purchase_price\": 16783}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(45, NULL, 'created', 'Product', 34, NULL, '{\"id\": 34, \"sku\": \"SKU-4904-UT\", \"name\": \"Special Earl Grey #6898\", \"image\": null, \"stock\": 66, \"is_active\": true, \"min_stock\": 5, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 10, \"sell_price\": 42800, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 2, \"description\": \"Sunt aut eos dolorem veniam vero in voluptatum ab.\", \"purchase_price\": 19884}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(46, NULL, 'created', 'Product', 35, NULL, '{\"id\": 35, \"sku\": \"SKU-8681-MT\", \"name\": \"Premium Espresso #9813\", \"image\": null, \"stock\": 97, \"is_active\": true, \"min_stock\": 8, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 8, \"sell_price\": 15600, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 8, \"description\": \"Dolorem veniam sint qui fuga reiciendis qui ipsam corporis aperiam sed est sunt consequatur.\", \"purchase_price\": 8520}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(47, NULL, 'created', 'Product', 36, NULL, '{\"id\": 36, \"sku\": \"SKU-8467-KZ\", \"name\": \"Premium Croissant #9329\", \"image\": null, \"stock\": 46, \"is_active\": true, \"min_stock\": 6, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 6, \"sell_price\": 11800, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 8, \"description\": \"Omnis impedit sequi provident dignissimos libero non aut possimus autem.\", \"purchase_price\": 7502}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(48, NULL, 'created', 'Product', 37, NULL, '{\"id\": 37, \"sku\": \"SKU-8443-WV\", \"name\": \"Classic Waffle #9229\", \"image\": null, \"stock\": 6, \"is_active\": true, \"min_stock\": 3, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 3, \"sell_price\": 17800, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 8, \"description\": \"Quos voluptatem deserunt adipisci esse sit mollitia et eius quaerat voluptatibus voluptatum assumenda impedit.\", \"purchase_price\": 10818}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(49, NULL, 'created', 'Product', 38, NULL, '{\"id\": 38, \"sku\": \"SKU-7044-CJ\", \"name\": \"Special Latte #6150\", \"image\": null, \"stock\": 72, \"is_active\": true, \"min_stock\": 12, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 10, \"sell_price\": 10900, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 8, \"description\": \"Et eum eaque omnis incidunt fugiat similique et et et.\", \"purchase_price\": 6392}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(50, NULL, 'created', 'Product', 39, NULL, '{\"id\": 39, \"sku\": \"SKU-3802-YP\", \"name\": \"Hot Waffle #6040\", \"image\": null, \"stock\": 6, \"is_active\": true, \"min_stock\": 15, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 10, \"sell_price\": 19300, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 7, \"description\": \"Amet reiciendis odit temporibus sed sint adipisci sit.\", \"purchase_price\": 12368}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(51, NULL, 'created', 'Product', 40, NULL, '{\"id\": 40, \"sku\": \"SKU-0796-XR\", \"name\": \"Signature Salad #354\", \"image\": null, \"stock\": 26, \"is_active\": false, \"min_stock\": 5, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 1, \"sell_price\": 22200, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 3, \"description\": \"Esse est aut cupiditate necessitatibus voluptatem autem suscipit facere ullam.\", \"purchase_price\": 10120}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(52, NULL, 'created', 'Product', 41, NULL, '{\"id\": 41, \"sku\": \"SKU-7671-JJ\", \"name\": \"Iced Matcha Latte #3969\", \"image\": null, \"stock\": 90, \"is_active\": true, \"min_stock\": 15, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 5, \"sell_price\": 35400, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 8, \"description\": \"Rerum dolorem nemo id suscipit quo adipisci ut molestiae commodi necessitatibus consequatur repellat beatae.\", \"purchase_price\": 23153}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(53, NULL, 'created', 'Product', 42, NULL, '{\"id\": 42, \"sku\": \"SKU-3168-OP\", \"name\": \"Seasonal Pancake #3073\", \"image\": null, \"stock\": 67, \"is_active\": false, \"min_stock\": 8, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 1, \"sell_price\": 9400, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 7, \"description\": \"Sequi aut dolorum deleniti officiis quos incidunt quia recusandae.\", \"purchase_price\": 5475}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(54, NULL, 'created', 'Product', 43, NULL, '{\"id\": 43, \"sku\": \"SKU-3229-CR\", \"name\": \"Original Sandwich #7299\", \"image\": null, \"stock\": 33, \"is_active\": true, \"min_stock\": 3, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 2, \"sell_price\": 51700, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 2, \"description\": \"Et commodi est nihil incidunt porro non dolorum fugit iusto aut cupiditate.\", \"purchase_price\": 24866}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(55, NULL, 'created', 'Product', 44, NULL, '{\"id\": 44, \"sku\": \"SKU-6008-XE\", \"name\": \"Signature Toast #5372\", \"image\": null, \"stock\": 99, \"is_active\": true, \"min_stock\": 7, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 11, \"sell_price\": 51000, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 4, \"description\": \"Ut quam et eos vero reprehenderit vel autem aut labore et odio sequi distinctio.\", \"purchase_price\": 24874}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(56, NULL, 'created', 'Product', 45, NULL, '{\"id\": 45, \"sku\": \"SKU-5086-YI\", \"name\": \"Limited Earl Grey #2295\", \"image\": null, \"stock\": 4, \"is_active\": true, \"min_stock\": 5, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 4, \"sell_price\": 20100, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 7, \"description\": \"Harum mollitia eveniet laboriosam rem sunt quaerat id deleniti ex autem.\", \"purchase_price\": 9154}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(57, NULL, 'created', 'Product', 46, NULL, '{\"id\": 46, \"sku\": \"SKU-0136-KI\", \"name\": \"Original Waffle #7527\", \"image\": null, \"stock\": 62, \"is_active\": true, \"min_stock\": 14, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 1, \"sell_price\": 26400, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 8, \"description\": \"Et consequatur labore quasi voluptatibus dolorum sequi illum.\", \"purchase_price\": 16918}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(58, NULL, 'created', 'Product', 47, NULL, '{\"id\": 47, \"sku\": \"SKU-3925-SW\", \"name\": \"Iced Toast #3803\", \"image\": null, \"stock\": 86, \"is_active\": true, \"min_stock\": 8, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 4, \"sell_price\": 32200, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 1, \"description\": \"Delectus quod dolorem voluptas deleniti voluptas est aut asperiores itaque pariatur aut.\", \"purchase_price\": 17602}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(59, NULL, 'created', 'Product', 48, NULL, '{\"id\": 48, \"sku\": \"SKU-5689-BG\", \"name\": \"Hot Mocha #3703\", \"image\": null, \"stock\": 58, \"is_active\": true, \"min_stock\": 15, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 9, \"sell_price\": 26500, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 6, \"description\": \"Magni tempore laborum quis sed eaque voluptatem consequatur sit quis.\", \"purchase_price\": 12684}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(60, NULL, 'created', 'Product', 49, NULL, '{\"id\": 49, \"sku\": \"SKU-4259-YL\", \"name\": \"Seasonal Mocha #1493\", \"image\": null, \"stock\": 70, \"is_active\": true, \"min_stock\": 9, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 10, \"sell_price\": 39500, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 3, \"description\": \"Nihil hic delectus velit excepturi non sed.\", \"purchase_price\": 24821}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(61, NULL, 'created', 'Product', 50, NULL, '{\"id\": 50, \"sku\": \"SKU-3613-YT\", \"name\": \"Original Muffin #5722\", \"image\": null, \"stock\": 23, \"is_active\": true, \"min_stock\": 12, \"created_at\": \"2026-04-23 02:32:14\", \"created_by\": 2, \"sell_price\": 12400, \"updated_at\": \"2026-04-23 02:32:14\", \"category_id\": 1, \"description\": \"Et voluptas dolore sit dolores voluptatum sit enim voluptates itaque ut temporibus alias non.\", \"purchase_price\": 7444}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(62, NULL, 'created', 'Member', 1, NULL, '{\"id\": 1, \"user_id\": 4, \"is_active\": true, \"created_at\": \"2026-04-23 02:32:14\", \"updated_at\": \"2026-04-23 02:32:14\", \"member_code\": \"MBR346CM\", \"total_spent\": 7751504, \"member_email\": \"ernestina89@example.com\", \"member_phone\": \"087785599198\", \"points_balance\": 268, \"discount_percentage\": 0}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(63, NULL, 'created', 'Member', 2, NULL, '{\"id\": 2, \"user_id\": 10, \"is_active\": true, \"created_at\": \"2026-04-23 02:32:14\", \"updated_at\": \"2026-04-23 02:32:14\", \"member_code\": \"MBR923FA\", \"total_spent\": 7499957, \"member_email\": \"leola88@example.com\", \"member_phone\": \"087216135588\", \"points_balance\": 103, \"discount_percentage\": 0}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(64, NULL, 'created', 'Member', 3, NULL, '{\"id\": 3, \"user_id\": 9, \"is_active\": true, \"created_at\": \"2026-04-23 02:32:14\", \"updated_at\": \"2026-04-23 02:32:14\", \"member_code\": \"MBR267PX\", \"total_spent\": 2879760, \"member_email\": \"vthompson@example.com\", \"member_phone\": \"086738646895\", \"points_balance\": 420, \"discount_percentage\": 10}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(65, NULL, 'created', 'Member', 4, NULL, '{\"id\": 4, \"user_id\": 1, \"is_active\": false, \"created_at\": \"2026-04-23 02:32:14\", \"updated_at\": \"2026-04-23 02:32:14\", \"member_code\": \"MBR146JO\", \"total_spent\": 3998688, \"member_email\": \"admin@brancoffee.com\", \"member_phone\": \"083959586123\", \"points_balance\": 92, \"discount_percentage\": 2}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(66, NULL, 'created', 'Member', 5, NULL, '{\"id\": 5, \"user_id\": 5, \"is_active\": false, \"created_at\": \"2026-04-23 02:32:14\", \"updated_at\": \"2026-04-23 02:32:14\", \"member_code\": \"MBR915UV\", \"total_spent\": 7501606, \"member_email\": \"cfeil@example.com\", \"member_phone\": \"088981149472\", \"points_balance\": 497, \"discount_percentage\": 5}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(67, NULL, 'created', 'Transaction', 1, NULL, '{\"id\": 1, \"notes\": null, \"user_id\": 5, \"subtotal\": 470017, \"member_id\": null, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 51702, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": \"2026-01-07 01:52:54\", \"total_amount\": 521719, \"payment_method\": \"e-wallet\", \"payment_status\": \"completed\", \"discount_amount\": 0, \"transaction_code\": \"TXN202604237975YN\", \"discount_percentage\": 0}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(68, NULL, 'created', 'Transaction', 2, NULL, '{\"id\": 2, \"notes\": null, \"user_id\": 11, \"subtotal\": 154646, \"member_id\": 3, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 17011, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": null, \"total_amount\": 171657, \"payment_method\": \"qris\", \"payment_status\": \"cancelled\", \"discount_amount\": 0, \"transaction_code\": \"TXN202604238972PE\", \"discount_percentage\": 0}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(69, NULL, 'created', 'Transaction', 3, NULL, '{\"id\": 3, \"notes\": \"Repudiandae animi ut soluta dolore impedit dignissimos exercitationem.\", \"user_id\": 5, \"subtotal\": 367548, \"member_id\": null, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 40430, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": null, \"total_amount\": 407978, \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": 0, \"transaction_code\": \"TXN202604230212ST\", \"discount_percentage\": 0}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(70, NULL, 'created', 'Transaction', 4, NULL, '{\"id\": 4, \"notes\": null, \"user_id\": 4, \"subtotal\": 225348, \"member_id\": null, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 24788, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": \"2026-01-10 09:11:52\", \"total_amount\": 250136, \"payment_method\": \"card\", \"payment_status\": \"completed\", \"discount_amount\": 0, \"transaction_code\": \"TXN202604236784HK\", \"discount_percentage\": 0}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(71, NULL, 'created', 'Transaction', 5, NULL, '{\"id\": 5, \"notes\": null, \"user_id\": 7, \"subtotal\": 115216, \"member_id\": null, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 12674, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": null, \"total_amount\": 127890, \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": 0, \"transaction_code\": \"TXN202604237404GY\", \"discount_percentage\": 0}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(72, NULL, 'created', 'Transaction', 6, NULL, '{\"id\": 6, \"notes\": \"Repellendus est ut sint eaque dolor sunt aut.\", \"user_id\": 7, \"subtotal\": 389013, \"member_id\": null, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 40652, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": \"2025-11-02 12:57:34\", \"total_amount\": 410214, \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": 19451, \"transaction_code\": \"TXN202604238104QU\", \"discount_percentage\": 5}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(73, NULL, 'created', 'Transaction', 7, NULL, '{\"id\": 7, \"notes\": null, \"user_id\": 8, \"subtotal\": 27476, \"member_id\": null, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 3022, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": null, \"total_amount\": 30498, \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": 0, \"transaction_code\": \"TXN202604238067FY\", \"discount_percentage\": 0}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(74, NULL, 'created', 'Transaction', 8, NULL, '{\"id\": 8, \"notes\": null, \"user_id\": 6, \"subtotal\": 402191, \"member_id\": 4, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 44241, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": null, \"total_amount\": 446432, \"payment_method\": \"card\", \"payment_status\": \"cancelled\", \"discount_amount\": 0, \"transaction_code\": \"TXN202604231478BO\", \"discount_percentage\": 0}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(75, NULL, 'created', 'Transaction', 9, NULL, '{\"id\": 9, \"notes\": null, \"user_id\": 10, \"subtotal\": 241138, \"member_id\": null, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 26525, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": \"2026-03-25 03:27:33\", \"total_amount\": 267663, \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": 0, \"transaction_code\": \"TXN202604232045BH\", \"discount_percentage\": 0}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(76, NULL, 'created', 'Transaction', 10, NULL, '{\"id\": 10, \"notes\": \"Distinctio nulla in quasi tempora qui.\", \"user_id\": 8, \"subtotal\": 104928, \"member_id\": null, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 10965, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": \"2026-04-14 23:45:27\", \"total_amount\": 110647, \"payment_method\": \"qris\", \"payment_status\": \"completed\", \"discount_amount\": 5246, \"transaction_code\": \"TXN202604239988BI\", \"discount_percentage\": 5}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(77, NULL, 'created', 'Transaction', 11, NULL, '{\"id\": 11, \"notes\": null, \"user_id\": 1, \"subtotal\": 158688, \"member_id\": null, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 16583, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": \"2025-11-05 01:03:19\", \"total_amount\": 167337, \"payment_method\": \"e-wallet\", \"payment_status\": \"completed\", \"discount_amount\": 7934, \"transaction_code\": \"TXN202604233819RT\", \"discount_percentage\": 5}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(78, NULL, 'created', 'Transaction', 12, NULL, '{\"id\": 12, \"notes\": null, \"user_id\": 3, \"subtotal\": 360358, \"member_id\": 5, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 35675, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": \"2026-01-03 10:50:37\", \"total_amount\": 359997, \"payment_method\": \"qris\", \"payment_status\": \"completed\", \"discount_amount\": 36036, \"transaction_code\": \"TXN202604237537NX\", \"discount_percentage\": 10}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(79, NULL, 'created', 'Transaction', 13, NULL, '{\"id\": 13, \"notes\": null, \"user_id\": 6, \"subtotal\": 163484, \"member_id\": 5, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 16185, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": \"2025-11-05 13:10:41\", \"total_amount\": 163321, \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": 16348, \"transaction_code\": \"TXN202604234127YR\", \"discount_percentage\": 10}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(80, NULL, 'created', 'Transaction', 14, NULL, '{\"id\": 14, \"notes\": null, \"user_id\": 11, \"subtotal\": 482717, \"member_id\": 3, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 47789, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": null, \"total_amount\": 482234, \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": 48272, \"transaction_code\": \"TXN202604233686WF\", \"discount_percentage\": 10}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(81, NULL, 'created', 'Transaction', 15, NULL, '{\"id\": 15, \"notes\": null, \"user_id\": 4, \"subtotal\": 131521, \"member_id\": 3, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 14467, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": null, \"total_amount\": 145988, \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": 0, \"transaction_code\": \"TXN202604237274XJ\", \"discount_percentage\": 0}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(82, NULL, 'created', 'Transaction', 16, NULL, '{\"id\": 16, \"notes\": null, \"user_id\": 5, \"subtotal\": 462871, \"member_id\": 3, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 45824, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": \"2026-04-20 00:04:01\", \"total_amount\": 462408, \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": 46287, \"transaction_code\": \"TXN202604230482KG\", \"discount_percentage\": 10}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(83, NULL, 'created', 'Transaction', 17, NULL, '{\"id\": 17, \"notes\": null, \"user_id\": 1, \"subtotal\": 192784, \"member_id\": null, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 21206, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": \"2026-04-08 03:58:26\", \"total_amount\": 213990, \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": 0, \"transaction_code\": \"TXN202604231827IC\", \"discount_percentage\": 0}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(84, NULL, 'created', 'Transaction', 18, NULL, '{\"id\": 18, \"notes\": null, \"user_id\": 1, \"subtotal\": 239893, \"member_id\": null, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 26388, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": null, \"total_amount\": 266281, \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": 0, \"transaction_code\": \"TXN202604230055WP\", \"discount_percentage\": 0}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(85, NULL, 'created', 'Transaction', 19, NULL, '{\"id\": 19, \"notes\": null, \"user_id\": 7, \"subtotal\": 181052, \"member_id\": null, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 18920, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": \"2026-04-16 12:16:12\", \"total_amount\": 190919, \"payment_method\": \"qris\", \"payment_status\": \"completed\", \"discount_amount\": 9053, \"transaction_code\": \"TXN202604236767PY\", \"discount_percentage\": 5}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(86, NULL, 'created', 'Transaction', 20, NULL, '{\"id\": 20, \"notes\": null, \"user_id\": 6, \"subtotal\": 498692, \"member_id\": null, \"created_at\": \"2026-04-23 02:32:14\", \"tax_amount\": 54856, \"updated_at\": \"2026-04-23 02:32:14\", \"payment_date\": null, \"total_amount\": 553548, \"payment_method\": \"e-wallet\", \"payment_status\": \"pending\", \"discount_amount\": 0, \"transaction_code\": \"TXN202604237561DG\", \"discount_percentage\": 0}', '127.0.0.1', 'Symfony', '2026-04-22 19:32:14'),
(87, NULL, 'updated', 'User', 1, '{\"id\": 1, \"name\": \"Admin\", \"role\": \"admin\", \"email\": \"admin@brancoffee.com\", \"phone\": null, \"address\": null, \"is_active\": true, \"created_at\": \"2026-04-23T02:21:40.000000Z\", \"updated_at\": \"2026-04-23T02:21:40.000000Z\", \"email_verified_at\": null}', '{\"updated_at\": \"2026-04-23 03:10:15\"}', '127.0.0.1', 'Symfony', '2026-04-22 20:10:15'),
(88, NULL, 'created', 'User', 12, NULL, '{\"id\": 12, \"name\": \"Manager\", \"role\": \"manager\", \"email\": \"manager@brancoffee.com\", \"created_at\": \"2026-04-23 03:10:15\", \"updated_at\": \"2026-04-23 03:10:15\"}', '127.0.0.1', 'Symfony', '2026-04-22 20:10:15'),
(89, NULL, 'created', 'User', 13, NULL, '{\"id\": 13, \"name\": \"CS Staff\", \"role\": \"cs\", \"email\": \"cs@brancoffee.com\", \"created_at\": \"2026-04-23 03:10:15\", \"updated_at\": \"2026-04-23 03:10:15\"}', '127.0.0.1', 'Symfony', '2026-04-22 20:10:15'),
(90, NULL, 'created', 'User', 14, NULL, '{\"id\": 14, \"name\": \"Member Test\", \"role\": \"user\", \"email\": \"member@brancoffee.com\", \"created_at\": \"2026-04-23 03:10:15\", \"updated_at\": \"2026-04-23 03:10:15\"}', '127.0.0.1', 'Symfony', '2026-04-22 20:10:15'),
(91, 1, 'created', 'Product', 51, NULL, '{\"id\": 51, \"sku\": \"ROT-BAK-001\", \"name\": \"Roti Bakar\", \"image\": \"products/Oto17kUkInwdkytN1JY5uyxcupVp8dZOTyJgWwWq.jpg\", \"stock\": \"10\", \"is_active\": true, \"min_stock\": \"3\", \"created_at\": \"2026-04-23 03:47:07\", \"created_by\": 1, \"sell_price\": \"7000\", \"updated_at\": \"2026-04-23 03:47:07\", \"category_id\": \"6\", \"description\": \"Tes roti bakar\", \"purchase_price\": \"5000\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 20:47:07'),
(93, 1, 'created', 'Transaction', 22, NULL, '{\"id\": 22, \"notes\": null, \"user_id\": 1, \"subtotal\": 82400, \"member_id\": \"1\", \"created_at\": \"2026-04-23 04:10:57\", \"tax_amount\": 8240, \"updated_at\": \"2026-04-23 04:10:57\", \"total_amount\": 90640, \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": 0, \"transaction_code\": \"TRX-20260423-00021\", \"discount_percentage\": \"0.00\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:10:57'),
(94, 1, 'updated', 'Product', 1, '{\"id\": 1, \"sku\": \"SKU-9526-MT\", \"name\": \"Triple Cappuccino #7165\", \"image\": null, \"stock\": 31, \"is_active\": true, \"min_stock\": 7, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 10, \"deleted_at\": null, \"sell_price\": \"25600.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"category_id\": 8, \"description\": \"Est quas non consequuntur velit quia ab.\", \"purchase_price\": \"12381.00\"}', '{\"stock\": 30, \"updated_at\": \"2026-04-23 04:10:57\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:10:57'),
(95, 1, 'updated', 'Product', 3, '{\"id\": 3, \"sku\": \"SKU-7568-ID\", \"name\": \"Original Salad #9440\", \"image\": null, \"stock\": 87, \"is_active\": true, \"min_stock\": 15, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 8, \"deleted_at\": null, \"sell_price\": \"22200.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"category_id\": 5, \"description\": \"In officia necessitatibus nulla et in accusamus voluptatum nesciunt est sit beatae odio minima et.\", \"purchase_price\": \"11248.00\"}', '{\"stock\": 86, \"updated_at\": \"2026-04-23 04:10:58\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:10:58'),
(96, 1, 'updated', 'Product', 4, '{\"id\": 4, \"sku\": \"SKU-0577-WN\", \"name\": \"Double Toast #7393\", \"image\": null, \"stock\": 66, \"is_active\": true, \"min_stock\": 9, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 10, \"deleted_at\": null, \"sell_price\": \"34600.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"category_id\": 8, \"description\": \"Mollitia saepe omnis beatae recusandae numquam hic ut voluptas et non odit sint.\", \"purchase_price\": \"21070.00\"}', '{\"stock\": 65, \"updated_at\": \"2026-04-23 04:10:58\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:10:58'),
(97, 1, 'updated', 'Member', 1, '{\"id\": 1, \"user_id\": 4, \"is_active\": true, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"member_code\": \"MBR346CM\", \"total_spent\": \"7751504.00\", \"member_email\": \"ernestina89@example.com\", \"member_phone\": \"087785599198\", \"points_balance\": 268, \"discount_percentage\": \"0.00\"}', '{\"total_spent\": 7842144}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:10:58'),
(98, 1, 'updated', 'Member', 1, '{\"id\": 1, \"user_id\": 4, \"is_active\": true, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"member_code\": \"MBR346CM\", \"total_spent\": \"7842144.00\", \"member_email\": \"ernestina89@example.com\", \"member_phone\": \"087785599198\", \"points_balance\": 268, \"discount_percentage\": \"0.00\"}', '{\"points_balance\": 358}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:10:58'),
(99, 1, 'created', 'Transaction', 23, NULL, '{\"id\": 23, \"notes\": null, \"user_id\": 1, \"subtotal\": 82400, \"member_id\": \"1\", \"created_at\": \"2026-04-23 04:11:54\", \"tax_amount\": 8240, \"updated_at\": \"2026-04-23 04:11:54\", \"total_amount\": 90640, \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": 0, \"transaction_code\": \"TRX-20260423-00022\", \"discount_percentage\": \"0.00\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:11:54'),
(100, 1, 'updated', 'Product', 1, '{\"id\": 1, \"sku\": \"SKU-9526-MT\", \"name\": \"Triple Cappuccino #7165\", \"image\": null, \"stock\": 30, \"is_active\": true, \"min_stock\": 7, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 10, \"deleted_at\": null, \"sell_price\": \"25600.00\", \"updated_at\": \"2026-04-23T04:10:57.000000Z\", \"category_id\": 8, \"description\": \"Est quas non consequuntur velit quia ab.\", \"purchase_price\": \"12381.00\"}', '{\"stock\": 29, \"updated_at\": \"2026-04-23 04:11:54\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:11:54'),
(101, 1, 'updated', 'Product', 3, '{\"id\": 3, \"sku\": \"SKU-7568-ID\", \"name\": \"Original Salad #9440\", \"image\": null, \"stock\": 86, \"is_active\": true, \"min_stock\": 15, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 8, \"deleted_at\": null, \"sell_price\": \"22200.00\", \"updated_at\": \"2026-04-23T04:10:58.000000Z\", \"category_id\": 5, \"description\": \"In officia necessitatibus nulla et in accusamus voluptatum nesciunt est sit beatae odio minima et.\", \"purchase_price\": \"11248.00\"}', '{\"stock\": 85, \"updated_at\": \"2026-04-23 04:11:54\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:11:54'),
(102, 1, 'updated', 'Product', 4, '{\"id\": 4, \"sku\": \"SKU-0577-WN\", \"name\": \"Double Toast #7393\", \"image\": null, \"stock\": 65, \"is_active\": true, \"min_stock\": 9, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 10, \"deleted_at\": null, \"sell_price\": \"34600.00\", \"updated_at\": \"2026-04-23T04:10:58.000000Z\", \"category_id\": 8, \"description\": \"Mollitia saepe omnis beatae recusandae numquam hic ut voluptas et non odit sint.\", \"purchase_price\": \"21070.00\"}', '{\"stock\": 64, \"updated_at\": \"2026-04-23 04:11:54\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:11:54'),
(103, 1, 'updated', 'Member', 1, '{\"id\": 1, \"user_id\": 4, \"is_active\": true, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"updated_at\": \"2026-04-23T04:10:58.000000Z\", \"member_code\": \"MBR346CM\", \"total_spent\": \"7842144.00\", \"member_email\": \"ernestina89@example.com\", \"member_phone\": \"087785599198\", \"points_balance\": 358, \"discount_percentage\": \"0.00\"}', '{\"total_spent\": 7932784}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:11:54');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `model`, `model_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `created_at`) VALUES
(104, 1, 'updated', 'Member', 1, '{\"id\": 1, \"user_id\": 4, \"is_active\": true, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"updated_at\": \"2026-04-23T04:10:58.000000Z\", \"member_code\": \"MBR346CM\", \"total_spent\": \"7932784.00\", \"member_email\": \"ernestina89@example.com\", \"member_phone\": \"087785599198\", \"points_balance\": 358, \"discount_percentage\": \"0.00\"}', '{\"points_balance\": 448}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:11:54'),
(105, 1, 'created', 'Transaction', 24, NULL, '{\"id\": 24, \"notes\": null, \"user_id\": 1, \"subtotal\": 89400, \"member_id\": \"1\", \"created_at\": \"2026-04-23 04:12:48\", \"tax_amount\": 8940, \"updated_at\": \"2026-04-23 04:12:48\", \"total_amount\": 98340, \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": 0, \"transaction_code\": \"TRX-20260423-00023\", \"discount_percentage\": \"0.00\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:12:48'),
(106, 1, 'updated', 'Product', 51, '{\"id\": 51, \"sku\": \"ROT-BAK-001\", \"name\": \"Roti Bakar\", \"image\": \"products/Oto17kUkInwdkytN1JY5uyxcupVp8dZOTyJgWwWq.jpg\", \"stock\": 10, \"is_active\": true, \"min_stock\": 3, \"created_at\": \"2026-04-23T03:47:07.000000Z\", \"created_by\": 1, \"deleted_at\": null, \"sell_price\": \"7000.00\", \"updated_at\": \"2026-04-23T03:47:07.000000Z\", \"category_id\": 6, \"description\": \"Tes roti bakar\", \"purchase_price\": \"5000.00\"}', '{\"stock\": 9, \"updated_at\": \"2026-04-23 04:12:48\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:12:48'),
(107, 1, 'updated', 'Product', 1, '{\"id\": 1, \"sku\": \"SKU-9526-MT\", \"name\": \"Triple Cappuccino #7165\", \"image\": null, \"stock\": 29, \"is_active\": true, \"min_stock\": 7, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 10, \"deleted_at\": null, \"sell_price\": \"25600.00\", \"updated_at\": \"2026-04-23T04:11:54.000000Z\", \"category_id\": 8, \"description\": \"Est quas non consequuntur velit quia ab.\", \"purchase_price\": \"12381.00\"}', '{\"stock\": 28, \"updated_at\": \"2026-04-23 04:12:48\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:12:48'),
(108, 1, 'updated', 'Product', 3, '{\"id\": 3, \"sku\": \"SKU-7568-ID\", \"name\": \"Original Salad #9440\", \"image\": null, \"stock\": 85, \"is_active\": true, \"min_stock\": 15, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 8, \"deleted_at\": null, \"sell_price\": \"22200.00\", \"updated_at\": \"2026-04-23T04:11:54.000000Z\", \"category_id\": 5, \"description\": \"In officia necessitatibus nulla et in accusamus voluptatum nesciunt est sit beatae odio minima et.\", \"purchase_price\": \"11248.00\"}', '{\"stock\": 84, \"updated_at\": \"2026-04-23 04:12:48\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:12:48'),
(109, 1, 'updated', 'Product', 4, '{\"id\": 4, \"sku\": \"SKU-0577-WN\", \"name\": \"Double Toast #7393\", \"image\": null, \"stock\": 64, \"is_active\": true, \"min_stock\": 9, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 10, \"deleted_at\": null, \"sell_price\": \"34600.00\", \"updated_at\": \"2026-04-23T04:11:54.000000Z\", \"category_id\": 8, \"description\": \"Mollitia saepe omnis beatae recusandae numquam hic ut voluptas et non odit sint.\", \"purchase_price\": \"21070.00\"}', '{\"stock\": 63, \"updated_at\": \"2026-04-23 04:12:48\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:12:48'),
(110, 1, 'updated', 'Member', 1, '{\"id\": 1, \"user_id\": 4, \"is_active\": true, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"updated_at\": \"2026-04-23T04:11:54.000000Z\", \"member_code\": \"MBR346CM\", \"total_spent\": \"7932784.00\", \"member_email\": \"ernestina89@example.com\", \"member_phone\": \"087785599198\", \"points_balance\": 448, \"discount_percentage\": \"0.00\"}', '{\"total_spent\": 8031124}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:12:48'),
(111, 1, 'updated', 'Member', 1, '{\"id\": 1, \"user_id\": 4, \"is_active\": true, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"updated_at\": \"2026-04-23T04:11:54.000000Z\", \"member_code\": \"MBR346CM\", \"total_spent\": \"8031124.00\", \"member_email\": \"ernestina89@example.com\", \"member_phone\": \"087785599198\", \"points_balance\": 448, \"discount_percentage\": \"0.00\"}', '{\"points_balance\": 546}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:12:48'),
(112, 1, 'created', 'Transaction', 25, NULL, '{\"id\": 25, \"notes\": null, \"user_id\": 1, \"subtotal\": 89400, \"member_id\": \"1\", \"created_at\": \"2026-04-23 04:13:48\", \"tax_amount\": 8940, \"updated_at\": \"2026-04-23 04:13:48\", \"total_amount\": 98340, \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": 0, \"transaction_code\": \"TRX-20260423-00024\", \"discount_percentage\": \"0.00\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:13:48'),
(113, 1, 'updated', 'Product', 51, '{\"id\": 51, \"sku\": \"ROT-BAK-001\", \"name\": \"Roti Bakar\", \"image\": \"products/Oto17kUkInwdkytN1JY5uyxcupVp8dZOTyJgWwWq.jpg\", \"stock\": 9, \"is_active\": true, \"min_stock\": 3, \"created_at\": \"2026-04-23T03:47:07.000000Z\", \"created_by\": 1, \"deleted_at\": null, \"sell_price\": \"7000.00\", \"updated_at\": \"2026-04-23T04:12:48.000000Z\", \"category_id\": 6, \"description\": \"Tes roti bakar\", \"purchase_price\": \"5000.00\"}', '{\"stock\": 8, \"updated_at\": \"2026-04-23 04:13:48\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:13:48'),
(114, 1, 'updated', 'Product', 1, '{\"id\": 1, \"sku\": \"SKU-9526-MT\", \"name\": \"Triple Cappuccino #7165\", \"image\": null, \"stock\": 28, \"is_active\": true, \"min_stock\": 7, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 10, \"deleted_at\": null, \"sell_price\": \"25600.00\", \"updated_at\": \"2026-04-23T04:12:48.000000Z\", \"category_id\": 8, \"description\": \"Est quas non consequuntur velit quia ab.\", \"purchase_price\": \"12381.00\"}', '{\"stock\": 27, \"updated_at\": \"2026-04-23 04:13:49\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:13:49'),
(115, 1, 'updated', 'Product', 3, '{\"id\": 3, \"sku\": \"SKU-7568-ID\", \"name\": \"Original Salad #9440\", \"image\": null, \"stock\": 84, \"is_active\": true, \"min_stock\": 15, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 8, \"deleted_at\": null, \"sell_price\": \"22200.00\", \"updated_at\": \"2026-04-23T04:12:48.000000Z\", \"category_id\": 5, \"description\": \"In officia necessitatibus nulla et in accusamus voluptatum nesciunt est sit beatae odio minima et.\", \"purchase_price\": \"11248.00\"}', '{\"stock\": 83, \"updated_at\": \"2026-04-23 04:13:49\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:13:49'),
(116, 1, 'updated', 'Product', 4, '{\"id\": 4, \"sku\": \"SKU-0577-WN\", \"name\": \"Double Toast #7393\", \"image\": null, \"stock\": 63, \"is_active\": true, \"min_stock\": 9, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 10, \"deleted_at\": null, \"sell_price\": \"34600.00\", \"updated_at\": \"2026-04-23T04:12:48.000000Z\", \"category_id\": 8, \"description\": \"Mollitia saepe omnis beatae recusandae numquam hic ut voluptas et non odit sint.\", \"purchase_price\": \"21070.00\"}', '{\"stock\": 62, \"updated_at\": \"2026-04-23 04:13:49\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:13:49'),
(117, 1, 'updated', 'Member', 1, '{\"id\": 1, \"user_id\": 4, \"is_active\": true, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"updated_at\": \"2026-04-23T04:12:48.000000Z\", \"member_code\": \"MBR346CM\", \"total_spent\": \"8031124.00\", \"member_email\": \"ernestina89@example.com\", \"member_phone\": \"087785599198\", \"points_balance\": 546, \"discount_percentage\": \"0.00\"}', '{\"total_spent\": 8129464}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:13:49'),
(118, 1, 'updated', 'Member', 1, '{\"id\": 1, \"user_id\": 4, \"is_active\": true, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"updated_at\": \"2026-04-23T04:12:48.000000Z\", \"member_code\": \"MBR346CM\", \"total_spent\": \"8129464.00\", \"member_email\": \"ernestina89@example.com\", \"member_phone\": \"087785599198\", \"points_balance\": 546, \"discount_percentage\": \"0.00\"}', '{\"points_balance\": 644}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:13:49'),
(119, 1, 'updated', 'Product', 12, '{\"id\": 12, \"sku\": \"SKU-3268-GM\", \"name\": \"Original Sandwich #4794\", \"image\": null, \"stock\": 0, \"is_active\": true, \"min_stock\": 10, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 5, \"deleted_at\": null, \"sell_price\": \"23700.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"category_id\": 1, \"description\": \"In a est ipsum ad itaque qui vel fugit et ea veniam.\", \"purchase_price\": \"12131.00\"}', '{\"stock\": \"20\", \"updated_at\": \"2026-04-23 04:54:55\", \"purchase_price\": \"12200\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 21:54:55'),
(120, 1, 'created', 'User', 15, NULL, '{\"id\": 15, \"name\": \"Budi Santoso\", \"role\": \"member\", \"email\": \"budi@example.com\", \"created_at\": \"2026-04-23 05:10:01\", \"updated_at\": \"2026-04-23 05:10:01\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 22:10:01'),
(121, 1, 'created', 'Member', 6, NULL, '{\"id\": 6, \"user_id\": 15, \"is_active\": \"0\", \"created_at\": \"2026-04-23 05:10:01\", \"updated_at\": \"2026-04-23 05:10:01\", \"member_code\": \"MBR-XTR1OVIR\", \"member_email\": \"budi@example.com\", \"member_phone\": \"081234567890\", \"discount_percentage\": \"10\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 22:10:01'),
(122, 1, 'updated', 'Member', 1, '{\"id\": 1, \"user_id\": 4, \"is_active\": true, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"updated_at\": \"2026-04-23T04:13:49.000000Z\", \"member_code\": \"MBR346CM\", \"total_spent\": \"8129464.00\", \"member_email\": \"ernestina89@example.com\", \"member_phone\": \"087785599198\", \"points_balance\": 644, \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-23 05:15:16\", \"discount_percentage\": \"15\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 22:15:16'),
(123, 1, 'created', 'User', 16, NULL, '{\"id\": 16, \"name\": \"Josep Stalin\", \"role\": \"member\", \"email\": \"josep@example.com\", \"created_at\": \"2026-04-23 05:18:08\", \"updated_at\": \"2026-04-23 05:18:08\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 22:18:08'),
(124, 1, 'created', 'Member', 7, NULL, '{\"id\": 7, \"user_id\": 16, \"is_active\": \"1\", \"created_at\": \"2026-04-23 05:18:08\", \"updated_at\": \"2026-04-23 05:18:08\", \"member_code\": \"MBR-VWPBY84M\", \"member_email\": \"josep@example.com\", \"member_phone\": \"081234567891\", \"discount_percentage\": \"0\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 22:18:08'),
(125, 1, 'updated', 'Member', 7, '{\"id\": 7, \"user_id\": 16, \"is_active\": true, \"created_at\": \"2026-04-23T05:18:08.000000Z\", \"updated_at\": \"2026-04-23T05:18:08.000000Z\", \"member_code\": \"MBR-VWPBY84M\", \"total_spent\": \"0.00\", \"member_email\": \"josep@example.com\", \"member_phone\": \"081234567891\", \"points_balance\": 0, \"discount_percentage\": \"0.00\"}', '{\"is_active\": \"0\", \"updated_at\": \"2026-04-23 05:18:25\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 22:18:25'),
(126, 1, 'updated', 'Member', 7, '{\"id\": 7, \"user_id\": 16, \"is_active\": false, \"created_at\": \"2026-04-23T05:18:08.000000Z\", \"updated_at\": \"2026-04-23T05:18:25.000000Z\", \"member_code\": \"MBR-VWPBY84M\", \"total_spent\": \"0.00\", \"member_email\": \"josep@example.com\", \"member_phone\": \"081234567891\", \"points_balance\": 0, \"discount_percentage\": \"0.00\"}', '{\"is_active\": \"1\", \"updated_at\": \"2026-04-23 05:18:33\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 22:18:33'),
(127, 1, 'updated', 'User', 16, '{\"id\": 16, \"name\": \"Josep Stalin\", \"role\": \"member\", \"email\": \"josep@example.com\", \"phone\": null, \"address\": null, \"is_active\": true, \"created_at\": \"2026-04-23T05:18:08.000000Z\", \"updated_at\": \"2026-04-23T05:18:08.000000Z\", \"email_verified_at\": null}', '{\"name\": \"Josep Stalinn\", \"updated_at\": \"2026-04-23 05:32:27\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 22:32:27'),
(128, 1, 'updated', 'User', 16, '{\"id\": 16, \"name\": \"Josep Stalinn\", \"role\": \"member\", \"email\": \"josep@example.com\", \"phone\": null, \"address\": null, \"is_active\": true, \"created_at\": \"2026-04-23T05:18:08.000000Z\", \"updated_at\": \"2026-04-23T05:32:27.000000Z\", \"email_verified_at\": null}', '{\"name\": \"Josep Stalin\", \"updated_at\": \"2026-04-23 05:32:32\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 22:32:32'),
(129, 12, 'created', 'Transaction', 26, NULL, '{\"id\": 26, \"notes\": null, \"user_id\": 12, \"subtotal\": 58000, \"member_id\": \"7\", \"created_at\": \"2026-04-23 06:12:15\", \"tax_amount\": 5220, \"updated_at\": \"2026-04-23 06:12:15\", \"total_amount\": 57420, \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": 5800, \"transaction_code\": \"TRX-20260423-00025\", \"discount_percentage\": \"0.00\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 23:12:15'),
(130, 12, 'updated', 'Product', 13, '{\"id\": 13, \"sku\": \"SKU-7512-CX\", \"name\": \"Classic Cold Brew #8564\", \"image\": null, \"stock\": 97, \"is_active\": true, \"min_stock\": 3, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 7, \"deleted_at\": null, \"sell_price\": \"41200.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"category_id\": 6, \"description\": \"Rem dolor sequi ut iure minima voluptates itaque enim dolores commodi perspiciatis fuga quos.\", \"purchase_price\": \"20892.00\"}', '{\"stock\": 96, \"updated_at\": \"2026-04-23 06:12:15\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 23:12:15'),
(131, 12, 'updated', 'Product', 14, '{\"id\": 14, \"sku\": \"SKU-4565-PL\", \"name\": \"Triple Americano #9809\", \"image\": null, \"stock\": 15, \"is_active\": true, \"min_stock\": 3, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 1, \"deleted_at\": null, \"sell_price\": \"16800.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"category_id\": 6, \"description\": \"Eius dolorum eos labore non sunt quia voluptates nisi voluptas et dolorum.\", \"purchase_price\": \"11003.00\"}', '{\"stock\": 14, \"updated_at\": \"2026-04-23 06:12:15\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 23:12:15'),
(132, 12, 'updated', 'Member', 7, '{\"id\": 7, \"user_id\": 16, \"is_active\": true, \"created_at\": \"2026-04-23T05:18:08.000000Z\", \"updated_at\": \"2026-04-23T05:18:33.000000Z\", \"member_code\": \"MBR-VWPBY84M\", \"total_spent\": \"0.00\", \"member_email\": \"josep@example.com\", \"member_phone\": \"081234567891\", \"points_balance\": 0, \"discount_percentage\": \"0.00\"}', '{\"total_spent\": 57420}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 23:12:15'),
(133, 12, 'updated', 'Member', 7, '{\"id\": 7, \"user_id\": 16, \"is_active\": true, \"created_at\": \"2026-04-23T05:18:08.000000Z\", \"updated_at\": \"2026-04-23T05:18:33.000000Z\", \"member_code\": \"MBR-VWPBY84M\", \"total_spent\": \"57420.00\", \"member_email\": \"josep@example.com\", \"member_phone\": \"081234567891\", \"points_balance\": 0, \"discount_percentage\": \"0.00\"}', '{\"points_balance\": 57}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 23:12:15'),
(134, 13, 'created', 'Transaction', 27, NULL, '{\"id\": 27, \"notes\": null, \"user_id\": 13, \"subtotal\": 25600, \"member_id\": null, \"created_at\": \"2026-04-23 06:50:42\", \"tax_amount\": 2560, \"updated_at\": \"2026-04-23 06:50:42\", \"total_amount\": 28160, \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": 0, \"transaction_code\": \"TRX-20260423-00026\", \"discount_percentage\": 0}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 23:50:42'),
(135, 13, 'updated', 'Product', 1, '{\"id\": 1, \"sku\": \"SKU-9526-MT\", \"name\": \"Triple Cappuccino #7165\", \"image\": null, \"stock\": 27, \"is_active\": true, \"min_stock\": 7, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 10, \"deleted_at\": null, \"sell_price\": \"25600.00\", \"updated_at\": \"2026-04-23T04:13:49.000000Z\", \"category_id\": 8, \"description\": \"Est quas non consequuntur velit quia ab.\", \"purchase_price\": \"12381.00\"}', '{\"stock\": 26, \"updated_at\": \"2026-04-23 06:50:42\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-22 23:50:42'),
(136, 13, 'created', 'User', 17, NULL, '{\"id\": 17, \"name\": \"tes\", \"role\": \"user\", \"email\": \"0845369852367896@brancoffee.member\", \"phone\": \"0845369852367896\", \"address\": \"tes saja\", \"is_active\": true, \"created_at\": \"2026-04-23 07:01:29\", \"updated_at\": \"2026-04-23 07:01:29\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 00:01:29'),
(137, 13, 'created', 'Member', 8, NULL, '{\"id\": 8, \"user_id\": 17, \"is_active\": true, \"created_at\": \"2026-04-23 07:01:29\", \"updated_at\": \"2026-04-23 07:01:29\", \"member_code\": \"MBR-00008\", \"member_phone\": \"0845369852367896\", \"discount_percentage\": 5}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 00:01:29'),
(138, 13, 'updated', 'User', 17, '{\"id\": 17, \"name\": \"tes\", \"role\": \"user\", \"email\": \"0845369852367896@brancoffee.member\", \"phone\": \"0845369852367896\", \"address\": \"tes saja\", \"is_active\": true, \"created_at\": \"2026-04-23T07:01:29.000000Z\", \"updated_at\": \"2026-04-23T07:01:29.000000Z\", \"email_verified_at\": null}', '{\"address\": \"bagus\", \"updated_at\": \"2026-04-23 07:02:23\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 00:02:23'),
(139, 1, 'deleted', 'User', 17, '{\"id\": 17, \"name\": \"tes\", \"role\": \"user\", \"email\": \"0845369852367896@brancoffee.member\", \"phone\": \"0845369852367896\", \"address\": \"bagus\", \"is_active\": 1, \"created_at\": \"2026-04-23 07:01:29\", \"updated_at\": \"2026-04-23 07:02:23\", \"email_verified_at\": null}', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 01:50:08'),
(140, 1, 'deleted', 'Member', 8, '{\"id\": 8, \"user_id\": 17, \"is_active\": 1, \"created_at\": \"2026-04-23 07:01:29\", \"updated_at\": \"2026-04-23 07:01:29\", \"member_code\": \"MBR-00008\", \"total_spent\": \"0.00\", \"member_email\": null, \"member_phone\": \"0845369852367896\", \"points_balance\": 0, \"discount_percentage\": \"5.00\"}', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 01:50:08'),
(141, 1, 'deleted', 'Product', 51, '{\"id\": 51, \"sku\": \"ROT-BAK-001\", \"name\": \"Roti Bakar\", \"image\": \"products/Oto17kUkInwdkytN1JY5uyxcupVp8dZOTyJgWwWq.jpg\", \"stock\": 8, \"is_active\": 1, \"min_stock\": 3, \"created_at\": \"2026-04-23 03:47:07\", \"created_by\": 1, \"deleted_at\": \"2026-04-23 08:50:27\", \"sell_price\": \"7000.00\", \"updated_at\": \"2026-04-23 08:50:27\", \"category_id\": 6, \"description\": \"Tes roti bakar\", \"purchase_price\": \"5000.00\"}', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 01:50:27'),
(142, 1, 'updated', 'Transaction', 1, '{\"id\": 1, \"notes\": null, \"user_id\": 5, \"subtotal\": \"470017.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"51702.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": \"2026-01-07T01:52:54.000000Z\", \"total_amount\": \"521719.00\", \"payment_method\": \"e-wallet\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604237975YN\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-23 08:59:42\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 01:59:42'),
(143, 1, 'updated', 'Transaction', 4, '{\"id\": 4, \"notes\": null, \"user_id\": 4, \"subtotal\": \"225348.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"24788.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": \"2026-01-10T09:11:52.000000Z\", \"total_amount\": \"250136.00\", \"payment_method\": \"card\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604236784HK\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-23 09:00:41\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:00:41'),
(144, 1, 'updated', 'Transaction', 1, '{\"id\": 1, \"notes\": null, \"user_id\": 5, \"subtotal\": \"470017.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"51702.00\", \"updated_at\": \"2026-04-23T08:59:42.000000Z\", \"order_status\": \"preparing\", \"payment_date\": \"2026-01-07T01:52:54.000000Z\", \"total_amount\": \"521719.00\", \"payment_method\": \"e-wallet\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604237975YN\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-23 09:01:01\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:01:01'),
(145, 1, 'updated', 'Transaction', 1, '{\"id\": 1, \"notes\": null, \"user_id\": 5, \"subtotal\": \"470017.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"51702.00\", \"updated_at\": \"2026-04-23T09:01:01.000000Z\", \"order_status\": \"ready\", \"payment_date\": \"2026-01-07T01:52:54.000000Z\", \"total_amount\": \"521719.00\", \"payment_method\": \"e-wallet\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604237975YN\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-23 09:03:08\", \"order_status\": \"served\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:03:08'),
(146, 1, 'updated', 'Transaction', 19, '{\"id\": 19, \"notes\": null, \"user_id\": 7, \"subtotal\": \"181052.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"18920.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": \"2026-04-16T12:16:12.000000Z\", \"total_amount\": \"190919.00\", \"payment_method\": \"qris\", \"payment_status\": \"completed\", \"discount_amount\": \"9053.00\", \"transaction_code\": \"TXN202604236767PY\", \"discount_percentage\": \"5.00\"}', '{\"updated_at\": \"2026-04-23 09:04:59\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:04:59'),
(147, 1, 'updated', 'Transaction', 17, '{\"id\": 17, \"notes\": null, \"user_id\": 1, \"subtotal\": \"192784.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"21206.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": \"2026-04-08T03:58:26.000000Z\", \"total_amount\": \"213990.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604231827IC\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-23 09:05:01\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:05:01'),
(148, 1, 'updated', 'Transaction', 16, '{\"id\": 16, \"notes\": null, \"user_id\": 5, \"subtotal\": \"462871.00\", \"member_id\": 3, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"45824.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": \"2026-04-20T00:04:01.000000Z\", \"total_amount\": \"462408.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"46287.00\", \"transaction_code\": \"TXN202604230482KG\", \"discount_percentage\": \"10.00\"}', '{\"updated_at\": \"2026-04-23 09:05:03\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:05:03'),
(149, 1, 'updated', 'Transaction', 13, '{\"id\": 13, \"notes\": null, \"user_id\": 6, \"subtotal\": \"163484.00\", \"member_id\": 5, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"16185.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": \"2025-11-05T13:10:41.000000Z\", \"total_amount\": \"163321.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"16348.00\", \"transaction_code\": \"TXN202604234127YR\", \"discount_percentage\": \"10.00\"}', '{\"updated_at\": \"2026-04-23 09:05:05\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:05:05'),
(150, 1, 'updated', 'Transaction', 12, '{\"id\": 12, \"notes\": null, \"user_id\": 3, \"subtotal\": \"360358.00\", \"member_id\": 5, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"35675.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": \"2026-01-03T10:50:37.000000Z\", \"total_amount\": \"359997.00\", \"payment_method\": \"qris\", \"payment_status\": \"completed\", \"discount_amount\": \"36036.00\", \"transaction_code\": \"TXN202604237537NX\", \"discount_percentage\": \"10.00\"}', '{\"updated_at\": \"2026-04-23 09:05:07\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:05:07'),
(151, 1, 'updated', 'Transaction', 11, '{\"id\": 11, \"notes\": null, \"user_id\": 1, \"subtotal\": \"158688.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"16583.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": \"2025-11-05T01:03:19.000000Z\", \"total_amount\": \"167337.00\", \"payment_method\": \"e-wallet\", \"payment_status\": \"completed\", \"discount_amount\": \"7934.00\", \"transaction_code\": \"TXN202604233819RT\", \"discount_percentage\": \"5.00\"}', '{\"updated_at\": \"2026-04-23 09:05:08\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:05:08'),
(152, 1, 'updated', 'Transaction', 10, '{\"id\": 10, \"notes\": \"Distinctio nulla in quasi tempora qui.\", \"user_id\": 8, \"subtotal\": \"104928.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"10965.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": \"2026-04-14T23:45:27.000000Z\", \"total_amount\": \"110647.00\", \"payment_method\": \"qris\", \"payment_status\": \"completed\", \"discount_amount\": \"5246.00\", \"transaction_code\": \"TXN202604239988BI\", \"discount_percentage\": \"5.00\"}', '{\"updated_at\": \"2026-04-23 09:05:10\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:05:10'),
(153, 1, 'updated', 'Transaction', 9, '{\"id\": 9, \"notes\": null, \"user_id\": 10, \"subtotal\": \"241138.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"26525.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": \"2026-03-25T03:27:33.000000Z\", \"total_amount\": \"267663.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604232045BH\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-23 09:05:11\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:05:11'),
(154, 1, 'updated', 'Transaction', 6, '{\"id\": 6, \"notes\": \"Repellendus est ut sint eaque dolor sunt aut.\", \"user_id\": 7, \"subtotal\": \"389013.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"40652.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": \"2025-11-02T12:57:34.000000Z\", \"total_amount\": \"410214.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"19451.00\", \"transaction_code\": \"TXN202604238104QU\", \"discount_percentage\": \"5.00\"}', '{\"updated_at\": \"2026-04-23 09:05:13\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:05:13'),
(155, 1, 'updated', 'Transaction', 10, '{\"id\": 10, \"notes\": \"Distinctio nulla in quasi tempora qui.\", \"user_id\": 8, \"subtotal\": \"104928.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"10965.00\", \"updated_at\": \"2026-04-23T09:05:10.000000Z\", \"order_status\": \"preparing\", \"payment_date\": \"2026-04-14T23:45:27.000000Z\", \"total_amount\": \"110647.00\", \"payment_method\": \"qris\", \"payment_status\": \"completed\", \"discount_amount\": \"5246.00\", \"transaction_code\": \"TXN202604239988BI\", \"discount_percentage\": \"5.00\"}', '{\"updated_at\": \"2026-04-23 09:05:19\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:05:19'),
(156, 1, 'updated', 'Transaction', 6, '{\"id\": 6, \"notes\": \"Repellendus est ut sint eaque dolor sunt aut.\", \"user_id\": 7, \"subtotal\": \"389013.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"40652.00\", \"updated_at\": \"2026-04-23T09:05:13.000000Z\", \"order_status\": \"preparing\", \"payment_date\": \"2025-11-02T12:57:34.000000Z\", \"total_amount\": \"410214.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"19451.00\", \"transaction_code\": \"TXN202604238104QU\", \"discount_percentage\": \"5.00\"}', '{\"updated_at\": \"2026-04-23 09:05:20\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:05:20'),
(157, 13, 'updated', 'Transaction', 6, '{\"id\": 6, \"notes\": \"Repellendus est ut sint eaque dolor sunt aut.\", \"user_id\": 7, \"subtotal\": \"389013.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"40652.00\", \"updated_at\": \"2026-04-23T09:05:20.000000Z\", \"order_status\": \"ready\", \"payment_date\": \"2025-11-02T12:57:34.000000Z\", \"total_amount\": \"410214.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"19451.00\", \"transaction_code\": \"TXN202604238104QU\", \"discount_percentage\": \"5.00\"}', '{\"updated_at\": \"2026-04-23 09:06:47\", \"order_status\": \"served\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:06:47'),
(158, 13, 'updated', 'Transaction', 10, '{\"id\": 10, \"notes\": \"Distinctio nulla in quasi tempora qui.\", \"user_id\": 8, \"subtotal\": \"104928.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"10965.00\", \"updated_at\": \"2026-04-23T09:05:19.000000Z\", \"order_status\": \"ready\", \"payment_date\": \"2026-04-14T23:45:27.000000Z\", \"total_amount\": \"110647.00\", \"payment_method\": \"qris\", \"payment_status\": \"completed\", \"discount_amount\": \"5246.00\", \"transaction_code\": \"TXN202604239988BI\", \"discount_percentage\": \"5.00\"}', '{\"updated_at\": \"2026-04-23 09:06:49\", \"order_status\": \"served\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 02:06:49'),
(159, 1, 'updated', 'Transaction', 2, '{\"id\": 2, \"notes\": null, \"user_id\": 11, \"subtotal\": \"154646.00\", \"member_id\": 3, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"17011.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": null, \"total_amount\": \"171657.00\", \"payment_method\": \"qris\", \"payment_status\": \"cancelled\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604238972PE\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:54:16\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:54:16'),
(160, 1, 'updated', 'Transaction', 2, '{\"id\": 2, \"notes\": null, \"user_id\": 11, \"subtotal\": \"154646.00\", \"member_id\": 3, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"17011.00\", \"updated_at\": \"2026-04-24T02:54:16.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"171657.00\", \"payment_method\": \"qris\", \"payment_status\": \"cancelled\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604238972PE\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:54:21\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:54:21'),
(161, 1, 'updated', 'Transaction', 2, '{\"id\": 2, \"notes\": null, \"user_id\": 11, \"subtotal\": \"154646.00\", \"member_id\": 3, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"17011.00\", \"updated_at\": \"2026-04-24T02:54:21.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"171657.00\", \"payment_method\": \"qris\", \"payment_status\": \"cancelled\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604238972PE\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:54:27\", \"order_status\": \"served\", \"payment_date\": \"2026-04-24 02:54:27\", \"payment_status\": \"completed\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:54:27'),
(162, 1, 'updated', 'Transaction', 4, '{\"id\": 4, \"notes\": null, \"user_id\": 4, \"subtotal\": \"225348.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"24788.00\", \"updated_at\": \"2026-04-23T09:00:41.000000Z\", \"order_status\": \"preparing\", \"payment_date\": \"2026-01-10T09:11:52.000000Z\", \"total_amount\": \"250136.00\", \"payment_method\": \"card\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604236784HK\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:55:25\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:55:25'),
(163, 1, 'updated', 'Transaction', 9, '{\"id\": 9, \"notes\": null, \"user_id\": 10, \"subtotal\": \"241138.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"26525.00\", \"updated_at\": \"2026-04-23T09:05:11.000000Z\", \"order_status\": \"preparing\", \"payment_date\": \"2026-03-25T03:27:33.000000Z\", \"total_amount\": \"267663.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604232045BH\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:55:30\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:55:30'),
(164, 1, 'updated', 'Transaction', 16, '{\"id\": 16, \"notes\": null, \"user_id\": 5, \"subtotal\": \"462871.00\", \"member_id\": 3, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"45824.00\", \"updated_at\": \"2026-04-23T09:05:03.000000Z\", \"order_status\": \"preparing\", \"payment_date\": \"2026-04-20T00:04:01.000000Z\", \"total_amount\": \"462408.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"46287.00\", \"transaction_code\": \"TXN202604230482KG\", \"discount_percentage\": \"10.00\"}', '{\"updated_at\": \"2026-04-24 02:55:32\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:55:32'),
(165, 1, 'updated', 'Transaction', 13, '{\"id\": 13, \"notes\": null, \"user_id\": 6, \"subtotal\": \"163484.00\", \"member_id\": 5, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"16185.00\", \"updated_at\": \"2026-04-23T09:05:05.000000Z\", \"order_status\": \"preparing\", \"payment_date\": \"2025-11-05T13:10:41.000000Z\", \"total_amount\": \"163321.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"16348.00\", \"transaction_code\": \"TXN202604234127YR\", \"discount_percentage\": \"10.00\"}', '{\"updated_at\": \"2026-04-24 02:55:34\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:55:34'),
(166, 1, 'updated', 'Transaction', 12, '{\"id\": 12, \"notes\": null, \"user_id\": 3, \"subtotal\": \"360358.00\", \"member_id\": 5, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"35675.00\", \"updated_at\": \"2026-04-23T09:05:07.000000Z\", \"order_status\": \"preparing\", \"payment_date\": \"2026-01-03T10:50:37.000000Z\", \"total_amount\": \"359997.00\", \"payment_method\": \"qris\", \"payment_status\": \"completed\", \"discount_amount\": \"36036.00\", \"transaction_code\": \"TXN202604237537NX\", \"discount_percentage\": \"10.00\"}', '{\"updated_at\": \"2026-04-24 02:55:35\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:55:35'),
(167, 1, 'updated', 'Transaction', 11, '{\"id\": 11, \"notes\": null, \"user_id\": 1, \"subtotal\": \"158688.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"16583.00\", \"updated_at\": \"2026-04-23T09:05:08.000000Z\", \"order_status\": \"preparing\", \"payment_date\": \"2025-11-05T01:03:19.000000Z\", \"total_amount\": \"167337.00\", \"payment_method\": \"e-wallet\", \"payment_status\": \"completed\", \"discount_amount\": \"7934.00\", \"transaction_code\": \"TXN202604233819RT\", \"discount_percentage\": \"5.00\"}', '{\"updated_at\": \"2026-04-24 02:55:37\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:55:37'),
(168, 1, 'updated', 'Transaction', 4, '{\"id\": 4, \"notes\": null, \"user_id\": 4, \"subtotal\": \"225348.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"24788.00\", \"updated_at\": \"2026-04-24T02:55:25.000000Z\", \"order_status\": \"ready\", \"payment_date\": \"2026-01-10T09:11:52.000000Z\", \"total_amount\": \"250136.00\", \"payment_method\": \"card\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604236784HK\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:55:41\", \"order_status\": \"served\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:55:41'),
(169, 1, 'updated', 'Transaction', 9, '{\"id\": 9, \"notes\": null, \"user_id\": 10, \"subtotal\": \"241138.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"26525.00\", \"updated_at\": \"2026-04-24T02:55:30.000000Z\", \"order_status\": \"ready\", \"payment_date\": \"2026-03-25T03:27:33.000000Z\", \"total_amount\": \"267663.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604232045BH\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:55:52\", \"order_status\": \"served\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:55:52'),
(170, 1, 'updated', 'Transaction', 11, '{\"id\": 11, \"notes\": null, \"user_id\": 1, \"subtotal\": \"158688.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"16583.00\", \"updated_at\": \"2026-04-24T02:55:37.000000Z\", \"order_status\": \"ready\", \"payment_date\": \"2025-11-05T01:03:19.000000Z\", \"total_amount\": \"167337.00\", \"payment_method\": \"e-wallet\", \"payment_status\": \"completed\", \"discount_amount\": \"7934.00\", \"transaction_code\": \"TXN202604233819RT\", \"discount_percentage\": \"5.00\"}', '{\"updated_at\": \"2026-04-24 02:55:54\", \"order_status\": \"served\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:55:54'),
(171, 1, 'updated', 'Transaction', 3, '{\"id\": 3, \"notes\": \"Repudiandae animi ut soluta dolore impedit dignissimos exercitationem.\", \"user_id\": 5, \"subtotal\": \"367548.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"40430.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": null, \"total_amount\": \"407978.00\", \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604230212ST\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:09\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:09'),
(172, 1, 'updated', 'Transaction', 5, '{\"id\": 5, \"notes\": null, \"user_id\": 7, \"subtotal\": \"115216.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"12674.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": null, \"total_amount\": \"127890.00\", \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604237404GY\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:11\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:11'),
(173, 1, 'updated', 'Transaction', 7, '{\"id\": 7, \"notes\": null, \"user_id\": 8, \"subtotal\": \"27476.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"3022.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": null, \"total_amount\": \"30498.00\", \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604238067FY\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:13\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:13'),
(174, 1, 'updated', 'Transaction', 8, '{\"id\": 8, \"notes\": null, \"user_id\": 6, \"subtotal\": \"402191.00\", \"member_id\": 4, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"44241.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": null, \"total_amount\": \"446432.00\", \"payment_method\": \"card\", \"payment_status\": \"cancelled\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604231478BO\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:15\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:15'),
(175, 1, 'updated', 'Transaction', 12, '{\"id\": 12, \"notes\": null, \"user_id\": 3, \"subtotal\": \"360358.00\", \"member_id\": 5, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"35675.00\", \"updated_at\": \"2026-04-24T02:55:35.000000Z\", \"order_status\": \"ready\", \"payment_date\": \"2026-01-03T10:50:37.000000Z\", \"total_amount\": \"359997.00\", \"payment_method\": \"qris\", \"payment_status\": \"completed\", \"discount_amount\": \"36036.00\", \"transaction_code\": \"TXN202604237537NX\", \"discount_percentage\": \"10.00\"}', '{\"updated_at\": \"2026-04-24 02:56:18\", \"order_status\": \"served\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:18');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `model`, `model_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `created_at`) VALUES
(176, 1, 'updated', 'Transaction', 13, '{\"id\": 13, \"notes\": null, \"user_id\": 6, \"subtotal\": \"163484.00\", \"member_id\": 5, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"16185.00\", \"updated_at\": \"2026-04-24T02:55:34.000000Z\", \"order_status\": \"ready\", \"payment_date\": \"2025-11-05T13:10:41.000000Z\", \"total_amount\": \"163321.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"16348.00\", \"transaction_code\": \"TXN202604234127YR\", \"discount_percentage\": \"10.00\"}', '{\"updated_at\": \"2026-04-24 02:56:20\", \"order_status\": \"served\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:20'),
(177, 1, 'updated', 'Transaction', 27, '{\"id\": 27, \"notes\": null, \"user_id\": 13, \"subtotal\": \"25600.00\", \"member_id\": null, \"created_at\": \"2026-04-23T06:50:42.000000Z\", \"deleted_at\": null, \"tax_amount\": \"2560.00\", \"updated_at\": \"2026-04-23T06:50:42.000000Z\", \"order_status\": \"pending\", \"payment_date\": null, \"total_amount\": \"28160.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260423-00026\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:30\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:30'),
(178, 1, 'updated', 'Transaction', 23, '{\"id\": 23, \"notes\": null, \"user_id\": 1, \"subtotal\": \"82400.00\", \"member_id\": 1, \"created_at\": \"2026-04-23T04:11:54.000000Z\", \"deleted_at\": null, \"tax_amount\": \"8240.00\", \"updated_at\": \"2026-04-23T04:11:54.000000Z\", \"order_status\": \"pending\", \"payment_date\": null, \"total_amount\": \"90640.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260423-00022\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:32\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:32'),
(179, 1, 'updated', 'Transaction', 24, '{\"id\": 24, \"notes\": null, \"user_id\": 1, \"subtotal\": \"89400.00\", \"member_id\": 1, \"created_at\": \"2026-04-23T04:12:48.000000Z\", \"deleted_at\": null, \"tax_amount\": \"8940.00\", \"updated_at\": \"2026-04-23T04:12:48.000000Z\", \"order_status\": \"pending\", \"payment_date\": null, \"total_amount\": \"98340.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260423-00023\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:34\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:34'),
(180, 1, 'updated', 'Transaction', 25, '{\"id\": 25, \"notes\": null, \"user_id\": 1, \"subtotal\": \"89400.00\", \"member_id\": 1, \"created_at\": \"2026-04-23T04:13:48.000000Z\", \"deleted_at\": null, \"tax_amount\": \"8940.00\", \"updated_at\": \"2026-04-23T04:13:48.000000Z\", \"order_status\": \"pending\", \"payment_date\": null, \"total_amount\": \"98340.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260423-00024\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:35\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:35'),
(181, 1, 'updated', 'Transaction', 26, '{\"id\": 26, \"notes\": null, \"user_id\": 12, \"subtotal\": \"58000.00\", \"member_id\": 7, \"created_at\": \"2026-04-23T06:12:15.000000Z\", \"deleted_at\": null, \"tax_amount\": \"5220.00\", \"updated_at\": \"2026-04-23T06:12:15.000000Z\", \"order_status\": \"pending\", \"payment_date\": null, \"total_amount\": \"57420.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"5800.00\", \"transaction_code\": \"TRX-20260423-00025\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:37\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:37'),
(182, 1, 'updated', 'Transaction', 23, '{\"id\": 23, \"notes\": null, \"user_id\": 1, \"subtotal\": \"82400.00\", \"member_id\": 1, \"created_at\": \"2026-04-23T04:11:54.000000Z\", \"deleted_at\": null, \"tax_amount\": \"8240.00\", \"updated_at\": \"2026-04-24T02:56:32.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"90640.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260423-00022\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:42\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:42'),
(183, 1, 'updated', 'Transaction', 24, '{\"id\": 24, \"notes\": null, \"user_id\": 1, \"subtotal\": \"89400.00\", \"member_id\": 1, \"created_at\": \"2026-04-23T04:12:48.000000Z\", \"deleted_at\": null, \"tax_amount\": \"8940.00\", \"updated_at\": \"2026-04-24T02:56:34.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"98340.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260423-00023\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:43\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:43'),
(184, 1, 'updated', 'Transaction', 25, '{\"id\": 25, \"notes\": null, \"user_id\": 1, \"subtotal\": \"89400.00\", \"member_id\": 1, \"created_at\": \"2026-04-23T04:13:48.000000Z\", \"deleted_at\": null, \"tax_amount\": \"8940.00\", \"updated_at\": \"2026-04-24T02:56:35.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"98340.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260423-00024\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:45\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:45'),
(185, 1, 'updated', 'Transaction', 26, '{\"id\": 26, \"notes\": null, \"user_id\": 12, \"subtotal\": \"58000.00\", \"member_id\": 7, \"created_at\": \"2026-04-23T06:12:15.000000Z\", \"deleted_at\": null, \"tax_amount\": \"5220.00\", \"updated_at\": \"2026-04-24T02:56:37.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"57420.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"5800.00\", \"transaction_code\": \"TRX-20260423-00025\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:46\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:46'),
(186, 1, 'updated', 'Transaction', 27, '{\"id\": 27, \"notes\": null, \"user_id\": 13, \"subtotal\": \"25600.00\", \"member_id\": null, \"created_at\": \"2026-04-23T06:50:42.000000Z\", \"deleted_at\": null, \"tax_amount\": \"2560.00\", \"updated_at\": \"2026-04-24T02:56:30.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"28160.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260423-00026\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:48\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:48'),
(187, 1, 'updated', 'Transaction', 23, '{\"id\": 23, \"notes\": null, \"user_id\": 1, \"subtotal\": \"82400.00\", \"member_id\": 1, \"created_at\": \"2026-04-23T04:11:54.000000Z\", \"deleted_at\": null, \"tax_amount\": \"8240.00\", \"updated_at\": \"2026-04-24T02:56:42.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"90640.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260423-00022\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:52\", \"order_status\": \"served\", \"payment_date\": \"2026-04-24 02:56:52\", \"payment_status\": \"completed\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:52'),
(188, 1, 'updated', 'Transaction', 24, '{\"id\": 24, \"notes\": null, \"user_id\": 1, \"subtotal\": \"89400.00\", \"member_id\": 1, \"created_at\": \"2026-04-23T04:12:48.000000Z\", \"deleted_at\": null, \"tax_amount\": \"8940.00\", \"updated_at\": \"2026-04-24T02:56:43.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"98340.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260423-00023\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:54\", \"order_status\": \"served\", \"payment_date\": \"2026-04-24 02:56:54\", \"payment_status\": \"completed\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:54'),
(189, 1, 'updated', 'Transaction', 25, '{\"id\": 25, \"notes\": null, \"user_id\": 1, \"subtotal\": \"89400.00\", \"member_id\": 1, \"created_at\": \"2026-04-23T04:13:48.000000Z\", \"deleted_at\": null, \"tax_amount\": \"8940.00\", \"updated_at\": \"2026-04-24T02:56:45.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"98340.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260423-00024\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:55\", \"order_status\": \"served\", \"payment_date\": \"2026-04-24 02:56:55\", \"payment_status\": \"completed\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:55'),
(190, 1, 'updated', 'Transaction', 26, '{\"id\": 26, \"notes\": null, \"user_id\": 12, \"subtotal\": \"58000.00\", \"member_id\": 7, \"created_at\": \"2026-04-23T06:12:15.000000Z\", \"deleted_at\": null, \"tax_amount\": \"5220.00\", \"updated_at\": \"2026-04-24T02:56:46.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"57420.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"5800.00\", \"transaction_code\": \"TRX-20260423-00025\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:57\", \"order_status\": \"served\", \"payment_date\": \"2026-04-24 02:56:57\", \"payment_status\": \"completed\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:57'),
(191, 1, 'updated', 'Transaction', 27, '{\"id\": 27, \"notes\": null, \"user_id\": 13, \"subtotal\": \"25600.00\", \"member_id\": null, \"created_at\": \"2026-04-23T06:50:42.000000Z\", \"deleted_at\": null, \"tax_amount\": \"2560.00\", \"updated_at\": \"2026-04-24T02:56:48.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"28160.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260423-00026\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:56:59\", \"order_status\": \"served\", \"payment_date\": \"2026-04-24 02:56:59\", \"payment_status\": \"completed\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:56:59'),
(192, 1, 'updated', 'Transaction', 3, '{\"id\": 3, \"notes\": \"Repudiandae animi ut soluta dolore impedit dignissimos exercitationem.\", \"user_id\": 5, \"subtotal\": \"367548.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"40430.00\", \"updated_at\": \"2026-04-24T02:56:09.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"407978.00\", \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604230212ST\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:57:05\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:57:05'),
(193, 1, 'updated', 'Transaction', 5, '{\"id\": 5, \"notes\": null, \"user_id\": 7, \"subtotal\": \"115216.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"12674.00\", \"updated_at\": \"2026-04-24T02:56:11.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"127890.00\", \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604237404GY\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:57:07\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:57:07'),
(194, 1, 'updated', 'Transaction', 7, '{\"id\": 7, \"notes\": null, \"user_id\": 8, \"subtotal\": \"27476.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"3022.00\", \"updated_at\": \"2026-04-24T02:56:13.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"30498.00\", \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604238067FY\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:57:09\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:57:09'),
(195, 1, 'updated', 'Transaction', 8, '{\"id\": 8, \"notes\": null, \"user_id\": 6, \"subtotal\": \"402191.00\", \"member_id\": 4, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"44241.00\", \"updated_at\": \"2026-04-24T02:56:15.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"446432.00\", \"payment_method\": \"card\", \"payment_status\": \"cancelled\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604231478BO\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:57:11\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:57:11'),
(196, 1, 'updated', 'Transaction', 17, '{\"id\": 17, \"notes\": null, \"user_id\": 1, \"subtotal\": \"192784.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"21206.00\", \"updated_at\": \"2026-04-23T09:05:01.000000Z\", \"order_status\": \"preparing\", \"payment_date\": \"2026-04-08T03:58:26.000000Z\", \"total_amount\": \"213990.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604231827IC\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 02:57:14\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 19:57:14'),
(197, 12, 'updated', 'Transaction', 3, '{\"id\": 3, \"notes\": \"Repudiandae animi ut soluta dolore impedit dignissimos exercitationem.\", \"user_id\": 5, \"subtotal\": \"367548.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"40430.00\", \"updated_at\": \"2026-04-24T02:57:05.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"407978.00\", \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604230212ST\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:06:24\", \"order_status\": \"served\", \"payment_date\": \"2026-04-24 03:06:24\", \"payment_status\": \"completed\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:06:24'),
(198, 12, 'updated', 'Transaction', 5, '{\"id\": 5, \"notes\": null, \"user_id\": 7, \"subtotal\": \"115216.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"12674.00\", \"updated_at\": \"2026-04-24T02:57:07.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"127890.00\", \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604237404GY\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:06:26\", \"order_status\": \"served\", \"payment_date\": \"2026-04-24 03:06:26\", \"payment_status\": \"completed\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:06:26'),
(199, 12, 'updated', 'Transaction', 7, '{\"id\": 7, \"notes\": null, \"user_id\": 8, \"subtotal\": \"27476.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"3022.00\", \"updated_at\": \"2026-04-24T02:57:09.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"30498.00\", \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604238067FY\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:06:28\", \"order_status\": \"served\", \"payment_date\": \"2026-04-24 03:06:28\", \"payment_status\": \"completed\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:06:28'),
(200, 12, 'updated', 'Transaction', 8, '{\"id\": 8, \"notes\": null, \"user_id\": 6, \"subtotal\": \"402191.00\", \"member_id\": 4, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"44241.00\", \"updated_at\": \"2026-04-24T02:57:11.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"446432.00\", \"payment_method\": \"card\", \"payment_status\": \"cancelled\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604231478BO\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:06:31\", \"order_status\": \"served\", \"payment_date\": \"2026-04-24 03:06:31\", \"payment_status\": \"completed\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:06:31'),
(201, 12, 'created', 'Transaction', 28, NULL, '{\"id\": 28, \"notes\": \"Meja 10 Less Sugar\", \"user_id\": 12, \"subtotal\": 25600, \"member_id\": null, \"created_at\": \"2026-04-24 03:14:12\", \"tax_amount\": 2560, \"updated_at\": \"2026-04-24 03:14:12\", \"order_status\": \"preparing\", \"total_amount\": 28160, \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": 0, \"transaction_code\": \"TRX-20260424-00001\", \"discount_percentage\": 0}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:14:12'),
(202, 12, 'updated', 'Product', 1, '{\"id\": 1, \"sku\": \"SKU-9526-MT\", \"name\": \"Triple Cappuccino #7165\", \"image\": null, \"stock\": 26, \"is_active\": true, \"min_stock\": 7, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 10, \"deleted_at\": null, \"sell_price\": \"25600.00\", \"updated_at\": \"2026-04-23T06:50:42.000000Z\", \"category_id\": 8, \"description\": \"Est quas non consequuntur velit quia ab.\", \"purchase_price\": \"12381.00\"}', '{\"stock\": 25, \"updated_at\": \"2026-04-24 03:14:12\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:14:12'),
(203, 12, 'updated', 'Transaction', 28, '{\"id\": 28, \"notes\": \"Meja 10 Less Sugar\", \"user_id\": 12, \"subtotal\": \"25600.00\", \"member_id\": null, \"created_at\": \"2026-04-24T03:14:12.000000Z\", \"deleted_at\": null, \"tax_amount\": \"2560.00\", \"updated_at\": \"2026-04-24T03:14:12.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"28160.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260424-00001\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:14:44\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:14:44'),
(204, 12, 'updated', 'Transaction', 28, '{\"id\": 28, \"notes\": \"Meja 10 Less Sugar\", \"user_id\": 12, \"subtotal\": \"25600.00\", \"member_id\": null, \"created_at\": \"2026-04-24T03:14:12.000000Z\", \"deleted_at\": null, \"tax_amount\": \"2560.00\", \"updated_at\": \"2026-04-24T03:14:44.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"28160.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260424-00001\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:14:52\", \"order_status\": \"served\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:14:52'),
(205, 12, 'updated', 'Transaction', 15, '{\"id\": 15, \"notes\": null, \"user_id\": 4, \"subtotal\": \"131521.00\", \"member_id\": 3, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"14467.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": null, \"total_amount\": \"145988.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604237274XJ\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:15:05\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:05'),
(206, 12, 'updated', 'Transaction', 16, '{\"id\": 16, \"notes\": null, \"user_id\": 5, \"subtotal\": \"462871.00\", \"member_id\": 3, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"45824.00\", \"updated_at\": \"2026-04-24T02:55:32.000000Z\", \"order_status\": \"ready\", \"payment_date\": \"2026-04-20T00:04:01.000000Z\", \"total_amount\": \"462408.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"46287.00\", \"transaction_code\": \"TXN202604230482KG\", \"discount_percentage\": \"10.00\"}', '{\"updated_at\": \"2026-04-24 03:15:07\", \"order_status\": \"served\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:07'),
(207, 12, 'updated', 'Transaction', 17, '{\"id\": 17, \"notes\": null, \"user_id\": 1, \"subtotal\": \"192784.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"21206.00\", \"updated_at\": \"2026-04-24T02:57:14.000000Z\", \"order_status\": \"ready\", \"payment_date\": \"2026-04-08T03:58:26.000000Z\", \"total_amount\": \"213990.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604231827IC\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:15:09\", \"order_status\": \"served\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:09'),
(208, 12, 'updated', 'Transaction', 18, '{\"id\": 18, \"notes\": null, \"user_id\": 1, \"subtotal\": \"239893.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"26388.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": null, \"total_amount\": \"266281.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604230055WP\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:15:11\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:11'),
(209, 12, 'updated', 'Transaction', 19, '{\"id\": 19, \"notes\": null, \"user_id\": 7, \"subtotal\": \"181052.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"18920.00\", \"updated_at\": \"2026-04-23T09:04:59.000000Z\", \"order_status\": \"preparing\", \"payment_date\": \"2026-04-16T12:16:12.000000Z\", \"total_amount\": \"190919.00\", \"payment_method\": \"qris\", \"payment_status\": \"completed\", \"discount_amount\": \"9053.00\", \"transaction_code\": \"TXN202604236767PY\", \"discount_percentage\": \"5.00\"}', '{\"updated_at\": \"2026-04-24 03:15:12\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:12'),
(210, 12, 'updated', 'Transaction', 20, '{\"id\": 20, \"notes\": null, \"user_id\": 6, \"subtotal\": \"498692.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"54856.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": null, \"total_amount\": \"553548.00\", \"payment_method\": \"e-wallet\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604237561DG\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:15:14\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:14'),
(211, 12, 'updated', 'Transaction', 22, '{\"id\": 22, \"notes\": null, \"user_id\": 1, \"subtotal\": \"82400.00\", \"member_id\": 1, \"created_at\": \"2026-04-23T04:10:57.000000Z\", \"deleted_at\": null, \"tax_amount\": \"8240.00\", \"updated_at\": \"2026-04-23T04:10:57.000000Z\", \"order_status\": \"pending\", \"payment_date\": null, \"total_amount\": \"90640.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260423-00021\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:15:16\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:16'),
(212, 12, 'updated', 'Transaction', 22, '{\"id\": 22, \"notes\": null, \"user_id\": 1, \"subtotal\": \"82400.00\", \"member_id\": 1, \"created_at\": \"2026-04-23T04:10:57.000000Z\", \"deleted_at\": null, \"tax_amount\": \"8240.00\", \"updated_at\": \"2026-04-24T03:15:16.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"90640.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260423-00021\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:15:25\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:25'),
(213, 12, 'updated', 'Transaction', 20, '{\"id\": 20, \"notes\": null, \"user_id\": 6, \"subtotal\": \"498692.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"54856.00\", \"updated_at\": \"2026-04-24T03:15:14.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"553548.00\", \"payment_method\": \"e-wallet\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604237561DG\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:15:26\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:26'),
(214, 12, 'updated', 'Transaction', 19, '{\"id\": 19, \"notes\": null, \"user_id\": 7, \"subtotal\": \"181052.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"18920.00\", \"updated_at\": \"2026-04-24T03:15:12.000000Z\", \"order_status\": \"ready\", \"payment_date\": \"2026-04-16T12:16:12.000000Z\", \"total_amount\": \"190919.00\", \"payment_method\": \"qris\", \"payment_status\": \"completed\", \"discount_amount\": \"9053.00\", \"transaction_code\": \"TXN202604236767PY\", \"discount_percentage\": \"5.00\"}', '{\"updated_at\": \"2026-04-24 03:15:28\", \"order_status\": \"served\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:28'),
(215, 12, 'updated', 'Transaction', 18, '{\"id\": 18, \"notes\": null, \"user_id\": 1, \"subtotal\": \"239893.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"26388.00\", \"updated_at\": \"2026-04-24T03:15:11.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"266281.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604230055WP\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:15:30\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:30'),
(216, 12, 'updated', 'Transaction', 15, '{\"id\": 15, \"notes\": null, \"user_id\": 4, \"subtotal\": \"131521.00\", \"member_id\": 3, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"14467.00\", \"updated_at\": \"2026-04-24T03:15:05.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"145988.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604237274XJ\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:15:31\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:31'),
(217, 12, 'updated', 'Transaction', 14, '{\"id\": 14, \"notes\": null, \"user_id\": 11, \"subtotal\": \"482717.00\", \"member_id\": 3, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"47789.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"order_status\": \"pending\", \"payment_date\": null, \"total_amount\": \"482234.00\", \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": \"48272.00\", \"transaction_code\": \"TXN202604233686WF\", \"discount_percentage\": \"10.00\"}', '{\"updated_at\": \"2026-04-24 03:15:33\", \"order_status\": \"preparing\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:33'),
(218, 12, 'updated', 'Transaction', 15, '{\"id\": 15, \"notes\": null, \"user_id\": 4, \"subtotal\": \"131521.00\", \"member_id\": 3, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"14467.00\", \"updated_at\": \"2026-04-24T03:15:31.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"145988.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604237274XJ\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:15:39\", \"order_status\": \"served\", \"payment_date\": \"2026-04-24 03:15:39\", \"payment_status\": \"completed\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:39'),
(219, 12, 'updated', 'Transaction', 18, '{\"id\": 18, \"notes\": null, \"user_id\": 1, \"subtotal\": \"239893.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"26388.00\", \"updated_at\": \"2026-04-24T03:15:30.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"266281.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604230055WP\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:15:41\", \"order_status\": \"served\", \"payment_date\": \"2026-04-24 03:15:41\", \"payment_status\": \"completed\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:41'),
(220, 12, 'updated', 'Transaction', 20, '{\"id\": 20, \"notes\": null, \"user_id\": 6, \"subtotal\": \"498692.00\", \"member_id\": null, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"54856.00\", \"updated_at\": \"2026-04-24T03:15:26.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"553548.00\", \"payment_method\": \"e-wallet\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TXN202604237561DG\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:15:42\", \"order_status\": \"served\", \"payment_date\": \"2026-04-24 03:15:42\", \"payment_status\": \"completed\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:42'),
(221, 12, 'updated', 'Transaction', 22, '{\"id\": 22, \"notes\": null, \"user_id\": 1, \"subtotal\": \"82400.00\", \"member_id\": 1, \"created_at\": \"2026-04-23T04:10:57.000000Z\", \"deleted_at\": null, \"tax_amount\": \"8240.00\", \"updated_at\": \"2026-04-24T03:15:25.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"90640.00\", \"payment_method\": \"cash\", \"payment_status\": \"pending\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260423-00021\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:15:44\", \"order_status\": \"served\", \"payment_date\": \"2026-04-24 03:15:44\", \"payment_status\": \"completed\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:15:44'),
(222, 12, 'updated', 'Transaction', 14, '{\"id\": 14, \"notes\": null, \"user_id\": 11, \"subtotal\": \"482717.00\", \"member_id\": 3, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"47789.00\", \"updated_at\": \"2026-04-24T03:15:33.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"482234.00\", \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": \"48272.00\", \"transaction_code\": \"TXN202604233686WF\", \"discount_percentage\": \"10.00\"}', '{\"updated_at\": \"2026-04-24 03:16:04\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:16:04'),
(223, 12, 'updated', 'Transaction', 14, '{\"id\": 14, \"notes\": null, \"user_id\": 11, \"subtotal\": \"482717.00\", \"member_id\": 3, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"deleted_at\": null, \"tax_amount\": \"47789.00\", \"updated_at\": \"2026-04-24T03:16:04.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"482234.00\", \"payment_method\": \"cash\", \"payment_status\": \"cancelled\", \"discount_amount\": \"48272.00\", \"transaction_code\": \"TXN202604233686WF\", \"discount_percentage\": \"10.00\"}', '{\"updated_at\": \"2026-04-24 03:16:09\", \"order_status\": \"served\", \"payment_date\": \"2026-04-24 03:16:09\", \"payment_status\": \"completed\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:16:09'),
(224, 13, 'created', 'Transaction', 29, NULL, '{\"id\": 29, \"notes\": \"Meja 12\", \"user_id\": 13, \"subtotal\": 74900, \"member_id\": \"7\", \"created_at\": \"2026-04-24 03:17:53\", \"tax_amount\": 7490, \"updated_at\": \"2026-04-24 03:17:53\", \"order_status\": \"preparing\", \"total_amount\": 82390, \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": 0, \"transaction_code\": \"TRX-20260424-00002\", \"discount_percentage\": \"0.00\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:17:53'),
(225, 13, 'updated', 'Product', 3, '{\"id\": 3, \"sku\": \"SKU-7568-ID\", \"name\": \"Original Salad #9440\", \"image\": null, \"stock\": 83, \"is_active\": true, \"min_stock\": 15, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 8, \"deleted_at\": null, \"sell_price\": \"22200.00\", \"updated_at\": \"2026-04-23T04:13:49.000000Z\", \"category_id\": 5, \"description\": \"In officia necessitatibus nulla et in accusamus voluptatum nesciunt est sit beatae odio minima et.\", \"purchase_price\": \"11248.00\"}', '{\"stock\": 82, \"updated_at\": \"2026-04-24 03:17:53\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:17:53'),
(226, 13, 'updated', 'Product', 4, '{\"id\": 4, \"sku\": \"SKU-0577-WN\", \"name\": \"Double Toast #7393\", \"image\": null, \"stock\": 62, \"is_active\": true, \"min_stock\": 9, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 10, \"deleted_at\": null, \"sell_price\": \"34600.00\", \"updated_at\": \"2026-04-23T04:13:49.000000Z\", \"category_id\": 8, \"description\": \"Mollitia saepe omnis beatae recusandae numquam hic ut voluptas et non odit sint.\", \"purchase_price\": \"21070.00\"}', '{\"stock\": 61, \"updated_at\": \"2026-04-24 03:17:53\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:17:53'),
(227, 13, 'updated', 'Product', 11, '{\"id\": 11, \"sku\": \"SKU-7308-ZN\", \"name\": \"Signature Americano #1851\", \"image\": null, \"stock\": 6, \"is_active\": true, \"min_stock\": 3, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 9, \"deleted_at\": null, \"sell_price\": \"18100.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"category_id\": 4, \"description\": \"Quibusdam atque voluptatibus rerum laborum ut quod.\", \"purchase_price\": \"10654.00\"}', '{\"stock\": 5, \"updated_at\": \"2026-04-24 03:17:53\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:17:53'),
(228, 13, 'updated', 'Member', 7, '{\"id\": 7, \"user_id\": 16, \"is_active\": true, \"created_at\": \"2026-04-23T05:18:08.000000Z\", \"updated_at\": \"2026-04-23T06:12:15.000000Z\", \"member_code\": \"MBR-VWPBY84M\", \"total_spent\": \"57420.00\", \"member_email\": \"josep@example.com\", \"member_phone\": \"081234567891\", \"points_balance\": 57, \"discount_percentage\": \"0.00\"}', '{\"total_spent\": 139810}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:17:53'),
(229, 13, 'updated', 'Member', 7, '{\"id\": 7, \"user_id\": 16, \"is_active\": true, \"created_at\": \"2026-04-23T05:18:08.000000Z\", \"updated_at\": \"2026-04-23T06:12:15.000000Z\", \"member_code\": \"MBR-VWPBY84M\", \"total_spent\": \"139810.00\", \"member_email\": \"josep@example.com\", \"member_phone\": \"081234567891\", \"points_balance\": 57, \"discount_percentage\": \"0.00\"}', '{\"points_balance\": 139}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:17:53'),
(230, 13, 'updated', 'Transaction', 29, '{\"id\": 29, \"notes\": \"Meja 12\", \"user_id\": 13, \"subtotal\": \"74900.00\", \"member_id\": 7, \"created_at\": \"2026-04-24T03:17:53.000000Z\", \"deleted_at\": null, \"tax_amount\": \"7490.00\", \"updated_at\": \"2026-04-24T03:17:53.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"82390.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260424-00002\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:30:21\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:30:21'),
(231, 13, 'updated', 'Transaction', 29, '{\"id\": 29, \"notes\": \"Meja 12\", \"user_id\": 13, \"subtotal\": \"74900.00\", \"member_id\": 7, \"created_at\": \"2026-04-24T03:17:53.000000Z\", \"deleted_at\": null, \"tax_amount\": \"7490.00\", \"updated_at\": \"2026-04-24T03:30:21.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"82390.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260424-00002\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 03:30:34\", \"order_status\": \"served\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:30:34'),
(232, 1, 'deleted', 'User', 15, '{\"id\": 15, \"name\": \"Budi Santoso\", \"role\": \"member\", \"email\": \"budi@example.com\", \"phone\": null, \"address\": null, \"is_active\": 1, \"created_at\": \"2026-04-23 05:10:01\", \"updated_at\": \"2026-04-23 05:10:01\", \"email_verified_at\": null}', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:40:00'),
(233, 1, 'deleted', 'Member', 6, '{\"id\": 6, \"user_id\": 15, \"is_active\": 0, \"created_at\": \"2026-04-23 05:10:01\", \"updated_at\": \"2026-04-23 05:10:01\", \"member_code\": \"MBR-XTR1OVIR\", \"total_spent\": \"0.00\", \"member_email\": \"budi@example.com\", \"member_phone\": \"081234567890\", \"points_balance\": 0, \"discount_percentage\": \"10.00\"}', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 20:40:00'),
(234, 13, 'created', 'Transaction', 30, NULL, '{\"id\": 30, \"notes\": \"Meja 1 add sauce\", \"user_id\": 13, \"subtotal\": 45000, \"member_id\": null, \"created_at\": \"2026-04-24 05:38:28\", \"tax_amount\": 4500, \"updated_at\": \"2026-04-24 05:38:28\", \"order_status\": \"preparing\", \"total_amount\": 49500, \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": 0, \"transaction_code\": \"TRX-20260424-00003\", \"discount_percentage\": 0}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:38:28'),
(235, 13, 'updated', 'Product', 50, '{\"id\": 50, \"sku\": \"SKU-3613-YT\", \"name\": \"Original Muffin #5722\", \"image\": null, \"stock\": 23, \"is_active\": true, \"min_stock\": 12, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 2, \"deleted_at\": null, \"sell_price\": \"12400.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"category_id\": 1, \"description\": \"Et voluptas dolore sit dolores voluptatum sit enim voluptates itaque ut temporibus alias non.\", \"purchase_price\": \"7444.00\"}', '{\"stock\": 22, \"updated_at\": \"2026-04-24 05:38:28\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:38:28'),
(236, 13, 'updated', 'Product', 28, '{\"id\": 28, \"sku\": \"SKU-3200-HU\", \"name\": \"Original Toast #6936\", \"image\": null, \"stock\": 52, \"is_active\": true, \"min_stock\": 6, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 2, \"deleted_at\": null, \"sell_price\": \"17600.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"category_id\": 6, \"description\": \"Quos adipisci voluptatibus ducimus voluptatem est omnis soluta fugiat ducimus dolore.\", \"purchase_price\": \"9808.00\"}', '{\"stock\": 51, \"updated_at\": \"2026-04-24 05:38:28\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:38:28'),
(237, 13, 'updated', 'Product', 31, '{\"id\": 31, \"sku\": \"SKU-2961-SU\", \"name\": \"Iced Macchiato #5564\", \"image\": null, \"stock\": 30, \"is_active\": true, \"min_stock\": 10, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 8, \"deleted_at\": null, \"sell_price\": \"15000.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"category_id\": 1, \"description\": \"Pariatur consectetur ut velit rerum iste sapiente dolore nihil aperiam deserunt a reprehenderit voluptates.\", \"purchase_price\": \"8774.00\"}', '{\"stock\": 29, \"updated_at\": \"2026-04-24 05:38:28\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:38:28'),
(238, 13, 'updated', 'Transaction', 30, '{\"id\": 30, \"notes\": \"Meja 1 add sauce\", \"user_id\": 13, \"subtotal\": \"45000.00\", \"member_id\": null, \"created_at\": \"2026-04-24T05:38:28.000000Z\", \"deleted_at\": null, \"tax_amount\": \"4500.00\", \"updated_at\": \"2026-04-24T05:38:28.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"49500.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260424-00003\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 05:39:04\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:39:04'),
(239, 13, 'updated', 'Transaction', 30, '{\"id\": 30, \"notes\": \"Meja 1 add sauce\", \"user_id\": 13, \"subtotal\": \"45000.00\", \"member_id\": null, \"created_at\": \"2026-04-24T05:38:28.000000Z\", \"deleted_at\": null, \"tax_amount\": \"4500.00\", \"updated_at\": \"2026-04-24T05:39:04.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"49500.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"0.00\", \"transaction_code\": \"TRX-20260424-00003\", \"discount_percentage\": \"0.00\"}', '{\"updated_at\": \"2026-04-24 05:39:29\", \"order_status\": \"served\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:39:29'),
(240, 13, 'created', 'User', 18, NULL, '{\"id\": 18, \"name\": \"Catur Sugi\", \"role\": \"user\", \"email\": \"085931457831@brancoffee.member\", \"phone\": \"085931457831\", \"address\": \"Medayu Rt 01 Rw 03 Kec wanadadi Kab Banjarnegara\", \"is_active\": true, \"created_at\": \"2026-04-24 05:39:58\", \"updated_at\": \"2026-04-24 05:39:58\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:39:58'),
(241, 13, 'created', 'Member', 9, NULL, '{\"id\": 9, \"user_id\": 18, \"is_active\": true, \"created_at\": \"2026-04-24 05:39:58\", \"updated_at\": \"2026-04-24 05:39:58\", \"member_code\": \"MBR-00007\", \"member_phone\": \"085931457831\", \"discount_percentage\": 5}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:39:58');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `model`, `model_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `created_at`) VALUES
(242, 13, 'created', 'Transaction', 31, NULL, '{\"id\": 31, \"notes\": \"Meja 2\", \"user_id\": 13, \"subtotal\": 115400, \"member_id\": \"9\", \"created_at\": \"2026-04-24 05:41:54\", \"tax_amount\": 10963, \"updated_at\": \"2026-04-24 05:41:54\", \"order_status\": \"preparing\", \"total_amount\": 120593, \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": 5770, \"transaction_code\": \"TRX-20260424-00004\", \"discount_percentage\": \"5.00\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:41:54'),
(243, 13, 'updated', 'Product', 23, '{\"id\": 23, \"sku\": \"SKU-8010-GX\", \"name\": \"Iced Chamomile Tea #3729\", \"image\": null, \"stock\": 70, \"is_active\": true, \"min_stock\": 4, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 10, \"deleted_at\": null, \"sell_price\": \"24000.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"category_id\": 8, \"description\": \"Repellendus voluptatem natus numquam illum molestias voluptatem laborum eum.\", \"purchase_price\": \"16109.00\"}', '{\"stock\": 68, \"updated_at\": \"2026-04-24 05:41:54\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:41:54'),
(244, 13, 'updated', 'Product', 3, '{\"id\": 3, \"sku\": \"SKU-7568-ID\", \"name\": \"Original Salad #9440\", \"image\": null, \"stock\": 82, \"is_active\": true, \"min_stock\": 15, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 8, \"deleted_at\": null, \"sell_price\": \"22200.00\", \"updated_at\": \"2026-04-24T03:17:53.000000Z\", \"category_id\": 5, \"description\": \"In officia necessitatibus nulla et in accusamus voluptatum nesciunt est sit beatae odio minima et.\", \"purchase_price\": \"11248.00\"}', '{\"stock\": 81, \"updated_at\": \"2026-04-24 05:41:54\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:41:54'),
(245, 13, 'updated', 'Product', 19, '{\"id\": 19, \"sku\": \"SKU-4896-OX\", \"name\": \"Hot Cheesecake #8401\", \"image\": null, \"stock\": 5, \"is_active\": true, \"min_stock\": 12, \"created_at\": \"2026-04-23T02:32:14.000000Z\", \"created_by\": 7, \"deleted_at\": null, \"sell_price\": \"45200.00\", \"updated_at\": \"2026-04-23T02:32:14.000000Z\", \"category_id\": 5, \"description\": \"Vel nihil exercitationem dolore voluptatem tempora culpa.\", \"purchase_price\": \"23689.00\"}', '{\"stock\": 4, \"updated_at\": \"2026-04-24 05:41:54\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:41:54'),
(246, 13, 'updated', 'Member', 9, '{\"id\": 9, \"user_id\": 18, \"is_active\": true, \"created_at\": \"2026-04-24T05:39:58.000000Z\", \"deleted_at\": null, \"updated_at\": \"2026-04-24T05:39:58.000000Z\", \"member_code\": \"MBR-00007\", \"total_spent\": \"0.00\", \"member_email\": null, \"member_phone\": \"085931457831\", \"points_balance\": 0, \"discount_percentage\": \"5.00\"}', '{\"total_spent\": 120593}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:41:54'),
(247, 13, 'updated', 'Member', 9, '{\"id\": 9, \"user_id\": 18, \"is_active\": true, \"created_at\": \"2026-04-24T05:39:58.000000Z\", \"deleted_at\": null, \"updated_at\": \"2026-04-24T05:39:58.000000Z\", \"member_code\": \"MBR-00007\", \"total_spent\": \"120593.00\", \"member_email\": null, \"member_phone\": \"085931457831\", \"points_balance\": 0, \"discount_percentage\": \"5.00\"}', '{\"points_balance\": 120}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:41:54'),
(248, 13, 'updated', 'Transaction', 31, '{\"id\": 31, \"notes\": \"Meja 2\", \"user_id\": 13, \"subtotal\": \"115400.00\", \"member_id\": 9, \"created_at\": \"2026-04-24T05:41:54.000000Z\", \"deleted_at\": null, \"tax_amount\": \"10963.00\", \"updated_at\": \"2026-04-24T05:41:54.000000Z\", \"order_status\": \"preparing\", \"payment_date\": null, \"total_amount\": \"120593.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"5770.00\", \"transaction_code\": \"TRX-20260424-00004\", \"discount_percentage\": \"5.00\"}', '{\"updated_at\": \"2026-04-24 05:42:12\", \"order_status\": \"ready\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:42:12'),
(249, 13, 'updated', 'Transaction', 31, '{\"id\": 31, \"notes\": \"Meja 2\", \"user_id\": 13, \"subtotal\": \"115400.00\", \"member_id\": 9, \"created_at\": \"2026-04-24T05:41:54.000000Z\", \"deleted_at\": null, \"tax_amount\": \"10963.00\", \"updated_at\": \"2026-04-24T05:42:12.000000Z\", \"order_status\": \"ready\", \"payment_date\": null, \"total_amount\": \"120593.00\", \"payment_method\": \"cash\", \"payment_status\": \"completed\", \"discount_amount\": \"5770.00\", \"transaction_code\": \"TRX-20260424-00004\", \"discount_percentage\": \"5.00\"}', '{\"updated_at\": \"2026-04-24 05:42:38\", \"order_status\": \"served\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 22:42:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `invoice_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `printed_at` timestamp NULL DEFAULT NULL,
  `print_count` int NOT NULL DEFAULT '0',
  `printer_type` enum('thermal','bluetooth','pdf') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'thermal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `transaction_id`, `invoice_number`, `printed_at`, `print_count`, `printer_type`, `created_at`, `updated_at`) VALUES
(1, 29, 'TRX-20260424-00002', '2026-04-23 20:22:21', 1, 'pdf', '2026-04-23 20:22:21', '2026-04-23 20:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `member_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_percentage` decimal(5,2) NOT NULL DEFAULT '0.00',
  `points_balance` int NOT NULL DEFAULT '0',
  `total_spent` decimal(12,2) NOT NULL DEFAULT '0.00',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `user_id`, `member_code`, `member_phone`, `member_email`, `discount_percentage`, `points_balance`, `total_spent`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 'MBR346CM', '087785599198', 'ernestina89@example.com', '15.00', 644, '8129464.00', 1, '2026-04-22 19:32:14', '2026-04-22 22:15:16', NULL),
(2, 10, 'MBR923FA', '087216135588', 'leola88@example.com', '0.00', 103, '7499957.00', 1, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(3, 9, 'MBR267PX', '086738646895', 'vthompson@example.com', '10.00', 420, '2879760.00', 1, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(4, 1, 'MBR146JO', '083959586123', 'admin@brancoffee.com', '2.00', 92, '3998688.00', 0, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(5, 5, 'MBR915UV', '088981149472', 'cfeil@example.com', '5.00', 497, '7501606.00', 0, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(7, 16, 'MBR-VWPBY84M', '081234567891', 'josep@example.com', '0.00', 139, '139810.00', 1, '2026-04-22 22:18:08', '2026-04-23 20:17:53', NULL),
(9, 18, 'MBR-00007', '085931457831', NULL, '5.00', 120, '120593.00', 1, '2026-04-23 22:39:58', '2026-04-23 22:41:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_01_000002_create_members_table', 1),
(6, '2024_01_01_000003_create_product_categories_table', 1),
(7, '2024_01_01_000004_create_products_table', 1),
(8, '2024_01_01_000005_create_transactions_table', 1),
(9, '2024_01_01_000006_create_transaction_details_table', 1),
(10, '2024_01_01_000007_create_promotions_table', 1),
(11, '2024_01_01_000008_create_invoices_table', 1),
(12, '2024_01_01_000009_create_posts_table', 1),
(13, '2024_01_01_000010_create_audit_logs_table', 1),
(14, '2024_01_01_000011_create_settings_table', 1),
(15, '2026_04_23_050730_add_member_role_to_users_table', 2),
(16, '2026_04_23_052905_add_soft_deletes_to_promotions_table', 3),
(17, '2026_04_23_084650_add_order_status_to_transactions_table', 4),
(18, '2026_04_24_034402_add_soft_deletes_to_members_table', 5),
(19, '2026_04_24_034445_add_soft_deletes_to_users_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `views_count` int NOT NULL DEFAULT '0',
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sku` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_price` decimal(12,2) DEFAULT NULL,
  `sell_price` decimal(12,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `min_stock` int NOT NULL DEFAULT '5',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `sku`, `purchase_price`, `sell_price`, `stock`, `min_stock`, `image`, `is_active`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 8, 'Triple Cappuccino #7165', 'Est quas non consequuntur velit quia ab.', 'SKU-9526-MT', '12381.00', '25600.00', 25, 7, NULL, 1, 10, '2026-04-22 19:32:14', '2026-04-23 20:14:12', NULL),
(2, 2, 'Seasonal Muffin #5807', 'Doloremque at corporis et asperiores ullam fugit placeat deleniti quaerat.', 'SKU-2506-PB', '14965.00', '29300.00', 10, 12, NULL, 0, 1, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(3, 5, 'Original Salad #9440', 'In officia necessitatibus nulla et in accusamus voluptatum nesciunt est sit beatae odio minima et.', 'SKU-7568-ID', '11248.00', '22200.00', 81, 15, NULL, 1, 8, '2026-04-22 19:32:14', '2026-04-23 22:41:54', NULL),
(4, 8, 'Double Toast #7393', 'Mollitia saepe omnis beatae recusandae numquam hic ut voluptas et non odit sint.', 'SKU-0577-WN', '21070.00', '34600.00', 61, 9, NULL, 1, 10, '2026-04-22 19:32:14', '2026-04-23 20:17:53', NULL),
(5, 3, 'Double Matcha Latte #2041', 'Et iure aut ea expedita consectetur veritatis cum occaecati.', 'SKU-5606-GX', '15280.00', '32500.00', 24, 11, NULL, 0, 7, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(6, 7, 'House Croissant #2956', 'Id autem id laudantium qui qui quod iusto.', 'SKU-5003-YO', '16716.00', '26600.00', 31, 14, NULL, 1, 6, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(7, 1, 'Original Americano #2467', 'Velit quibusdam voluptatem consequatur ut est architecto ipsum iure.', 'SKU-4877-ZJ', '13258.00', '22400.00', 88, 9, NULL, 1, 2, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(8, 6, 'House Chamomile Tea #4217', 'Quam consequatur omnis quod voluptatibus minima nobis dolor iste sunt voluptatem rerum.', 'SKU-6154-OF', '17484.00', '26200.00', 46, 8, NULL, 1, 10, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(9, 3, 'Triple Waffle #1760', 'Sed voluptatem ea dolorem ut dignissimos nihil nulla optio quis facere accusantium voluptas.', 'SKU-2700-ZG', '10650.00', '18000.00', 18, 3, NULL, 1, 7, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(10, 6, 'Original Toast #2173', 'Omnis magni voluptas illo omnis odit aliquid.', 'SKU-4319-QA', '24830.00', '35500.00', 30, 8, NULL, 1, 2, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(11, 4, 'Signature Americano #1851', 'Quibusdam atque voluptatibus rerum laborum ut quod.', 'SKU-7308-ZN', '10654.00', '18100.00', 5, 3, NULL, 1, 9, '2026-04-22 19:32:14', '2026-04-23 20:17:53', NULL),
(12, 1, 'Original Sandwich #4794', 'In a est ipsum ad itaque qui vel fugit et ea veniam.', 'SKU-3268-GM', '12200.00', '23700.00', 20, 10, NULL, 1, 5, '2026-04-22 19:32:14', '2026-04-22 21:54:55', NULL),
(13, 6, 'Classic Cold Brew #8564', 'Rem dolor sequi ut iure minima voluptates itaque enim dolores commodi perspiciatis fuga quos.', 'SKU-7512-CX', '20892.00', '41200.00', 96, 3, NULL, 1, 7, '2026-04-22 19:32:14', '2026-04-22 23:12:15', NULL),
(14, 6, 'Triple Americano #9809', 'Eius dolorum eos labore non sunt quia voluptates nisi voluptas et dolorum.', 'SKU-4565-PL', '11003.00', '16800.00', 14, 3, NULL, 1, 1, '2026-04-22 19:32:14', '2026-04-22 23:12:15', NULL),
(15, 2, 'Iced Cheesecake #5492', 'Sapiente voluptatem recusandae ducimus voluptate quia eveniet et nostrum.', 'SKU-5170-ZT', '7849.00', '11100.00', 85, 15, NULL, 1, 10, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(16, 6, 'Special Salad #7265', 'Quam velit tempora quod consequatur non et iure.', 'SKU-5150-BG', '14511.00', '31200.00', 29, 3, NULL, 1, 3, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(17, 1, 'Limited Espresso #1273', 'Aut repellendus ut aliquam sint ut tenetur voluptas laudantium est.', 'SKU-2502-JN', '9715.00', '19600.00', 59, 12, NULL, 1, 9, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(18, 6, 'Seasonal Chamomile Tea #4790', 'Illo excepturi consequatur quasi dolor sit aut sit ex nisi quia.', 'SKU-4918-TY', '14793.00', '29600.00', 91, 11, NULL, 1, 10, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(19, 5, 'Hot Cheesecake #8401', 'Vel nihil exercitationem dolore voluptatem tempora culpa.', 'SKU-4896-OX', '23689.00', '45200.00', 4, 12, NULL, 1, 7, '2026-04-22 19:32:14', '2026-04-23 22:41:54', NULL),
(20, 2, 'Iced Waffle #3835', 'Non libero ut illo aliquid et ea omnis.', 'SKU-0373-FM', '10583.00', '16800.00', 6, 11, NULL, 1, 1, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(21, 7, 'Double Croissant #6461', 'Quo ut laudantium dolorem minus rem fugiat minima hic labore laudantium quam.', 'SKU-6626-II', '16454.00', '24700.00', 9, 12, NULL, 1, 2, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(22, 7, 'Double Cappuccino #7038', 'Impedit voluptatum sed voluptatem aspernatur reiciendis dolorem rerum natus voluptatem sit debitis natus et.', 'SKU-4945-JX', '8394.00', '17200.00', 91, 5, NULL, 1, 5, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(23, 8, 'Iced Chamomile Tea #3729', 'Repellendus voluptatem natus numquam illum molestias voluptatem laborum eum.', 'SKU-8010-GX', '16109.00', '24000.00', 68, 4, NULL, 1, 10, '2026-04-22 19:32:14', '2026-04-23 22:41:54', NULL),
(24, 1, 'Double Espresso #4245', 'Voluptate vitae vel aut unde quidem porro voluptas enim.', 'SKU-8656-HZ', '12410.00', '24800.00', 32, 10, NULL, 1, 10, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(25, 1, 'Signature Earl Grey #5344', 'Esse fugit quia non occaecati aut tenetur officiis facilis debitis.', 'SKU-9509-LZ', '14732.00', '24300.00', 41, 3, NULL, 1, 9, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(26, 1, 'Original Salad #9070', 'Rerum numquam quis aperiam quia numquam rem dolores minima deleniti.', 'SKU-5616-ZM', '9885.00', '18300.00', 17, 3, NULL, 1, 7, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(27, 3, 'House Latte #3408', 'Sed mollitia natus quo aut atque nostrum et dolorem voluptatum.', 'SKU-7255-SY', '17443.00', '36500.00', 22, 7, NULL, 1, 5, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(28, 6, 'Original Toast #6936', 'Quos adipisci voluptatibus ducimus voluptatem est omnis soluta fugiat ducimus dolore.', 'SKU-3200-HU', '9808.00', '17600.00', 51, 6, NULL, 1, 2, '2026-04-22 19:32:14', '2026-04-23 22:38:28', NULL),
(29, 1, 'Original Muffin #2783', 'Eligendi hic cupiditate labore sint consequatur dolorem.', 'SKU-4717-YV', '20239.00', '37800.00', 80, 11, NULL, 1, 7, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(30, 8, 'Limited Salad #2857', 'Illum tempore voluptates mollitia vero accusamus et harum.', 'SKU-1929-BY', '22930.00', '37600.00', 83, 13, NULL, 1, 10, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(31, 1, 'Iced Macchiato #5564', 'Pariatur consectetur ut velit rerum iste sapiente dolore nihil aperiam deserunt a reprehenderit voluptates.', 'SKU-2961-SU', '8774.00', '15000.00', 29, 10, NULL, 1, 8, '2026-04-22 19:32:14', '2026-04-23 22:38:28', NULL),
(32, 2, 'Original Frappe #7881', 'Nobis delectus similique ex id dolorum vero officia quo labore.', 'SKU-5283-EV', '15072.00', '27100.00', 47, 4, NULL, 1, 8, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(33, 2, 'House Cold Brew #5624', 'Nobis nobis tempore dolorem fugit eos accusamus doloremque veritatis aliquam veniam esse molestiae sit.', 'SKU-9534-EG', '16783.00', '30400.00', 54, 10, NULL, 1, 4, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(34, 2, 'Special Earl Grey #6898', 'Sunt aut eos dolorem veniam vero in voluptatum ab.', 'SKU-4904-UT', '19884.00', '42800.00', 66, 5, NULL, 1, 10, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(35, 8, 'Premium Espresso #9813', 'Dolorem veniam sint qui fuga reiciendis qui ipsam corporis aperiam sed est sunt consequatur.', 'SKU-8681-MT', '8520.00', '15600.00', 97, 8, NULL, 1, 8, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(36, 8, 'Premium Croissant #9329', 'Omnis impedit sequi provident dignissimos libero non aut possimus autem.', 'SKU-8467-KZ', '7502.00', '11800.00', 46, 6, NULL, 1, 6, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(37, 8, 'Classic Waffle #9229', 'Quos voluptatem deserunt adipisci esse sit mollitia et eius quaerat voluptatibus voluptatum assumenda impedit.', 'SKU-8443-WV', '10818.00', '17800.00', 6, 3, NULL, 1, 3, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(38, 8, 'Special Latte #6150', 'Et eum eaque omnis incidunt fugiat similique et et et.', 'SKU-7044-CJ', '6392.00', '10900.00', 72, 12, NULL, 1, 10, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(39, 7, 'Hot Waffle #6040', 'Amet reiciendis odit temporibus sed sint adipisci sit.', 'SKU-3802-YP', '12368.00', '19300.00', 6, 15, NULL, 1, 10, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(40, 3, 'Signature Salad #354', 'Esse est aut cupiditate necessitatibus voluptatem autem suscipit facere ullam.', 'SKU-0796-XR', '10120.00', '22200.00', 26, 5, NULL, 0, 1, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(41, 8, 'Iced Matcha Latte #3969', 'Rerum dolorem nemo id suscipit quo adipisci ut molestiae commodi necessitatibus consequatur repellat beatae.', 'SKU-7671-JJ', '23153.00', '35400.00', 90, 15, NULL, 1, 5, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(42, 7, 'Seasonal Pancake #3073', 'Sequi aut dolorum deleniti officiis quos incidunt quia recusandae.', 'SKU-3168-OP', '5475.00', '9400.00', 67, 8, NULL, 0, 1, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(43, 2, 'Original Sandwich #7299', 'Et commodi est nihil incidunt porro non dolorum fugit iusto aut cupiditate.', 'SKU-3229-CR', '24866.00', '51700.00', 33, 3, NULL, 1, 2, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(44, 4, 'Signature Toast #5372', 'Ut quam et eos vero reprehenderit vel autem aut labore et odio sequi distinctio.', 'SKU-6008-XE', '24874.00', '51000.00', 99, 7, NULL, 1, 11, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(45, 7, 'Limited Earl Grey #2295', 'Harum mollitia eveniet laboriosam rem sunt quaerat id deleniti ex autem.', 'SKU-5086-YI', '9154.00', '20100.00', 4, 5, NULL, 1, 4, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(46, 8, 'Original Waffle #7527', 'Et consequatur labore quasi voluptatibus dolorum sequi illum.', 'SKU-0136-KI', '16918.00', '26400.00', 62, 14, NULL, 1, 1, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(47, 1, 'Iced Toast #3803', 'Delectus quod dolorem voluptas deleniti voluptas est aut asperiores itaque pariatur aut.', 'SKU-3925-SW', '17602.00', '32200.00', 86, 8, NULL, 1, 4, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(48, 6, 'Hot Mocha #3703', 'Magni tempore laborum quis sed eaque voluptatem consequatur sit quis.', 'SKU-5689-BG', '12684.00', '26500.00', 58, 15, NULL, 1, 9, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(49, 3, 'Seasonal Mocha #1493', 'Nihil hic delectus velit excepturi non sed.', 'SKU-4259-YL', '24821.00', '39500.00', 70, 9, NULL, 1, 10, '2026-04-22 19:32:14', '2026-04-22 19:32:14', NULL),
(50, 1, 'Original Muffin #5722', 'Et voluptas dolore sit dolores voluptatum sit enim voluptates itaque ut temporibus alias non.', 'SKU-3613-YT', '7444.00', '12400.00', 22, 12, NULL, 1, 2, '2026-04-22 19:32:14', '2026-04-23 22:38:28', NULL),
(51, 6, 'Roti Bakar', 'Tes roti bakar', 'ROT-BAK-001', '5000.00', '7000.00', 8, 3, 'products/Oto17kUkInwdkytN1JY5uyxcupVp8dZOTyJgWwWq.jpg', 1, 1, '2026-04-22 20:47:07', '2026-04-23 01:50:27', '2026-04-23 01:50:27');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `slug`, `description`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Espresso Drinks', 'espresso-drinks-1640', 'Eligendi optio accusantium sed dolore incidunt ea ut nisi.', 'food', 1, '2026-04-22 19:31:31', '2026-04-22 19:31:31'),
(2, 'Cold Brew', 'cold-brew-2626', 'Enim dignissimos et repellendus enim.', 'food', 1, '2026-04-22 19:31:31', '2026-04-22 19:31:31'),
(3, 'Frappe & Blended', 'frappe-blended-4153', 'Consequatur autem veritatis incidunt voluptates aut pariatur.', 'drink', 1, '2026-04-22 19:31:31', '2026-04-22 19:31:31'),
(4, 'Tea & Herbal', 'tea-herbal-8309', 'Aut nemo expedita possimus doloremque voluptatem voluptates voluptatem ab.', 'gift', 1, '2026-04-22 19:31:31', '2026-04-22 19:31:31'),
(5, 'Food & Snacks', 'food-snacks-2152', 'Quis ad nulla non fugit laborum nostrum voluptatum.', 'food', 1, '2026-04-22 19:31:31', '2026-04-22 19:31:31'),
(6, 'Pastries', 'pastries-2070', 'Quisquam quisquam consectetur impedit earum magnam aut.', 'star', 1, '2026-04-22 19:31:31', '2026-04-22 19:31:31'),
(7, 'Merchandise', 'merchandise-9012', 'Animi et reprehenderit perspiciatis molestiae dolorum.', 'star', 1, '2026-04-22 19:31:31', '2026-04-22 19:31:31'),
(8, 'Non-Coffee', 'non-coffee-9447', 'Voluptatum et molestiae dolorum autem minus.', 'drink', 1, '2026-04-22 19:31:31', '2026-04-22 19:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `discount_type` enum('percentage','fixed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` decimal(12,2) NOT NULL,
  `min_purchase` decimal(12,2) NOT NULL DEFAULT '0.00',
  `max_discount` decimal(12,2) DEFAULT NULL,
  `usage_limit` int DEFAULT NULL,
  `usage_count` int NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `name`, `code`, `description`, `discount_type`, `discount_value`, `min_purchase`, `max_discount`, `usage_limit`, `usage_count`, `start_date`, `end_date`, `is_active`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'April Mop', 'APLMOP', NULL, 'percentage', '10.00', '20000.00', NULL, NULL, 1, '2026-04-23', '2026-04-24', 1, NULL, '2026-04-22 23:07:28', '2026-04-22 23:12:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, 'shop_name', 'The Coffee House', NULL, '2026-04-23 21:37:46', '2026-04-23 21:37:46'),
(2, 'shop_tagline', 'Brewing Happiness', NULL, '2026-04-23 21:37:46', '2026-04-23 21:37:46'),
(3, 'shop_email', 'hello@coffeehouse.com', NULL, '2026-04-23 21:37:46', '2026-04-23 21:37:46'),
(4, 'shop_phone', '0812-3456-7890', NULL, '2026-04-23 21:37:46', '2026-04-23 21:37:46'),
(5, 'shop_address', NULL, NULL, '2026-04-23 21:37:46', '2026-04-23 21:37:46'),
(6, 'pos_tax_percentage', '10', NULL, '2026-04-23 21:37:46', '2026-04-23 21:37:46'),
(7, 'pos_service_charge', '0', NULL, '2026-04-23 21:37:46', '2026-04-23 21:37:46'),
(8, 'pos_currency_symbol', 'Rp', NULL, '2026-04-23 21:37:46', '2026-04-23 21:37:46'),
(9, 'pos_receipt_footer', 'Terima kasih atas kunjungan Anda!', NULL, '2026-04-23 21:37:46', '2026-04-23 21:37:46'),
(10, 'app_brand_color', '#100ce9', NULL, '2026-04-23 21:37:46', '2026-04-23 21:37:46'),
(11, 'social_instagram', NULL, NULL, '2026-04-23 21:37:46', '2026-04-23 21:37:46'),
(12, 'social_whatsapp', NULL, NULL, '2026-04-23 21:37:46', '2026-04-23 21:37:46'),
(13, 'social_facebook', NULL, NULL, '2026-04-23 21:37:46', '2026-04-23 21:37:46');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `member_id` bigint UNSIGNED DEFAULT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `discount_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `discount_percentage` decimal(5,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(12,2) NOT NULL,
  `payment_method` enum('cash','card','e-wallet','qris') COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('pending','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `order_status` enum('pending','preparing','ready','served') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_date` timestamp NULL DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_code`, `user_id`, `member_id`, `subtotal`, `discount_amount`, `discount_percentage`, `tax_amount`, `total_amount`, `payment_method`, `payment_status`, `order_status`, `payment_date`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'TXN202604237975YN', 5, NULL, '470017.00', '0.00', '0.00', '51702.00', '521719.00', 'e-wallet', 'completed', 'served', '2026-01-06 18:52:54', NULL, '2026-04-22 19:32:14', '2026-04-23 02:03:08', NULL),
(2, 'TXN202604238972PE', 11, 3, '154646.00', '0.00', '0.00', '17011.00', '171657.00', 'qris', 'completed', 'served', '2026-04-23 19:54:27', NULL, '2026-04-22 19:32:14', '2026-04-23 19:54:27', NULL),
(3, 'TXN202604230212ST', 5, NULL, '367548.00', '0.00', '0.00', '40430.00', '407978.00', 'cash', 'completed', 'served', '2026-04-23 20:06:24', 'Repudiandae animi ut soluta dolore impedit dignissimos exercitationem.', '2026-04-22 19:32:14', '2026-04-23 20:06:24', NULL),
(4, 'TXN202604236784HK', 4, NULL, '225348.00', '0.00', '0.00', '24788.00', '250136.00', 'card', 'completed', 'served', '2026-01-10 02:11:52', NULL, '2026-04-22 19:32:14', '2026-04-23 19:55:41', NULL),
(5, 'TXN202604237404GY', 7, NULL, '115216.00', '0.00', '0.00', '12674.00', '127890.00', 'cash', 'completed', 'served', '2026-04-23 20:06:26', NULL, '2026-04-22 19:32:14', '2026-04-23 20:06:26', NULL),
(6, 'TXN202604238104QU', 7, NULL, '389013.00', '19451.00', '5.00', '40652.00', '410214.00', 'cash', 'completed', 'served', '2025-11-02 05:57:34', 'Repellendus est ut sint eaque dolor sunt aut.', '2026-04-22 19:32:14', '2026-04-23 02:06:47', NULL),
(7, 'TXN202604238067FY', 8, NULL, '27476.00', '0.00', '0.00', '3022.00', '30498.00', 'cash', 'completed', 'served', '2026-04-23 20:06:28', NULL, '2026-04-22 19:32:14', '2026-04-23 20:06:28', NULL),
(8, 'TXN202604231478BO', 6, 4, '402191.00', '0.00', '0.00', '44241.00', '446432.00', 'card', 'completed', 'served', '2026-04-23 20:06:31', NULL, '2026-04-22 19:32:14', '2026-04-23 20:06:31', NULL),
(9, 'TXN202604232045BH', 10, NULL, '241138.00', '0.00', '0.00', '26525.00', '267663.00', 'cash', 'completed', 'served', '2026-03-24 20:27:33', NULL, '2026-04-22 19:32:14', '2026-04-23 19:55:52', NULL),
(10, 'TXN202604239988BI', 8, NULL, '104928.00', '5246.00', '5.00', '10965.00', '110647.00', 'qris', 'completed', 'served', '2026-04-14 16:45:27', 'Distinctio nulla in quasi tempora qui.', '2026-04-22 19:32:14', '2026-04-23 02:06:49', NULL),
(11, 'TXN202604233819RT', 1, NULL, '158688.00', '7934.00', '5.00', '16583.00', '167337.00', 'e-wallet', 'completed', 'served', '2025-11-04 18:03:19', NULL, '2026-04-22 19:32:14', '2026-04-23 19:55:54', NULL),
(12, 'TXN202604237537NX', 3, 5, '360358.00', '36036.00', '10.00', '35675.00', '359997.00', 'qris', 'completed', 'served', '2026-01-03 03:50:37', NULL, '2026-04-22 19:32:14', '2026-04-23 19:56:18', NULL),
(13, 'TXN202604234127YR', 6, 5, '163484.00', '16348.00', '10.00', '16185.00', '163321.00', 'cash', 'completed', 'served', '2025-11-05 06:10:41', NULL, '2026-04-22 19:32:14', '2026-04-23 19:56:20', NULL),
(14, 'TXN202604233686WF', 11, 3, '482717.00', '48272.00', '10.00', '47789.00', '482234.00', 'cash', 'completed', 'served', '2026-04-23 20:16:09', NULL, '2026-04-22 19:32:14', '2026-04-23 20:16:09', NULL),
(15, 'TXN202604237274XJ', 4, 3, '131521.00', '0.00', '0.00', '14467.00', '145988.00', 'cash', 'completed', 'served', '2026-04-23 20:15:39', NULL, '2026-04-22 19:32:14', '2026-04-23 20:15:39', NULL),
(16, 'TXN202604230482KG', 5, 3, '462871.00', '46287.00', '10.00', '45824.00', '462408.00', 'cash', 'completed', 'served', '2026-04-19 17:04:01', NULL, '2026-04-22 19:32:14', '2026-04-23 20:15:07', NULL),
(17, 'TXN202604231827IC', 1, NULL, '192784.00', '0.00', '0.00', '21206.00', '213990.00', 'cash', 'completed', 'served', '2026-04-07 20:58:26', NULL, '2026-04-22 19:32:14', '2026-04-23 20:15:09', NULL),
(18, 'TXN202604230055WP', 1, NULL, '239893.00', '0.00', '0.00', '26388.00', '266281.00', 'cash', 'completed', 'served', '2026-04-23 20:15:41', NULL, '2026-04-22 19:32:14', '2026-04-23 20:15:41', NULL),
(19, 'TXN202604236767PY', 7, NULL, '181052.00', '9053.00', '5.00', '18920.00', '190919.00', 'qris', 'completed', 'served', '2026-04-16 05:16:12', NULL, '2026-04-22 19:32:14', '2026-04-23 20:15:28', NULL),
(20, 'TXN202604237561DG', 6, NULL, '498692.00', '0.00', '0.00', '54856.00', '553548.00', 'e-wallet', 'completed', 'served', '2026-04-23 20:15:42', NULL, '2026-04-22 19:32:14', '2026-04-23 20:15:42', NULL),
(22, 'TRX-20260423-00021', 1, 1, '82400.00', '0.00', '0.00', '8240.00', '90640.00', 'cash', 'completed', 'served', '2026-04-23 20:15:44', NULL, '2026-04-22 21:10:57', '2026-04-23 20:15:44', NULL),
(23, 'TRX-20260423-00022', 1, 1, '82400.00', '0.00', '0.00', '8240.00', '90640.00', 'cash', 'completed', 'served', '2026-04-23 19:56:52', NULL, '2026-04-22 21:11:54', '2026-04-23 19:56:52', NULL),
(24, 'TRX-20260423-00023', 1, 1, '89400.00', '0.00', '0.00', '8940.00', '98340.00', 'cash', 'completed', 'served', '2026-04-23 19:56:54', NULL, '2026-04-22 21:12:48', '2026-04-23 19:56:54', NULL),
(25, 'TRX-20260423-00024', 1, 1, '89400.00', '0.00', '0.00', '8940.00', '98340.00', 'cash', 'completed', 'served', '2026-04-23 19:56:55', NULL, '2026-04-22 21:13:48', '2026-04-23 19:56:55', NULL),
(26, 'TRX-20260423-00025', 12, 7, '58000.00', '5800.00', '0.00', '5220.00', '57420.00', 'cash', 'completed', 'served', '2026-04-23 19:56:57', NULL, '2026-04-22 23:12:15', '2026-04-23 19:56:57', NULL),
(27, 'TRX-20260423-00026', 13, NULL, '25600.00', '0.00', '0.00', '2560.00', '28160.00', 'cash', 'completed', 'served', '2026-04-23 19:56:59', NULL, '2026-04-22 23:50:42', '2026-04-23 19:56:59', NULL),
(28, 'TRX-20260424-00001', 12, NULL, '25600.00', '0.00', '0.00', '2560.00', '28160.00', 'cash', 'completed', 'served', NULL, 'Meja 10 Less Sugar', '2026-04-23 20:14:12', '2026-04-23 20:14:52', NULL),
(29, 'TRX-20260424-00002', 13, 7, '74900.00', '0.00', '0.00', '7490.00', '82390.00', 'cash', 'completed', 'served', NULL, 'Meja 12', '2026-04-23 20:17:53', '2026-04-23 20:30:34', NULL),
(30, 'TRX-20260424-00003', 13, NULL, '45000.00', '0.00', '0.00', '4500.00', '49500.00', 'cash', 'completed', 'served', NULL, 'Meja 1 add sauce', '2026-04-23 22:38:28', '2026-04-23 22:39:29', NULL),
(31, 'TRX-20260424-00004', 13, 9, '115400.00', '5770.00', '5.00', '10963.00', '120593.00', 'cash', 'completed', 'served', NULL, 'Meja 2', '2026-04-23 22:41:54', '2026-04-23 22:42:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `product_id`, `quantity`, `unit_price`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES
(1, 22, 1, 1, '25600.00', '25600.00', NULL, '2026-04-22 21:10:57', '2026-04-22 21:10:57'),
(2, 22, 3, 1, '22200.00', '22200.00', NULL, '2026-04-22 21:10:57', '2026-04-22 21:10:57'),
(3, 22, 4, 1, '34600.00', '34600.00', NULL, '2026-04-22 21:10:58', '2026-04-22 21:10:58'),
(4, 23, 1, 1, '25600.00', '25600.00', NULL, '2026-04-22 21:11:54', '2026-04-22 21:11:54'),
(5, 23, 3, 1, '22200.00', '22200.00', NULL, '2026-04-22 21:11:54', '2026-04-22 21:11:54'),
(6, 23, 4, 1, '34600.00', '34600.00', NULL, '2026-04-22 21:11:54', '2026-04-22 21:11:54'),
(7, 24, 51, 1, '7000.00', '7000.00', NULL, '2026-04-22 21:12:48', '2026-04-22 21:12:48'),
(8, 24, 1, 1, '25600.00', '25600.00', NULL, '2026-04-22 21:12:48', '2026-04-22 21:12:48'),
(9, 24, 3, 1, '22200.00', '22200.00', NULL, '2026-04-22 21:12:48', '2026-04-22 21:12:48'),
(10, 24, 4, 1, '34600.00', '34600.00', NULL, '2026-04-22 21:12:48', '2026-04-22 21:12:48'),
(11, 25, 51, 1, '7000.00', '7000.00', NULL, '2026-04-22 21:13:48', '2026-04-22 21:13:48'),
(12, 25, 1, 1, '25600.00', '25600.00', NULL, '2026-04-22 21:13:48', '2026-04-22 21:13:48'),
(13, 25, 3, 1, '22200.00', '22200.00', NULL, '2026-04-22 21:13:49', '2026-04-22 21:13:49'),
(14, 25, 4, 1, '34600.00', '34600.00', NULL, '2026-04-22 21:13:49', '2026-04-22 21:13:49'),
(15, 26, 13, 1, '41200.00', '41200.00', NULL, '2026-04-22 23:12:15', '2026-04-22 23:12:15'),
(16, 26, 14, 1, '16800.00', '16800.00', NULL, '2026-04-22 23:12:15', '2026-04-22 23:12:15'),
(17, 27, 1, 1, '25600.00', '25600.00', NULL, '2026-04-22 23:50:42', '2026-04-22 23:50:42'),
(18, 28, 1, 1, '25600.00', '25600.00', NULL, '2026-04-23 20:14:12', '2026-04-23 20:14:12'),
(19, 29, 3, 1, '22200.00', '22200.00', NULL, '2026-04-23 20:17:53', '2026-04-23 20:17:53'),
(20, 29, 4, 1, '34600.00', '34600.00', NULL, '2026-04-23 20:17:53', '2026-04-23 20:17:53'),
(21, 29, 11, 1, '18100.00', '18100.00', NULL, '2026-04-23 20:17:53', '2026-04-23 20:17:53'),
(22, 30, 50, 1, '12400.00', '12400.00', NULL, '2026-04-23 22:38:28', '2026-04-23 22:38:28'),
(23, 30, 28, 1, '17600.00', '17600.00', NULL, '2026-04-23 22:38:28', '2026-04-23 22:38:28'),
(24, 30, 31, 1, '15000.00', '15000.00', NULL, '2026-04-23 22:38:28', '2026-04-23 22:38:28'),
(25, 31, 23, 2, '24000.00', '48000.00', NULL, '2026-04-23 22:41:54', '2026-04-23 22:41:54'),
(26, 31, 3, 1, '22200.00', '22200.00', NULL, '2026-04-23 22:41:54', '2026-04-23 22:41:54'),
(27, 31, 19, 1, '45200.00', '45200.00', NULL, '2026-04-23 22:41:54', '2026-04-23 22:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `role` enum('admin','manager','cs','user','member') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `role`, `is_active`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@brancoffee.com', NULL, '$2y$12$uDEtsocR3T9TLxQRvsyDXuOCycFDuz9n6HNB.aYgcekvBcUfMei/G', NULL, NULL, 'admin', 1, NULL, '2026-04-22 19:21:40', '2026-04-22 20:10:15', NULL),
(2, 'Camden O\'Connell', 'sandra45@example.org', '2026-04-22 19:27:25', '$2y$12$qAOwE2LMb6YleB2XPQHJ0uYGJQmNYNWT4f5fNL.6BrwZzIOdKxC3m', NULL, NULL, 'user', 1, 'q4djt0JSgw', '2026-04-22 19:27:26', '2026-04-22 19:27:26', NULL),
(3, 'Maximillia Greenholt Sr.', 'schinner.laurie@example.org', '2026-04-22 19:27:26', '$2y$12$qAOwE2LMb6YleB2XPQHJ0uYGJQmNYNWT4f5fNL.6BrwZzIOdKxC3m', NULL, NULL, 'user', 1, 'ABUXnRIvfM', '2026-04-22 19:27:26', '2026-04-22 19:27:26', NULL),
(4, 'Fletcher Johnston', 'ernestina89@example.com', '2026-04-22 19:27:26', '$2y$12$qAOwE2LMb6YleB2XPQHJ0uYGJQmNYNWT4f5fNL.6BrwZzIOdKxC3m', NULL, NULL, 'user', 1, 'Nc4AWakyAn', '2026-04-22 19:27:26', '2026-04-22 19:27:26', NULL),
(5, 'Dr. Devon Murray', 'cfeil@example.com', '2026-04-22 19:27:26', '$2y$12$qAOwE2LMb6YleB2XPQHJ0uYGJQmNYNWT4f5fNL.6BrwZzIOdKxC3m', NULL, NULL, 'user', 1, 'VYiKPGx9AO', '2026-04-22 19:27:26', '2026-04-22 19:27:26', NULL),
(6, 'Prof. Vernon Collier', 'tkiehn@example.net', '2026-04-22 19:27:26', '$2y$12$qAOwE2LMb6YleB2XPQHJ0uYGJQmNYNWT4f5fNL.6BrwZzIOdKxC3m', NULL, NULL, 'user', 1, 'iRwBUSYKeb', '2026-04-22 19:27:26', '2026-04-22 19:27:26', NULL),
(7, 'Kelsi Reinger', 'loyal98@example.org', '2026-04-22 19:27:26', '$2y$12$qAOwE2LMb6YleB2XPQHJ0uYGJQmNYNWT4f5fNL.6BrwZzIOdKxC3m', NULL, NULL, 'user', 1, 'NxzFotNURo', '2026-04-22 19:27:26', '2026-04-22 19:27:26', NULL),
(8, 'Holden Miller', 'qhammes@example.net', '2026-04-22 19:27:26', '$2y$12$qAOwE2LMb6YleB2XPQHJ0uYGJQmNYNWT4f5fNL.6BrwZzIOdKxC3m', NULL, NULL, 'user', 1, 'IBsWZeGLWF', '2026-04-22 19:27:26', '2026-04-22 19:27:26', NULL),
(9, 'Gretchen Gerhold', 'vthompson@example.com', '2026-04-22 19:27:26', '$2y$12$qAOwE2LMb6YleB2XPQHJ0uYGJQmNYNWT4f5fNL.6BrwZzIOdKxC3m', NULL, NULL, 'user', 1, 'GZ2mhgi1as', '2026-04-22 19:27:26', '2026-04-22 19:27:26', NULL),
(10, 'Prince Schuppe', 'leola88@example.com', '2026-04-22 19:27:26', '$2y$12$qAOwE2LMb6YleB2XPQHJ0uYGJQmNYNWT4f5fNL.6BrwZzIOdKxC3m', NULL, NULL, 'user', 1, 'h2modDfXKD', '2026-04-22 19:27:26', '2026-04-22 19:27:26', NULL),
(11, 'Curtis Hahn PhD', 'rrath@example.org', '2026-04-22 19:27:26', '$2y$12$qAOwE2LMb6YleB2XPQHJ0uYGJQmNYNWT4f5fNL.6BrwZzIOdKxC3m', NULL, NULL, 'user', 1, 'KU0v9VWnxF', '2026-04-22 19:27:26', '2026-04-22 19:27:26', NULL),
(12, 'Manager', 'manager@brancoffee.com', NULL, '$2y$12$RDsBno9Qpve4kpR5emavW.OthdA3uqvFCg03qzdVY4mvPckOKTfqu', NULL, NULL, 'manager', 1, NULL, '2026-04-22 20:10:15', '2026-04-22 20:10:15', NULL),
(13, 'CS Staff', 'cs@brancoffee.com', NULL, '$2y$12$iQA0R1D/3sTztT9BHDvrceH5FXJQ9Vnkc.eVI2rblpVV8suNVSShy', NULL, NULL, 'cs', 1, NULL, '2026-04-22 20:10:15', '2026-04-22 20:10:15', NULL),
(14, 'Member Test', 'member@brancoffee.com', NULL, '$2y$12$4JS.A9/CWh8SEs5gL3Zh3OmHTY/Jul4zctq.I3uHj5kmw7Wi63goS', NULL, NULL, 'user', 1, NULL, '2026-04-22 20:10:15', '2026-04-22 20:10:15', NULL),
(16, 'Josep Stalin', 'josep@example.com', NULL, '$2y$12$vvi6XCZdR5G5zBwUTMXwuO3p6MsMuCt6TZW2ljqZkrWeacmYaqnhO', NULL, NULL, 'member', 1, NULL, '2026-04-22 22:18:08', '2026-04-22 22:32:32', NULL),
(18, 'Catur Sugi', '085931457831@brancoffee.member', NULL, '$2y$12$80mUdQdbTmxbqrq820ShAuq/SZVp6hL6JifcIRK.Myp8jY2zfd/yC', '085931457831', 'Medayu Rt 01 Rw 03 Kec wanadadi Kab Banjarnegara', 'user', 1, NULL, '2026-04-23 22:39:58', '2026-04-23 22:39:58', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_logs_user_id_index` (`user_id`),
  ADD KEY `audit_logs_action_index` (`action`),
  ADD KEY `audit_logs_created_at_index` (`created_at`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_transaction_id_unique` (`transaction_id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_invoice_number_index` (`invoice_number`),
  ADD KEY `invoices_printed_at_index` (`printed_at`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `members_member_code_unique` (`member_code`),
  ADD KEY `members_member_code_index` (`member_code`),
  ADD KEY `members_member_phone_index` (`member_phone`),
  ADD KEY `members_is_active_index` (`is_active`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_slug_index` (`slug`),
  ADD KEY `posts_status_index` (`status`),
  ADD KEY `posts_author_id_index` (`author_id`),
  ADD KEY `posts_published_at_index` (`published_at`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_created_by_foreign` (`created_by`),
  ADD KEY `products_category_id_index` (`category_id`),
  ADD KEY `products_sku_index` (`sku`),
  ADD KEY `products_is_active_index` (`is_active`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categories_slug_unique` (`slug`),
  ADD KEY `product_categories_slug_index` (`slug`),
  ADD KEY `product_categories_is_active_index` (`is_active`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promotions_code_unique` (`code`),
  ADD KEY `promotions_created_by_foreign` (`created_by`),
  ADD KEY `promotions_code_index` (`code`),
  ADD KEY `promotions_is_active_index` (`is_active`),
  ADD KEY `promotions_start_date_end_date_index` (`start_date`,`end_date`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`),
  ADD KEY `settings_key_index` (`key`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_transaction_code_unique` (`transaction_code`),
  ADD KEY `transactions_transaction_code_index` (`transaction_code`),
  ADD KEY `transactions_user_id_index` (`user_id`),
  ADD KEY `transactions_member_id_index` (`member_id`),
  ADD KEY `transactions_payment_status_index` (`payment_status`),
  ADD KEY `transactions_created_at_index` (`created_at`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_details_transaction_id_index` (`transaction_id`),
  ADD KEY `transaction_details_product_id_index` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_index` (`role`),
  ADD KEY `users_is_active_index` (`is_active`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`),
  ADD CONSTRAINT `products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `promotions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `transaction_details_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
