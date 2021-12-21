-- -----------------------------------------------------
-- Schema taskforce
-- -----------------------------------------------------
CREATE DATABASE IF NOT EXISTS taskforce
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE taskforce;

-- -----------------------------------------------------
-- Table `taskforce`.`cities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS cities (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  city_name VARCHAR(128) NOT NULL
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `taskforce`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  registered_at DATETIME,
  email VARCHAR(128) NOT NULL UNIQUE,
  user_name VARCHAR(128) NOT NULL,
  user_password VARCHAR(128) NOT NULL,
  is_performer TINYINT NULL DEFAULT 0,
  city_id INT UNSIGNED NOT NULL,
  FOREIGN KEY (city_id) 
    REFERENCES cities(id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `taskforce`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS categories (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  category VARCHAR(45) NOT NULL,
  alias VARCHAR(45) NOT NULL
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `taskforce`.`statuses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS statuses (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  status VARCHAR(45) NOT NULL,
  alias VARCHAR(45) NOT NULL
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `taskforce`.`profiles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS profiles (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  birthday DATE NULL,
  phone VARCHAR(11) NULL,
  telegram VARCHAR(64) NULL,
  about TEXT NULL,
  count_fail INT UNSIGNED NULL,
  avatar_url VARCHAR(2048) NULL,
  FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `taskforce`.`tasks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tasks (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  created_at DATETIME NOT NULL,
  title VARCHAR(128) NOT NULL,
  description TEXT NOT NULL,
  latitude VARCHAR(128) NULL,
  longitude VARCHAR(128) NULL,
  finance INT NULL,
  dedline DATE NULL,
  author_id INT UNSIGNED NOT NULL,
  category_id INT UNSIGNED NOT NULL,
  city_id INT UNSIGNED NOT NULL,
  status_id INT UNSIGNED NOT NULL,
  performer_id INT UNSIGNED NOT NULL,
  FOREIGN KEY (author_id)
    REFERENCES users(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (category_id)
    REFERENCES categories(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (city_id)
    REFERENCES cities(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (status_id)
    REFERENCES statuses(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (performer_id)
    REFERENCES profiles(id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `taskforce`.`responses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS responses (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  created_at DATETIME NOT NULL,
  text_content TEXT NULL,
  price INT NULL,
  task_id INT UNSIGNED NOT NULL,
  performer_id INT UNSIGNED NOT NULL,
  FOREIGN KEY (task_id)
    REFERENCES tasks(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (performer_id)
    REFERENCES profiles(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `taskforce`.`feedbacks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS feedbacks (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  created_at DATETIME NOT NULL,
  comment TEXT NULL,
  evaluation INT NOT NULL,
  author_id INT UNSIGNED NOT NULL,
  task_id INT UNSIGNED NOT NULL,
  FOREIGN KEY (author_id)
    REFERENCES users(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (task_id)
    REFERENCES tasks(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `taskforce`.`performers_has_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS performers_has_categories (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  performer_id INT UNSIGNED NOT NULL,
  category_id INT UNSIGNED NOT NULL,
  FOREIGN KEY (performer_id)
    REFERENCES profiles(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (category_id)
    REFERENCES categories(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `taskforce`.`files`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS files (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  file_url VARCHAR(2048) NOT NULL,
  task_id INT UNSIGNED NOT NULL,
  FOREIGN KEY (task_id)
    REFERENCES tasks(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;