<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Slug;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
class News
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Slug(fields: ['title'])]
    private ?string $alias = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $seo_title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $seo_description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $seo_keywords = null;

    #[ORM\Column]
    private ?bool $visible = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): static
    {
        $this->alias = $alias;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSeoTitle(): ?string
    {
        return $this->seo_title;
    }

    public function setSeoTitle(string $seo_title): static
    {
        $this->seo_title = $seo_title;

        return $this;
    }

    public function getSeoDescription(): ?string
    {
        return $this->seo_description;
    }

    public function setSeoDescription(?string $seo_description): static
    {
        $this->seo_description = $seo_description;

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

    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): static
    {
        $this->visible = $visible;

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
}
