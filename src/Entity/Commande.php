<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $confirme_at;

    /**
     * @ORM\ManyToOne(targetEntity=CommandeArticle::class, inversedBy="commandes")
     */
    private $articles;

    /**
     * @ORM\ManyToOne(targetEntity=Panier::class, inversedBy="Commandes")
     */
    private $panier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getConfirmeAt(): ?\DateTimeInterface
    {
        return $this->confirme_at;
    }

    public function setConfirmeAt(?\DateTimeInterface $confirme_at): self
    {
        $this->confirme_at = $confirme_at;

        return $this;
    }

    public function getArticles(): ?CommandeArticle
    {
        return $this->articles;
    }

    public function setArticles(?CommandeArticle $articles): self
    {
        $this->articles = $articles;

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->panier;
    }

    public function setPanier(?Panier $panier): self
    {
        $this->panier = $panier;

        return $this;
    }
}
