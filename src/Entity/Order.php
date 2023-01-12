<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
#[ApiResource(
    formats: ['json']
)]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text', nullable: true)]
    private $prestation;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $price;

    #[ORM\Column(type: 'text', nullable: true)]
    private $shipping_adress;

    #[ORM\Column(type: 'boolean')]
    private $delivery_isneeded;

    #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'orders')]
    private $customer;

    #[ORM\ManyToOne(targetEntity: Schedule::class, inversedBy: 'orders')]
    private $schedule;

    #[ORM\ManyToOne(targetEntity: Driver::class, inversedBy: 'orders')]
    private $driver;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrestation(): ?string
    {
        return $this->prestation;
    }

    public function setPrestation(?string $prestation): self
    {
        $this->prestation = $prestation;

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

    public function getShippingAdress(): ?string
    {
        return $this->shipping_adress;
    }

    public function setShippingAdress(?string $shipping_adress): self
    {
        $this->shipping_adress = $shipping_adress;

        return $this;
    }

    public function isDeliveryIsneeded(): ?bool
    {
        return $this->delivery_isneeded;
    }

    public function setDeliveryIsneeded(bool $delivery_isneeded): self
    {
        $this->delivery_isneeded = $delivery_isneeded;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getSchedule(): ?Schedule
    {
        return $this->schedule;
    }

    public function setSchedule(?Schedule $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getDriver(): ?Driver
    {
        return $this->driver;
    }

    public function setDriver(?Driver $driver): self
    {
        $this->driver = $driver;

        return $this;
    }
}
