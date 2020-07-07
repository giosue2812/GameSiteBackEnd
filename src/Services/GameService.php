<?php

namespace App\Services;


use App\Entity\Game;
use App\Repository\GameRepository;
use Exception;

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
     * @return Game[] if array.lenght > 0
     * @throws Exception if array.lenght <= 0
     */
    public function gamesList()
    {
        $games = $this->gameRepoistory->gamesListRepository();
        if($games)
        {
            return $games;
        }
        else
        {
            throw new Exception('Games not found');
        }
    }
}
