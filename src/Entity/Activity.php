<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $departureTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $arrivalTime = null;

    #[ORM\Column(nullable: true)]
    private ?float $distance = null;

    #[ORM\Column(nullable: true)]
    private ?float $speedAverage = null;

    #[ORM\Column(nullable: true)]
    private ?float $speedMax = null;

    #[ORM\Column(nullable: true)]
    private ?int $heightDifference = null;

    #[ORM\Column(nullable: true)]
    private ?int $powerAverage = null;

    #[ORM\Column(nullable: true)]
    private ?int $caloriesConsumed = null;

    #[ORM\ManyToOne]
    private ?ActivityType $activityType = null;

    #[ORM\ManyToOne]
    private ?Equipment $equipment = null;

    #[ORM\ManyToOne]
    private ?Difficulty $difficulty = null;

    #[ORM\ManyToOne]
    private ?User $userLink = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getDepartureTime(): ?\DateTimeInterface
    {
        return $this->departureTime;
    }

    public function setDepartureTime(?\DateTimeInterface $departureTime): self
    {
        $this->departureTime = $departureTime;

        return $this;
    }

    public function getArrivalTime(): ?\DateTimeInterface
    {
        return $this->arrivalTime;
    }

    public function setArrivalTime(?\DateTimeInterface $arrivalTime): self
    {
        $this->arrivalTime = $arrivalTime;

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

    public function getSpeedAverage(): ?float
    {
        return $this->speedAverage;
    }

    public function setSpeedAverage(?float $speedAverage): self
    {
        $this->speedAverage = $speedAverage;

        return $this;
    }

    public function getSpeedMax(): ?float
    {
        return $this->speedMax;
    }

    public function setSpeedMax(?float $speedMax): self
    {
        $this->speedMax = $speedMax;

        return $this;
    }

    public function getHeightDifference(): ?int
    {
        return $this->heightDifference;
    }

    public function setHeightDifference(?int $heightDifference): self
    {
        $this->heightDifference = $heightDifference;

        return $this;
    }

    public function getPowerAverage(): ?int
    {
        return $this->powerAverage;
    }

    public function setPowerAverage(?int $powerAverage): self
    {
        $this->powerAverage = $powerAverage;

        return $this;
    }

    public function getCaloriesConsumed(): ?int
    {
        return $this->caloriesConsumed;
    }

    public function setCaloriesConsumed(?int $caloriesConsumed): self
    {
        $this->caloriesConsumed = $caloriesConsumed;

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

    public function getEquipment(): ?Equipment
    {
        return $this->equipment;
    }

    public function setEquipment(?Equipment $equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }

    public function getDifficulty(): ?Difficulty
    {
        return $this->difficulty;
    }

    public function setDifficulty(?Difficulty $difficulty): self
    {
        $this->difficulty = $difficulty;

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
