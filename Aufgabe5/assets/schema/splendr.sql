
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- User
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `User`;

CREATE TABLE `User`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL,
    `email` TEXT(320) NOT NULL,
    `password` CHAR(64) NOT NULL,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `User_u_7e364b` (`email`(255), `username`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- LoginAttempt
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `LoginAttempt`;

CREATE TABLE `LoginAttempt`
(
    `user_id` INTEGER NOT NULL,
    `successful_logins` INTEGER DEFAULT 0 NOT NULL,
    `failed_logins` INTEGER DEFAULT 0 NOT NULL,
    `last_login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`user_id`),
    CONSTRAINT `LoginAttempt_fk_29554a`
        FOREIGN KEY (`user_id`)
        REFERENCES `User` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Product
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Product`;

CREATE TABLE `Product`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `image_url` VARCHAR(255) NOT NULL,
    `product_url` TEXT NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `Product_u_d94269` (`name`),
    INDEX `Product_i_8501d1` (`name`, `product_url`(255))
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ProductBoard
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ProductBoard`;

CREATE TABLE `ProductBoard`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `image_url` TEXT NOT NULL,
    `user_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`,`user_id`),
    INDEX `ProductBoard_fi_29554a` (`user_id`),
    CONSTRAINT `ProductBoard_fk_29554a`
        FOREIGN KEY (`user_id`)
        REFERENCES `User` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Product_Review
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Product_Review`;

CREATE TABLE `Product_Review`
(
    `product_id` INTEGER NOT NULL,
    `user_id` INTEGER NOT NULL,
    `review` TEXT NOT NULL,
    `points` INTEGER NOT NULL,
    PRIMARY KEY (`product_id`,`user_id`),
    INDEX `Product_Review_fi_29554a` (`user_id`),
    CONSTRAINT `Product_Review_fk_0f5ed8`
        FOREIGN KEY (`product_id`)
        REFERENCES `Product` (`id`),
    CONSTRAINT `Product_Review_fk_29554a`
        FOREIGN KEY (`user_id`)
        REFERENCES `User` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
