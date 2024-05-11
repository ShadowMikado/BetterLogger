<?php

namespace ShadowMikado\BetterLogger\logs;

abstract class  Log
{

    /**
     * @return string
     */
    abstract public function getName(): string;

    /**
     * @return String[]
     */
    abstract public function getParameters(): array;

    /**
     * @return bool
     */
    abstract public function isEmbeded(): bool;

    /**
     * @return string
     */
    abstract public function getDiscordMessage(): string;

    /**
     * @return string
     */
    abstract public function getToken(): string;

}