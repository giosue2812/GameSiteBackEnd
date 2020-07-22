<?php


namespace App\DTO;


use App\Entity\Game;
use OpenApi\Annotations as OA;

/**
 * Class GameDetailDTO
 * @package App\DTO)
 * @OA\Schema(
 *     description="Model of game detail",
 *     type="object",
 *     title="GameDetailDTO"
 * )
 */
class GameDetailDTO
{
    /**
     * @OA\Property(
     *     title="Game ID",
     *     property="id",
     *     type="integer",
     *     description="Id of the one game"
     * )
     * @var int|null
     */
    private $id;
    /**
     * @OA\Property(
     *     title="Game nom",
     *     property="nom",
     *     type="string",
     *     description="Nom of the game"
     * )
     * @var string|null
     */
    private $nom;
    /**
     * @OA\Property(
     *     title="Game description",
     *     property="description",
     *     type="string",
     *     description="Description of the Game"
     * )
     * @var string|null
     */
    private $description;
    /**
     * @OA\Property(
     *     title="Game price",
     *     property="prix",
     *     type="decimal",
     *     description="Price of game"
     * )
     * @var float|null
     */
    private $prix;
    /**
     * @OA\Property(
     *     title="Game picture",
     *     property="image",
     *     type="string",
     *     description="Picture of game"
     * )
     * @var string|null
     */
    private $image;
    /**
     * @OA\Property(
     *     title="Game video",
     *     property="video",
     *     type="string",
     *     description="Video of game"
     * )
     * @var mixed
     */
    private $video;
    /**
     * @OA\Property(
     *     title="Game editeur",
     *     property="editeur",
     *     type="string",
     *     description="Editeur of the game"
     * )
     * @var string|null
     */
    private $editeur;
    /**
     * @OA\Property(
     *     title="genre",
     *     property="genre",
     *     type="string",
     *     description="Genre of the game"
     * )
     * @var string|null
     */
    private $genre;
    /**
     * @OA\Property(
     *     title="platform",
     *     property="platform",
     *     type="string",
     *     description="Platform of the game"
     * )
     * @var string|null
     */
    private $platform;

    /**
     * GameDetailDTO constructor.
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->id = $game->getId();
        $this->nom = $game->getNom();
        $this->description = $game->getDescription();
        $this->prix = $game->getPrix();
        $this->image = $game->getImage();
        $this->video = $game->getVideo();
        $this->editeur = $game->getEditeur()->getLabel();
        $this->genre = $game->getGenre()->getLabel();
        $this->platform = $game->getPlatform()->getLabel();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @return mixed
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @return mixed
     */
    public function getPlatform()
    {
        return $this->platform;
    }
}