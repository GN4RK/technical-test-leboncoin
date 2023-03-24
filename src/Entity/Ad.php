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
    #[Groups(["getList"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getList"])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getList"])]
    private ?string $content = null;

    #[ORM\OneToMany(mappedBy: 'Ad', targetEntity: AdAuto::class)]
    #[Groups(["getList"])]
    private Collection $adAutos;

    public function __construct()
    {
        $this->adAutos = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, AdAuto>
     */
    public function getAdAutos(): Collection
    {
        return $this->adAutos;
    }

    public function addAdAuto(AdAuto $adAuto): self
    {
        if (!$this->adAutos->contains($adAuto)) {
            $this->adAutos->add($adAuto);
            $adAuto->setAd($this);
        }

        return $this;
    }

    public function removeAdAuto(AdAuto $adAuto): self
    {
        if ($this->adAutos->removeElement($adAuto)) {
            // set the owning side to null (unless already changed)
            if ($adAuto->getAd() === $this) {
                $adAuto->setAd(null);
            }
        }

        return $this;
    }
}
