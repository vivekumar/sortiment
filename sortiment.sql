-- Adminer 4.8.1 MySQL 5.7.34-0ubuntu0.18.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'admin@admin.com',	'2021-07-23 02:22:00',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	'aAXRJh1xEy',	NULL,	NULL,	'2021-07-23 02:22:00',	'2021-07-23 02:22:00');

DROP TABLE IF EXISTS `attributes`;
CREATE TABLE `attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `attributes` (`id`, `attr_name`, `created_at`, `updated_at`) VALUES
(1,	'Color',	NULL,	NULL),
(2,	'Size',	NULL,	NULL);

DROP TABLE IF EXISTS `attribute_values`;
CREATE TABLE `attribute_values` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` int(10) unsigned NOT NULL,
  `attr_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attr_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_values_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `attribute_values` (`id`, `attribute_id`, `attr_value`, `attr_code`, `created_at`, `updated_at`) VALUES
(1,	1,	'White',	'#fff',	NULL,	NULL),
(2,	1,	'Black',	'#000',	NULL,	NULL),
(3,	2,	'XL',	'XL',	NULL,	NULL),
(4,	2,	'L',	'L',	NULL,	NULL),
(5,	2,	'M',	'M',	NULL,	NULL);

DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `brands` (`id`, `brand_name`, `brand_slug`, `created_at`, `updated_at`) VALUES
(1,	'Stella Kshlerin',	'Inventore et aut consectetur. Aut et voluptas ullam non. Voluptatem ipsam dolorem tempora possimus.',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(2,	'Hilda Cronin',	'Optio non corrupti cumque eaque aut atque rerum. Enim fugit sit veniam. Corrupti sunt eveniet vel quia sint. Vero quia omnis dolor iste iste porro.',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(3,	'Berta Carter DDS',	'Explicabo veritatis maiores officia fuga eveniet rerum. Dolorem sit facilis repellendus omnis quo consequatur tenetur sit. Dolores eos vel et sed dolor. Ducimus odio ducimus commodi culpa.',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(4,	'Mr. Jared Spinka',	'Neque iste reiciendis qui aut. Qui illum dignissimos et culpa similique. Ut fugit enim at dolores pariatur. Harum nesciunt iusto autem aut. Qui eligendi autem nam voluptates quo fugiat at.',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(5,	'Prof. Pierre Frami I',	'Itaque voluptates aliquid voluptates omnis. Ex magnam voluptas ratione est hic non. Non recusandae quas eum amet cupiditate provident quia quis.',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(6,	'Bell Marks',	'Voluptas exercitationem non cupiditate praesentium sed. Qui ipsam ex fugiat eum consequatur. Consequatur eius cumque nisi quia.',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(7,	'Stephania Cremin',	'Ut numquam et qui enim laboriosam. Natus nesciunt et delectus commodi. Qui est praesentium fuga reiciendis et.',	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(8,	'Chasity Nader',	'Tempora quia nobis eaque omnis. Officia eius deserunt amet ut corporis eum exercitationem. Recusandae eveniet earum consequatur ad quidem eius voluptas magnam.',	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(9,	'Odessa Haag',	'Autem atque et et voluptatem veritatis aut. Dignissimos porro dolor fuga quos dignissimos. Sequi sapiente possimus minus delectus. Aut explicabo repellat est consequatur consequuntur molestias id.',	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(10,	'Sage Bogisich DVM',	'Iure nihil expedita reiciendis. Quos ea incidunt nulla est. Voluptatem vel omnis nihil molestiae ducimus similique rerum. Voluptatem placeat temporibus laborum consequatur asperiores.',	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(11,	'Demarco Halvorson',	'Voluptas laborum et molestias consequatur. Fuga et suscipit accusantium necessitatibus. Delectus quo ullam sunt eos voluptas voluptatem. Laudantium natus aut minima soluta quam quis ad.',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(12,	'Savion Rogahn',	'Quod dolorem eos et et culpa. Amet eveniet est dolores voluptate suscipit ducimus minima. Unde sed est sunt quam accusantium illum aut.',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(13,	'Mafalda Olson DDS',	'Fugiat pariatur officiis id sit dolorem ab non. Itaque deserunt id ipsum. Rerum totam labore voluptatibus. Non sed repellat officiis magnam.',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(14,	'Garland Cole MD',	'Dolorem repellendus quia excepturi ut. Amet id et temporibus debitis. Itaque modi dolores ipsam laborum dolores molestiae. Occaecati et et ea ex illo repudiandae occaecati.',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(15,	'Bria Kub',	'Debitis inventore consequuntur quia consequuntur hic non. Voluptatem non expedita optio et dolor explicabo dolorum. Illo autem pariatur quibusdam quidem. Optio repellendus tenetur asperiores ipsa.',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(16,	'Vada Collins',	'Saepe delectus repellat labore nemo. Necessitatibus aut illo illo porro qui esse aut.',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(17,	'Gay Kirlin V',	'Possimus quia impedit ex eos. Voluptatem esse non aut esse. Et ut sed delectus necessitatibus impedit.',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(18,	'Hermina Gusikowski',	'Id qui id quas nobis est quod iste. Itaque ut magni quis consequuntur quidem fuga. Quia vero voluptatibus laborum corporis. Et molestiae ea molestiae suscipit expedita.',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(19,	'Prof. Joshua Ullrich I',	'Iure odio et ducimus inventore eveniet. Labore dolorem excepturi et ut cum ut quia. Ut ea eos quia rerum voluptatem reprehenderit dicta. Qui fugiat eveniet quos repellat culpa voluptas.',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(20,	'Dr. Garret Kertzmann',	'Magnam quasi soluta quos sint fuga impedit facere. Rerum et iure voluptatem sint. Rerum odio accusantium ad blanditiis reprehenderit quo est.',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(21,	'Amalia Botsford DVM',	'Cupiditate neque velit illo tenetur molestiae fuga. Quisquam nulla voluptatum dolorem molestiae. Harum alias nostrum a suscipit in.',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(22,	'Prof. Brenden Hammes V',	'Minus perspiciatis eum sed quo ipsa possimus quisquam voluptate. Aut voluptas aut doloribus aut tenetur consequatur labore. Ut eum ipsa voluptatibus aut alias fugiat.',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(23,	'Prof. Nelle Bosco Jr.',	'Repellendus dolorem tempora autem quidem. Fuga et et autem similique earum nesciunt minus.',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(24,	'Katlynn Cummings',	'Illo culpa aliquam fugiat aut eligendi. Blanditiis ut veritatis sit consequatur laudantium error.',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(25,	'Prof. Garrett Strosin III',	'Qui voluptatibus quisquam minus. Rerum temporibus non consequuntur vel magni illo aut. Quidem earum occaecati quibusdam voluptatum. Cupiditate aut enim quaerat laborum et.',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cagegory_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `category_name`, `cagegory_slug`, `created_at`, `updated_at`) VALUES
(1,	'rerum',	'ratione',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(2,	'officia',	'ut',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(3,	'velit',	'corrupti',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(5,	'non',	'repellendus',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(6,	'rerum',	'eum',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(7,	'enim',	'doloribus',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(8,	'commodi',	'pariatur',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(9,	'rerum',	'dolor',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(10,	'reprehenderit',	'aliquam',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(11,	'odio',	'dolores',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(12,	'sint',	'qui',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(13,	'et',	'et',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(14,	'veniam',	'dolorem',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(15,	'illum',	'hic',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(16,	'nihil',	'quia',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(17,	'sunt',	'dignissimos',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(18,	'voluptas',	'eaque',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(19,	'fugit',	'incidunt',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(20,	'beatae',	'dolorum',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(21,	'sapiente',	'placeat',	'2021-07-23 02:22:01',	'2021-07-23 02:22:01'),
(22,	'ut',	'at',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(23,	'qui',	'consequatur',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(24,	'quo',	'tenetur',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(25,	'ullam',	'voluptatum',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(26,	'consequatur',	'quas',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(27,	'nihil',	'provident',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(28,	'enim',	'perferendis',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(29,	'sit',	'nulla',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(30,	'repudiandae',	'veniam',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(31,	'repellat',	'minus',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(32,	'aut',	'omnis',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(33,	'culpa',	'harum',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(34,	'dolor',	'eos',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(35,	'tempore',	'impedit',	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(36,	'magni',	'minima',	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(37,	'minima',	'id',	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(38,	'numquam',	'illo',	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(39,	'ratione',	'quos',	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(40,	'autem',	'sed',	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(41,	'voluptatem',	'error',	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(42,	'odio',	'deleniti',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(43,	'laboriosam',	'illum',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(44,	'voluptatem',	'vel',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(45,	'qui',	'quis',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(46,	'fugiat',	'distinctio',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(47,	'et',	'suscipit',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(48,	'assumenda',	'rerum',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(49,	'et',	'tempore',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(50,	'ipsa',	'magni',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(51,	'reprehenderit',	'ea',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(52,	'exercitationem',	'consequuntur',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(53,	'sed',	'vero',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(54,	'ut',	'aut',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(55,	'cumque',	'eligendi',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(56,	'itaque',	'doloremque',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(57,	'odio',	'nesciunt',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(58,	'culpa',	'quasi',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(59,	'nemo',	'dicta',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(60,	'et',	'voluptate',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(61,	'id',	'debitis',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(62,	'est',	'voluptatem',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(63,	'fuga',	'autem',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(64,	'eos',	'delectus',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(65,	'aut',	'dolore',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(66,	'qui',	'esse',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(67,	'impedit',	'perspiciatis',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(68,	'repellendus',	'iusto',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(69,	'inventore',	'in',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(70,	'et',	'sit',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07');

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_admins_table',	1),
(2,	'2014_10_12_000000_create_employees_table',	1),
(3,	'2014_10_12_000000_create_users_table',	1),
(4,	'2014_10_12_100000_create_password_resets_table',	1),
(5,	'2014_10_12_200000_add_two_factor_columns_to_users_table',	1),
(6,	'2019_08_19_000000_create_failed_jobs_table',	1),
(7,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(8,	'2021_06_01_072313_create_sessions_table',	1),
(9,	'2021_06_04_080404_create_categories_table',	1),
(10,	'2021_06_07_055114_create_products_table',	1),
(11,	'2021_06_07_062051_create_multi_imgs_table',	1),
(12,	'2021_06_10_095956_create_sub_categories_table',	1),
(13,	'2021_07_15_090654_create_my_products_table',	1),
(14,	'2021_07_20_094133_create_brands_table',	1),
(15,	'2021_07_21_054019_create_attributes_table',	1),
(16,	'2021_07_21_054020_create_attribute_values_table',	1),
(17,	'2021_07_21_054045_create_product_attributes_table',	1);

DROP TABLE IF EXISTS `multi_imgs`;
CREATE TABLE `multi_imgs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `multi_imgs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `my_products`;
CREATE TABLE `my_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `text_on_product` int(11) NOT NULL DEFAULT '0',
  `logo_on_product` int(11) NOT NULL DEFAULT '0',
  `logo_front_left` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_front_right` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_shoulder_left` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_shoulder_right` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_onthe_back_side` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_front_left` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_front_right` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_shoulder_left` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_shoulder_right` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_onthe_back_side` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Approved','Denied','Ordered') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `brand_id` int(10) unsigned NOT NULL,
  `subcategory_id` int(10) unsigned NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` decimal(8,2) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `product_thambnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty1` int(10) unsigned NOT NULL,
  `qty2` int(10) unsigned NOT NULL,
  `qty3` int(10) unsigned NOT NULL,
  `qty4` int(10) unsigned NOT NULL,
  `qty5` int(10) unsigned NOT NULL,
  `price1` decimal(8,2) NOT NULL,
  `price2` decimal(8,2) NOT NULL,
  `price3` decimal(8,2) NOT NULL,
  `price4` decimal(8,2) NOT NULL,
  `price5` decimal(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_brand_id_index` (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `category_id`, `user_id`, `brand_id`, `subcategory_id`, `product_name`, `product_slug`, `product_sku`, `product_price`, `description`, `product_thambnail`, `qty1`, `qty2`, `qty3`, `qty4`, `qty5`, `price1`, `price2`, `price3`, `price4`, `price5`, `status`, `created_at`, `updated_at`) VALUES
(1,	31,	11,	6,	21,	'Prof.',	'Reba Baumbach',	'Rhoda Prohaska II',	2.00,	'Et excepturi cum est expedita. Numquam et ut dolore illo placeat quia. Tenetur est dolor dolorum temporibus. Perspiciatis doloribus quae excepturi ducimus est dolor beatae.',	'https://via.placeholder.com/200x200.png/00eecc?text=illo',	0,	10,	25,	50,	100,	2.00,	7.00,	9.00,	9.00,	6.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(2,	33,	12,	7,	22,	'Prof.',	'Mr. Xavier McKenzie',	'Arvid Kerluke',	1.00,	'Iusto aut vel aut laborum maiores laborum. Est aperiam enim occaecati laudantium officiis aut. Necessitatibus excepturi voluptate voluptas accusamus.',	'https://via.placeholder.com/200x200.png/000077?text=itaque',	0,	10,	25,	50,	100,	2.00,	8.00,	4.00,	2.00,	2.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(3,	35,	13,	8,	23,	'Miss',	'Mrs. Esther Spinka',	'Valerie Wilderman',	4.00,	'Et libero ad id distinctio. Modi illo perferendis ea voluptatem tempora rerum reiciendis. Porro exercitationem architecto in et magnam exercitationem quo. Maiores quis exercitationem cumque consequuntur quia molestiae.',	'https://via.placeholder.com/200x200.png/00ddbb?text=laborum',	0,	10,	25,	50,	100,	5.00,	8.00,	9.00,	4.00,	5.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(4,	37,	14,	9,	24,	'Prof.',	'Celestine Turner',	'Winston Erdman',	3.00,	'Ad quaerat magnam tempora odio maxime quis. Praesentium nesciunt reiciendis nisi maxime atque. Fuga est omnis dicta qui ut. Cupiditate consequatur pariatur cum minima.',	'https://via.placeholder.com/200x200.png/006633?text=provident',	0,	10,	25,	50,	100,	2.00,	6.00,	4.00,	1.00,	4.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(5,	39,	15,	10,	25,	'Mr.',	'Janessa Rice',	'Gussie Zulauf',	1.00,	'Aut neque et possimus aut nihil eum. Explicabo voluptatem repellat et reiciendis magnam iusto non. Ipsa sunt ducimus magni omnis nemo repudiandae amet et. Omnis quia rerum et quo quibusdam.',	'https://via.placeholder.com/200x200.png/0011dd?text=et',	0,	10,	25,	50,	100,	8.00,	3.00,	1.00,	6.00,	6.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(6,	41,	16,	11,	26,	'Mr.',	'Dr. Flo Goodwin PhD',	'Maynard Skiles',	4.00,	'Labore nostrum quo impedit iste beatae ab dolores. Ut voluptatem error alias autem recusandae eos quidem. Reprehenderit illum repellat nihil suscipit sint vel. Ut commodi minima qui eum.',	'https://via.placeholder.com/200x200.png/00bb99?text=excepturi',	0,	10,	25,	50,	100,	8.00,	6.00,	4.00,	1.00,	0.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(7,	43,	17,	12,	27,	'Dr.',	'Jamar Borer V',	'Hilton Labadie',	5.00,	'Consectetur minima laudantium consequatur consequatur. Omnis sit et est a dolore. Non qui sed ratione dicta dolores explicabo.',	'https://via.placeholder.com/200x200.png/0055dd?text=iste',	0,	10,	25,	50,	100,	0.00,	5.00,	2.00,	3.00,	9.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(8,	45,	18,	13,	28,	'Prof.',	'Dr. Davonte Terry',	'Alfred Rohan DDS',	1.00,	'Eos ullam expedita dolorem aut et consectetur quia. Sunt sint laboriosam voluptatem assumenda provident illo.',	'https://via.placeholder.com/200x200.png/000077?text=et',	0,	10,	25,	50,	100,	8.00,	6.00,	7.00,	3.00,	5.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(9,	47,	19,	14,	29,	'Miss',	'Maverick Wolff',	'Eldon Stamm',	3.00,	'Id qui autem totam consequuntur et aut. Veritatis error sed assumenda rerum natus error est. Facilis eveniet iusto ipsa aspernatur rerum qui. Consequatur suscipit rerum quibusdam beatae quae.',	'https://via.placeholder.com/200x200.png/0044dd?text=vel',	0,	10,	25,	50,	100,	3.00,	3.00,	7.00,	2.00,	6.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(10,	49,	20,	15,	30,	'Prof.',	'Dorothea Lockman',	'Kasandra Collins',	9.00,	'Nam aliquid veritatis expedita aliquid et magni. Omnis sit voluptas est numquam deserunt fuga. Ut consequatur nihil et voluptatem nisi. Voluptatem error minima quasi eaque a.',	'https://via.placeholder.com/200x200.png/00bb66?text=cum',	0,	10,	25,	50,	100,	2.00,	1.00,	4.00,	0.00,	0.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(11,	51,	21,	16,	31,	'Prof.',	'Yasmin Yundt',	'Rollin Graham',	3.00,	'Molestiae doloremque sunt ea nam ut est rerum. Aliquam sunt enim facere omnis. Doloribus ipsa amet aut atque maiores qui.',	'https://via.placeholder.com/200x200.png/009900?text=sit',	0,	10,	25,	50,	100,	4.00,	3.00,	5.00,	1.00,	2.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(12,	53,	22,	17,	32,	'Mrs.',	'Ms. Reva Mraz',	'Dr. Lucius Kuhlman PhD',	9.00,	'Quis consequatur unde vero saepe et dolor itaque. Voluptatem animi velit laudantium est. Eligendi provident occaecati voluptate nisi voluptas unde ipsa. Sint et illo tenetur natus qui est.',	'https://via.placeholder.com/200x200.png/009988?text=molestiae',	0,	10,	25,	50,	100,	1.00,	9.00,	0.00,	3.00,	9.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(13,	55,	23,	18,	33,	'Ms.',	'Ona Kertzmann Jr.',	'Colten Wisoky',	7.00,	'Id quod dolor facilis nihil occaecati occaecati. Ab ullam voluptatem praesentium qui. Voluptate vitae voluptatem ut aperiam aut. Vero molestiae quam dolores quasi consequatur tenetur occaecati. Consequuntur eum maxime reiciendis at illum illo sit.',	'https://via.placeholder.com/200x200.png/00aa77?text=est',	0,	10,	25,	50,	100,	6.00,	2.00,	0.00,	7.00,	7.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(14,	57,	24,	19,	34,	'Ms.',	'Annette Kling',	'Easter Schulist',	8.00,	'Distinctio nulla delectus magnam voluptas porro non provident ab. Corrupti pariatur nostrum et voluptas perferendis.',	'https://via.placeholder.com/200x200.png/00ee33?text=fuga',	0,	10,	25,	50,	100,	9.00,	6.00,	5.00,	4.00,	7.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(15,	59,	25,	20,	35,	'Dr.',	'Tyrel Schmidt II',	'Carolyne Howell I',	0.00,	'Accusamus neque praesentium fugiat. Modi neque at molestiae cumque quibusdam autem quod.',	'https://via.placeholder.com/200x200.png/0088ff?text=ratione',	0,	10,	25,	50,	100,	5.00,	3.00,	7.00,	8.00,	6.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(16,	61,	26,	21,	36,	'Miss',	'Delbert Schneider Sr.',	'Cale Bartoletti',	7.00,	'Quo sed dolorem blanditiis dolorem doloremque minima sit. Sed ratione occaecati odio iusto assumenda odit blanditiis. Alias libero dolorem libero dignissimos.',	'https://via.placeholder.com/200x200.png/00ff11?text=impedit',	0,	10,	25,	50,	100,	5.00,	4.00,	8.00,	2.00,	0.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(17,	63,	27,	22,	37,	'Mr.',	'Justyn Smith MD',	'Charity Koepp MD',	4.00,	'Alias dolor voluptas eum natus ipsum. Aspernatur est voluptate enim explicabo id praesentium aut autem. Sed non sunt autem eos omnis quod et. Enim sequi quo voluptatem iure ullam omnis. Earum repudiandae eum eos velit enim.',	'https://via.placeholder.com/200x200.png/00aa33?text=quis',	0,	10,	25,	50,	100,	0.00,	1.00,	6.00,	1.00,	9.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(18,	65,	28,	23,	38,	'Mr.',	'Ena Runolfsson II',	'Mr. Alden Funk',	0.00,	'Explicabo eum aut quidem illum in perspiciatis nam. Dolor alias occaecati dolores quidem. Et quia eius illum voluptas ut.',	'https://via.placeholder.com/200x200.png/00dd11?text=quia',	0,	10,	25,	50,	100,	5.00,	7.00,	1.00,	5.00,	3.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(19,	67,	29,	24,	39,	'Dr.',	'Sigmund Gleason',	'Mercedes Nitzsche',	5.00,	'Hic et nihil quia in nisi iste explicabo est. Vero pariatur quasi dolorum nesciunt suscipit. Perspiciatis et et quasi.',	'https://via.placeholder.com/200x200.png/0088dd?text=illo',	0,	10,	25,	50,	100,	8.00,	6.00,	1.00,	2.00,	0.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(20,	69,	30,	25,	40,	'Prof.',	'Gianni McDermott',	'Cade Crona',	3.00,	'Eum ut fugiat minima alias corporis nam. Nisi consequuntur expedita explicabo. Asperiores sed eius aut eius tenetur. Nostrum molestiae ea omnis sapiente est nostrum.',	'https://via.placeholder.com/200x200.png/00dd88?text=quia',	0,	10,	25,	50,	100,	6.00,	1.00,	8.00,	2.00,	5.00,	1,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08'),
(21,	62,	30,	20,	36,	'rew',	'rew',	'EEddd',	23.00,	'<p>tewrtf</p>',	'public/uploads/products/thambnail/1706068272195808.png',	0,	10,	25,	50,	100,	32.00,	342.00,	342.00,	23.00,	23.00,	1,	'2021-07-23 04:14:53',	NULL),
(22,	62,	30,	20,	36,	'rew',	'rew',	'EEddd',	23.00,	'<p>tewrtf</p>',	'public/uploads/products/thambnail/1706068477120112.png',	0,	10,	25,	50,	100,	32.00,	342.00,	342.00,	23.00,	23.00,	1,	'2021-07-23 04:18:08',	NULL),
(23,	62,	30,	20,	36,	'rew',	'rew',	'EEddd',	23.00,	'<p>tewrtf</p>',	'public/uploads/products/thambnail/1706068500467233.png',	0,	10,	25,	50,	100,	32.00,	342.00,	342.00,	23.00,	23.00,	1,	'2021-07-23 04:18:31',	NULL),
(24,	62,	30,	20,	36,	'rew',	'rew',	'EEddd',	23.00,	'<p>tewrtf</p>',	'public/uploads/products/thambnail/1706068819038319.png',	0,	10,	25,	50,	100,	32.00,	342.00,	342.00,	23.00,	23.00,	1,	'2021-07-23 04:23:35',	NULL);

DROP TABLE IF EXISTS `product_attributes`;
CREATE TABLE `product_attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `attribute_id` int(10) unsigned NOT NULL,
  `attrvalue_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attributes_product_id_foreign` (`product_id`),
  KEY `product_attributes_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `product_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_id`, `attrvalue_id`, `created_at`, `updated_at`) VALUES
(1,	24,	1,	1,	'2021-07-23 04:23:35',	NULL),
(3,	24,	2,	3,	'2021-07-23 04:23:35',	NULL),
(4,	24,	2,	4,	'2021-07-23 04:23:35',	NULL);

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('nKAF9WHgg96aOlh1xHlEGQWeJoSxuODMyvyiR3IE',	1,	'::1',	'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36',	'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUmdrQzZjUlM0UnBETzlRUzU2TWw2SndCQUJCamRwOGp2YnBaMVdRViI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ2OiJodHRwOi8vbG9jYWxob3N0L2xhcmF2ZWwvc29ydGltZW50L2NvbXBhbnkvYWRkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',	1627046651);

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE `sub_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sub_categories` (`id`, `category_id`, `subcategory_name`, `subcategory_slug`, `created_at`, `updated_at`) VALUES
(1,	11,	'Clifton Barton',	'Jalen Ferry',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(2,	12,	'Alfreda Heathcote',	'Domenica Crooks Jr.',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(3,	13,	'Hattie Lesch',	'Winifred Kemmer',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(4,	14,	'Christ Brown',	'Ellsworth Block',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(5,	15,	'Elroy Gorczany',	'Shaylee Hackett',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(6,	16,	'Bert Kuphal',	'Donavon Kreiger',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(7,	17,	'Dr. Terrill Hartmann',	'Sharon Gaylord Sr.',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(8,	18,	'Ettie Durgan',	'Remington Leuschke',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(9,	19,	'Miss Rhea Bartoletti',	'Prof. Frieda Keebler',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(10,	20,	'Joe Fritsch',	'Crystel Barrows',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(11,	21,	'Harry O\'Kon',	'Aurore Schaden',	'2021-07-23 02:22:02',	'2021-07-23 02:22:02'),
(12,	22,	'Aileen Robel PhD',	'Audra O\'Reilly',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(13,	23,	'Piper Powlowski MD',	'Korbin Kassulke',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(14,	24,	'Dr. Fannie Runolfsdottir',	'Ahmad Haag',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(15,	25,	'Ms. Makenzie Gulgowski DVM',	'Rossie Paucek',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(16,	26,	'Carlie Kihn',	'Sonya Batz',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(17,	27,	'Mr. Ford Herman',	'Maia McKenzie',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(18,	28,	'Madisen Lebsack',	'Miss Laurine Bradtke',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(19,	29,	'Neha Thompson',	'Miss Lysanne Windler',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(20,	30,	'Lilliana Cummings',	'Osbaldo Gerlach',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(21,	32,	'Joanne Cummings',	'Prof. Darby Turner',	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(22,	34,	'Emerald Ernser',	'Lesley Schneider',	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(23,	36,	'Mitchel Koss',	'Mrs. Andreane Schaden I',	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(24,	38,	'Abigayle Goyette',	'Reinhold Turcotte Sr.',	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(25,	40,	'Neoma Pacocha IV',	'Antonio Ruecker',	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(26,	42,	'Neoma Jerde',	'Leonardo Stark',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(27,	44,	'Chaz Jakubowski',	'Rachael Brown',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(28,	46,	'Karine Buckridge',	'Pasquale Rutherford',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(29,	48,	'Filomena Goyette',	'Raul Rodriguez',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(30,	50,	'Edna Strosin IV',	'Frances Bednar',	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(31,	52,	'Dixie Lind',	'Dr. Baron Schaefer',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(32,	54,	'Prof. Buford Kunde',	'Eino Rodriguez',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(33,	56,	'Dr. August Yost',	'Avis Gibson',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(34,	58,	'Lucy Quigley',	'Candelario Hills II',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(35,	60,	'Earlene Cruickshank I',	'Terrance Huel',	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(36,	62,	'Heidi Zemlak',	'Josephine Jacobson',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(37,	64,	'Carlie O\'Hara',	'Frances Vandervort',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(38,	66,	'Millie Jacobson',	'Shanny Shanahan',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(39,	68,	'Elwin Treutel',	'Ora Koch III',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(40,	70,	'Arch Wiza',	'Maci Baumbach',	'2021-07-23 02:22:07',	'2021-07-23 02:22:07');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crv_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `company`, `address`, `crv_number`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1,	'Mrs. Juanita Kovacek',	'jaime.leannon@example.org',	NULL,	NULL,	NULL,	'2021-07-23 02:22:00',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'aLQfuPGS5D',	NULL,	NULL,	'2021-07-23 02:22:00',	'2021-07-23 02:22:00'),
(2,	'Clementina Cormier',	'hershel90@example.net',	NULL,	NULL,	NULL,	'2021-07-23 02:22:00',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'8yCTjKW0pq',	NULL,	NULL,	'2021-07-23 02:22:00',	'2021-07-23 02:22:00'),
(3,	'Madelynn Torp',	'allie.gutkowski@example.com',	NULL,	NULL,	NULL,	'2021-07-23 02:22:00',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'mdMpU0IeiB',	NULL,	NULL,	'2021-07-23 02:22:00',	'2021-07-23 02:22:00'),
(4,	'Meda Cassin PhD',	'rick.hansen@example.org',	NULL,	NULL,	NULL,	'2021-07-23 02:22:00',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'5qEIG5tZKG',	NULL,	NULL,	'2021-07-23 02:22:00',	'2021-07-23 02:22:00'),
(5,	'Prof. Lawson Goldner DDS',	'oliver09@example.org',	NULL,	NULL,	NULL,	'2021-07-23 02:22:00',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'aq4v4kEVke',	NULL,	NULL,	'2021-07-23 02:22:00',	'2021-07-23 02:22:00'),
(6,	'Mandy Yost MD',	'emmerich.lonny@example.net',	NULL,	NULL,	NULL,	'2021-07-23 02:22:00',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'Z9Z6tArII0',	NULL,	NULL,	'2021-07-23 02:22:00',	'2021-07-23 02:22:00'),
(7,	'Paul Kuhic',	'pmiller@example.org',	NULL,	NULL,	NULL,	'2021-07-23 02:22:00',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'j2EQD81dAN',	NULL,	NULL,	'2021-07-23 02:22:00',	'2021-07-23 02:22:00'),
(8,	'Dorothea Vandervort',	'blanda.amiya@example.org',	NULL,	NULL,	NULL,	'2021-07-23 02:22:00',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'Ghb9FiSo9i',	NULL,	NULL,	'2021-07-23 02:22:00',	'2021-07-23 02:22:00'),
(9,	'Lenna Corwin IV',	'llegros@example.net',	NULL,	NULL,	NULL,	'2021-07-23 02:22:00',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'KkClaqnKV7',	NULL,	NULL,	'2021-07-23 02:22:00',	'2021-07-23 02:22:00'),
(10,	'Bradly Mills',	'granville.morissette@example.org',	NULL,	NULL,	NULL,	'2021-07-23 02:22:00',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'Zx1tvM7oin',	NULL,	NULL,	'2021-07-23 02:22:00',	'2021-07-23 02:22:00'),
(11,	'Eden Stroman Jr.',	'rubie.moore@example.net',	NULL,	NULL,	NULL,	'2021-07-23 02:22:03',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'xfKjiKFzXI',	NULL,	NULL,	'2021-07-23 02:22:03',	'2021-07-23 02:22:03'),
(12,	'Mrs. Yvette Mertz Jr.',	'zmarks@example.net',	NULL,	NULL,	NULL,	'2021-07-23 02:22:04',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'ypRdijvo4b',	NULL,	NULL,	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(13,	'Angelita Emmerich',	'frieda72@example.net',	NULL,	NULL,	NULL,	'2021-07-23 02:22:04',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'P84v2DQTwK',	NULL,	NULL,	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(14,	'Delia Cummings',	'araynor@example.org',	NULL,	NULL,	NULL,	'2021-07-23 02:22:04',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'Q5ACQzistB',	NULL,	NULL,	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(15,	'Jairo Jaskolski',	'letha.berge@example.net',	NULL,	NULL,	NULL,	'2021-07-23 02:22:04',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'NiG735Ap8h',	NULL,	NULL,	'2021-07-23 02:22:04',	'2021-07-23 02:22:04'),
(16,	'Chaya Blick',	'shyanne.considine@example.com',	NULL,	NULL,	NULL,	'2021-07-23 02:22:05',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'InPtuWrDD3',	NULL,	NULL,	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(17,	'Dr. Michelle Braun',	'djaskolski@example.com',	NULL,	NULL,	NULL,	'2021-07-23 02:22:05',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'F7HGy90Iee',	NULL,	NULL,	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(18,	'Prof. Celestino Fahey III',	'kuhn.savanna@example.net',	NULL,	NULL,	NULL,	'2021-07-23 02:22:05',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'CuEoIfj5b6',	NULL,	NULL,	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(19,	'Drew Cronin Sr.',	'orville94@example.org',	NULL,	NULL,	NULL,	'2021-07-23 02:22:05',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'cw6neFTi4m',	NULL,	NULL,	'2021-07-23 02:22:05',	'2021-07-23 02:22:05'),
(20,	'Jamar Bartoletti',	'thaddeus.prohaska@example.net',	NULL,	NULL,	NULL,	'2021-07-23 02:22:06',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'33vRTusrSL',	NULL,	NULL,	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(21,	'Yessenia Stokes',	'pearl34@example.net',	NULL,	NULL,	NULL,	'2021-07-23 02:22:06',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'2JTpJLksxP',	NULL,	NULL,	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(22,	'Queen Howe',	'okey.kilback@example.net',	NULL,	NULL,	NULL,	'2021-07-23 02:22:06',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'UheFuLI45b',	NULL,	NULL,	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(23,	'Gwendolyn Bahringer',	'chanelle10@example.net',	NULL,	NULL,	NULL,	'2021-07-23 02:22:06',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'ZOyiDD9Xmx',	NULL,	NULL,	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(24,	'Dr. Nestor Johnson',	'rodrigo.dietrich@example.org',	NULL,	NULL,	NULL,	'2021-07-23 02:22:06',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'zeDQKmWNkc',	NULL,	NULL,	'2021-07-23 02:22:06',	'2021-07-23 02:22:06'),
(25,	'Jedidiah Fadel',	'cody.breitenberg@example.com',	NULL,	NULL,	NULL,	'2021-07-23 02:22:07',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'rkZGsVshv1',	NULL,	NULL,	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(26,	'Aileen Rowe',	'simonis.georgette@example.org',	NULL,	NULL,	NULL,	'2021-07-23 02:22:07',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'tYDEexQTFo',	NULL,	NULL,	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(27,	'Prof. Emilia Stiedemann Jr.',	'adele.stracke@example.net',	NULL,	NULL,	NULL,	'2021-07-23 02:22:07',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'Ls1Y1DT1BQ',	NULL,	NULL,	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(28,	'Karelle Moen V',	'quigley.kristina@example.org',	NULL,	NULL,	NULL,	'2021-07-23 02:22:07',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'vPD52EqWut',	NULL,	NULL,	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(29,	'Freddie Barrows',	'carlotta43@example.org',	NULL,	NULL,	NULL,	'2021-07-23 02:22:07',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'CgV3E0Wyn6',	NULL,	NULL,	'2021-07-23 02:22:07',	'2021-07-23 02:22:07'),
(30,	'Elva Quigley Sr.',	'misty94@example.org',	NULL,	NULL,	NULL,	'2021-07-23 02:22:08',	'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',	NULL,	NULL,	'vXyopPYV8D',	NULL,	NULL,	'2021-07-23 02:22:08',	'2021-07-23 02:22:08');

-- 2021-07-23 13:32:45
