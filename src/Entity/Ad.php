<?php

namespace App\Entity;

use App\Repository\AdRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AdRepository::class)]
class Ad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getList", "getDetails"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getList", "getDetails"])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getList", "getDetails"])]
    private ?string $content = null;

    #[ORM\OneToOne(mappedBy: 'ad', cascade: ['persist', 'remove'])]
    #[Groups(["getList", "getDetails"])]
    private ?AdAuto $adAuto = null;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAdAuto(): ?AdAuto
    {
        return $this->adAuto;
    }

    public function setAdAuto(AdAuto $adAuto): self
    {
        // set the owning side of the relation if necessary
        if ($adAuto->getAd() !== $this) {
            $adAuto->setAd($this);
        }

        $this->adAuto = $adAuto;

        return $this;
    }

}
