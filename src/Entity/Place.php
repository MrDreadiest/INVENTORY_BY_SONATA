<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlaceRepository::class)
 */
class Place
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Space::class, inversedBy="places")
     * @ORM\JoinColumn(nullable=false)
     */
    private $space;

    /**
     * @ORM\ManyToOne(targetEntity=PlaceCategory::class, inversedBy="places")
     * @ORM\JoinColumn(nullable=false)
     */
    private $placeCategory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSpace(): ?Space
    {
        return $this->space;
    }

    public function setSpace(?Space $space): self
    {
        $this->space = $space;

        return $this;
    }

    public function getPlaceCategory(): ?PlaceCategory
    {
        return $this->placeCategory;
    }

    public function setPlaceCategory(?PlaceCategory $placeCategory): self
    {
        $this->placeCategory = $placeCategory;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
