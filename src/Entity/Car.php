<?php

namespace App\Entity; 

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CarRepository::class)]
#[ApiResource(
    normalizationContext:['groups'=>['cars:read']],
    operations:[
        new GetCollection(),
        new Get()
    ]
)]
#[ApiFilter(BooleanFilter::class, properties:['visible'])]
#[ApiFilter(SearchFilter::class, properties:['name'=>'ipartial'])]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['cars:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['cars:read'])]

    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['cars:read'])]

    private ?int $year = null;

    #[ORM\Column(length: 255)]
    #[Groups(['cars:read'])]

    private ?string $type = null;

    #[ORM\Column]
    #[Groups(['cars:read'])]

    private ?int $nbKm = null;

    #[ORM\Column]
    #[Groups(['cars:read'])]

    private ?int $doorCount = null;

    #[ORM\Column(length: 255)]
    #[Groups(['cars:read'])]

    private ?string $fuelType = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['cars:read'])]
    #[ApiFilter(SearchFilter::class, properties:['brand.name'=>'ipartial'])]
    private ?Brand $brand = null;

    #[ORM\Column]
    private ?bool $visible = null;

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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getNbKm(): ?int
    {
        return $this->nbKm;
    }

    public function setNbKm(int $nbKm): static
    {
        $this->nbKm = $nbKm;

        return $this;
    }

    public function getDoorCount(): ?int
    {
        return $this->doorCount;
    }

    public function setDoorCount(int $doorCount): static
    {
        $this->doorCount = $doorCount;

        return $this;
    }

    public function getFuelType(): ?string
    {
        return $this->fuelType;
    }

    public function setFuelType(string $fuelType): static
    {
        $this->fuelType = $fuelType;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

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
}
