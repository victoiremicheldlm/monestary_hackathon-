<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ApiResource(
    formats: ['json'],
    normalizationContext: ['groups' => ['customer']]
)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['customer', 'user', 'enterprise', 'vehicle'])]
    private $id;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Groups(['customer', 'user', 'enterprise', 'vehicle'])]
    private $firstname;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Groups(['customer', 'user', 'enterprise', 'vehicle'])]
    private $lastname;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Groups(['customer', 'user'])]
    private $phone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['customer', 'user', 'vehicle'])]
    private $avatar;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['customer', 'user'])]
    private $address;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    #[Groups(['customer', 'user'])]
    private $zipCode;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Groups(['customer', 'user'])]
    private $country;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['customer', 'user'])]
    private $description;

    #[ORM\ManyToMany(targetEntity: Enterprise::class, inversedBy: 'customers')]
    #[ORM\JoinTable(name:'favorite_enterprises')]
    #[Groups(['customer', 'user'])]
    private $enterprises;

    #[ORM\ManyToMany(targetEntity: Vehicle::class, inversedBy: 'customers')]
    #[ORM\JoinTable(name:'favorite_vehicles')]
    #[Groups(['customer', 'user'])]
    private $vehicles;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Order::class)]
    private $orders;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Cart::class)]
    private $carts;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: CommentVehicle::class)]
    private $commentVehicles;

    #[ORM\OneToOne(inversedBy: 'customer', targetEntity: User::class, cascade: ['persist', 'remove'])]
    private $user;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: CommentEnterprise::class)]
    private $commentEnterprises;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->carts = new ArrayCollection();
        $this->commentVehicles = new ArrayCollection();
        $this->commentEnterprises = new ArrayCollection();
        $this->enterprises = new ArrayCollection();
        $this->vehicles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

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

    /**
     * @return Collection<int, Enterprise>
     */
    public function getEnterprises(): Collection
    {
        return $this->enterprises;
    }

    public function addEnterprise(Enterprise $enterprise): self
    {
        if (!$this->enterprises->contains($enterprise)) {
            $this->enterprises[] = $enterprise;
        }

        return $this;
    }

    public function removeEnterprise(Enterprise $enterprise): self
    {
        $this->enterprises->removeElement($enterprise);

        return $this;
    }

    /**
     * @return Collection<int, Vehicle>
     */
    public function getVehicles(): Collection
    {
        return $this->vehicles;
    }

    public function addVehicle(Vehicle $vehicle): self
    {
        if (!$this->vehicles->contains($vehicle)) {
            $this->vehicles[] = $vehicle;
        }

        return $this;
    }

    public function removeVehicle(Vehicle $vehicle): self
    {
        $this->vehicles->removeElement($vehicle);

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setCustomer($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCustomer() === $this) {
                $order->setCustomer(null);
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
            $cart->setCustomer($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->removeElement($cart)) {
            // set the owning side to null (unless already changed)
            if ($cart->getCustomer() === $this) {
                $cart->setCustomer(null);
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
            $commentVehicle->setCustomer($this);
        }

        return $this;
    }

    public function removeCommentVehicle(CommentVehicle $commentVehicle): self
    {
        if ($this->commentVehicles->removeElement($commentVehicle)) {
            // set the owning side to null (unless already changed)
            if ($commentVehicle->getCustomer() === $this) {
                $commentVehicle->setCustomer(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, CommentEnterprise>
     */
    public function getCommentEnterprises(): Collection
    {
        return $this->commentEnterprises;
    }

    public function addCommentEnterprise(CommentEnterprise $commentEnterprise): self
    {
        if (!$this->commentEnterprises->contains($commentEnterprise)) {
            $this->commentEnterprises[] = $commentEnterprise;
            $commentEnterprise->setCustomer($this);
        }

        return $this;
    }

    public function removeCommentEnterprise(CommentEnterprise $commentEnterprise): self
    {
        if ($this->commentEnterprises->removeElement($commentEnterprise)) {
            // set the owning side to null (unless already changed)
            if ($commentEnterprise->getCustomer() === $this) {
                $commentEnterprise->setCustomer(null);
            }
        }

        return $this;
    }
}
