-- Drop the database if it exists to start fresh, useful for development.
-- Be cautious with this in a production environment.
DROP DATABASE IF EXISTS `smartcareerai`;

-- Create Database and select it for use.
CREATE DATABASE IF NOT EXISTS `smartcareerai` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `smartcareerai`;

--
-- Table structure for table `users`
-- Stores user account information.
--
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `profile_image` VARCHAR(255) DEFAULT NULL,
  `theme` VARCHAR(10) DEFAULT 'dark',
  `categories` VARCHAR(255) DEFAULT NULL COMMENT 'User-preferred job categories',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

--
-- Table structure for table `admins`
-- Stores administrator account information.
--
CREATE TABLE `admins` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

--
-- Table structure for table `test_questions`
-- Stores all questions for aptitude tests.
--
CREATE TABLE `test_questions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `question_text` TEXT NOT NULL,
  `category` VARCHAR(50) NOT NULL,
  `option_a` VARCHAR(255) NOT NULL,
  `option_b` VARCHAR(255) NOT NULL,
  `option_c` VARCHAR(255) NOT NULL,
  `option_d` VARCHAR(255) NOT NULL,
  `correct_option` ENUM('a', 'b', 'c', 'd') NOT NULL COMMENT 'The correct answer'
) ENGINE=InnoDB;

--
-- Table structure for table `test_sessions`
-- Tracks each instance a user starts a test.
--
CREATE TABLE `test_sessions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `started_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `completed_at` TIMESTAMP NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

--
-- Table structure for table `test_answers`
-- Stores user's answers for each question in a test session.
--
CREATE TABLE `test_answers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `session_id` INT NOT NULL,
  `question_id` INT NOT NULL,
  `selected_option` ENUM('a', 'b', 'c', 'd') NOT NULL,
  `is_correct` BOOLEAN NOT NULL,
  `answered_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`session_id`) REFERENCES `test_sessions`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`question_id`) REFERENCES `test_questions`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

--
-- Table structure for table `results`
-- Stores the final analysis and score for each completed test session.
--
CREATE TABLE `results` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `session_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `score` DECIMAL(5,2) NOT NULL COMMENT 'Overall score percentage',
  `category_scores` JSON COMMENT 'Scores per category, e.g., {"Logical": 80.5, "Verbal": 75.0}',
  `ai_feedback` TEXT COMMENT 'AI-generated career feedback and analysis',
  `generated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`session_id`) REFERENCES `test_sessions`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

--
-- Table structure for table `careers`
-- Stores information about different career paths.
--
CREATE TABLE `careers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  `category` VARCHAR(100) NOT NULL,
  `roadmap_link` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB;

--
-- Table structure for table `mentors`
-- Stores profiles of available mentors.
--
CREATE TABLE `mentors` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `field` VARCHAR(100) NOT NULL COMMENT 'Area of expertise',
  `bio` TEXT,
  `profile_picture_url` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB;

--
-- Table structure for table `auth_tokens`
-- For "Remember Me" functionality.
--
CREATE TABLE `auth_tokens` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `selector` VARCHAR(255) NOT NULL,
    `hashed_validator` VARCHAR(255) NOT NULL,
    `user_id` INT NOT NULL,
    `expires` DATETIME NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;