<?php

namespace App\Controller;


use App\DTO\GamesListDTO;
use App\Services\GameService;
use App\Utils\DataManipulation;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use OpenApi\Annotations as OA;

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
     * @OA\Get(
     *     tags={"Game"},
     *     path="/games",
     *     summary="Get a list of games",
     *     operationId="game",
     *     @OA\Response(
     *          response="404",
     *          description="No found games list",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Return a list of Games",
     *          @OA\JsonContent(ref="#/components/schemas/GamesListDTO")
     *     )
     * )
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
