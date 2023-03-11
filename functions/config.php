<?php 

$ENV = parse_ini_file('.env');

define('TELEGRAM_TOKEN', $ENV['TELEGRAM_TOKEN']);
define('MIGRATIONS_RUNNED', (bool) $ENV['MIGRATIONS_RUNNED']);
