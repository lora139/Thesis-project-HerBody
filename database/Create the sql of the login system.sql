CREATE DATABASE loginsystem;
use loginsystem;

CREATE TABLE `user`(
    `username` VARCHAR(700) PRIMARY KEY,
    `email` VARCHAR(320) UNIQUE,
	`password` TEXT,
	`create_datetime` TIMESTAMP,
	`is_admin` BOOLEAN
);

CREATE TABLE `currency` (
	`code` VARCHAR(3) PRIMARY KEY,
    `xrate` DOUBLE NOT NULL
);

CREATE TABLE `products`(
	`id` INT PRIMARY KEY AUTO_INCREMENT,
    `img` TEXT NOT NULL,
    `name` TEXT NOT NULL,
    `price` DOUBLE NOT NULL,
    `currency` VARCHAR(3) NOT NULL,
    `desc` TEXT NOT NULL,
    
    FOREIGN KEY (`currency`) REFERENCES `currency`(`code`)
);

CREATE TABLE `cart_item` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
	`uid` VARCHAR(700) NOT NULL, -- user id
    `pid` INT NOT NULL, -- product id
    `qty` INT DEFAULT 1, -- quantity
    
    FOREIGN KEY (uid) REFERENCES `user`(username) ON DELETE CASCADE,
    FOREIGN KEY (pid) REFERENCES `products`(id) ON DELETE CASCADE
);

CREATE TABLE `order`(
	`orderid` INT PRIMARY KEY AUTO_INCREMENT,
    `clientname`VARCHAR(320) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
	`phone` VARCHAR(12) NOT NULL,
	`addr1` VARCHAR(700) NOT NULL
);

CREATE TABLE `cart_order`(
	`oid` INT,
    `uid` varchar(700),
    `qty` INT,
    `pid` INT,
    PRIMARY KEY (oid,uid,pid),
    
    FOREIGN KEY (`oid`) REFERENCES `order`(`orderid`) ON DELETE CASCADE,
    FOREIGN KEY (`uid`) REFERENCES `user`(`username`) ON DELETE CASCADE,
    FOREIGN KEY (`pid`) REFERENCES `products`(`id`) ON DELETE CASCADE
);
-- select * from cart_item where uid='le username' order by qty;

INSERT INTO `currency` VALUE ("BGN", 0.51);
INSERT INTO `currency` VALUE ("EUR", 1.0);
INSERT INTO `currency` VALUE ("USD", 0.93);

