<?php

namespace App\Models\Forms;

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
     *     title="Game of video",
     *     property="video",
     *     type="array",
     *     @OA\Items(type="string"),
     *     description="Videos of the game"
     * )
     * @var array $video
     */
    private $video;
    /**
     * @OA\Property(
     *     title="Game editeur",
     *     property="idEditeur",
     *     type="integer",
     *     description="Id of the editeur of the game"
     * )
     * @var integer $idEditeur
     */
    private $idEditeur;
    /**
     * @OA\Property(
     *     title="Game genre",
     *     property="idGenre",
     *     type="integer",
     *     description="Id of the genre of the game"
     * )
     * @var integer $idGenre
     */
    private $idGenre;
    /**
     * @OA\Property(
     *     title="Game platform",
     *     property="idPlatform",
     *     type="integer",
     *     description="Id of the platform of the game"
     * )
     * @var integer $idPlatform
     */
    private $idPlatform;

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
     * @return array
     */
    public function getVideo(): ?array
    {
        return $this->video;
    }

    /**
     * @param array $video
     * @return GameEditForm
     */
    public function setVideo(array $video): GameEditForm
    {
        $this->video = $video;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdEditeur(): ?int
    {
        return $this->idEditeur;
    }

    /**
     * @param int $idEditeur
     * @return GameEditForm
     */
    public function setIdEditeur(int $idEditeur): GameEditForm
    {
        $this->idEditeur = $idEditeur;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdGenre(): ?int
    {
        return $this->idGenre;
    }

    /**
     * @param int $idGenre
     * @return GameEditForm
     */
    public function setIdGenre(int $idGenre): GameEditForm
    {
        $this->idGenre = $idGenre;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdPlatform(): ?int
    {
        return $this->idPlatform;
    }

    /**
     * @param int $idPlatform
     * @return GameEditForm
     */
    public function setIdPLatform(int $idPlatform): GameEditForm
    {
        $this->idPlatform = $idPlatform;
        return $this;
    }



}
