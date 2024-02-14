<?php

namespace App\Exception;

class AdvertisementNotFoundException extends \RuntimeException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Объявление не найдено.');
    }
}