<?php

namespace App\Entity;

use App\Repository\BannerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BannerRepository::class)]
class Banner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sub_title = null;

    #[ORM\Column(length: 512, nullable: true)]
    private ?string $text = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $button_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $button_link = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $css_class = null;

    #[ORM\Column(length: 20)]
    private ?string $block = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $visible = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(length: 15)]
    private ?string $section = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSubTitle(): ?string
    {
        return $this->sub_title;
    }

    public function setSubTitle(?string $sub_title): static
    {
        $this->sub_title = $sub_title;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getButtonName(): ?string
    {
        return $this->button_name;
    }

    public function setButtonName(?string $button_name): static
    {
        $this->button_name = $button_name;

        return $this;
    }

    public function getButtonLink(): ?string
    {
        return $this->button_link;
    }

    public function setButtonLink(?string $button_link): static
    {
        $this->button_link = $button_link;

        return $this;
    }

    public function getCssClass(): ?string
    {
        return $this->css_class;
    }

    public function setCssClass(?string $css_class): static
    {
        $this->css_class = $css_class;

        return $this;
    }

    public function getBlock(): ?string
    {
        return $this->block;
    }

    public function setBlock(string $block): static
    {
        $this->block = $block;

        return $this;
    }

    public function getVisible(): ?int
    {
        return $this->visible;
    }

    public function setVisible(?int $visible): static
    {
        $this->visible = $visible;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(string $section): static
    {
        $this->section = $section;

        return $this;
    }
}
