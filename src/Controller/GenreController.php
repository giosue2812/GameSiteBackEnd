<?php


namespace App\Controller;


use App\DTO\GenresListDTO;
use App\Services\GenreService;
use App\Utils\DataManipulation;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use OpenApi\Annotations as OA;

class GenreController extends AbstractFOSRestController
{
    /**
     * @var GenreService $genreService
     */
    private $genreService;

    /**
     * GenreController constructor.
     * @param GenreService $genreService
     */
    public function __construct(GenreService $genreService)
    {
        $this->genreService = $genreService;
    }

    /**
     * @Rest\Get(path="/api/genres")
     * @Rest\View()
     * @OA\Get(
     *     tags={"Genre"},
     *     path="/genres",
     *     summary="Get a list of genre",
     *     operationId="genre",
     *     @OA\Response(
     *          response="404",
     *          description="No found genres list",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Return a list of genre",
     *          @OA\JsonContent(ref="#/components/schemas/GenresListDTO")
     *     )
     * )
     * @return array
     */
    public function genresListAction()
    {
        try {
            $genres = $this->genreService->genresList();
            return DataManipulation::arrayMap(GenresListDTO::class,$genres);
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }
}
