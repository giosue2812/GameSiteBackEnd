<?php

namespace App\Controller;


use App\DTO\GamesListDTO;
use App\Services\GameService;
use App\Utils\DataManipulation;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
     * @throws \Exception
     */
    public function gamesListAction()
    {
        try {
            $games = $this->gameService->gamesList();
            return DataManipulation::arrayMap(GamesListDTO::class,$games);
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }

    }

}
