<?php


namespace App\Controller;


use App\DTO\GameDetailDTO;
use App\Entity\Game;
use App\Services\GameService;
use App\Services\VideoService;
use App\Utils\DataManipulation;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use OpenApi\Annotations as OA;

class VideoController extends AbstractFOSRestController
{
    /**
     * @var VideoService $videoService
     */
    private $videoService;
    /**
     * @var GameService $gameService
     */
    private $gameService;

    /**
     * VideoController constructor.
     * @param VideoService $videoService
     * @param GameService $gameService
     */
    public function __construct(
        VideoService $videoService,
        GameService $gameService
    )
    {
        $this->videoService = $videoService;
        $this->gameService = $gameService;
    }

    /**
     * @Rest\Delete(path="/api/video/delete/{videoId}")
     * @Rest\View()
     * @OA\Delete(
     *     tags={"Video"},
     *     path="/video/delete/{videoId}",
     *     summary="Delete on video of game",
     *     operationId="videoId",
     *     @OA\Parameter(
     *          parameter="videoId",
     *          in="path",
     *          name="videoId",
     *          description="Delete one video",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="Video Not found",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Return a array of one game",
     *          @OA\JsonContent(ref="#/components/schemas/GameDetailDTO")
     *      )
     * )
     * @param Request $request
     * @return Game[]
     */
    public function deleteVideoAction(Request $request)
    {
        try {
            $video = $this->videoService->deleteVideo($request->get('videoId'));
            $game = $this->gameService->game($video->getGame()->getId());
            return DataManipulation::arrayMap(GameDetailDTO::class,$game);
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }
}