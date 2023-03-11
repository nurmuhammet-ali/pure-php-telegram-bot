<?php 

$ENV = parse_ini_file('.env');


define('TELEGRAM_TOKEN', $ENV['telegram_token']);
