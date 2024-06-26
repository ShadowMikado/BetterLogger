<?php

declare(strict_types=1);

namespace ShadowMikado\BetterLogger\discord\Message;

class TextMessage extends Message
{
    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'content' => $this->content,
            'avatar_url' => $this->avatarUrl,
            'tts' => $this->tts,
        ];
    }
}
