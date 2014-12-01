CREATE TABLE IF NOT EXISTS `users` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(50),
  `password` VARCHAR(100),
	`register_date` DATE
);

INSERT INTO `users` (`email`, `password`, `register_date`) VALUES
  (`test@test.de`, );