CREATE DATABASE curriculum;

CREATE TABLE `user` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `role` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(255),
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