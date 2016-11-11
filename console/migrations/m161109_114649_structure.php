<?php

use yii\db\Migration;

class m161109_114649_structure extends Migration
{
    public function up()
    {
        $this->execute("
CREATE TABLE IF NOT EXISTS `conference` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) NOT NULL DEFAULT '',
  `description` TEXT NULL,
  `created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `enabled` INT NOT NULL DEFAULT 1,
  `location` TEXT NULL,
  `start_date` DATE NULL,
  `start_time` TIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `member` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `last_name` VARCHAR(45) NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `conference_id` INT NOT NULL,
  `reg_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_member_conference_idx` (`conference_id` ASC),
  CONSTRAINT `fk_member_conference`
    FOREIGN KEY (`conference_id`)
    REFERENCES `conference` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `conference`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `conference` (`id`, `title`, `description`, `created`, `enabled`, `location`, `start_date`, `start_time`) VALUES (1, 'Конференция Yii', 'Конференция по поводу разработки с использованием программного фрейворка Yii. Мероприятие рассчитано как на начинающих, так и на опытных разработчиков, желающих научиться использовать Yii и ускорить процесс создания web-приложений.Мероприятие рассчитано как на начинающих, так и на опытных разработчиков, желающих научиться использовать Yii и ускорить процесс создания web-приложений.', NULL, 1, 'НГУЭиУ, 2-й корпус, актовый зал', '2014-02-01', '14:00');
INSERT INTO `conference` (`id`, `title`, `description`, `created`, `enabled`, `location`, `start_date`, `start_time`) VALUES (2, 'UbuntuGlobalJam', 'UbuntuGlobalJam — это мероприятие для всех, кто хотел бы получить опыт в разработке Свободного программного обеспечения. В рамках UbuntuGlobalJam было сделано несколько докладов, посвящённых проблеме СПО, а также прошли мастер-классы, касающиеся различных аспектов разработки дистрибутива Ubuntu Linux. ', NULL, 1, 'НГТУ, 1-й корпус', '2014-02-22', '12:00');
INSERT INTO `conference` (`id`, `title`, `description`, `created`, `enabled`, `location`, `start_date`, `start_time`) VALUES (3, 'Software Freedom Day', 'Software Freedom Day — ежегодный всемирный праздник, посвященный свободному программному обеспечению и ПО с открытым исходным кодом. Это публичная образовательная инициатива, нацеленная на повышение уровня осведомленности о свободном ПО и его преимуществах.', NULL, 0, 'НГУ, главный корпус', '2014-01-15', '12:30');

COMMIT;


-- -----------------------------------------------------
-- Data for table `member`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `member` (`id`, `last_name`, `first_name`, `phone`, `email`, `conference_id`, `reg_date`) VALUES (1, 'Иванов', 'Иван', '8-913-911-2233', 'ivanov@mail.ru', 1, NULL);
INSERT INTO `member` (`id`, `last_name`, `first_name`, `phone`, `email`, `conference_id`, `reg_date`) VALUES (2, 'Петров', 'Петр', '9-923-244-4444', 'petrov@mail.ru', 1, NULL);

COMMIT;

        ");
    }
}
