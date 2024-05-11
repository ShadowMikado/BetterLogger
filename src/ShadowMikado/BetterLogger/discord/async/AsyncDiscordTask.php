<?php

namespace ShadowMikado\BetterLogger\discord\async;

use pocketmine\scheduler\AsyncTask;
use ShadowMikado\BetterLogger\discord\DiscordWebhook;

class AsyncDiscordTask extends AsyncTask
{

    public function __construct(private $webhook)
    {
    }

    public function onRun(): void
    {
        /** @var DiscordWebhook $webhook */
        $webhook = igbinary_unserialize($this->webhook);
        try {
            $webhook->send();
        } catch (\Exception) {
        }
    }
}