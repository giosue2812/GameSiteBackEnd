<?php

namespace App\Controller;

use App\DTO\PlatformListDTO;
use App\Form\PlatformNewFormType;
use App\Models\Forms\PlatformNewForm;
use App\Services\PlatformService;
use App\Utils\DataManipulation;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use OpenApi\Annotations as OA;
use FOS\RestBundle\Controller\Annotations as Rest;

class PlatformController extends AbstractFOSRestController
{
    /**
     * @var PlatformService $platformService
     */
    private $platformService;

    public function __construct(PlatformService $platformService)
    {
        $this->platformService = $platformService;
    }

    /**
     * @Rest\Get(path="/api/platforms")
     * @Rest\View()
     * @OA\Get(
     *     tags={"Platform"},
     *     path="/platforms",
     *     summary="Get a list of platform",
     *     operationId="platform",
     *     @OA\Response(
     *          response="404",
     *          description="No found a list of platform",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Return a list of platform",
     *          @OA\JsonContent(ref="#/components/schemas/PlatformListDTO")
     *     )
     * )
     * @return array
     */
    public function platformListAction()
    {
        try {
            $platforms = $this->platformService->platformList();
            return DataManipulation::arrayMap(PlatformListDTO::class,$platforms);
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }

    /**
     * @Rest\Post(path="/api/platform/new")
     * @Rest\View()
     * @OA\Post(
     *     tags={"Platform"},
     *     path="/platform/new",
     *     summary="New Platform",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/PlatformNewForm")
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
     *          description="Return a list a platform",
     *          @OA\JsonContent(ref="#/components/schemas/PlatformListDTO")
     *      )
     * )
     * @param Request $request
     * @return array
     */
    public function platformNewAction(Request $request)
    {
        $platformForm = new PlatformNewForm();
        $data = json_decode($request->getContent(),true);
        $form = $this->createForm(PlatformNewFormType::class,$platformForm);
        $form->handleRequest($request);
        $form->submit($data);
        if($form->isSubmitted() && $form->isValid())
        {
            $platforms = $this->platformService->platformNew($form->getData());
            return DataManipulation::arrayMap(PlatformListDTO::class,$platforms);
        }
        else
        {
            throw new Exception('Form is invalid',400);
        }
    }
}
