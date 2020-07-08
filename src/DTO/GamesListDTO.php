<?php

namespace App\DTO;

use App\Entity\Game;
use OpenApi\Annotations as OA;

/**
 * Class GamesListDTO
 * @package App\DTO
 * @OA\Schema(
 *     description="Model of games list response",
 *     type="object",
 *     title="GameListDTO"
 * )
 */
class GamesListDTO
{
    /**
     * @OA\Property(
     *     title="Game ID",
     *     property="id",
     *     type="integer",
     *     description="Id of the one game"
     * )
     * @var integer $id
     */
    private $id;
    /**
     * @OA\Property(
     *     title="Game name",
     *     property="nom",
     *     type="string",
     *     description="Name of the one game"
     * )
     * @var string $nom
     */
    private $nom;
    /**
     * @OA\Property(
     *     title="Game image",
     *     property="image",
     *     type="string",
     *     description="Image of the one game"
     * )
     * @var string $image
     */
    private $image;

    /**
     * GamesListDTO constructor.
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->id = $game->getId();
        $this->nom = $game->getNom();
        $this->image = $game->getImage();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }




}
