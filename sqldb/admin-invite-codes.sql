--
-- Table structure for table `admin_invites`
-- Stores unique, one-time use invite codes for admin registration.
--
CREATE TABLE `admin_invites` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `code` VARCHAR(255) NOT NULL UNIQUE,
  `is_used` BOOLEAN NOT NULL DEFAULT FALSE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

--
-- Sample Invite Code
-- Here is your first invite code to register an admin account.
--
INSERT INTO `admin_invites` (`code`) VALUES ('SCA-ADMIN-2025-XYZ');
