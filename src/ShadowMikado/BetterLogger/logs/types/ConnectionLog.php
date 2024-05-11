<?php


namespace ShadowMikado\BetterLogger\logs\types;

use ShadowMikado\BetterLogger\logs\Log;
use ShadowMikado\BetterLogger\logs\LogIds;

class ConnectionLog extends Log
{

    public function getName(): string
    {
        return LogIds::CONNECTION_LOG;
    }

    public function getParameters(): array
    {
        return ["USERNAME", "TYPE", "DATE"];
    }

    public function isEmbeded(): bool
    {
        return false;
    }

    public function getDiscordMessage(): string
    {
        return "[{DATE}] {USERNAME} {TYPE}";
    }

    public function getToken(): string
    {
        return "https://discord.com/api/webhooks/1238913563104641084/hu4nROeg00ZOh2-wILnboF1IhqeJ-AascmPb1hHbkA67R1A3Cn6FwyrhNwprcVEbMnvp";
    }
}