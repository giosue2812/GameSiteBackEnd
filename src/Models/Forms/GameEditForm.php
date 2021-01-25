<?php

namespace App\Models\Forms;

use Cassandra\Date;
use Symfony\Component\Validator\Constraints as Assert;
use OpenApi\Annotations as OA;

/**
 * Class GameEditForm
 * @package App\Models\Forms
 * @OA\Schema(
 *     description="Model to update game",
 *     type="object",
 *     title="GameEditForm"
 * )
 */
class GameEditForm
{
    /**
     * @OA\Property(
     *     title="Id game",
     *     property="id",
     *     type="integer",
     *     description="Id of game"
     * )
     * @var integer $id
     */
    private $id;
    /**
     * @var string $nom
     * @Assert\NotNull()
     * @OA\Property(
     *     title="Game nom",
     *     property="nom",
     *     type="string",
     *     description="Nom of game"
     * )
     */
    private $nom;
    /**
     * @OA\Property(
     *     title="Game description",
     *     property="description",
     *     type="string",
     *     description="Game of description"
     * )
     * @var string $description
     */
    private $description;
    /**
     * @OA\Property(
     *     title="Prix of game",
     *     property="prix",
     *     type="integer",
     *     description="Prix of one game"
     * )
     * @var float $prix
     */
    private $prix;
    /**
     * @OA\Property(
     *     title="Date achat",
     *     property="dateAchat",
     *     type="string",
     *     format="date",
     *     description="Date achat of game"
     * )
     * @var Date $dateAchat
     */
    private $date_achat;
    /**
     * @OA\Property(
     *     title="Date Sortie",
     *     property="dateSortie",
     *     type="string",
     *     format="date",
     *     description="Date sortie of game"
     * )
     * @var Date $date_sortie
     */
    private $date_sortie;
    /**
     * @OA\Property(
     *     title="Game of video",
     *     property="video",
     *     type="string",
     *     description="Videos of the game"
     * )
     * @var string $video
     */
    private $video;
    /**
     * @OA\Property(
     *     title="Game editeur",
     *     property="editeur",
     *     type="string",
     *     description="label of the editeur of the game"
     * )
     * @var string $editeur
     */
    private $editeur;
    /**
     * @OA\Property(
     *     title="Game genre",
     *     property="genre",
     *     type="string",
     *     description="label of the genre of the game"
     * )
     * @var string $genre
     */
    private $genre;
    /**
     * @OA\Property(
     *     title="Game platform",
     *     property="platform",
     *     type="string",
     *     description="label of the platform of the game"
     * )
     * @var string $platform
     */
    private $platform;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return GameEditForm
     */
    public function setId(int $id): GameEditForm
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return GameEditForm
     */
    public function setNom(string $nom): GameEditForm
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return GameEditForm
     */
    public function setDescription(string $description): GameEditForm
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrix(): ?float
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     * @return GameEditForm
     */
    public function setPrix(float $prix): GameEditForm
    {
        $this->prix = $prix;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getDateAchat()
    {
        return $this->date_achat;
    }

    /**
     * @param mixed $date_achat
     * @return GameEditForm
     */
    public function setDateAchat($date_achat)
    {
        $this->date_achat = $date_achat;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateSortie()
    {
        return $this->date_sortie;
    }

    /**
     * @param mixed $date_sortie
     * @return GameEditForm
     */
    public function setDateSortie($date_sortie)
    {
        $this->date_sortie = $date_sortie;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideo(): ?string
    {
        return $this->video;
    }

    /**
     * @param string $video
     * @return GameEditForm
     */
    public function setVideo(string $video): GameEditForm
    {
        $this->video = $video;
        return $this;
    }

    /**
     * @return string
     */
    public function getEditeur(): ?string
    {
        return $this->editeur;
    }

    /**
     * @param string $editeur
     * @return GameEditForm
     */
    public function setEditeur(string $editeur): GameEditForm
    {
        $this->editeur = $editeur;
        return $this;
    }

    /**
     * @return string
     */
    public function getGenre(): ?string
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     * @return GameEditForm
     */
    public function setGenre(string $genre): GameEditForm
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    /**
     * @param string $platform
     * @return GameEditForm
     */
    public function setPlatform(string $platform): GameEditForm
    {
        $this->platform = $platform;
        return $this;
    }



}
