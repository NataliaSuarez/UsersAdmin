<?php
require __DIR__ . '/vendor/autoload.php';

use App\Lib\Config;
$LOG_PATH = Config::get('LOG_PATH', '');
echo "[LOG_PATH]: $LOG_PATH";