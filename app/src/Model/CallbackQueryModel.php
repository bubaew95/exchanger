<?php

namespace App\Model;

class CallbackQueryModel
{
    public function __construct(
        private array $from,
        private string $data
    ){}

    public function getChatId() : int
    {
        return $this->from['id'];
    }

    public function getData(): mixed
    {
        return json_decode($this->data, true);
    }

    public function getMethod()
    {
        return $this->getData()['method'] ?? null;
    }

    public function getArgs()
    {
        return $this->getData()['args'] ?? null;
    }
}