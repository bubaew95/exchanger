<?php

namespace App\Exception;

class TelegramAuthorizationException extends \RuntimeException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Телеграм: Ошибка идентификации.');
    }
}