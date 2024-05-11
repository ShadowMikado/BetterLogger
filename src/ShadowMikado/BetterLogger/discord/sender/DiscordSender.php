<?php

namespace ShadowMikado\BetterLogger\discord\sender;

use ShadowMikado\BetterLogger\BetterLogger;
use ShadowMikado\BetterLogger\discord\async\AsyncDiscordTask;
use ShadowMikado\BetterLogger\discord\DiscordWebhook;
use ShadowMikado\BetterLogger\discord\Message\EmbedMessage;
use ShadowMikado\BetterLogger\discord\Message\MessageFactory;
use ShadowMikado\BetterLogger\discord\Message\TextMessage;
use ShadowMikado\BetterLogger\logs\Log;

class DiscordSender
{

    /**
     * @param Log $log
     * @param string $message
     * @return void
     */
    public function send(Log $log, string $message): void
    {
        $messageFactory = new MessageFactory();

        if (!$log->isEmbeded()) {
            /** @var TextMessage $discordMessage */
            $discordMessage = $messageFactory->create('text');
            $discordMessage->setUsername(ucfirst($log->getName()) . " Logs");
            $discordMessage->setContent($message);
        } else {
            /** @var EmbedMessage $discordMessage */
            $discordMessage = $messageFactory->create("embed");
            $discordMessage->setColor("10181046");
            $discordMessage->setThumbnailUrl("https://media.discordapp.net/attachments/996138076101423134/1210328132024803328/1704399532149.png?ex=65ea28e9&is=65d7b3e9&hm=4bda17e3214b97dd0594d75127e60be091a1b6c07c9a5befc73c8e7d669ff3d7&=&format=webp&quality=lossless&width=660&height=660");
            $discordMessage->setTitle(ucfirst($log->getName()) . " Logs");
            $discordMessage->setDescription($message);
            $discordMessage->setContent(" ");
        }
        $discordMessage->setUsername(ucfirst($log->getName()) . " Logs");

        $webhook = new DiscordWebhook($discordMessage);
        $webhook->setWebhookUrl($log->getToken());
        BetterLogger::getInstance()->getServer()->getAsyncPool()->submitTask(new AsyncDiscordTask(igbinary_serialize($webhook)));
    }


}