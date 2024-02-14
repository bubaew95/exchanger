<?php

namespace App\Entity;

use App\Repository\AdvertisementImagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvertisementImagesRepository::class)]
class AdvertisementImages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Advertisement $advertisement = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?bool $base = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdvertisement(): ?Advertisement
    {
        return $this->advertisement;
    }

    public function setAdvertisement(?Advertisement $advertisement): static
    {
        $this->advertisement = $advertisement;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function isBase(): ?bool
    {
        return $this->base;
    }

    public function setBase(bool $base): static
    {
        $this->base = $base;

        return $this;
    }
}
