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
    #[Groups(["getList", "getDetails"])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'adAutos')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["getDetails"])]
    private ?Ad $Ad = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getList", "getDetails"])]
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getList", "getDetails"])]
    private ?string $model = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAd(): ?Ad
    {
        return $this->Ad;
    }

    public function setAd(?Ad $Ad): self
    {
        $this->Ad = $Ad;

        return $this;
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
}
