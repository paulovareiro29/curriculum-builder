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