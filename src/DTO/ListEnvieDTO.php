<?php


namespace App\DTO;


use App\Entity\Game;
use OpenApi\Annotations as OA;

/**
 * Class ListEnvieDTO
 * @package App\DTO
 * @OA\Schema(
 *     description="Model of game list envie",
 *     type="object",
 *     title="ListEnvieDTO"
 * )
 */
class ListEnvieDTO
{
    /**
     * @OA\Property(
     *     title="Game Id",
     *     property="id",
     *     type="integer",
     *     description="Id of the one game"
     * )
     * @var int|null
     */
    private $id;
    /**
     * @OA\Property(
     *     title="Game name",
     *     property="nom",
     *     type="string",
     *     description="Name of the game"
     * )
     * @var string|null
     */
    private $nom;
    /**
     * @OA\Property(
     *     title="Game description",
     *     property="description",
     *     type="string",
     *     description="Description of the game"
     * )
     * @var string|null
     */
    private $description;
    /**
     * @OA\Property(
     *     title="Date of out",
     *     property="dateSortie",
     *     type="string",
     *     description="Date of out the game"
     * )
     * @var \DateTime|null
     */
    private $dateSortie;
    /**
     * @OA\Property(
     *     title="Image game",
     *     property="image",
     *     type="string",
     *     description="Image of the game"
     * )
     * @var string
     */
    private $image;

    public function __construct(Game $game)
    {
        $this->id = $game->getId();
        $this->nom = $game->getNom();
        $this->description = $game->getDescription();
        $this->dateSortie = $game->getDateSortie();
        $this->image = $game->getImage();
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
    public function getDateSortie()
    {
        return $this->dateSortie;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

}