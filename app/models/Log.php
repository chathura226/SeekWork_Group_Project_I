<?php

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require '../app/thirdParty/Monolog/Logger.php';
require '../app/thirdParty/Monolog/Handler/StreamHandler.php';
require '../app/thirdParty/Monolog/Handler/RotatingFileHandler.php';
require '../app/thirdParty/Monolog/Formatter/JsonFormatter.php';
require '../app/thirdParty/Monolog/Formatter/LineFormatter.php';


class Log
{
    private static $logger;

    public static function initialize()
    {
        if (!self::$logger) {
            $log = new Logger('log');
            $log->pushHandler(new StreamHandler('../app/log/app.log', Level::Warning));
            self::$logger = $log;
        }
    }

    public static function warning($message)
    {
        if (!self::$logger) {
            self::initialize();
        }

        self::$logger->warning($message);
    }

    public static function error($message)
    {
        if (!self::$logger) {
            self::initialize();
        }

        self::$logger->error($message);
    }

    public static function info($message)
    {
        if (!self::$logger) {
            self::initialize();
        }

        self::$logger->info($message);
    }
}
