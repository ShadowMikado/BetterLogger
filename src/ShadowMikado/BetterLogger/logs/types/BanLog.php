<?php


namespace ShadowMikado\BetterLogger\logs\types;

use ShadowMikado\BetterLogger\logs\Log;
use ShadowMikado\BetterLogger\logs\LogIds;

class BanLog extends Log
{

    public function getName(): string
    {
        return LogIds::BAN_LOG;
    }

    public function getParameters(): array
    {
        return ["USERNAME", "STAFF", "REASON", "DURATION", "DATE"];
    }

    public function isEmbeded(): bool
    {
        return true;
    }

    public function getDiscordMessage(): string
    {
        return "**Joueur:** {USERNAME}\n**Staff:** {STAFF}\n**Raison:** {REASON}\n**Temps:** {DURATION}\n**Date:** {DATE}";
    }

    public function getToken(): string
    {
        return "https://discord.com/api/webhooks/1224037605252010024/fSvlJ8RzrtMJqHA5Z-eQr6yiZKN-aiO42j_pVeDd6iR3dKJTRBoukm3lRDA0AzyeWDOI";
    }
}