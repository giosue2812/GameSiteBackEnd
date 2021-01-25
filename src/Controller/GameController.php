<?php

namespace App\Controller;


use App\DTO\GameDetailDTO;
use App\DTO\GamesListDTO;
use App\DTO\ListEnvieDTO;
use App\Form\GameFormType;
use App\Form\GameNewFormType;
use App\Models\Forms\GameEditForm;
use App\Models\Forms\GameNewForm;
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
    private GameService $gameService;

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
     * @return array
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
     * @Rest\Get(path="/api/listEnvies")
     * @Rest\View()
     * @OA\Get(
     *     tags={"Game"},
     *     path="/listEnvies",
     *     summary="Get a list of game not buy",
     *     operationId="game",
     *     @OA\Response(
     *          response="404",
     *          description="No found list envie",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Return a list of game not buy",
     *          @OA\JsonContent(ref="#/components/schemas/ListEnvieDTO")
     *      )
     * )
     * @return array
     * @throws \Exception
     */
    public function listEnvieAction()
    {
        try {
            $listEnvie = $this->gameService->listEnvie();
            return DataManipulation::arrayMap(ListEnvieDTO::class, $listEnvie);
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }
    /**
     * @Rest\Get(path="/api/game/{gameId}")
     * @Rest\View()
     * @OA\Get(
     *     tags={"Game"},
     *     path="/game/{gameId}",
     *     summary="Get a game by id",
     *     operationId="gameId",
     *     @OA\Parameter(
     *          parameter="gameId",
     *          in="path",
     *          name="gameId",
     *          description="Id for game to get",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *          response="404",
     *          description="No found game",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Return a array of one game",
     *          @OA\JsonContent(ref="#/components/schemas/GameDetailDTO")
     *     )
     * )
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function gameAction(Request $request)
    {
        try {
            $game = $this->gameService->game($request->get('gameId'));
            return DataManipulation::arrayMap(GameDetailDTO::class,$game);
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
     *     operationId="gameId",
     *     @OA\RequestBody(
     *          required=true,
     *          description="Update game",
     *               @OA\MediaType(
     *                  mediaType="application/json",
     *                  @OA\Schema(
     *                      ref="#/components/schemas/GameEditForm"
     *                  )
     *              )
     *          ),
     *     @OA\Parameter(
     *          parameter="gameId",
     *          name="gameId",
     *          in="path",
     *          description="Id for game to update",
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
     * @OA\Post(
     *     tags={"Game"},
     *     path="/game/upload/{gameId}",
     *     summary="Upload image of game",
     *     operationId="upload",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      description="Picture to upload",
     *                      property="picture",
     *                      type="file",
     *                      format="file"
     *                  ),
     *                 required={"file"}
     *              )
     *          )
     *     ),
     *     @OA\Parameter(
     *          description="Id of game",
     *          in="path",
     *          name="gameId",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *     ),
     *     @OA\Response(
     *          response="404",
     *          description="Not found game or not found file to upload",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *     ),
     *     @OA\Response(
     *          response="500",
     *          description="Unexpected error",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Return game upadted",
     *          @OA\JsonContent(ref="#/components/schemas/GameDetailDTO")
     *     )
     * )
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function uploadAction(Request $request)
    {
        try {
            $game = $this->gameService->upload($request->get('gameId'),$request->files->get('picture'));
            return DataManipulation::arrayMap(GameDetailDTO::class,$game);
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }

    /**
     * @Rest\Post(path="/api/game/new")
     * @Rest\View()
     * @OA\Post(
     *     tags={"Game"},
     *     path="/game/new",
     *     summary="New Game",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/GameNewForm")
     *          )
     *      ),
     *     @OA\Response(
     *          response="400",
     *          description="Form is invalid",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *      ),
     *     @OA\Response(
     *          response="500",
     *          description="Unexpected Error",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Return a array of new product",
     *          @OA\JsonContent(ref="#/components/schemas/GameDetailDTO")
     *      )
     * )
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function gameNewAction(Request $request)
    {
        try {
            $gameForm = new GameNewForm();
            $data = json_decode($request->getContent(),true);
            $form = $this->createForm(GameNewFormType::class,$gameForm);
            $form->handleRequest($request);
            $form->submit($data);
            if($form->isSubmitted() && $form->isValid()){
                $games = $this->gameService->gameNew($form->getData());
                return DataManipulation::arrayMap(GamesListDTO::class,$games);
            }
            else
            {
                throw new Exception('Form is invalid',400);
            }
        }
        catch (Exception $exception){
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }

    /**
     * @Rest\Delete(path="/api/game/delete/{idGame}")
     * @Rest\View()
     * @OA\Delete(
     *     tags={"Game"},
     *     path="/game/delete/{idGame}",
     *     summary="Delete Game",
     *     operationId="idGame",
     *     @OA\Parameter(
     *          parameter="idGame",
     *          in="path",
     *          name="idGame",
     *          description="Delete on game",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="Delete not possibel",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Return a list of game",
     *          @OA\JsonContent(ref="#/components/schemas/GamesListDTO")
     *      )
     * )
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function gameDeleteAction(Request $request)
    {
        try {
            $games = $this->gameService->gameDelete($request->get('idGame'));
            return DataManipulation::arrayMap(GamesListDTO::class,$games);
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }
}
