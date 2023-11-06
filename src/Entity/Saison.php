<?php

namespace App\Entity;

use App\Repository\SaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaisonRepository::class)]
class Saison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelleSaison = null;

    #[ORM\OneToMany(mappedBy: 'saisonId', targetEntity: Tarif::class)]
    private Collection $tarifs;

    #[ORM\OneToMany(mappedBy: 'numSaison', targetEntity: Semaine::class)]
    private Collection $semaines;

    public function __construct()
    {
        $this->tarifs = new ArrayCollection();
        $this->semaines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleSaison(): ?string
    {
        return $this->libelleSaison;
    }

    public function setLibelleSaison(string $libelleSaison): static
    {
        $this->libelleSaison = $libelleSaison;

        return $this;
    }

    /**
     * @return Collection<int, Tarif>
     */
    public function getTarifs(): Collection
    {
        return $this->tarifs;
    }

    public function addTarif(Tarif $tarif): static
    {
        if (!$this->tarifs->contains($tarif)) {
            $this->tarifs->add($tarif);
            $tarif->setSaisonId($this);
        }

        return $this;
    }

    public function removeTarif(Tarif $tarif): static
    {
        if ($this->tarifs->removeElement($tarif)) {
            // set the owning side to null (unless already changed)
            if ($tarif->getSaisonId() === $this) {
                $tarif->setSaisonId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Semaine>
     */
    public function getSemaines(): Collection
    {
        return $this->semaines;
    }

    public function addSemaine(Semaine $semaine): static
    {
        if (!$this->semaines->contains($semaine)) {
            $this->semaines->add($semaine);
            $semaine->setNumSaison($this);
        }

        return $this;
    }

    public function removeSemaine(Semaine $semaine): static
    {
        if ($this->semaines->removeElement($semaine)) {
            // set the owning side to null (unless already changed)
            if ($semaine->getNumSaison() === $this) {
                $semaine->setNumSaison(null);
            }
        }

        return $this;
    }
}
