<?php

namespace App\Controller;


use App\DTO\GameDetailDTO;
use App\DTO\GamesListDTO;
use App\Form\GameFormType;
use App\Models\Forms\GameEditForm;
use App\Services\GameService;
use App\Utils\DataManipulation;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Rest\Put(path="/api/game/edit/{gameId}")
     * @Rest\View()
     * @OA\Put(
     *     tags={"Game"},
     *     path="/game/edit/{gameId}",
     *     summary="Update Game",
     *     operationId="update",
     *     @OA\RequestBody(
     *          required=true,
     *          description="Update game",
     *               @OA\MediaType(
     *                  mediaType="application/json",
     *                  @OA\Schema(
     *                      ref="#components/schemas/GameEditForm"
     *                  )
     *              )
     *          ),
     *     @OA\Parameter(
     *          parameter="gameId",
     *          name="gameId",
     *          in="path",
     *          description="If for game to update",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *          response="404",
     *          description="No found Game, Platform, Editeur, Genre",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *     ),
     *     @OA\Response(
     *          response="400",
     *          description="Form is invalid",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *     ),
     *     @OA\Response(
     *          response="500",
     *          description="Unexpected Error",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Return a game detail",
     *          @OA\JsonContent(ref="#/components/schemas/GameDetailDTO")
     *     )
     *     )
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function gameEditAction(Request $request)
    {
        try {
            $gameForm = new GameEditForm();
            $data = json_decode($request->getContent(), true);
            $form = $this->createForm(GameFormType::class,$gameForm);
            $form->handleRequest($request);
            $form->submit($data);
            if($form->isSubmitted() && $form->isValid()){
                $games = $this->gameService->gameEdit($form->getData(),$request->get('gameId'));
                return DataManipulation::arrayMap(GameDetailDTO::class,$games);
            }
            else
            {
                throw new Exception('Form is invalid',400);
            }
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }

    /**
     * @Rest\Post(path="/api/game/upload/{gameId}")
     * @Rest\View()
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function uploadAction(Request $request)
    {
        try {
            $game = $this->gameService->upload($request->get('gameId'),$request->files->get('image'));
            return DataManipulation::arrayMap(GameDetailDTO::class,$game);
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }
}
