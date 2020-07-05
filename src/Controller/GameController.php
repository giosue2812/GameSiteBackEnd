<?php

namespace App\Controller;


use App\Services\GameService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class GameController extends AbstractFOSRestController
{
    /**
     * @var GameService $gameService
     */
    private $gameService;

    /**
     * GameController constructor.
     * @param GameService $gameService
     */
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    /**
     * @Rest\Get(path="/api/games")
     * @Rest\View()
     */
    public function gamesListAction()
    {
        return $this->gameService->gamesList();
    }

}
