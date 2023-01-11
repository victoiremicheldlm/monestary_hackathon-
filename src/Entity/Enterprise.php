<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EnterpriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnterpriseRepository::class)]
#[ApiResource]
class Enterprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $logo;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $address;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $zipCode;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $country;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\ManyToMany(targetEntity: Customer::class, mappedBy: 'enterprises')]
    private $customers;

    #[ORM\OneToOne(inversedBy: 'enterprise', targetEntity: User::class, cascade: ['persist', 'remove'])]
    private $user;

    #[ORM\OneToMany(mappedBy: 'enterprise', targetEntity: Vehicule::class)]
    private $vehicules;

    #[ORM\OneToMany(mappedBy: 'enterprise', targetEntity: CommentEnterprise::class)]
    private $commentEnterprises;

    public function __construct()
    {
        $this->vehicules = new ArrayCollection();
        $this->customers = new ArrayCollection();
        $this->commentEnterprises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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
            $customer->addEnterprise($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): self
    {
        if ($this->customers->removeElement($customer)) {
            $customer->removeEnterprise($this);
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
     * @return Collection<int, Vehicule>
     */
    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    public function addVehicule(Vehicule $vehicule): self
    {
        if (!$this->vehicules->contains($vehicule)) {
            $this->vehicules[] = $vehicule;
            $vehicule->setEnterprise($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): self
    {
        if ($this->vehicules->removeElement($vehicule)) {
            // set the owning side to null (unless already changed)
            if ($vehicule->getEnterprise() === $this) {
                $vehicule->setEnterprise(null);
            }
        }

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
            $commentEnterprise->setEnterprise($this);
        }

        return $this;
    }

    public function removeCommentEnterprise(CommentEnterprise $commentEnterprise): self
    {
        if ($this->commentEnterprises->removeElement($commentEnterprise)) {
            // set the owning side to null (unless already changed)
            if ($commentEnterprise->getEnterprise() === $this) {
                $commentEnterprise->setEnterprise(null);
            }
        }

        return $this;
    }
}
