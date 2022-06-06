<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActivityRepository::class)
 */
class Activity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $departureTime;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $arrivalTime;

    /**
     * @ORM\Column(type="float")
     */
    private $speedAverage;

    /**
     * @ORM\Column(type="float")
     */
    private $speedMax;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $heightDifference;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $powerAverage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $caloriesConsumed;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $userLink;

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

    public function getSpeedAverage(): ?float
    {
        return $this->speedAverage;
    }

    public function setSpeedAverage(float $speedAverage): self
    {
        $this->speedAverage = $speedAverage;

        return $this;
    }

    public function getSpeedMax(): ?float
    {
        return $this->speedMax;
    }

    public function setSpeedMax(float $speedMax): self
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
