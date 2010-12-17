CREATE TABLE  `sloind`.`be_menu` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`submenu` INT( 1 ) NOT NULL ,
`name` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`title` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`link` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`img` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;