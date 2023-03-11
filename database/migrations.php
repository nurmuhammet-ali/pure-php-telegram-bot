<?php

if (! MIGRATIONS_RUNNED) {
	DB::query('
		CREATE TABLE users(
			id INT NOT NULL AUTO_INCREMENT,
			telegram_username VARCHAR(255),
			telegram_first_name VARCHAR(255),
			telegram_chat_id BIGINT,
			PRIMARY KEY(id)
		);
	');

	changeEnv('MIGRATIONS_RUNNED', true);
}
