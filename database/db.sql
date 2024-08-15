-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               8.0.37-0ubuntu0.22.04.3 - (Ubuntu)
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
  `question_id` int NOT NULL,QuestionModules
  `user_id` int NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`answer_id`),
  KEY `question_id` (`question_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `Answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `Questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Answers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.Answers: ~9 rows (approximately)
INSERT INTO `Answers` (`answer_id`, `question_id`, `user_id`, `body`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Paris', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(2, 1, 2, 'London', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(3, 1, 3, 'Berlin', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(4, 2, 1, 'To find happiness and fulfillment, one must pursue their passions and live a meaningful life.', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(5, 2, 2, 'To find the meaning of life, one must question their beliefs and seek answers.', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(6, 2, 3, 'The meaning of life is to achieve personal growth and self-discovery.', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(7, 3, 1, 'Python is a versatile and powerful programming language.', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(8, 3, 2, 'JavaScript is the language of the web and is widely used for front-end development.', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(9, 3, 3, 'Java is a popular language for building enterprise-level applications.', '2024-08-01 06:22:51', '2024-08-01 06:22:51');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.Comments: ~0 rows (approximately)

-- Dumping structure for table cipher.Contacts
CREATE TABLE IF NOT EXISTS `Contacts` (
  `contact_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
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
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.Modules: ~3 rows (approximately)
INSERT INTO `Modules` (`module_id`, `module_name`, `created_at`, `updated_at`) VALUES
	(1, 'Math', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(2, 'Science', '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(3, 'History', '2024-08-01 06:22:51', '2024-08-01 06:22:51');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.QuestionModules: ~6 rows (approximately)
INSERT INTO `QuestionModules` (`question_module_id`, `question_id`, `module_id`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 2, 1),
	(4, 2, 2),
	(5, 3, 1),
	(6, 3, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.Questions: ~3 rows (approximately)
INSERT INTO `Questions` (`question_id`, `user_id`, `title`, `body`, `image_path`, `created_at`, `updated_at`) VALUES
	(1, 1, 'What is the capital of France?', 'The capital of France is Paris.', NULL, '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(2, 2, 'What is the meaning of life?', 'The meaning of life is to find happiness and fulfillment.', NULL, '2024-08-01 06:22:51', '2024-08-01 06:22:51'),
	(3, 3, 'What is the best programming language?', 'The best programming language is a matter of personal preference.', NULL, '2024-08-01 06:22:51', '2024-08-01 06:22:51');

-- Dumping structure for table cipher.Roles
CREATE TABLE IF NOT EXISTS `Roles` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role` enum('admin','user') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.Roles: ~0 rows (approximately)

-- Dumping structure for table cipher.Users
CREATE TABLE IF NOT EXISTS `Users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role_id` int DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `Roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.Users: ~3 rows (approximately)
INSERT INTO `Users` (`user_id`, `username`, `email`, `password`, `created_at`, `updated_at`, `role_id`) VALUES
	(1, 'john_doe', 'john_doe@example.com', 'password123', '2024-08-01 06:22:51', '2024-08-01 06:22:51', NULL),
	(2, 'jane_smith', 'jane_smith@example.com', 'password456', '2024-08-01 06:22:51', '2024-08-01 06:22:51', NULL),
	(3, 'bob_jones', 'bob_jones@example.com', 'password789', '2024-08-01 06:22:51', '2024-08-01 06:22:51', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cipher.Votes: ~9 rows (approximately)
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
	(15, NULL, 3, 'upvote', '2024-08-02 07:02:02', 1);

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
