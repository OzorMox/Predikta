ALTER TABLE `players` ADD `email` VARCHAR(500) NULL AFTER password;
ALTER TABLE `players` ADD `send_reminder_email` TINYINT(1) DEFAULT 0 AFTER email;
