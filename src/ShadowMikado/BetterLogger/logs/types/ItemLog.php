<?php

namespace ShadowMikado\BetterLogger\logs\types;

use ShadowMikado\BetterLogger\logs\Log;
use ShadowMikado\BetterLogger\logs\LogIds;

class
ItemLog extends Log
{

    public function getName(): string
    {
        return LogIds::ITEM_LOG;
    }

    public function getParameters(): array
    {
        return ["USERNAME", "ITEM", "COUNT", "GAMEMODE", "DATE"];
    }

    public function isEmbeded(): bool
    {
        return false;
    }

    public function getDiscordMessage(): string
    {
        return "[{DATE}] {USERNAME} ({GAMEMODE}) x{COUNT} {ITEM}";
    }

    public function getToken(): string
    {
        return "https://discord.com/api/webhooks/1238914319287062649/u73wnc_1eN-PCdzwlaIGvR0DNxUvR1rIgo6bCQeYXoWhM-6EGc9FMuJ1Dk3X6GHjlUW7";
    }
}