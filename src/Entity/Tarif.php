<?php

namespace App\Entity;

use App\Repository\TarifRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TarifRepository::class)]
class Tarif
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $prixSemaine = null;

    #[ORM\ManyToOne(inversedBy: 'tarifs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorieId = null;

    #[ORM\ManyToOne(inversedBy: 'tarifs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Saison $saisonId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixSemaine(): ?float
    {
        return $this->prixSemaine;
    }

    public function setPrixSemaine(float $prixSemaine): static
    {
        $this->prixSemaine = $prixSemaine;

        return $this;
    }

    public function getCategorieId(): ?Categorie
    {
        return $this->categorieId;
    }

    public function setCategorieId(?Categorie $categorieId): static
    {
        $this->categorieId = $categorieId;

        return $this;
    }

    public function getSaisonId(): ?Saison
    {
        return $this->saisonId;
    }

    public function setSaisonId(?Saison $saisonId): static
    {
        $this->saisonId = $saisonId;

        return $this;
    }
}
