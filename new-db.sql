-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: pos_blok_barat_coffee
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bahan_bakus`
--

DROP TABLE IF EXISTS `bahan_bakus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bahan_bakus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_bahan` varchar(255) NOT NULL,
  `nama_bahan` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL DEFAULT 0,
  `stok` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bahan_bakus_kode_bahan_unique` (`kode_bahan`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bahan_bakus`
--

LOCK TABLES `bahan_bakus` WRITE;
/*!40000 ALTER TABLE `bahan_bakus` DISABLE KEYS */;
INSERT INTO `bahan_bakus` VALUES (1,'BB001','Biji Kopi Espresso','gram',200,5000.00,'2026-07-06 02:20:57','2026-08-07 06:29:05'),(2,'BB002','Susu Segar','ml',15,10000.00,'2026-07-06 02:20:57','2026-08-07 06:29:05'),(3,'BB003','Gula Aren','ml',20,5000.00,'2026-07-06 02:20:57','2026-08-07 06:29:05'),(4,'BB004','Sirup Caramel','ml',30,2000.00,'2026-07-30 05:10:40','2026-08-07 06:29:05'),(5,'BB005','Sirup Vanilla','ml',30,2000.00,'2026-07-30 05:10:40','2026-08-07 06:29:05'),(6,'BB006','Sirup Butterscotch','ml',35,2000.00,'2026-07-30 05:10:40','2026-08-07 06:29:05'),(7,'BB007','Bubuk Coklat','gram',100,3000.00,'2026-07-30 05:10:40','2026-08-07 06:29:05'),(8,'BB008','Bubuk Matcha','gram',150,3000.00,'2026-07-30 05:10:40','2026-08-07 06:29:05'),(9,'BB009','Bubuk Taro','gram',120,3000.00,'2026-07-30 05:10:40','2026-08-07 06:29:05'),(10,'BB010','Bubuk Red Velvet','gram',120,3000.00,'2026-07-30 05:10:40','2026-08-07 06:29:05'),(11,'BB011','Teh Hitam','gram',50,2000.00,'2026-07-30 05:10:40','2026-08-07 06:29:05'),(12,'BB012','Sirup Lychee','ml',25,2000.00,'2026-07-30 05:10:40','2026-08-07 06:29:05'),(13,'BB013','Sirup Lemon','ml',25,2000.00,'2026-07-30 05:10:40','2026-08-07 06:29:05'),(14,'BB014','Es Batu','porsi',500,1000.00,'2026-07-30 05:10:40','2026-08-07 06:29:05'),(15,'BB-015','Roti Tawar','Lembar',0,100.00,'2026-07-30 06:26:40','2026-07-30 06:28:01'),(16,'BB-016','Coklat Meises','Gram',0,1000.00,'2026-07-30 06:26:40','2026-07-30 06:28:18'),(17,'BB-017','Keju Cheddar','Gram',0,1000.00,'2026-07-30 06:26:40','2026-07-30 06:28:29'),(18,'BB-018','Selai Kacang','Gram',0,1000.00,'2026-07-30 06:26:40','2026-07-30 06:28:46'),(19,'BB-019','Selai Strawberry','Gram',0,1000.00,'2026-07-30 06:26:40','2026-07-30 06:28:56'),(20,'BB-020','Selai Nanas','Gram',0,100.00,'2026-07-30 06:26:40','2026-07-30 06:29:58'),(21,'BB-021','Kentang Beku','Gram',0,1000.00,'2026-07-30 06:26:40','2026-07-30 06:30:11'),(22,'BB-022','Nasi Putih','Porsi',0,50.00,'2026-07-30 06:26:40','2026-07-30 06:30:32'),(23,'BB-023','Bumbu Nasi Goreng','Porsi',0,50.00,'2026-07-30 06:26:40','2026-07-30 06:30:21'),(24,'BB-024','Telur','Butir',0,100.00,'2026-07-30 06:26:40','2026-07-30 06:29:39'),(25,'BB-025','Otak-Otak Beku','Pcs',0,100.00,'2026-07-30 06:26:40','2026-07-30 06:29:29'),(26,'BB-026','Nugget Beku','Pcs',0,100.00,'2026-07-30 06:26:40','2026-07-30 06:29:20'),(27,'BB-027','Minyak Goreng','ml',0,2000.00,'2026-07-30 06:26:40','2026-07-30 06:29:05');
/*!40000 ALTER TABLE `bahan_bakus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barang_masuks`
--

DROP TABLE IF EXISTS `barang_masuks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barang_masuks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint(20) unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `total_item` int(11) NOT NULL DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `barang_masuks_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `barang_masuks_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang_masuks`
--

LOCK TABLES `barang_masuks` WRITE;
/*!40000 ALTER TABLE `barang_masuks` DISABLE KEYS */;
/*!40000 ALTER TABLE `barang_masuks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_12_14_000001_create_personal_access_tokens_table',1),(2,'2026_06_13_141553_create_users_table',1),(3,'2026_06_13_144125_create_password_resets_table',1),(4,'2026_06_13_150000_create_suppliers_table',1),(5,'2026_06_13_150001_create_products_table',1),(6,'2026_06_13_150002_create_bahan_bakus_table',1),(7,'2026_06_13_150003_create_transactions_table',1),(8,'2026_06_13_150004_create_transaction_details_table',1),(9,'2026_06_13_150005_create_barang_masuks_table',1),(10,'2026_06_13_150006_add_metode_pembayaran_to_transactions',1),(11,'2026_07_16_052601_add_harga_to_bahan_bakus_table',2),(12,'2026_07_30_120826_create_product_bahan_bakus_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_bahan_bakus`
--

DROP TABLE IF EXISTS `product_bahan_bakus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_bahan_bakus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `bahan_baku_id` bigint(20) unsigned NOT NULL,
  `jumlah` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_bahan_bakus_product_id_foreign` (`product_id`),
  KEY `product_bahan_bakus_bahan_baku_id_foreign` (`bahan_baku_id`),
  CONSTRAINT `product_bahan_bakus_bahan_baku_id_foreign` FOREIGN KEY (`bahan_baku_id`) REFERENCES `bahan_bakus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_bahan_bakus_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_bahan_bakus`
--

LOCK TABLES `product_bahan_bakus` WRITE;
/*!40000 ALTER TABLE `product_bahan_bakus` DISABLE KEYS */;
INSERT INTO `product_bahan_bakus` VALUES (1,1,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:05'),(2,1,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:05'),(3,1,3,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(4,2,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(5,3,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(6,3,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(7,7,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(8,8,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(9,8,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(10,9,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(11,9,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(12,9,3,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(13,10,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(14,10,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(15,10,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(16,10,3,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(17,11,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(18,11,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(19,11,4,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(20,12,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(21,12,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(22,12,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(23,12,4,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(24,13,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(25,13,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(26,13,5,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(27,14,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(28,14,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(29,14,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(30,14,5,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(31,15,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(32,15,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(33,16,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(34,16,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(35,16,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(36,17,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(37,17,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(38,17,6,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(39,18,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(40,18,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(41,18,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(42,18,6,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(43,19,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(44,19,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(45,20,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(46,20,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(47,20,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(48,21,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(49,21,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(50,21,7,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(51,22,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(52,22,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(53,22,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(54,22,7,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(55,23,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(56,24,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(57,24,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(58,24,7,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(59,25,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(60,25,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(61,25,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(62,25,7,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(63,26,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(64,26,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(65,26,8,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(66,27,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(67,27,1,18.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(68,27,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(69,27,8,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(70,28,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(71,28,9,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(72,29,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(73,29,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(74,29,9,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(75,30,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(76,30,10,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(77,31,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(78,31,2,150.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(79,31,10,20.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(80,32,11,10.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(81,32,12,30.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(82,33,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(83,33,11,10.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(84,33,12,30.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(85,34,11,10.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(86,34,13,30.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(87,35,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(88,35,11,10.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(89,35,13,30.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(90,36,11,10.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(91,37,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(92,37,11,10.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(93,38,14,1.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(94,38,13,30.00,'2026-07-30 05:10:40','2026-08-07 06:29:06'),(95,39,14,1.00,'2026-07-30 05:10:41','2026-08-07 06:29:06'),(96,39,13,30.00,'2026-07-30 05:10:41','2026-08-07 06:29:06'),(99,4,15,2.00,'2026-07-30 06:27:21','2026-08-07 06:26:54'),(100,4,16,15.00,'2026-07-30 06:27:21','2026-08-07 06:26:54'),(101,44,15,2.00,'2026-07-30 06:27:21','2026-08-07 06:26:54'),(102,44,16,15.00,'2026-07-30 06:27:21','2026-08-07 06:26:54'),(103,45,15,2.00,'2026-07-30 06:27:21','2026-08-07 06:26:54'),(104,45,17,15.00,'2026-07-30 06:27:21','2026-08-07 06:26:54'),(105,46,15,2.00,'2026-07-30 06:27:21','2026-08-07 06:26:54'),(106,46,18,15.00,'2026-07-30 06:27:21','2026-08-07 06:26:54'),(107,47,15,2.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(108,47,19,15.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(109,48,15,2.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(110,48,20,15.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(111,5,21,150.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(112,5,27,50.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(113,40,21,150.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(114,40,27,50.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(115,6,22,1.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(116,6,23,1.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(117,6,24,1.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(118,6,27,20.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(119,41,25,5.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(120,41,27,30.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(121,42,26,5.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(122,42,27,30.00,'2026-07-30 06:27:21','2026-08-07 06:26:55'),(127,43,1,18.00,'2026-08-07 06:29:06','2026-08-07 06:29:06'),(128,43,2,150.00,'2026-08-07 06:29:06','2026-08-07 06:29:06');
/*!40000 ALTER TABLE `product_bahan_bakus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_beli` decimal(15,2) NOT NULL DEFAULT 0.00,
  `harga_jual` decimal(15,2) NOT NULL DEFAULT 0.00,
  `stok` int(11) NOT NULL DEFAULT 0,
  `kategori` varchar(255) NOT NULL DEFAULT 'minuman',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_kode_produk_unique` (`kode_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'PR001','Es Kopi Susu',10000.00,18000.00,96,'minuman','2026-07-06 02:20:57','2026-08-04 12:54:06'),(2,'PR002','Americano',8000.00,15000.00,99,'minuman','2026-07-06 02:20:57','2026-07-30 20:48:10'),(3,'PR003','Cappuccino',12000.00,22000.00,95,'minuman','2026-07-06 02:20:57','2026-08-04 12:54:37'),(4,'PR004','Roti Bakar Cokelat',8000.00,15000.00,50,'makanan','2026-07-06 02:20:57','2026-07-06 02:20:57'),(5,'PR005','Kentang Goreng',7000.00,12000.00,60,'makanan','2026-07-06 02:20:58','2026-07-06 02:20:58'),(6,'PR006','Nasi Goreng Spesial',12000.00,20000.00,39,'makanan','2026-07-06 02:20:58','2026-07-13 00:00:17'),(7,'COF018','Americano Hot',7500.00,15000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(8,'COF019','Americano Ice',9000.00,18000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(9,'COF020','Kopi Susu Barat Hot',8000.00,16000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(10,'COF021','Kopi Susu Barat Ice',9000.00,18000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(11,'COF022','Caramel Machiato Hot',10000.00,20000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(12,'COF023','Caramel Machiato Ice',11500.00,23000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(13,'COF024','Vanilla Latte Hot',10000.00,20000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(14,'COF025','Vanilla Latte Ice',11500.00,23000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(15,'COF026','Cafe Latte Hot',10000.00,20000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(16,'COF027','Cafe Latte Ice',11500.00,23000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(17,'COF028','Butterscotch Latte Hot',10000.00,20000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(18,'COF029','Butterscotch Latte Ice',11500.00,23000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(19,'COF030','Cappuccino Hot',10000.00,20000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(20,'COF031','Cappuccino Ice',11500.00,23000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(21,'COF032','Mochacino Hot',11500.00,23000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(22,'COF033','Mochacino Ice',12500.00,25000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(23,'COF034','Add Espresso',2500.00,5000.00,50,'minuman_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(24,'NCF017','Chocolatte Hot',10000.00,20000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(25,'NCF018','Chocolatte Ice',11500.00,23000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(26,'NCF019','Matcha Latte Hot',10000.00,20000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(27,'NCF020','Matcha Latte Ice',11500.00,23000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(28,'NCF021','Taro Hot',10000.00,20000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(29,'NCF022','Taro Ice',11500.00,23000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(30,'NCF023','Red Velvet Hot',10000.00,20000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(31,'NCF024','Red Velvet Ice',11500.00,23000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(32,'NCF025','Lychee Tea Hot',10000.00,20000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(33,'NCF026','Lychee Tea Ice',11500.00,23000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(34,'NCF027','Lemon Tea Hot',7500.00,15000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(35,'NCF028','Lemon Tea Ice',9000.00,18000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(36,'NCF029','Black Tea Hot',7500.00,15000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(37,'NCF030','Black Tea Ice',9000.00,18000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(38,'NCF031','Lemon Squash Ice',10000.00,20000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(39,'NCF032','Citrus Mint Ice',11500.00,23000.00,50,'minuman_non_coffee','2026-07-15 20:59:55','2026-08-07 06:29:05'),(40,'MKN010','French Fries',8000.00,16000.00,50,'makanan','2026-07-15 21:04:12','2026-08-07 06:29:04'),(41,'MKN011','Otak-Otak',8000.00,16000.00,50,'makanan','2026-07-15 21:04:12','2026-08-07 06:29:04'),(42,'MKN012','Nugget',8000.00,16000.00,50,'makanan','2026-07-15 21:04:12','2026-08-07 06:29:04'),(43,'MKN013','Mix Platter',11500.00,23000.00,50,'makanan','2026-07-15 21:04:12','2026-08-07 06:29:04'),(44,'MKN014','Roti Bakar Coklat',6500.00,13000.00,50,'makanan','2026-07-15 21:04:12','2026-08-07 06:29:04'),(45,'MKN015','Roti Bakar Keju',6500.00,13000.00,50,'makanan','2026-07-15 21:04:12','2026-08-07 06:29:04'),(46,'MKN016','Roti Bakar Kacang',6500.00,13000.00,50,'makanan','2026-07-15 21:04:12','2026-08-07 06:29:04'),(47,'MKN017','Roti Bakar Strawberry',6500.00,13000.00,50,'makanan','2026-07-15 21:04:12','2026-08-07 06:29:04'),(48,'MKN018','Roti Bakar Nanas',6500.00,13000.00,50,'makanan','2026-07-15 21:04:12','2026-08-07 06:29:04');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'PT Kopi Nusantara','Bekasi','081234567890','2026-07-06 02:20:57','2026-07-06 02:20:57'),(2,'PT Susu Segar Indonesia','Jakarta','081234567891','2026-07-06 02:20:57','2026-07-06 02:20:57');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_details`
--

DROP TABLE IF EXISTS `transaction_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `harga` decimal(15,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_details_transaction_id_foreign` (`transaction_id`),
  KEY `transaction_details_product_id_foreign` (`product_id`),
  CONSTRAINT `transaction_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaction_details_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_details`
--

LOCK TABLES `transaction_details` WRITE;
/*!40000 ALTER TABLE `transaction_details` DISABLE KEYS */;
INSERT INTO `transaction_details` VALUES (1,1,1,1,18000.00,18000.00,'2026-07-06 02:25:58','2026-07-06 02:25:58'),(2,1,3,1,22000.00,22000.00,'2026-07-06 02:25:58','2026-07-06 02:25:58'),(3,2,6,1,20000.00,20000.00,'2026-07-13 00:00:17','2026-07-13 00:00:17'),(4,3,3,1,22000.00,22000.00,'2026-07-21 21:04:38','2026-07-21 21:04:38'),(5,4,3,1,22000.00,22000.00,'2026-07-28 20:53:19','2026-07-28 20:53:19'),(6,5,3,1,22000.00,22000.00,'2026-07-28 20:53:19','2026-07-28 20:53:19'),(7,6,32,1,20000.00,20000.00,'2026-07-30 05:14:17','2026-07-30 05:14:17'),(8,7,2,1,15000.00,15000.00,'2026-07-30 20:48:10','2026-07-30 20:48:10'),(9,8,24,1,20000.00,20000.00,'2026-07-30 23:06:05','2026-07-30 23:06:05'),(10,9,1,1,18000.00,18000.00,'2026-08-04 12:54:06','2026-08-04 12:54:06'),(11,10,1,1,18000.00,18000.00,'2026-08-04 12:54:06','2026-08-04 12:54:06'),(12,11,1,1,18000.00,18000.00,'2026-08-04 12:54:06','2026-08-04 12:54:06'),(13,12,3,1,22000.00,22000.00,'2026-08-04 12:54:37','2026-08-04 12:54:37'),(14,13,31,1,23000.00,23000.00,'2026-08-07 05:57:51','2026-08-07 05:57:51');
/*!40000 ALTER TABLE `transaction_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice` varchar(255) NOT NULL,
  `kasir_id` bigint(20) unsigned NOT NULL,
  `total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bayar` decimal(15,2) NOT NULL DEFAULT 0.00,
  `kembali` decimal(15,2) NOT NULL DEFAULT 0.00,
  `metode_pembayaran` enum('cash','qris','transfer','kartu') NOT NULL DEFAULT 'cash',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transactions_invoice_unique` (`invoice`),
  KEY `transactions_kasir_id_foreign` (`kasir_id`),
  CONSTRAINT `transactions_kasir_id_foreign` FOREIGN KEY (`kasir_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,'INV-20260706-0001',1,40000.00,40000.00,0.00,'cash','2026-07-06 02:25:58','2026-07-06 02:25:58'),(2,'INV-20260713-0001',1,20000.00,100000.00,80000.00,'cash','2026-07-13 00:00:17','2026-07-13 00:00:17'),(3,'INV-20260722-0001',1,22000.00,30000.00,8000.00,'cash','2026-07-21 21:04:38','2026-07-21 21:04:38'),(4,'INV-20260729-0001',1,22000.00,50000.00,28000.00,'cash','2026-07-28 20:53:19','2026-07-28 20:53:19'),(5,'INV-20260729-0002',1,22000.00,50000.00,28000.00,'cash','2026-07-28 20:53:19','2026-07-28 20:53:19'),(6,'INV-20260730-0001',1,20000.00,50000.00,30000.00,'cash','2026-07-30 05:14:17','2026-07-30 05:14:17'),(7,'INV-20260731-0001',1,15000.00,20000.00,5000.00,'cash','2026-07-30 20:48:10','2026-07-30 20:48:10'),(8,'INV-20260731-0002',1,20000.00,20000.00,0.00,'cash','2026-07-30 23:06:05','2026-07-30 23:06:05'),(9,'INV-20260804-0001',1,18000.00,20000.00,2000.00,'cash','2026-08-04 12:54:05','2026-08-04 12:54:05'),(10,'INV-20260804-0002',1,18000.00,20000.00,2000.00,'cash','2026-08-04 12:54:06','2026-08-04 12:54:06'),(11,'INV-20260804-0003',1,18000.00,20000.00,2000.00,'cash','2026-08-04 12:54:06','2026-08-04 12:54:06'),(12,'INV-20260804-0004',1,22000.00,50000.00,28000.00,'cash','2026-08-04 12:54:37','2026-08-04 12:54:37'),(13,'INV-20260807-0001',1,23000.00,23000.00,0.00,'kartu','2026-08-07 05:57:50','2026-08-07 05:57:50');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','kasir') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Rabil Setiady','rabil setiady123','$2y$10$NAViP09CuxJTx4TPuRyu2O5vtF5Dsu0OQvTXj73L.UFlpptwvmTvu','admin',NULL,'2026-07-06 02:20:57','2026-07-06 02:20:57'),(2,'Kasir Cafe','kasir01','$2y$10$ca8h.1t6ZlHAg2geuyMoYuVTVy03QCsokk39ee3GRv7cbbsiM4P2m','kasir',NULL,'2026-07-06 02:20:57','2026-07-06 02:20:57');
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

-- Dump completed on 2026-08-18 20:33:37
