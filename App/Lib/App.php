<?php

namespace App\Lib;

class App
{
    public static function run()
    {
        Logger::enableSystemLogs();
        $logger = Logger::getInstance();
        $logger->info('>>>> Testing App Logger ');
    }
}
