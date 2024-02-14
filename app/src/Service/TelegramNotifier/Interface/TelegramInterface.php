<?php

namespace App\Service\TelegramNotifier\Interface;

interface TelegramInterface
{
    public function send(): mixed;
}