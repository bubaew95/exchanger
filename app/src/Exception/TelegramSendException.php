<?php

namespace App\Exception;

use Throwable;

class TelegramSendException extends \RuntimeException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, 404);
    }
}