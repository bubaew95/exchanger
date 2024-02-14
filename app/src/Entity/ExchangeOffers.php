<?php

namespace App\Entity;

use App\Repository\ExchangeOffersRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: ExchangeOffersRepository::class)]
class ExchangeOffers
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    private ?Advertisement $advertisement = null;

    #[ORM\ManyToOne(inversedBy: 'proposedAdvertisement')]
    private ?Advertisement $proposed_advertisement = null;

    #[ORM\ManyToOne(inversedBy: 'exchangeOffsers')]
    private ?User $user = null;

    #[ORM\Column]
    private ?bool $choosed = null;

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

    public function getProposedAdvertisement(): ?Advertisement
    {
        return $this->proposed_advertisement;
    }

    public function setProposedAdvertisement(?Advertisement $proposed_advertisement): static
    {
        $this->proposed_advertisement = $proposed_advertisement;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function isChoosed(): ?bool
    {
        return $this->choosed;
    }

    public function setChoosed(bool $choosed): static
    {
        $this->choosed = $choosed;

        return $this;
    }
}
