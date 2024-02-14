<?php

namespace App\Exception;

class OfferUserMismatchException extends \RuntimeException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Вы не являетесь владельцем данного объявления.');
    }
}