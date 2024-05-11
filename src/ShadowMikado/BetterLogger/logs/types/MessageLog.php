<?php

namespace ShadowMikado\BetterLogger\logs\types;

use ShadowMikado\BetterLogger\logs\Log;
use ShadowMikado\BetterLogger\logs\LogIds;

class
MessageLog extends Log
{

    public function getName(): string
    {
        return LogIds::MESSAGE_LOG;
    }

    public function getParameters(): array
    {
        return ["USERNAME", "MESSAGE", "DATE"];
    }

    public function isEmbeded(): bool
    {
        return false;
    }

    public function getDiscordMessage(): string
    {
        return "[{DATE}] {USERNAME} : {MESSAGE}";
    }

    public function getToken(): string
    {
        return "https://discord.com/api/webhooks/1238908871154733227/5LmwMMas9UnjaiV_8AM4f3Q3We58qY9GEC74LGzi7B6FfHYuMOReBtafEH-PFlZQFTaa";
    }
}