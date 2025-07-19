<?php

namespace App\Entity;

use App\Repository\MaterialRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterialRepository::class)]
class Material
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $section = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $materialUrl = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $materialContent = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(string $section): static
    {
        $this->section = $section;

        return $this;
    }

    public function getMaterialUrl(): ?string
    {
        return $this->materialUrl;
    }

    public function setMaterialUrl(?string $materialUrl): static
    {
        $this->materialUrl = $materialUrl;

        return $this;
    }

    public function getMaterialContent(): ?string
    {
        return $this->materialContent;
    }

    public function setMaterialContent(?string $materialContent): static
    {
        $this->materialContent = $materialContent;

        return $this;
    }
}
