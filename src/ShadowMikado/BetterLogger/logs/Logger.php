<?php


namespace ShadowMikado\BetterLogger\logs;

use ShadowMikado\BetterLogger\BetterLogger;
use ShadowMikado\BetterLogger\database\queries\LogQuery;
use ShadowMikado\BetterLogger\discord\sender\DiscordSender;

class Logger
{
    /**
     * @param Log $log
     * @param String[] $args
     * @return void
     */
    public static function log(Log $log, array $args): void
    {

        $sender = new DiscordSender();
        $sender->send($log, self::format($log, $args));

        BetterLogger::getInstance()->getConnectionPool()->submit(new LogQuery(igbinary_serialize($log), igbinary_serialize($args)));

    }

    private static function format(Log $log, $args): string
    {
        return str_replace(array_map(function ($param) {
            return "{" . $param . "}";
        }, $log->getParameters()), $args, $log->getDiscordMessage());
    }
}