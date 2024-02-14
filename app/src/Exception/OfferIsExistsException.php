<?php

namespace App\Exception;

class OfferIsExistsException extends \RuntimeException
{
    public function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct('Это предложение уже добавлено.');
    }
}