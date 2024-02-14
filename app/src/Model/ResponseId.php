<?php

namespace App\Model;

readonly class ResponseId
{
    public function __construct(private int $id){}

    public function getId(): int
    {
        return $this->id;
    }
}