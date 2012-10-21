CREATE TABLE user (
id INT(5) auto_increment,
name VARCHAR(60),
firstname VARCHAR(60),
login VARCHAR(60),
password VARCHAR(180),
admin boolean default 0, 
PRIMARY KEY(id)) ENGINE = InnoDB;