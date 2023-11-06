<?php

namespace App\Entity;

use App\Repository\ImmeubleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Appartement;

#[ORM\Entity(repositoryClass: ImmeubleRepository::class)]
class Immeuble
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomImmeuble = null;

    #[ORM\Column(length: 255)]
    private ?string $RueImmeuble = null;

    #[ORM\Column]
    private ?int $cpImmeuble = null;

    #[ORM\Column(length: 255)]
    private ?string $villeImmeuble = null;

    #[ORM\OneToMany(mappedBy: 'immeuble', targetEntity: Appartement::class, orphanRemoval: true)]
    private Collection $appartements;

    public function __construct()
    {
        $this->appartements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomImmeuble(): ?string
    {
        return $this->nomImmeuble;
    }

    public function setNomImmeuble(string $nomImmeuble): static
    {
        $this->nomImmeuble = $nomImmeuble;

        return $this;
    }

    public function getRueImmeuble(): ?string
    {
        return $this->RueImmeuble;
    }

    public function setRueImmeuble(string $RueImmeuble): static
    {
        $this->RueImmeuble = $RueImmeuble;

        return $this;
    }

    public function getCpImmeuble(): ?int
    {
        return $this->cpImmeuble;
    }

    public function setCpImmeuble(int $cpImmeuble): static
    {
        $this->cpImmeuble = $cpImmeuble;

        return $this;
    }

    public function getVilleImmeuble(): ?string
    {
        return $this->villeImmeuble;
    }

    public function setVilleImmeuble(string $villeImmeuble): static
    {
        $this->villeImmeuble = $villeImmeuble;

        return $this;
    }

    /**
     * @return Collection<int, Appartement>
     */
    public function getAppartements(): Collection
    {
        return $this->appartements;
    }

    public function addAppartement(Appartement $appartement): static
    {
        if (!$this->appartements->contains($appartement)) {
            $this->appartements->add($appartement);
            $appartement->setImmeuble($this);
        }

        return $this;
    }

    public function removeAppartement(Appartement $appartement): static
    {
        if ($this->appartements->removeElement($appartement)) {
            // set the owning side to null (unless already changed)
            if ($appartement->getImmeuble() === $this) {
                $appartement->setImmeuble(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNomImmeuble();
    }
}