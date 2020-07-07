<?php

namespace App\DTO;

use App\Entity\Game;

class GamesListDTO
{
    /**
     * @var integer $id
     */
    private $id;
    /**
     * @var string $nom
     */
    private $nom;
    /**
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
     * @param int $id
     * @return GamesListDTO
     */
    public function setId(int $id): GamesListDTO
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return GamesListDTO
     */
    public function setNom(string $nom): GamesListDTO
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return GamesListDTO
     */
    public function setDescription(string $description): GamesListDTO
    {
        $this->description = $description;
        return $this;
    }


}
