<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: Types::BIGINT)]
    private ?int $id = null;

    #[Assert\NotNull(groups: ['edit'])]
    #[Assert\Length(min: 3, max: 50, groups: ['edit'])]
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $first_name = null;

    #[Assert\Length(min: 3, max: 32, groups: ['edit'])]
    #[ORM\Column(length: 32, nullable: true)]
    private ?string $username = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo_url = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $status = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Advertisement::class)]
    private Collection $advertisements;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ExchangeOffers::class)]
    private Collection $exchangeOffers;

    #[Assert\NotNull(groups: ['edit'])]
    #[Assert\Length(min: 3, max: 50, groups: ['edit'])]
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $last_name = null;

    #[Assert\NotNull(groups: ['edit'])]
    #[Assert\Length(min: 11, max: 15, groups: ['edit'])]
    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phone = null;

    #[Assert\Email(groups: ['edit'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    private ?int $auth_date = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_edit = null;

    public function __construct()
    {
        $this->advertisements = new ArrayCollection();
        $this->exchangeOffers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): User
    {
        $this->id = $id;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): User
    {
        $this->first_name = $first_name;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username ?? "#{$this->getId()}";
    }

    public function setUsername(?string $username): User
    {
        $this->username = $username;
        return $this;
    }

    public function getPhotoUrl(): ?string
    {
        return $this->photo_url;
    }

    public function setPhotoUrl(?string $photo_url): User
    {
        $this->photo_url = $photo_url;
        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): User
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return Collection<int, Advertisement>
     */
    public function getAdvertisements(): Collection
    {
        return $this->advertisements;
    }

    public function addAdvertisement(Advertisement $advertisement): static
    {
        if (!$this->advertisements->contains($advertisement)) {
            $this->advertisements->add($advertisement);
            $advertisement->setUser($this);
        }

        return $this;
    }

    public function removeAdvertisement(Advertisement $advertisement): static
    {
        if ($this->advertisements->removeElement($advertisement)) {
            // set the owning side to null (unless already changed)
            if ($advertisement->getUser() === $this) {
                $advertisement->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ExchangeOffers>
     */
    public function getExchangeOffers(): Collection
    {
        return $this->exchangeOffers;
    }

    public function addExchangeOffser(ExchangeOffers $exchangeOffser): static
    {
        if (!$this->exchangeOffers->contains($exchangeOffser)) {
            $this->exchangeOffers->add($exchangeOffser);
            $exchangeOffser->setUser($this);
        }

        return $this;
    }

    public function removeExchangeOffser(ExchangeOffers $exchangeOffser): static
    {
        if ($this->exchangeOffers->removeElement($exchangeOffser)) {
            // set the owning side to null (unless already changed)
            if ($exchangeOffser->getUser() === $this) {
                $exchangeOffser->setUser(null);
            }
        }

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getAuthDate(): ?int
    {
        return $this->auth_date;
    }

    public function setAuthDate(int $auth_date): static
    {
        $this->auth_date = $auth_date;

        return $this;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->username ?? $this->getId();
    }

    public function isIsEdit(): ?bool
    {
        return $this->is_edit;
    }

    public function setIsEdit(?bool $is_edit): static
    {
        $this->is_edit = $is_edit;

        return $this;
    }
}