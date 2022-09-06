-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 15, 2022 at 08:59 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homzdepot`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
                               `id` bigint(20) UNSIGNED NOT NULL,
                               `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `routes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                               `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                               `created_at` timestamp NULL DEFAULT NULL,
                               `updated_at` timestamp NULL DEFAULT NULL,
                               PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `routes`, `group`, `created_at`, `updated_at`) VALUES
(1, 'عرض المستخدمين', 'admin', 'users.index', 'المستخدمين', NULL, NULL),
(2, 'اضافة مستخدم', 'admin', 'users.create,users.store', 'المستخدمين', NULL, NULL),
(3, 'تعديل مستخدم', 'admin', 'users.edit,users.update', 'المستخدمين', NULL, NULL),
(4, 'حذف مستخدم', 'admin', 'users.destroy', 'المستخدمين', NULL, NULL),
(5, 'عرض الموردين', 'admin', 'suppliers.index', 'الموردين', NULL, NULL),
(6, 'اضافة مورد', 'admin', 'suppliers.create,suppliers.store', 'الموردين', NULL, NULL),
(7, 'تعديل مورد', 'admin', 'suppliers.edit,suppliers.update', 'الموردين', NULL, NULL),
(8, 'حذف مورد', 'admin', 'suppliers.destroy', 'الموردين', NULL, NULL),
(9, 'عرض التحويلات', 'admin', 'payment.index,all.payment', 'التحويلات المالية', NULL, NULL),
(10, 'تسجيل تحويل', 'admin', 'payment.store', 'التحويلات المالية', NULL, NULL),
(11, 'عرض وانشاء وتعديل وحذف محافظات', 'admin', 'goverments.index', 'المحافظات', NULL, NULL),
(12, 'عرض المنتجات', 'admin', 'products.pending,products.out-of-stock', 'المنتجات', NULL, NULL),
(13, 'رفض وقبول المنتجات', 'admin', 'product.pending.accept,product.pending.reject', 'المنتجات', NULL, NULL),
(14, 'تعديل منتج', 'admin', 'accepted.edit,accepted.update', 'المنتجات', NULL, NULL),
(15, 'حذف منتج', 'admin', 'accepted.destroy', 'المنتجات', NULL, NULL),
(16, 'عرض الرتب', 'admin', 'roles.index', 'الرتب', NULL, NULL),
(17, 'اضافة رتبة', 'admin', 'roles.create,roles.store', 'الرتب', NULL, NULL),
(18, 'تعديل رتبة', 'admin', 'roles.edit,roles.update', 'الرتب', NULL, NULL),
(19, 'حذف رتبة', 'admin', 'roles.destroy', 'الرتب', NULL, NULL),
(20, 'عرض اﻹعدادات', 'admin', 'setting.index', 'اﻹعدادات', NULL, NULL),
(21, 'تعديل اﻹعدادات', 'admin', 'setting.edit,setting.update', 'اﻹعدادات', NULL, NULL),
(22, 'عرض السجلات', 'admin', 'log.index', 'السجلات', NULL, NULL),
(23, 'عرض وحذف الشكاوي والمقترحات', 'admin', 'complaints.index,complaints.destroy', 'الشكاوي والمقترحات', NULL, NULL),
(24, 'عرض وتعديل وحذف التصنيفات', 'admin', 'categories.index,categories.store,categories.create,categories.edit,categories.destroy', 'التصنيفات', NULL, NULL),
(25, 'عرض وانشاء وتعديل وحذف كوبونات الخصم', 'admin', 'discount-code.destroy,discount-code.index,discount-code.create,discount-code.update', 'كوبونات الخصم', NULL, NULL),
(26, 'تفعيل كوبونات الخصم', 'admin', 'discount-code.toggleBoolean', 'كوبونات الخصم', NULL, NULL),
(27, 'عرض المخزن', 'admin', 'store.index', 'المخزن', NULL, NULL),
(28, 'اضافات الكميات في المخزن', 'admin', 'store.add-quantity,store.add-quantity.show,store.add-quantity.accept,store.add-quantity.reject', 'المخزن', NULL, NULL),
(29, 'سحب الكميات في المخزن', 'admin', 'store.pull-quantity,store.pull-quantity.show,store.pull-quantity.accept,store.pull-quantity.reject', 'المخزن', NULL, NULL),
(30, 'الطلبات المعلقة', 'admin', 'orders.pending,orders.pending.show,orders.pending.accept', 'الطلبات', NULL, NULL),
(31, 'الطلبات قيد التنفيذ', 'admin', 'orders.inProgress,orders.inProgress.show,orders.inProgress.accept', 'الطلبات', NULL, NULL),
(32, 'الطلبات الجاهزة للشحن', 'admin', 'orders.ready,orders.ready.show,orders.ready.accept', 'الطلبات', NULL, NULL),
(33, 'طلبات جاري شحنها', 'admin', 'orders.delivering,orders.delivering.show,orders.delivering.accept', 'الطلبات', NULL, NULL),
(34, 'المنتجات المستلمة', 'admin', 'orders.received,orders.received.show', 'الطلبات', NULL, NULL),
(35, 'المرتجعات', 'admin', 'refund.store,refund.index,refund.show', 'الطلبات', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
