CREATE TABLE `users` (
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`name` VARCHAR(255) DEFAULT NULL,
`gender` ENUM('0', '1', '2') NOT NULL COMMENT '0 - не указан, 1 - мужчина, 2 - женщина.',
`birth_date` INT(11) NOT NULL COMMENT 'Дата в unixtime.',
PRIMARY KEY (`id`)
);

CREATE TABLE `phone_numbers` (
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` INT(11) UNSIGNED NOT NULL,
`phone`	VARCHAR(15) DEFAULT NULL,
PRIMARY KEY (`id`)
);

ALTER TABLE test.users ADD INDEX `bd` (`birth_date`);
ALTER TABLE test.phone_numbers ADD INDEX `uid` (`user_id`);
ALTER TABLE `phone_numbers` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;




SET sql_mode = '';
SELECT users.id, users.name, count(phone_numbers.phone) AS countNumbers
FROM users
LEFT JOIN phone_numbers ON users.id = phone_numbers.user_id
WHERE users.gender = 1 AND users.birth_date BETWEEN
UNIX_TIMESTAMP(STR_TO_DATE(NOW() - INTERVAL 38 YEAR, '%Y-%m-%d %H:%i:%s')) AND UNIX_TIMESTAMP(STR_TO_DATE(NOW() - INTERVAL 28 YEAR, '%Y-%m-%d %H:%i:%s'))
GROUP BY users.id



