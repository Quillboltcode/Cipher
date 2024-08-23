-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               8.0.39-0ubuntu0.22.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for cipher
CREATE DATABASE IF NOT EXISTS `cipher` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cipher`;

-- Dumping structure for table cipher.Answers
CREATE TABLE IF NOT EXISTS `Answers` (
  `answer_id` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL,
  `user_id` int NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`answer_id`),
  KEY `question_id` (`question_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `Answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `Questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Answers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.Answers: ~12 rows (approximately)
INSERT INTO `Answers` (`answer_id`, `question_id`, `user_id`, `body`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Paris', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(2, 1, 2, 'London', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(3, 1, 3, 'Berlin', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(4, 2, 1, 'To find happiness and fulfillment, one must pursue their passions and live a meaningful life.', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(5, 2, 2, 'To find the meaning of life, one must question their beliefs and seek answers.', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(6, 2, 3, 'The meaning of life is to achieve personal growth and self-discovery.', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(7, 3, 1, 'Python is a versatile and powerful programming language.', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(8, 3, 2, 'JavaScript is the language of the web and is widely used for front-end development.', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(9, 3, 3, 'Java is a popular language for building enterprise-level applications.', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(10, 7, 16, 'test', '2024-08-21 13:30:23', '2024-08-21 13:30:23'),
	(11, 7, 16, 'test2', '2024-08-21 13:30:41', '2024-08-21 13:30:41'),
	(12, 7, 16, 'test3', '2024-08-21 13:31:08', '2024-08-21 13:31:08');

-- Dumping structure for table cipher.Comments
CREATE TABLE IF NOT EXISTS `Comments` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `question_id` int DEFAULT NULL,
  `answer_id` int DEFAULT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `question_id` (`question_id`),
  KEY `answer_id` (`answer_id`),
  CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Comments_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `Questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Comments_ibfk_3` FOREIGN KEY (`answer_id`) REFERENCES `Answers` (`answer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.Comments: ~2 rows (approximately)
INSERT INTO `Comments` (`comment_id`, `user_id`, `question_id`, `answer_id`, `body`, `created_at`) VALUES
	(1, 16, 7, NULL, '123', '2024-08-21 13:51:56'),
	(2, 16, 7, NULL, '123', '2024-08-21 13:51:59');

-- Dumping structure for table cipher.Contacts
CREATE TABLE IF NOT EXISTS `Contacts` (
  `contact_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`contact_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `Contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.Contacts: ~0 rows (approximately)

-- Dumping structure for table cipher.Modules
CREATE TABLE IF NOT EXISTS `Modules` (
  `module_id` int NOT NULL AUTO_INCREMENT,
  `module_name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` text,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.Modules: ~4 rows (approximately)
INSERT INTO `Modules` (`module_id`, `module_name`, `created_at`, `updated_at`, `description`) VALUES
	(1, 'Math', '2024-08-01 06:22:51', '2024-08-22 04:46:55', 'A public discuss about Math'),
	(2, 'Science', '2024-08-01 06:22:51', '2024-08-01 06:22:51', NULL),
	(3, 'History', '2024-08-01 06:22:51', '2024-08-01 06:22:51', NULL),
	(4, 'PHP', '2024-08-22 04:58:25', '2024-08-22 04:58:25', 'a course about PHP language');

-- Dumping structure for table cipher.QuestionModules
CREATE TABLE IF NOT EXISTS `QuestionModules` (
  `question_module_id` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL,
  `module_id` int NOT NULL,
  PRIMARY KEY (`question_module_id`),
  KEY `question_id` (`question_id`),
  KEY `module_id` (`module_id`),
  CONSTRAINT `QuestionModules_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `Questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `QuestionModules_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `Modules` (`module_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.QuestionModules: ~8 rows (approximately)
INSERT INTO `QuestionModules` (`question_module_id`, `question_id`, `module_id`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 2, 1),
	(4, 2, 2),
	(5, 3, 1),
	(6, 3, 2),
	(7, 13, 1),
	(8, 13, 2),
	(19, 4, 3),
	(20, 4, 4),
	(23, 15, 4);

-- Dumping structure for table cipher.Questions
CREATE TABLE IF NOT EXISTS `Questions` (
  `question_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`question_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `Questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.Questions: ~9 rows (approximately)
INSERT INTO `Questions` (`question_id`, `user_id`, `title`, `body`, `image_path`, `created_at`, `updated_at`) VALUES
	(1, 1, 'What is the capital of France?', 'The capital of France is Paris.', NULL, '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(2, 2, 'What is the meaning of life?', 'The meaning of life is to find happiness and fulfillment.', NULL, '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(3, 3, 'What is the best programming language?', 'The best programming language is a matter of personal preference.', NULL, '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(4, 13, 'What is this?', 'Can anyone tell me what is this', '', '2024-08-15 07:27:37', '2024-08-22 09:19:40'),
	(7, 13, 'TEsttt', 'change', '', '2024-08-16 09:24:20', '2024-08-20 14:52:19'),
	(9, 13, 'change', 'change', '', '2024-08-20 14:59:08', '2024-08-20 14:59:08'),
	(11, 13, 'array', 'array', '', '2024-08-20 15:03:56', '2024-08-20 15:03:56'),
	(12, 13, 'can', 'cannot', '', '2024-08-20 15:06:56', '2024-08-20 15:06:56'),
	(13, 13, 'can', 'can', '', '2024-08-20 15:11:10', '2024-08-20 15:11:10'),
	(14, 13, 'How can I prevent SQL injection in PHP?', 'If user input is inserted without modification into an SQL query, then the application becomes vulnerable to SQL injection, like in the following example:', '', '2024-08-22 09:07:53', '2024-08-22 09:18:04'),
	(15, 13, 'test image', 'image', '66c71c76e92679.21330918.png', '2024-08-22 10:37:16', '2024-08-22 11:09:42');

-- Dumping structure for table cipher.Roles
CREATE TABLE IF NOT EXISTS `Roles` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role` enum('admin','user') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.Roles: ~2 rows (approximately)
INSERT INTO `Roles` (`role_id`, `role`, `created_at`) VALUES
	(1, 'admin', '2024-08-15 08:54:51'),
	(2, 'user', '2024-08-15 08:55:00');

-- Dumping structure for table cipher.Users
CREATE TABLE IF NOT EXISTS `Users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role_id` int DEFAULT '2',
  `avatar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `Roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.Users: ~6 rows (approximately)
INSERT INTO `Users` (`user_id`, `username`, `email`, `password`, `created_at`, `updated_at`, `role_id`, `avatar`) VALUES
	(1, 'john_doe', 'john_doe@example.com', 'password123', '2024-08-01 06:22:51', '2024-08-15 08:55:35', 2, NULL),
	(2, 'jane_smith', 'jane_smith@example.com', 'password456', '2024-08-01 06:22:51', '2024-08-15 08:55:38', 2, NULL),
	(3, 'bob_jones', 'bob_jones@example.com', 'password789', '2024-08-01 06:22:51', '2024-08-15 08:55:40', 2, NULL),
	(13, 'john', 'john@gmail.com', '$2y$10$Yi9KHcD4n8cFeClt9pYkB.ec5hu7MAsoXCM8SC4Gckpk7PttAwVV.', '2024-08-14 02:18:08', '2024-08-22 11:01:39', 2, 'avatar_66c71a93e342b.jpeg'),
	(15, 'hello', 'hello@gmail.com', '$2y$10$3Xjf10isHvExWifCNgUIyuPHDmFfLRTUlccs9cYnup2ApY9Az0GOq', '2024-08-15 03:07:16', '2024-08-15 08:55:48', 2, NULL),
	(16, 'admin', 'admin@gmail.com', '$2y$10$S0dqAclJNX6gRL6O5QKb3ezBtL03tvzQA.4FcG9kE9/VeOgJRmD1W', '2024-08-21 09:19:17', '2024-08-21 14:01:46', 1, 'avatar_66c5f34a4adc8.png');

-- Dumping structure for table cipher.Votes
CREATE TABLE IF NOT EXISTS `Votes` (
  `vote_id` int NOT NULL AUTO_INCREMENT,
  `answer_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `vote_type` enum('upvote','downvote') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `question_id` int DEFAULT NULL,
  PRIMARY KEY (`vote_id`),
  KEY `answer_id` (`answer_id`),
  KEY `user_id` (`user_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `Votes_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `Answers` (`answer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Votes_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `Questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.Votes: ~22 rows (approximately)
INSERT INTO `Votes` (`vote_id`, `answer_id`, `user_id`, `vote_type`, `created_at`, `question_id`) VALUES
	(1, 1, 1, 'upvote', '2024-08-01 06:22:51', NULL),
	(2, 2, 1, 'downvote', '2024-08-01 06:22:51', NULL),
	(3, 3, 1, 'upvote', '2024-08-01 06:22:51', NULL),
	(4, 4, 2, 'upvote', '2024-08-01 06:22:51', NULL),
	(5, 5, 2, 'upvote', '2024-08-01 06:22:51', NULL),
	(6, 6, 2, 'downvote', '2024-08-01 06:22:51', NULL),
	(7, 7, 3, 'upvote', '2024-08-01 06:22:51', NULL),
	(8, 8, 3, 'upvote', '2024-08-01 06:22:51', NULL),
	(9, 9, 3, 'upvote', '2024-08-01 06:22:51', NULL),
	(10, NULL, 1, 'upvote', '2024-08-02 07:02:02', 1),
	(11, NULL, 2, 'downvote', '2024-08-02 07:02:02', 1),
	(12, NULL, 3, 'upvote', '2024-08-02 07:02:02', 2),
	(13, NULL, 1, 'upvote', '2024-08-02 07:02:02', 2),
	(14, NULL, 2, 'downvote', '2024-08-02 07:02:02', 2),
	(15, NULL, 3, 'upvote', '2024-08-02 07:02:02', 1),
	(16, NULL, 16, 'upvote', '2024-08-21 10:41:31', 7),
	(17, NULL, 16, 'upvote', '2024-08-21 10:42:05', 7),
	(18, NULL, 16, 'downvote', '2024-08-21 10:42:11', 7),
	(19, NULL, 16, 'upvote', '2024-08-21 13:32:23', 7),
	(20, NULL, 16, 'downvote', '2024-08-21 13:32:34', 7),
	(21, NULL, 16, 'upvote', '2024-08-21 13:33:10', 7),
	(22, NULL, 16, 'downvote', '2024-08-21 13:33:12', 7),
	(23, 7, 16, 'upvote', '2024-08-22 07:48:09', NULL),
	(24, 3, 16, 'upvote', '2024-08-22 07:48:43', NULL),
	(25, 1, 16, 'upvote', '2024-08-22 07:50:30', NULL),
	(26, 1, 16, 'upvote', '2024-08-22 07:50:32', NULL),
	(27, 1, 16, 'upvote', '2024-08-22 07:50:34', NULL),
	(28, 1, 16, 'downvote', '2024-08-22 07:50:36', NULL),
	(29, 1, 16, 'upvote', '2024-08-22 07:50:39', NULL),
	(30, 1, 16, 'downvote', '2024-08-22 07:50:40', NULL),
	(31, 1, 16, 'upvote', '2024-08-22 07:50:43', NULL),
	(32, 1, 16, 'upvote', '2024-08-22 07:50:45', NULL),
	(33, 1, 16, 'downvote', '2024-08-22 07:50:47', NULL),
	(34, 1, 16, 'upvote', '2024-08-22 07:50:49', NULL),
	(35, 1, 16, 'upvote', '2024-08-22 07:52:05', NULL),
	(36, 2, 16, 'upvote', '2024-08-22 07:52:06', NULL),
	(37, 2, 16, 'downvote', '2024-08-22 07:52:07', NULL);

-- Dumping structure for trigger cipher.check_vote_constraint
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `check_vote_constraint` BEFORE INSERT ON `Votes` FOR EACH ROW BEGIN
    IF (NEW.answer_id IS NOT NULL AND NEW.question_id IS NOT NULL) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cannot have both answer_id and question_id present in a vote';
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
