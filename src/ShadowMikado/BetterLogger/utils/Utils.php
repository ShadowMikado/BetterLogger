<?php

namespace ShadowMikado\BetterLogger\utils;

class Utils
{
    /**
     * @return string
     */
    public static function getDate(): string
    {
        return date("d-m-Y H:i:s");
    }
}