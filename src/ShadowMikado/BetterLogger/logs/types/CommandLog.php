<?php

namespace ShadowMikado\BetterLogger\logs\types;


use ShadowMikado\BetterLogger\logs\Log;
use ShadowMikado\BetterLogger\logs\LogIds;

class CommandLog extends Log
{

    public function getName(): string
    {
        return LogIds::COMMAND_LOG;
    }

    public function getParameters(): array
    {
        return ["USERNAME", "COMMAND", "DATE"];
    }

    public function isEmbeded(): bool
    {
        return false;
    }

    public function getDiscordMessage(): string
    {
        return "[{DATE}] {USERNAME} : {COMMAND}";
    }

    public function getToken(): string
    {
        return "https://discord.com/api/webhooks/1229881986160529458/XBzqkKFVQgSb8AUJP3f56vNaE2EGrcVYbud-Qfe_0KSL-N0Zz8xp7dIZxnmryOuptgFX";
    }
}