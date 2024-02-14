<?php

namespace App\Model;

readonly class MyAdvertisementResponse
{
    public function __construct(
        private int $id,
        private string $name,
        private string $slug,
        private string $description,
        private ?string $image,
        private ?bool $isProposed = false
    ){ }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getIsProposed(): ?bool
    {
        return $this->isProposed;
    }
}