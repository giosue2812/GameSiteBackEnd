<?php


namespace App\Controller;


use App\DTO\GenresListDTO;
use App\Form\GenreNewFormType;
use App\Models\Forms\GenreNewForm;
use App\Services\GenreService;
use App\Utils\DataManipulation;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Rest\Post(path="/api/genre/new")
     * @Rest\View()
     * @OA\Post(
     *     tags={"Genre"},
     *     path="/genre/new",
     *     summary="New Genre",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/GenreNewForm")
     *          )
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="Form is invalid",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *      ),
     *      @OA\Response(
     *          response="500",
     *          description="Unexpected Error",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Return a list of genre",
     *          @OA\JsonContent(ref="#/components/schemas/GenresListDTO")
     *      )
     * )
     * @param Request $request
     * @return array
     */
    public function genreNewAction(Request $request)
    {
        $genreForm = new GenreNewForm();
        $data = json_decode($request->getContent(),true);
        $form = $this->createForm(GenreNewFormType::class,$genreForm);
        $form->handleRequest($request);
        $form->submit($data);
        if($form->isSubmitted() && $form->isValid())
        {
            $genres = $this->genreService->genreNew($form->getData());
            return DataManipulation::arrayMap(GenresListDTO::class,$genres);
        }
        else
        {
            throw new Exception('Form is invalid',400);
        }
    }
}
