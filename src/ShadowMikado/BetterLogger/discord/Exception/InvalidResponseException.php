<?php

declare(strict_types=1);

namespace ShadowMikado\BetterLogger\discord\Exception;

use Exception;

class InvalidResponseException extends Exception
{
    /**
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message = "", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
