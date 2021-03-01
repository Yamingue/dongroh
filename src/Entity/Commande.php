<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $confirme_at;

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

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_out;

    /**
     * @ORM\OneToMany(targetEntity=CommandeArticle::class, mappedBy="commande")
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIsOut(): ?bool
    {
        return $this->is_out;
    }

    public function setIsOut(?bool $is_out): self
    {
        $this->is_out = $is_out;

        return $this;
    }

    /**
     * @return Collection|CommandeArticle[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(CommandeArticle $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setCommande($this);
        }

        return $this;
    }

    public function removeArticle(CommandeArticle $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getCommande() === $this) {
                $article->setCommande(null);
            }
        }

        return $this;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->getArticles() as $prod) {
            $total = $total + ($prod->getQte() * $prod->getArticle()->getPrix());
        }
        return $total;
    }

    public function hasArticle(Article $ar){
        /**
         * @var $prod CommandeArticle
         */
        foreach ($this->getArticles() as $prod) {
            dump($prod);
            if (($prod->getArticle())->getId() == $ar->getId()) {
            return true;
            }
           
        }
        return false;
    }
}
