<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ApiResource]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $avatar;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $address;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $zipCode;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $country;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Order::class)]
    private $orders;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Cart::class)]
    private $carts;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: CommentVehicule::class)]
    private $commentVehicules;

    #[ORM\OneToOne(inversedBy: 'customer', targetEntity: User::class, cascade: ['persist', 'remove'])]
    private $user;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: CommentEnterprise::class)]
    private $commentEnterprises;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->carts = new ArrayCollection();
        $this->commentVehicules = new ArrayCollection();
        $this->commentEnterprises = new ArrayCollection();
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
     * @return Collection<int, CommentVehicule>
     */
    public function getCommentVehicules(): Collection
    {
        return $this->commentVehicules;
    }

    public function addCommentVehicule(CommentVehicule $commentVehicule): self
    {
        if (!$this->commentVehicules->contains($commentVehicule)) {
            $this->commentVehicules[] = $commentVehicule;
            $commentVehicule->setCustomer($this);
        }

        return $this;
    }

    public function removeCommentVehicule(CommentVehicule $commentVehicule): self
    {
        if ($this->commentVehicules->removeElement($commentVehicule)) {
            // set the owning side to null (unless already changed)
            if ($commentVehicule->getCustomer() === $this) {
                $commentVehicule->setCustomer(null);
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
