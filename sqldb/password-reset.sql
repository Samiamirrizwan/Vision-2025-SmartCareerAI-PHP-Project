--
-- Table structure for table `password_resets`
-- This table stores temporary tokens for user password reset requests.
--
CREATE TABLE `password_resets` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(100) NOT NULL,
  `token` VARCHAR(255) NOT NULL UNIQUE,
  `is_used` BOOLEAN NOT NULL DEFAULT FALSE,
  `expires_at` DATETIME NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Add an index on the email column for faster lookups.
CREATE INDEX idx_password_resets_email ON password_resets(email);
