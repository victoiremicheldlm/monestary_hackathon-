<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
#[ApiResource(
    formats: ['json'],
    normalizationContext: ['groups' => ['vehicle']]
)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['enterprise', 'user', 'vehicle'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['enterprise', 'user','customer', 'vehicle'])]
    private $model;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['enterprise', 'user','customer', 'vehicle'])]
    private $brand;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('vehicle')]
    private $energy;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups('vehicle')]
    private $power;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups('vehicle')]
    private $passenger;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups('vehicle')]
    private $load_capacity;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups('vehicle')]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('vehicle')]
    private $photo;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups('vehicle')]
    private $price;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups('vehicle')]
    private $milage;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('vehicle')]
    private $status;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('vehicle')]
    private $numberplate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('vehicle')]
    private $color;

    #[ORM\ManyToMany(targetEntity: Customer::class, mappedBy: 'vehicles')]
    #[Groups('vehicle')]
    private $customers;

    #[ORM\ManyToOne(targetEntity: Enterprise::class, inversedBy: 'vehicles')]
    #[Groups('vehicle')]
    private $enterprise;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: Schedule::class)]
    #[Groups('vehicle')]
    private $schedules;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: Cart::class)]
    private $carts;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: CommentVehicle::class)]
    #[Groups('vehicle')]
    private $commentVehicles;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('vehicle')]
    private $generalState;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups('vehicle')]
    private $distance;

    #[ORM\Column(type: 'float', nullable: true)]
    private $longitude;

    #[ORM\Column(type: 'float', nullable: true)]
    private $latitude;

    public function __construct()
    {
        $this->schedules = new ArrayCollection();
        $this->carts = new ArrayCollection();
        $this->commentVehicles = new ArrayCollection();
        $this->customers = new ArrayCollection();
    }

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getNumberplate(): ?string
    {
        return $this->numberplate;
    }

    public function setNumberplate(?string $numberplate): self
    {
        $this->numberplate = $numberplate;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection<int, Customer>
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customer $customer): self
    {
        if (!$this->customers->contains($customer)) {
            $this->customers[] = $customer;
            $customer->addVehicle($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): self
    {
        if ($this->customers->removeElement($customer)) {
            $customer->removeVehicle($this);
        }

        return $this;
    }

    public function getEnterprise(): ?Enterprise
    {
        return $this->enterprise;
    }

    public function setEnterprise(?Enterprise $enterprise): self
    {
        $this->enterprise = $enterprise;

        return $this;
    }

    /**
     * @return Collection<int, Schedule>
     */
    public function getSchedules(): Collection
    {
        return $this->schedules;
    }

    public function addSchedule(Schedule $schedule): self
    {
        if (!$this->schedules->contains($schedule)) {
            $this->schedules[] = $schedule;
            $schedule->setVehicle($this);
        }

        return $this;
    }

    public function removeSchedule(Schedule $schedule): self
    {
        if ($this->schedules->removeElement($schedule)) {
            // set the owning side to null (unless already changed)
            if ($schedule->getVehicle() === $this) {
                $schedule->setVehicle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Cart>
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->carts->contains($cart)) {
            $this->carts[] = $cart;
            $cart->setVehicle($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->removeElement($cart)) {
            // set the owning side to null (unless already changed)
            if ($cart->getVehicle() === $this) {
                $cart->setVehicle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommentVehicle>
     */
    public function getCommentVehicles(): Collection
    {
        return $this->commentVehicles;
    }

    public function addCommentVehicle(CommentVehicle $commentVehicle): self
    {
        if (!$this->commentVehicles->contains($commentVehicle)) {
            $this->commentVehicles[] = $commentVehicle;
            $commentVehicle->setVehicle($this);
        }

        return $this;
    }

    public function removeCommentVehicle(CommentVehicle $commentVehicle): self
    {
        if ($this->commentVehicles->removeElement($commentVehicle)) {
            // set the owning side to null (unless already changed)
            if ($commentVehicle->getVehicle() === $this) {
                $commentVehicle->setVehicle(null);
            }
        }

        return $this;
    }

    public function getGeneralState(): ?string
    {
        return $this->generalState;
    }

    public function setGeneralState(?string $generalState): self
    {
        $this->generalState = $generalState;

        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(?float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }
}
