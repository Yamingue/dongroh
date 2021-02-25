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

    /**
     * @ORM\Column(type="datetime")
     */
    private $do_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandes")
     */
    private $make_by;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_confirme;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_deliver;

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

    public function getDoAt(): ?\DateTimeInterface
    {
        return $this->do_at;
    }

    public function setDoAt(\DateTimeInterface $do_at): self
    {
        $this->do_at = $do_at;

        return $this;
    }

    public function getMakeBy(): ?User
    {
        return $this->make_by;
    }

    public function setMakeBy(?User $make_by): self
    {
        $this->make_by = $make_by;

        return $this;
    }

    public function getIsConfirme(): ?bool
    {
        return $this->is_confirme;
    }

    public function setIsConfirme(?bool $is_confirme): self
    {
        $this->is_confirme = $is_confirme;

        return $this;
    }

    public function getIsDeliver(): ?bool
    {
        return $this->is_deliver;
    }

    public function setIsDeliver(?bool $is_deliver): self
    {
        $this->is_deliver = $is_deliver;

        return $this;
    }
}
