CREATE DATABASE curriculum;

CREATE TABLE `user` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE TABLE `role` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(255),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE TABLE `user_role` (
    `user_id` INT NOT NULL,
    `role_id` INT NOT NULL,
    PRIMARY KEY (`user_id`, `role_id`),
    CONSTRAINT FK_UR_USER
        FOREIGN KEY (`user_id`)
            REFERENCES user(`id`),
    CONSTRAINT FK_UR_ROLE
        FOREIGN KEY (`role_id`)
            REFERENCES role(`id`)
);

CREATE TABLE `curriculum` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255),
    `person_name` VARCHAR(255),
    `avatar` LONGBLOB,
    `profile` VARCHAR(255) NOT NULL DEFAULT 'Profile',
    `info` VARCHAR(255) NOT NULL DEFAULT 'Info',
    `skills` VARCHAR(255) NOT NULL DEFAULT 'Skills',
    `education` VARCHAR(255) NOT NULL DEFAULT 'Education',
    `experience` VARCHAR(255) NOT NULL DEFAULT 'Experience',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT FK_CU_USER
        FOREIGN KEY (`user_id`)
            REFERENCES user(`id`)
);

CREATE TABLE `profile` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `curriculum_id` INT NOT NULL,
    `content` VARCHAR(2048) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT FK_PC_PROFILE
        FOREIGN KEY (`curriculum_id`)
            REFERENCES curriculum(`id`)
);

CREATE TABLE `info` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `curriculum_id` INT NOT NULL,
    `href` VARCHAR(255) NOT NULL,
    `content` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT FK_IC_INFO
        FOREIGN KEY (`curriculum_id`)
            REFERENCES curriculum(`id`)
);

CREATE TABLE `skill` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `curriculum_id` INT NOT NULL,
    `content` VARCHAR(255) NOT NULL,
    `rating` FLOAT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT FK_SC_SKILL
        FOREIGN KEY (`curriculum_id`)
            REFERENCES curriculum(`id`)
);

CREATE TABLE `education` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `curriculum_id` INT NOT NULL,
    `start_date` VARCHAR(255) NOT NULL,
    `end_date` VARCHAR(255) NOT NULL,
    `school` VARCHAR(255) NOT NULL,
    `course` VARCHAR(255) NOT NULL,
    `location` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT FK_EC_EDUCATION
        FOREIGN KEY (`curriculum_id`)
            REFERENCES curriculum(`id`)
);

CREATE TABLE `experience` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `curriculum_id` INT NOT NULL,
    `start_date` VARCHAR(255) NOT NULL,
    `end_date` VARCHAR(255) NOT NULL,
    `company` VARCHAR(255) NOT NULL,
    `role` VARCHAR(255) NOT NULL,
    `content` VARCHAR(2048) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT FK_EC_EXPERIENCE
        FOREIGN KEY (`curriculum_id`)
            REFERENCES curriculum(`id`)
);