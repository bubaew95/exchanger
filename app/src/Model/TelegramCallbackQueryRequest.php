<?php

namespace App\Model;

readonly class TelegramCallbackQueryRequest
{
    public function __construct(
        private CallbackQueryModel $callback_query
    ){}

    public function getCallbackQuery(): CallbackQueryModel
    {
        return $this->callback_query;
    }

    public function getChatId(): int
    {
        return $this->getCallbackQuery()->getChatId();
    }

    public function getData(): array
    {
        return $this->getCallbackQuery()->getData();
    }
}