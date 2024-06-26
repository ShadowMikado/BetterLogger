<?php

declare(strict_types=1);

namespace ShadowMikado\BetterLogger\discord;

use ShadowMikado\BetterLogger\discord\Message\Message;

/**
 * DiscordWebhook
 * @author Atakan Demircioğlu
 * @version 1.0
 * @package DiscordWebhook
 */
class DiscordWebhook
{
    /**
     * @var Message $message
     */
    private Message $message;

    /**
     * @var string $webhookUrl
     */
    private string $webhookUrl;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function setWebhookUrl(string $webhookUrl): void
    {
        $this->webhookUrl = $webhookUrl;
    }

    public function setDebug(bool $debug): void
    {
        $this->debug = $debug;
    }


    public function send(): bool
    {
        try {
            $ch = curl_init($this->webhookUrl);
            // is multipart/form-data
            if ($this->isMultipart()) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $this->message->toArray());
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: multipart/form-data']);
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $this->message->toJson());
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($this->message->toJson())
                ));
            }

            $response = curl_exec($ch);
            $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($responseCode >= 200 && $responseCode < 300) {
                return true;
            } else {
                (new \SimpleLogger())->critical("Failed to send webhook ($responseCode), message: \"" . $this->message->toArray()['content'] . "\"");
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function isMultipart(): bool
    {
        return $this->message->isMultipart();
    }
}
