<?php

namespace App\Exception;

class UserNotFoundException extends \RuntimeException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Пользователь не найден', 404);
    }
}