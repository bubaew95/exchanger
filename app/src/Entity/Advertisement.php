<?php

namespace App\Entity;

use App\Repository\AdvertisementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: AdvertisementRepository::class)]
class Advertisement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'advertisements')]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Gedmo\Slug(fields: ['name'])]
    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $seo_keywords = null;

    #[ORM\Column(length: 512)]
    private ?string $seo_description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $text = null;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    #[ORM\Column(length: 512)]
    private ?string $exchange_for_what = null;

    #[ORM\OneToMany(mappedBy: 'advertisement', targetEntity: AdvertisementImages::class)]
    #[ORM\OrderBy(['base' => 'DESC'])]
    private Collection $images;

    #[ORM\OneToMany(mappedBy: 'advertisement', targetEntity: ExchangeOffers::class)]
    private Collection $offers;

    #[ORM\OneToMany(mappedBy: 'proposed_advertisement', targetEntity: ExchangeOffers::class)]
    private Collection $proposedAdvertisement;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $status = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->offers = new ArrayCollection();
        $this->proposedAdvertisement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSeoKeywords(): ?string
    {
        return $this->seo_keywords;
    }

    public function setSeoKeywords(?string $seo_keywords): static
    {
        $this->seo_keywords = $seo_keywords;

        return $this;
    }

    public function getSeoDescription(): ?string
    {
        return $this->seo_description;
    }

    public function setSeoDescription(string $seo_description): static
    {
        $this->seo_description = $seo_description;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getExchangeForWhat(): ?string
    {
        return $this->exchange_for_what;
    }

    public function setExchangeForWhat(string $exchange_for_what): static
    {
        $this->exchange_for_what = $exchange_for_what;

        return $this;
    }

    /**
     * @return Collection<int, AdvertisementImages>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addAdvertisementImage(AdvertisementImages $advertisementImage): static
    {
        if (!$this->images->contains($advertisementImage)) {
            $this->images->add($advertisementImage);
            $advertisementImage->setAdvertisement($this);
        }

        return $this;
    }

    public function removeAdvertisementImage(AdvertisementImages $advertisementImage): static
    {
        if ($this->images->removeElement($advertisementImage)) {
            // set the owning side to null (unless already changed)
            if ($advertisementImage->getAdvertisement() === $this) {
                $advertisementImage->setAdvertisement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ExchangeOffers>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addExchangeOffser(ExchangeOffers $exchangeOffser): static
    {
        if (!$this->offers->contains($exchangeOffser)) {
            $this->offers->add($exchangeOffser);
            $exchangeOffser->setAdvertisement($this);
        }

        return $this;
    }

    public function removeExchangeOffser(ExchangeOffers $exchangeOffser): static
    {
        if ($this->offers->removeElement($exchangeOffser)) {
            // set the owning side to null (unless already changed)
            if ($exchangeOffser->getAdvertisement() === $this) {
                $exchangeOffser->setAdvertisement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ExchangeOffers>
     */
    public function getProposedAdvertisement(): Collection
    {
        return $this->proposedAdvertisement;
    }

    public function addMyExchangeOffser(ExchangeOffers $myExchangeOffser): static
    {
        if (!$this->proposedAdvertisement->contains($myExchangeOffser)) {
            $this->proposedAdvertisement->add($myExchangeOffser);
            $myExchangeOffser->setProposedAdvertisement($this);
        }

        return $this;
    }

    public function removeMyExchangeOffser(ExchangeOffers $myExchangeOffser): static
    {
        if ($this->proposedAdvertisement->removeElement($myExchangeOffser)) {
            // set the owning side to null (unless already changed)
            if ($myExchangeOffser->getProposedAdvertisement() === $this) {
                $myExchangeOffser->setProposedAdvertisement(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }
}
