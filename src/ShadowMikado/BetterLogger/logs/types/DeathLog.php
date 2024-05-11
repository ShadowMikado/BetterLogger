<?php


namespace ShadowMikado\BetterLogger\logs\types;

use ShadowMikado\BetterLogger\logs\Log;
use ShadowMikado\BetterLogger\logs\LogIds;

class DeathLog extends Log
{

    public function getName(): string
    {
        return LogIds::DEATH_LOG;
    }

    public function getParameters(): array
    {
        return ["USERNAME", "KILLER", "DATE"];
    }

    public function isEmbeded(): bool
    {
        return false;
    }

    public function getDiscordMessage(): string
    {
        return "[{DATE}] {USERNAME} est mort par {KILLER}";
    }

    public function getToken(): string
    {
        return "https://discord.com/api/webhooks/1238911418498154496/3E6gAjhB_97gRm2nFtQY4qOakOWdyH1wC3xEo88P844eZo0_kz1bkrm7KozKpcEGErC4";
    }
}