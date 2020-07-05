<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_achat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="json",nullable=true)
     */
    private $video;

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
     * @ORM\ManyToOne(targetEntity=ListeEnvie::class, inversedBy="games")
     * @ORM\JoinColumn(name="id_envie")
     */
    private $ListeEnvie;

    /**
     * @ORM\OneToMany(targetEntity=Impression::class, mappedBy="Game")
     */
    private $impressions;

    public function __construct()
    {
        $this->impressions = new ArrayCollection();
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
        return $this->date_achat;
    }

    public function setDateAchat(?\DateTimeInterface $date_achat): self
    {
        $this->date_achat = $date_achat;

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

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param mixed $video
     * @return Game
     */
    public function setVideo($video)
    {
        $this->video = $video;
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

    public function getListeEnvie(): ?ListeEnvie
    {
        return $this->ListeEnvie;
    }

    public function setListeEnvie(?ListeEnvie $ListeEnvie): self
    {
        $this->ListeEnvie = $ListeEnvie;

        return $this;
    }

    /**
     * @return Collection|Impression[]
     */
    public function getImpressions(): Collection
    {
        return $this->impressions;
    }
}
