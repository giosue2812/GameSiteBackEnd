<?php

namespace App\Controller;

use App\DTO\EditeurListDTO;
use App\Form\EditeurNewFormType;
use App\Models\Forms\EditeurNewForm;
use App\Services\EditeurService;
use App\Utils\DataManipulation;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use OpenApi\Annotations as OA;
use FOS\RestBundle\Controller\Annotations as Rest;

class EditeurController extends AbstractFOSRestController
{
    /**
     * @var EditeurService $editeurService
     */
    private EditeurService $editeurService;

    /**
     * EditeurController constructor.
     * @param EditeurService $editeurService
     */
    public function __construct(EditeurService $editeurService)
    {
        $this->editeurService = $editeurService;
    }

    /**
     * @Rest\Get(path="/api/editeurs")
     * @Rest\View()
     * @OA\Get(
     *     tags={"Editeur"},
     *     path="/editeurs",
     *     summary="Get a list of editeur",
     *     operationId="editeur",
     *     @OA\Response(
     *          response="404",
     *          description="No found editeur list",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Return a list of editeur",
     *          @OA\JsonContent(ref="#/components/schemas/EditeurListDTO")
     *     )
     * )
     * @return array
     * @throws Exception
     */
    public function editeurListAction()
    {
        try {
            $editeurs = $this->editeurService->editeurList();
            return DataManipulation::arrayMap(EditeurListDTO::class,$editeurs);
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }

    /**
     * @Rest\Post(path="/api/editeur/new")
     * @Rest\View()
     * @OA\Post(
     *     tags={"Editeur"},
     *     path="/editeur/new",
     *     summary="New Editeur",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/EditeurNewForm")
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
     *          description="Return a list of editeur",
     *          @OA\JsonContent(ref="#/components/schemas/EditeurListDTO")
     *      )
     * )
     * @param Request $request
     * @return array
     */
    public function editeurNewAction(Request $request)
    {
        $editeurForm = new EditeurNewForm();
        $data = json_decode($request->getContent(),true);
        $form = $this->createForm(EditeurNewFormType::class,$editeurForm);
        $form->handleRequest($request);
        $form->submit($data);
        if($form->isSubmitted() && $form->isValid())
        {
            $editeurs = $this->editeurService->editeurNew($form->getData());
            return DataManipulation::arrayMap(EditeurListDTO::class,$editeurs);
        }
        else
        {
            throw new Exception('Form is invalid',400);
        }
    }
}
