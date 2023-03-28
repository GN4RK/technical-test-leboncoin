<?php

namespace App\Entity;

use App\Repository\AdAutoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AdAutoRepository::class)]
class AdAuto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getList", "getDetails"])]
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getList", "getDetails"])]
    private ?string $model = null;

    #[ORM\OneToOne(inversedBy: 'adAuto', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ad $ad = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getAd(): ?Ad
    {
        return $this->ad;
    }

    public function setAd(Ad $ad): self
    {
        $this->ad = $ad;

        return $this;
    }
}
