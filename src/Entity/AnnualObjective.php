<?php

namespace App\Entity;

use App\Repository\AnnualObjectiveRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnualObjectiveRepository::class)]
class AnnualObjective
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne]
    private ?ActivityType $activityType = null;

    #[ORM\ManyToOne]
    private ?TypeObjective $typeObjective = null;

    #[ORM\ManyToOne]
    private ?User $userLink = null;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getActivityType(): ?ActivityType
    {
        return $this->activityType;
    }

    public function setActivityType(?ActivityType $activityType): self
    {
        $this->activityType = $activityType;

        return $this;
    }

    public function getTypeObjective(): ?TypeObjective
    {
        return $this->typeObjective;
    }

    public function setTypeObjective(?TypeObjective $typeObjective): self
    {
        $this->typeObjective = $typeObjective;

        return $this;
    }

    public function getUserLink(): ?User
    {
        return $this->userLink;
    }

    public function setUserLink(?User $userLink): self
    {
        $this->userLink = $userLink;

        return $this;
    }
}
