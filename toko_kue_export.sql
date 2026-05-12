-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: toko_kue_kharisma
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Rumah',
  `recipient_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_user_id_foreign` (`user_id`),
  CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `carts_user_id_product_id_unique` (`user_id`,`product_id`),
  KEY `carts_product_id_foreign` (`product_id`),
  KEY `carts_user_id_product_id_index` (`user_id`,`product_id`),
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_02_14_000003_create_products_table',1),(5,'2026_02_14_000004_create_orders_table',1),(6,'2026_02_14_000005_create_order_items_table',1),(7,'2026_02_14_000006_create_reviews_table',1),(8,'2026_02_14_000007_add_phone_to_users_table',1),(9,'2026_03_17_000000_add_role_to_users_table',1),(10,'2026_03_28_093936_add_indexes_for_scalability',1),(11,'2026_03_28_094433_create_carts_table',1),(12,'2026_04_15_000008_create_addresses_table',1),(13,'2026_04_15_000001_remove_stock_from_products_table',2),(14,'2026_04_15_000002_add_notes_to_orders_table',2),(15,'2026_04_19_000001_add_order_number_to_reviews_table',3),(16,'2026_04_20_000001_add_address_to_users_table',4),(17,'2026_04_20_000002_add_delivery_address_to_orders_table',4),(18,'2026_04_25_000001_create_payment_proofs_table',5),(19,'2026_04_25_000002_add_midtrans_fields_and_paid_status_to_orders_table',5),(20,'2026_04_26_204316_add_profile_fields_to_users_table',5),(21,'2026_04_26_212318_add_price_to_carts_table',5),(22,'2026_04_27_000100_add_promo_packages_to_products',5),(23,'2026_05_07_115705_update_status_enum_in_orders_table',5),(24,'2026_05_11_082409_add_is_read_to_orders_table',5),(25,'2026_05_11_200000_add_shipping_status_to_orders_table',6),(26,'2026_05_12_100000_create_notifications_table',7),(27,'2026_05_12_200000_add_photo_to_users_table',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_index` (`order_id`),
  KEY `order_items_product_id_index` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,2,1,2000.00,2000.00,'2026-05-11 11:36:40','2026-05-11 11:36:40'),(2,2,2,1,2000.00,2000.00,'2026-05-11 11:43:45','2026-05-11 11:43:45'),(3,3,3,1,2000.00,2000.00,'2026-05-11 11:48:38','2026-05-11 11:48:38'),(4,4,3,1,2000.00,2000.00,'2026-05-11 11:51:14','2026-05-11 11:51:14'),(5,5,2,1,2000.00,2000.00,'2026-05-12 01:20:27','2026-05-12 01:20:27'),(6,6,2,1,2000.00,2000.00,'2026-05-12 01:22:03','2026-05-12 01:22:03'),(7,7,3,1,2000.00,2000.00,'2026-05-12 01:27:55','2026-05-12 01:27:55'),(8,8,3,1,2000.00,2000.00,'2026-05-12 09:16:18','2026-05-12 09:16:18'),(9,9,2,1,2000.00,2000.00,'2026-05-12 09:24:34','2026-05-12 09:24:34'),(10,10,3,1,2000.00,2000.00,'2026-05-12 09:26:11','2026-05-12 09:26:11'),(11,11,2,1,2000.00,2000.00,'2026-05-12 09:32:38','2026-05-12 09:32:38'),(12,12,2,1,2000.00,2000.00,'2026-05-12 13:15:22','2026-05-12 13:15:22'),(13,13,901,1,20000.00,20000.00,'2026-05-12 13:16:20','2026-05-12 13:16:20');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT '5000.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `delivery_address` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','in_progress','shipping','completed','cancelled','paid','verified') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `midtrans_order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `midtrans_transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `midtrans_payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `midtrans_transaction_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `midtrans_raw_notification` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_index` (`user_id`),
  KEY `orders_status_index` (`status`),
  KEY `orders_created_at_index` (`created_at`),
  KEY `orders_midtrans_order_id_index` (`midtrans_order_id`),
  KEY `orders_midtrans_transaction_id_index` (`midtrans_transaction_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,'ORD-6A01BF48207E6',6,2000.00,0.00,0.00,2000.00,'qris',NULL,'jalan pahlawan','cancelled','2026-05-11 11:36:40','2026-05-11 11:43:17','ORD-6A01BF48207E6-1778499400',NULL,NULL,NULL,NULL),(2,1,'ORD-6A01C0F146019',6,2000.00,0.00,0.00,2000.00,'qris',NULL,'jalan pahlawan','cancelled','2026-05-11 11:43:45','2026-05-11 11:48:05','ORD-6A01C0F146019-1778499825',NULL,NULL,NULL,NULL),(3,1,'ORD-6A01C216A845A',6,2000.00,0.00,0.00,2000.00,'qris',NULL,'jalan pahlawan','cancelled','2026-05-11 11:48:38','2026-05-11 11:49:41','ORD-6A01C216A845A-1778500118',NULL,NULL,NULL,NULL),(4,1,'ORD-6A01C2B2F01E8',6,2000.00,0.00,0.00,2000.00,'cod',NULL,'jalan pahlawan','completed','2026-05-11 11:51:14','2026-05-11 11:59:50',NULL,NULL,NULL,NULL,NULL),(5,1,'ORD-6A02805BD61EE',6,2000.00,0.00,0.00,2000.00,'qris',NULL,'jalan pahlawan','cancelled','2026-05-12 01:20:27','2026-05-12 13:14:57','ORD-6A02805BD61EE-1778548828',NULL,NULL,NULL,NULL),(6,1,'ORD-6A0280BB018E0',6,2000.00,0.00,0.00,2000.00,'cod',NULL,'jalan pahlawan','completed','2026-05-12 01:22:03','2026-05-12 01:23:53',NULL,NULL,NULL,NULL,NULL),(7,1,'ORD-6A02821B939F6',6,2000.00,0.00,0.00,2000.00,'cod',NULL,'jalan pahlawan','completed','2026-05-12 01:27:55','2026-05-12 09:17:18',NULL,NULL,NULL,NULL,NULL),(8,1,'ORD-6A02EFE26DFB4',6,2000.00,0.00,0.00,2000.00,'cod',NULL,'jalan pahlawan','cancelled','2026-05-12 09:16:18','2026-05-12 09:17:50',NULL,NULL,NULL,NULL,NULL),(9,1,'ORD-6A02F1D248459',6,2000.00,0.00,0.00,2000.00,'cod',NULL,'jalan pahlawan','completed','2026-05-12 09:24:34','2026-05-12 09:25:41',NULL,NULL,NULL,NULL,NULL),(10,1,'ORD-6A02F2330D8E3',6,2000.00,0.00,0.00,2000.00,'cod',NULL,'jalan pahlawan','cancelled','2026-05-12 09:26:11','2026-05-12 09:26:26',NULL,NULL,NULL,NULL,NULL),(11,1,'ORD-6A02F3B6E9A67',6,2000.00,0.00,0.00,2000.00,'cod',NULL,'jalan pahlawan','cancelled','2026-05-12 09:32:38','2026-05-12 09:33:26',NULL,NULL,NULL,NULL,NULL),(12,1,'ORD-6A0327EA6E980',6,2000.00,0.00,0.00,2000.00,'cod',NULL,'jalan pahlawan','cancelled','2026-05-12 13:15:22','2026-05-12 13:15:39',NULL,NULL,NULL,NULL,NULL),(13,1,'ORD-6A032824E11BB',6,20000.00,0.00,0.00,20000.00,'cod',NULL,'jalan pahlawan','completed','2026-05-12 13:16:20','2026-05-12 13:16:57',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_proofs`
--

DROP TABLE IF EXISTS `payment_proofs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_proofs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `proof_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','verified','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_proofs_order_id_foreign` (`order_id`),
  CONSTRAINT `payment_proofs_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_proofs`
--

LOCK TABLES `payment_proofs` WRITE;
/*!40000 ALTER TABLE `payment_proofs` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_proofs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_name_index` (`name`),
  KEY `products_price_index` (`price`)
) ENGINE=InnoDB AUTO_INCREMENT=905 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Bolu Pelangi','Bolu lembut dengan 7 lapisan warna pelangi yang cantik dan lezat',2000.00,'Kue','/images/products/bolu-pelangi.jpg','2026-04-15 01:21:29','2026-04-15 04:35:29'),(2,'Pie Buah','Pie dengan isian buah segar',2000.00,'Kue','/images/products/pie-buah.jpg','2026-04-15 01:21:29','2026-04-15 01:21:29'),(3,'Kue Lumpur','Kue lumpur lembut dan manis',2000.00,'Kue','/images/products/kue-lumpur.jpg','2026-04-15 01:21:29','2026-04-15 01:21:29'),(5,'Pepe Pelangi','Kue pepe dengan warna pelangi yang menarik',2000.00,'Kue','/images/products/pepe-pelangi.jpg','2026-04-15 01:21:29','2026-04-15 01:21:29'),(6,'Putu Ayu','Kue putu ayu dengan kelapa parut',2000.00,'Kue','/images/products/putu-ayu.jpg','2026-04-15 01:21:29','2026-04-15 01:21:29'),(7,'Pepe Hijau','Kue pepe hijau dengan aroma pandan',2000.00,'Kue','/images/products/pepe-hijau.jpg','2026-04-15 01:21:29','2026-04-15 01:21:29'),(8,'Lemper','Lemper ayam gurih dengan ketan',2000.00,'Kue','/images/products/lemper.jpg','2026-04-15 01:21:29','2026-04-15 01:21:29'),(9,'Kue Apem','Kue apem lembut tradisional',2000.00,'Kue','/images/products/kue-apem.jpg','2026-04-15 01:21:29','2026-04-15 01:21:29'),(10,'Kue Talam Suji','Kue talam suji dengan santan',2000.00,'Kue','/images/products/kue-talam-suji.jpg','2026-04-15 01:21:29','2026-04-15 01:21:29'),(11,'Dadar Gulung','Dadar gulung isi kelapa manis',2000.00,'Kue','/images/products/dadar-gulung.jpg','2026-04-15 01:21:29','2026-04-15 01:21:29'),(12,'Risoles','Risoles isi sayuran dan daging',2000.00,'Kue','/images/products/risoles.jpg','2026-04-15 01:21:29','2026-04-15 01:21:29'),(13,'Pie Brownies','Pie dengan isian brownies coklat',2000.00,'Kue','/images/products/pie-brownies.jpg','2026-04-15 01:21:29','2026-04-15 01:21:29'),(14,'Talam Ubi','Kue talam ubi ungu yang lezat',2000.00,'Kue','/images/products/talam-ubi.jpg','2026-04-15 01:21:29','2026-04-15 01:21:29'),(15,'Pastel','Pastel goreng isi sayuran',2000.00,'Kue','/images/products/pastel.jpg','2026-04-15 01:21:29','2026-04-15 01:21:29'),(16,'Ongol Ongol','Ongol ongol kenyal dengan kelapa',2000.00,'Kue','/images/products/ongol-ongol.jpeg','2026-04-15 01:21:29','2026-04-15 01:21:29'),(17,'Lupis','Lupis dengan gula merah dan kelapa',2000.00,'Kue','/images/products/lupis.jpg','2026-04-15 01:21:29','2026-04-15 01:21:29'),(901,'Paketan Hemat A','Paket promo: Dadar Gulung, Lemper, Putu Ayu, Lupis, Kue Apem',20000.00,'Paket Promo','/images/products/dadar-gulung.jpg','2026-05-11 09:11:09','2026-05-11 09:11:09'),(902,'Paketan Hemat B','Paket promo: Talam Suji, Pepe Hijau, Pepe Pelangi, Ongol-Ongol, Kue Lumpur',20000.00,'Paket Promo','/images/products/kue-talam-suji.jpg','2026-05-11 09:11:09','2026-05-11 09:11:09'),(903,'Paketan Hemat C','Paket promo: Bolu Pelangi, Pie Buah, Pie Brownies, Risoles, Pastel',20000.00,'Paket Promo','/images/products/bolu-pelangi.jpg','2026-05-11 09:11:09','2026-05-11 09:11:09');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_rating_index` (`rating`),
  KEY `reviews_created_at_index` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,'jack','ORD-6A0280BB018E0',5,'kuenya enak','2026-05-12 01:24:24','2026-05-12 01:24:24');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('AGQmGwc7NDyqadEwigbT7VIRW57zMIdGD1p7Ojlz',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiaWtDc1ZhVlhibHBjRDB4QU83ZkFzdVJ4Z3g2NTRUYWU0UDE5MTgyUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi91c2VycyI7czo1OiJyb3V0ZSI7czozNjoiZmlsYW1lbnQuYWRtaW4ucmVzb3VyY2VzLnVzZXJzLmluZGV4Ijt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjBlMGJkYTA0MjU3ZDZkZjZiYWM3NmVmYjU2MDRkODM2Y2FmYjI1YjJmYjUyYmRkNmViYWZmZmUzMDc3ZWJjMjQiO30=',1778592025),('MBfkz7e0Vxqz4ZV648njSBJAPFV7stayhlsxyQxY',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Avast/147.0.0.0','YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6ImZ2NGo2U3pFdzlIaGY5S0VFUmw5VEV2YUx1ZlpNanN1cHd6cDJUV1IiO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4iO3M6NToicm91dGUiO3M6MzA6ImZpbGFtZW50LmFkbWluLnBhZ2VzLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE0OiJ1c2VyX2xvZ2dlZF9pbiI7YjoxO3M6ODoiaXNfYWRtaW4iO2I6MTtzOjk6InVzZXJfbmFtZSI7czo1OiJBZG1pbiI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjBlMGJkYTA0MjU3ZDZkZjZiYWM3NmVmYjU2MDRkODM2Y2FmYjI1YjJmYjUyYmRkNmViYWZmZmUzMDc3ZWJjMjQiO3M6ODoiZmlsYW1lbnQiO2E6MDp7fX0=',1778545894),('PT7DfaNB9FejO2UcpH0ppCp8SnWkSqyLa3TCVoXd',6,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','YTo4OntzOjY6Il90b2tlbiI7czo0MDoiZ04xQ2ZuTkQzaXFrNTRxQktaN1VjWTVySVNHT1U0WXJ6OW9pMlFvdSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGkvbm90aWZpY2F0aW9ucyI7czo1OiJyb3V0ZSI7czoxOToibm90aWZpY2F0aW9ucy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O3M6MTQ6InVzZXJfbG9nZ2VkX2luIjtiOjE7czo4OiJpc19hZG1pbiI7YjowO3M6OToidXNlcl9uYW1lIjtzOjQ6ImphY2siO30=',1778594005),('zaZutPqRAFbdxasjiYn4aBJrzojbkiQjBbypEQ2L',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVVpMTWJTR3habE1MT0tFVkdQdERLZm1TV0t1dDlrWG5PbGY0cEtOZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjt9fQ==',1778551171);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_notifications`
--

DROP TABLE IF EXISTS `user_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bell',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `user_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_notifications`
--

LOCK TABLES `user_notifications` WRITE;
/*!40000 ALTER TABLE `user_notifications` DISABLE KEYS */;
INSERT INTO `user_notifications` VALUES (1,6,'Pesanan Diterima! 🛍️','Pesanan #ORD-6A02EFE26DFB4 sedang diproses. Bayar saat barang tiba.','success','bell',1,'2026-05-12 09:16:18','2026-05-12 09:17:06'),(2,6,'Pesanan Diterima! 🛍️','Pesanan #ORD-6A02F1D248459 sedang diproses. Bayar saat barang tiba.','success','bell',1,'2026-05-12 09:24:34','2026-05-12 09:24:56'),(3,6,'Pesanan Sedang Dikirim ','Pesanan Anda dengan ID #ORD-6A02F1D248459 sedang dikirimkan ke alamat Anda.','info','bell',1,'2026-05-12 09:25:16','2026-05-12 09:25:57'),(4,6,'Pesanan Selesai ✅','Pesanan Anda dengan ID #ORD-6A02F1D248459 telah selesai. Terima kasih telah berbelanja!','success','bell',1,'2026-05-12 09:25:41','2026-05-12 09:25:57'),(5,6,'Pesanan Diterima! 🛍️','Pesanan #ORD-6A02F2330D8E3 sedang diproses. Bayar saat barang tiba.','success','bell',1,'2026-05-12 09:26:11','2026-05-12 09:32:28'),(6,6,'Pesanan Diterima! 🛍️','Pesanan #ORD-6A02F3B6E9A67 sedang diproses. Bayar saat barang tiba.','success','bell',1,'2026-05-12 09:32:38','2026-05-12 09:34:23'),(7,6,'Pesanan Dibatalkan ❌','Maaf, pesanan Anda dengan ID #ORD-6A02F3B6E9A67 telah dibatalkan oleh admin.','danger','bell',1,'2026-05-12 09:33:26','2026-05-12 09:34:23'),(8,6,'Pesanan Diterima! 🛍️','Pesanan #ORD-6A0327EA6E980 sedang diproses. Bayar saat barang tiba.','success','bell',1,'2026-05-12 13:15:22','2026-05-12 13:15:50'),(9,6,'Pesanan Dibatalkan ❌','Maaf, pesanan Anda dengan ID #ORD-6A0327EA6E980 telah dibatalkan oleh penjual.','danger','bell',1,'2026-05-12 13:15:39','2026-05-12 13:15:50'),(10,6,'Pesanan Diterima! 🛍️','Pesanan #ORD-6A032824E11BB sedang diproses. Bayar saat barang tiba.','success','bell',1,'2026-05-12 13:16:20','2026-05-12 13:17:09'),(11,6,'Pesanan Sedang Dikirim ','Pesanan Anda dengan ID #ORD-6A032824E11BB sedang dikirimkan ke alamat Anda.','info','bell',1,'2026-05-12 13:16:40','2026-05-12 13:17:09'),(12,6,'Pesanan Selesai ✅','Pesanan Anda dengan ID #ORD-6A032824E11BB telah selesai. Terima kasih telah berbelanja!','success','bell',1,'2026-05-12 13:16:57','2026-05-12 13:17:09');
/*!40000 ALTER TABLE `user_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_index` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@gmail.com',NULL,NULL,'2026-04-15 01:21:28','$2y$12$kdM4sGi/3FXFQgiho68aXub2IIetPp8FFIZObuV3qhvia2jIFHEEu','admin',NULL,'2026-04-15 01:21:28','2026-04-15 04:13:54',NULL,NULL,NULL,NULL,NULL),(3,'Rudi','rudi@email.com','081234567891',NULL,NULL,'$2y$12$ttRKEDP49G16v9WkFW9yi.avceryP76jj9FznZpPHGjLJhm.fWyvG','user',NULL,'2026-04-15 01:21:29','2026-04-15 01:21:29',NULL,NULL,NULL,NULL,NULL),(4,'Cindy','cindy@email.com','081234567892',NULL,NULL,'$2y$12$bhYbdxMWppyNvYIIEQuwbO/DJge0Uv4afcSv2Y9bQb0rCFsW3AL3S','user',NULL,'2026-04-15 01:21:29','2026-04-15 01:21:29',NULL,NULL,NULL,NULL,NULL),(6,'jack','jackk@gmail.com',NULL,'jalan pahlawan',NULL,'$2y$12$1iGwuLktsSuLlp3XulgfwOlyJDWu9xSwPL9lUnNhjI6x1xg98bSBK','user',NULL,'2026-04-15 01:43:26','2026-05-12 12:48:53','5.6599803','100.4971918',NULL,'Laki-laki','avatars/avatar_6_1778590133.jpg'),(7,'wadwa','adwas@gmail.com','081234567891','weqwe',NULL,'$2y$12$xR..XOjN/fZaMN/f/5OVk.ZG.Fzjt2b6D9IMyK65Y/kuM9Tr49Z2a','user',NULL,'2026-05-12 02:10:06','2026-05-12 02:10:06',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-12 21:18:45
