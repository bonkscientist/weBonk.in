CREATE DATABASE IF NOT EXISTS weBONK;

DROP TABLE IF EXISTS memes;
DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS users (
	user_id bigint UNSIGNED NOT NULL AUTO_INCREMENT,
	username varchar(255) NOT NULL,
	upassword varchar(255) NOT NULL,
	upbonks int NOT NULL DEFAULT 0,
	is_admin boolean NOT NULL DEFAULT false,
	is_mod boolean NOT NULL DEFAULT false,
	created_on TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS memes (
	meme_id bigint UNSIGNED NOT NULL AUTO_INCREMENT,
	title varchar(255),
	url varchar(505) NOT NULL,
	upbonks int DEFAULT 0,
	posted_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	user_id bigint UNSIGNED,
	PRIMARY KEY (meme_id),
    	FOREIGN KEY (user_id) REFERENCES users(user_id)
    	ON DELETE CASCADE   
	ON UPDATE CASCADE
);