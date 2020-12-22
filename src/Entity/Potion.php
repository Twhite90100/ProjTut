<?php

namespace App\Entity;

use App\Repository\PotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PotionRepository::class)
 */
class Potion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $effet;

    /**
     * @ORM\Column(type="integer")
     */
    private $valeur;

    /**
     * @ORM\Column(type="integer")
     */
    private $rarete;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sprite;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="potions")
     */
    private $joueurs;

    /**
     * @ORM\OneToMany(targetEntity=Ennemi::class, mappedBy="potion")
     */
    private $ennemis;

    /**
     * @ORM\OneToMany(targetEntity=Inventaire::class, mappedBy="potion")
     */
    private $inventaires;

    public function __construct()
    {
        $this->joueurs = new ArrayCollection();
        $this->ennemis = new ArrayCollection();
        $this->inventaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEffet(): ?string
    {
        return $this->effet;
    }

    public function setEffet(string $effet): self
    {
        $this->effet = $effet;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getRarete(): ?int
    {
        return $this->rarete;
    }

    public function setRarete(int $rarete): self
    {
        $this->rarete = $rarete;

        return $this;
    }

    public function getSprite(): ?string
    {
        return $this->sprite;
    }

    public function setSprite(?string $sprite): self
    {
        $this->sprite = $sprite;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(User $joueur): self
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs[] = $joueur;
        }

        return $this;
    }

    public function removeJoueur(User $joueur): self
    {
        $this->joueurs->removeElement($joueur);

        return $this;
    }

    /**
     * @return Collection|Ennemi[]
     */
    public function getEnnemis(): Collection
    {
        return $this->ennemis;
    }

    public function addEnnemi(Ennemi $ennemi): self
    {
        if (!$this->ennemis->contains($ennemi)) {
            $this->ennemis[] = $ennemi;
            $ennemi->setPotion($this);
        }

        return $this;
    }

    public function removeEnnemi(Ennemi $ennemi): self
    {
        if ($this->ennemis->removeElement($ennemi)) {
            // set the owning side to null (unless already changed)
            if ($ennemi->getPotion() === $this) {
                $ennemi->setPotion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Inventaire[]
     */
    public function getInventaires(): Collection
    {
        return $this->inventaires;
    }

    public function addInventaire(Inventaire $inventaire): self
    {
        if (!$this->inventaires->contains($inventaire)) {
            $this->inventaires[] = $inventaire;
            $inventaire->setPotion($this);
        }

        return $this;
    }

    public function removeInventaire(Inventaire $inventaire): self
    {
        if ($this->inventaires->removeElement($inventaire)) {
            // set the owning side to null (unless already changed)
            if ($inventaire->getPotion() === $this) {
                $inventaire->setPotion(null);
            }
        }

        return $this;
    }
}
