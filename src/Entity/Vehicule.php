<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
#[ApiResource]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $model;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $brand;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $energy;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $power;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $passenger;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $load_capacity;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $photo;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $price;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $milage;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $location;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getEnergy(): ?string
    {
        return $this->energy;
    }

    public function setEnergy(?string $energy): self
    {
        $this->energy = $energy;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(?int $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getPassenger(): ?int
    {
        return $this->passenger;
    }

    public function setPassenger(?int $passenger): self
    {
        $this->passenger = $passenger;

        return $this;
    }

    public function getLoadCapacity(): ?int
    {
        return $this->load_capacity;
    }

    public function setLoadCapacity(?int $load_capacity): self
    {
        $this->load_capacity = $load_capacity;

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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getMilage(): ?int
    {
        return $this->milage;
    }

    public function setMilage(?int $milage): self
    {
        $this->milage = $milage;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
