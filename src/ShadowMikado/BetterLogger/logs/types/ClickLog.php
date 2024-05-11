<?php


namespace ShadowMikado\BetterLogger\logs\types;

use ShadowMikado\BetterLogger\logs\Log;
use ShadowMikado\BetterLogger\logs\LogIds;

class ClickLog extends Log
{

    public function getName(): string
    {
        return LogIds::ClICK_LOG;
    }

    public function getParameters(): array
    {
        return ["USERNAME", "CLICK", "DATE"];
    }

    public function isEmbeded(): bool
    {
        return true;
    }

    public function getDiscordMessage(): string
    {
        return "**Joueur:** {USERNAME}\n**CPS:** {CLICK}\n**Date:** {DATE}";
    }

    public function getToken(): string
    {
        return "https://discord.com/api/webhooks/1224037708645535917/ghcjTu_C45YwYF4TG06PR5n1nT5dt6U7YJbaacMuNF5KkXhGd9VmC57rnc1qlNnOVBj8";
    }
}