<?php
require '../app/thirdParty/composer/vendor/autoload.php';


use Psr\Log\LogLevel;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log
{

    private static $logger;

    public static function initialize()
    {
        if (!self::$logger) {
            $log = new Logger('log');
            $log->pushHandler(new StreamHandler('../app/logs/app.log'));
            self::$logger = $log;
        }
    }

    public static function warning($message,$context1=[],$context2=[])
    {
        if (!self::$logger) {
            self::initialize();
        }

        self::$logger->warning($message,$context1,$context2);
    }

    public static function error($message,$context1=[],$context2=[])
    {
        if (!self::$logger) {
            self::initialize();
        }

        self::$logger->error($message,$context1,$context2);
    }

    public static function info($message,$context1=[],$context2=[])
    {
        if (!self::$logger) {
            self::initialize();
        }

        self::$logger->info($message,$context1,$context2);
    }

    // public static function log($msg)
    // {
    //     // create a log channel
    //     $log = new Logger('App');
    //     $log->pushHandler(new StreamHandler('../app/logs/app.log', LogLevel::INFO));

    //     // add records to the log
    //     $log->info("drd");
    // }
}
