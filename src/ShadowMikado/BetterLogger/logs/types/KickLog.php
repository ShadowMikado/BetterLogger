<?php


namespace ShadowMikado\BetterLogger\logs\types;

use ShadowMikado\BetterLogger\logs\Log;
use ShadowMikado\BetterLogger\logs\LogIds;

class KickLog extends Log
{

    public function getName(): string
    {
        return LogIds::KICK_LOG;
    }

    public function getParameters(): array
    {
        return ["USERNAME", "STAFF", "REASON", "DATE"];
    }

    public function isEmbeded(): bool
    {
        return true;
    }

    public function getDiscordMessage(): string
    {
        return "**Joueur:** {USERNAME}\n**Staff:** {STAFF}\n**Raison:** {REASON}\n**Date:** {DATE}";
    }

    public function getToken(): string
    {
        return "https://discord.com/api/webhooks/1238908951404478505/sreZReOk5p6izMpViXGJUObhLVj2YEeYQQRNFwVOhEzWfyEYRZjfUcRPtIK3TlHxkPcC";
    }
}