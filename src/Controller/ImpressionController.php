<?php


namespace App\Controller;

use App\DTO\ImpressionDTO;
use App\Form\ImpressionEditFormType;
use App\Form\ImpressionNewFormType;
use App\Models\Forms\ImpressionForm;
use App\Services\ImpressionService;
use App\Utils\DataManipulation;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ImpressionController extends AbstractFOSRestController
{
    /**
     * @var ImpressionService $impressionService
     */
    private ImpressionService $impressionService;

    public function __construct(ImpressionService $impressionService)
    {
        $this->impressionService = $impressionService;
    }

    /**
     * @Rest\Get(path="/api/impressions")
     * @Rest\View()
     * @OA\Get(
     *     tags={"Impression"},
     *     path="/impressions",
     *     summary="Get a list of impressions",
     *     operationId="impression",
     *     @OA\Response(
     *          response="404",
     *          description="No found impression list",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Return a list of impression",
     *          @OA\JsonContent(ref="#/components/schemas/ImpressionDTO")
     *      )
     * )
     * @return array
     * @throws Exception
     */
    public function impressionListAction()
    {
        try {
            $impressions = $this->impressionService->impressionList();
            return DataManipulation::arrayMap(ImpressionDTO::class,$impressions);
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }
    /**
     * @Rest\Post(path="/api/impression/new")
     * @Rest\View()
     * @OA\Post(
     *     tags={"Impression"},
     *     path="/impression/new",
     *     summary="New Impression",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/ImpressionForm")
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
     *          description="Return a list of impression",
     *          @OA\JsonContent(ref="#/components/schemas/ImpressionDTO")
     *      )
     * )
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function impressionNewAction(Request $request)
    {
        try {
            $impressionForm = new ImpressionForm();
            $data = json_decode($request->getContent(),true);
            $form = $this->createForm(ImpressionNewFormType::class,$impressionForm);
            $form->handleRequest($request);
            $form->submit($data);
            if($form->isSubmitted() && $form->isValid()){
                $impressions = $this->impressionService->impressionNew($form->getData());
                return DataManipulation::arrayMap(ImpressionDTO::class,$impressions);
            }
            else
            {
                throw new Exception('Form is invalid',404);
            }
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }

    /**
     * @Rest\Put(path="/api/impression/edit/{idImpression}")
     * @Rest\View()
     * @OA\Put(
     *     tags={"Impression"},
     *     path="/impression/edit/{idImpression}",
     *     summary="Impression Update",
     *     operationId="idImpression",
     *     @OA\RequestBody(
     *          required=true,
     *          description="Impression Update",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  ref="#components/schemas/ImpressionForm"
     *              )
     *          )
     *      ),
     *     @OA\Parameter(
     *          parameter="idImpression",
     *          name="idImpression",
     *          in="path",
     *          description="Id of impression game",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="No found impression game",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
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
     *          description="Return a impression list",
     *          @OA\JsonContent(ref="#/components/schemas/ImpressionDTO")
     *      )
     * )
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function impressionEditAction(Request $request)
    {
        try {
            $impressionForm = new ImpressionForm();
            $data = json_decode($request->getContent(),true);
            $form = $this->createForm(ImpressionEditFormType::class,$impressionForm);
            $form->handleRequest($request);
            $form->submit($data);
            if($form->isSubmitted() && $form->isValid()){
                $impression = $this->impressionService->impressionEdit($form->getData(),$request->get('idImpression'));
                return DataManipulation::arrayMap(ImpressionDTO::class,$impression);
            }
            else
            {
                throw new Exception('Form is invalid',404);
            }
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }

    /**
     * @Rest\Get(path="/api/impression/{idImpression}")
     * @Rest\View()
     * @OA\Get(
     *     tags={"Impression"},
     *     path="/impression/{idImpression}",
     *     summary="Get impression game",
     *     operationId="idImpression",
     *     @OA\Parameter(
     *          parameter="idImpression",
     *          in="path",
     *          name="idImpression",
     *          description="Id impression game to get",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="No found impression",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Return an array of impression",
     *          @OA\JsonContent(ref="#/components/schemas/ImpressionDTO")
     *      )
     * )
     * @param Request $request
     * @return array
     */
    public function getImpressionAction(Request $request)
    {
        try {
            $impression = $this->impressionService->getImpression($request->get('idImpression'));
            return DataManipulation::arrayMap(ImpressionDTO::class,$impression);
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }
}