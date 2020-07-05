<?php

namespace App\Services;


use App\Entity\Game;
use App\Repository\GameRepository;

class GameService
{
    /**
     * @var GameRepository $gameRepoistory
     */
    private $gameRepoistory;

    /**
     * GameService constructor.
     * @param GameRepository $gameRepoistory
     */
    public function __construct(GameRepository $gameRepoistory)
    {
        $this->gameRepoistory = $gameRepoistory;
    }

    /**
     * @return Game[]
     */
    public function gamesList()
    {
        $games = $this->gameRepoistory->findAll();
        return $games;
    }
}
