<?php


namespace ShadowMikado\BetterLogger\logs\types;

use ShadowMikado\BetterLogger\logs\Log;
use ShadowMikado\BetterLogger\logs\LogIds;

class FreezeLog extends Log
{

    public function getName(): string
    {
        return LogIds::FREEZE_LOG;
    }

    public function getParameters(): array
    {
        return ["USERNAME", "TYPE", "STAFF", "DATE"];
    }

    public function isEmbeded(): bool
    {
        return true;
    }

    public function getDiscordMessage(): string
    {
        return "**Joueur:** {USERNAME}\n**Type:** {TYPE}\n**Staff:** {STAFF}\n**Date:** {DATE}";
    }

    public function getToken(): string
    {
        return "https://discord.com/api/webhooks/1238913892801839125/PfKKV5nYe0DhEwaX99izU1mILW-Yv5eSIiBDWL2rQ2DVv7ukmxqG-A6tkMpfzMEb9K6g";
    }
}