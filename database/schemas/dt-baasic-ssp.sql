CREATE TABLE `personal_db`.`dt_basic_ssp` (
  `id` INT NOT NULL,
  `user` VARCHAR NOT NULL,
  `email` VARCHAR NOT NULL,
  `note` VARCHAR NOT NULL,
  `website` VARCHAR NOT NULL
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;