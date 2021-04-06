<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateAchat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Editeur::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false,name="id_editeur")
     */
    private $Editeur;

    /**
     * @ORM\ManyToOne(targetEntity=Genre::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false,name="id_genre")
     */
    private $Genre;

    /**
     * @ORM\ManyToOne(targetEntity=Platform::class, inversedBy="games")
     * @ORM\JoinColumn(name="id_platform")
     */
    private $Platform;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $dateSortie;
    /**
     * @ORM\Column(type="boolean",nullable=false)
     */
    private $isBuy;

    /**
     * @ORM\OneToMany(targetEntity=Video::class, mappedBy="game")
     */
    private $video;

    public function __construct()
    {
        $this->video = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(?\DateTimeInterface $dateAchat): self
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getEditeur(): ?Editeur
    {
        return $this->Editeur;
    }

    public function setEditeur(?Editeur $Editeur): self
    {
        $this->Editeur = $Editeur;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->Genre;
    }

    public function setGenre(?Genre $Genre): self
    {
        $this->Genre = $Genre;

        return $this;
    }


    public function getPlatform(): ?Platform
    {
        return $this->Platform;
    }

    public function setPlatform(?Platform $Platform): self
    {
        $this->Platform = $Platform;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateSortie()
    {
        return $this->dateSortie;
    }

    /**
     * @param mixed $dateSortie
     * @return Game
     */
    public function setDateSortie($dateSortie)
    {
        $this->dateSortie = $dateSortie;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsBuy()
    {
        return $this->isBuy;
    }

    /**
     * @param mixed $isBuy
     * @return Game
     */
    public function setIsBuy($isBuy)
    {
        $this->isBuy = $isBuy;
        return $this;
    }

    /**
     * @return Collection|video[]
     */
    public function getVideo(): Collection
    {
        return $this->video;
    }

    public function addVideo(video $video): self
    {
        if (!$this->video->contains($video)) {
            $this->video[] = $video;
            $video->setGame($this);
        }

        return $this;
    }

    public function removeVideo(video $video): self
    {
        if ($this->video->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getGame() === $this) {
                $video->setGame(null);
            }
        }

        return $this;
    }

}
