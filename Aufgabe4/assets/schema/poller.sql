
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- Poll
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Poll`;

CREATE TABLE `Poll`
(
    `id` VARCHAR(32) NOT NULL,
    `question` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Poll_Answer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Poll_Answer`;

CREATE TABLE `Poll_Answer`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `poll` VARCHAR(32) NOT NULL,
    `text` VARCHAR(255) NOT NULL,
    `votes` INTEGER DEFAULT 0,
    PRIMARY KEY (`id`,`poll`),
    INDEX `Poll_Answer_fi_d3c16d` (`poll`),
    CONSTRAINT `Poll_Answer_fk_d3c16d`
        FOREIGN KEY (`poll`)
        REFERENCES `Poll` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
