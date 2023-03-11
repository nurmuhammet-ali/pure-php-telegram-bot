<?php

define('HOME_DIR', __DIR__);
define('ENV', parse_ini_file('.env'));

require 'functions/boostrap.php';
require 'routes.php';
