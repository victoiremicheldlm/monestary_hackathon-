<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommentEnterpriseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommentEnterpriseRepository::class)]
#[ApiResource(
    formats: ['json'],
    normalizationContext: ['groups' => ['commentEnterprise']]
)]
class CommentEnterprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['enterprise', 'commentEnterprise'])]
    private $id;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['enterprise', 'commentEnterprise'])]
    private $content;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['enterprise', 'commentEnterprise'])]
    private $rating;

    #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'commentEnterprises')]
    #[Groups(['enterprise', 'commentEnterprise'])]
    private $customer;

    #[ORM\ManyToOne(targetEntity: Enterprise::class, inversedBy: 'commentEnterprises')]
    #[Groups(['commentEnterprise'])]
    private $enterprise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

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

    public function getEnterprise(): ?Enterprise
    {
        return $this->enterprise;
    }

    public function setEnterprise(?Enterprise $enterprise): self
    {
        $this->enterprise = $enterprise;

        return $this;
    }

}
