<?php


namespace App\Controller;

use App\DTO\UserDTO;
use App\Form\UserEditFormType;
use App\Models\Forms\UserEditForm;
use OpenApi\Annotations as OA;
use App\DTO\UserDetailSetupDTO;
use App\Entity\User;
use App\Form\UserEditRoleFormType;
use App\Form\UserNewFormType;
use App\Models\Forms\UserEditRoleForm;
use App\Models\Forms\UserNewForm;
use App\Services\UserService;
use App\Utils\DataManipulation;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends AbstractFOSRestController
{
    /**
     * @var UserService $userService
     */
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Rest\Post(path="/api/user/new")
     * @Rest\View()
     * @OA\Post(
     *     tags={"User"},
     *     path="/user/new",
     *     summary="New User",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/UserNewForm")
     *          )
     *      ),
     *     @OA\Response(
     *          response="400",
     *          description="Form is invalid",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *      ),
     *     @OA\Response(
     *          response="500",
     *          description="Unexected Error",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Return impression list",
     *          @OA\JsonContent(ref="#/components/schemas/UserDTO")
     *      )
     * )
     * @param Request $request
     * @return User
     */
    public function newUserAction(Request $request)
    {
        try {
            $userNewForm = new UserNewForm();
            $data = json_decode($request->getContent(),true);
            $form = $this->createForm(UserNewFormType::class,$userNewForm);
            $form->handleRequest($request);
            $form->submit($data);
            if($form->isSubmitted() && $form->isValid()){
                return $this->userService->newUser($form->getData());
            }
            else{
                throw new Exception('Form is invalid',400);
            }
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }

    /**
     * @Rest\Get(path="/api/users")
     * @Rest\View()
     * @OA\Get(
     *     tags={"User"},
     *     path="/users",
     *     summary="Get a list of Users",
     *     operationId="user",
     *     @OA\Response(
     *          response="404",
     *          description="No found users list",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Return a list of user",
     *          @OA\JsonContent(ref="#/components/schemas/UserDetailSetupDTO")
     *      )
     * )
     * @return array
     * @throws Exception
     */
    public function userListAction()
    {
        try {
            $users = $this->userService->userList();
            return DataManipulation::arrayMap(UserDetailSetupDTO::class,$users);
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getCode(),$exception->getMessage());
        }
    }

    /**
     * @Rest\Get(path="/api/user/{userID}")
     * @Rest\View()
     * @OA\Get(
     *     tags={"User"},
     *     path="/user/{userID}",
     *     summary="Get a user by id",
     *     operationId="userID",
     *     @OA\Parameter(
     *          parameter="userID",
     *          in="path",
     *          name="userID",
     *          description="Id for user to get",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="No found game",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Return an array of one user",
     *          @OA\JsonContent(ref="#/components/schemas/UserDetailSetupDTO")
     *      )
     * )
     * @param Request $request
     * @return array
     */
    public function getUserAction(Request $request)
    {
        try {
            $user = $this->userService->getUser($request->get('userID'));
            return DataManipulation::arrayMap(UserDetailSetupDTO::class,$user);
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getMessage(),$exception->getCode());
        }
    }

    /**
     * @Rest\Get(path="/api/user/username/{username}")
     * @Rest\View()
     * @OA\Get(
     *     tags={"User"},
     *     path="/user/username/{username}",
     *     summary="Get a user by username",
     *     operationId="username",
     *     @OA\Parameter(
     *          parameter="username",
     *          in="path",
     *          name="username",
     *          description="Username for user to get",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              format="email"
     *          )
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="No found game",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorResponseDTO")
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Return an array of one user",
     *          @OA\JsonContent(ref="#/components/schemas/UserDTO")
     *      )
     * )
     * @param Request $request
     * @return array
     */
    public function getUserProfil(Request $request)
    {
        try {
            $profil = $this->userService->getUserProfil($request->get('username'));
            return DataManipulation::arrayMap(UserDTO::class,$profil);
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getMessage(),$exception->getCode());
        }
    }

    /**
     * @Rest\Put(path="/api/user/edit/profil/{username}")
     * @Rest\View()
     * @OA\Put(
     *     tags={"User"},
     *     path="/user/edit/profil/{username}",
     *     summary="Update user profil",
     *     operationId="username",
     *     @OA\RequestBody(
     *          required=true,
     *          description="Username for user",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/UserEditForm")
     *          )
     *      ),
     *     @OA\Parameter(
     *          parameter="username",
     *          name="username",
     *          in="path",
     *          description="Username for user",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
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
     *          description="Return profil",
     *          @OA\JsonContent(ref="#/components/schemas/UserDTO")
     *      )
     * )
     * @param Request $request
     * @return array
     */
    public function editUserProfilAction(Request $request)
    {
        try {
            $userEditForm = new UserEditForm();
            $data = json_decode($request->getContent(),true);
            $form = $this->createForm(UserEditFormType::class,$userEditForm);
            $form->handleRequest($request);
            $form->submit($data);
            if($form->isSubmitted() && $form->isValid())
            {
                $profil = $this->userService->editUserProfil($form->getData(),$request->get('username'));
                return DataManipulation::arrayMap(UserDTO::class,$profil);
            }
            else
            {
                throw new Exception('Form is invalid',400);
            }
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getMessage(),$exception->getCode());
        }
    }

    /**
     * @Rest\Put(path="/api/user/editRole/{userId}")
     * @Rest\View()
     * @OA\Put(
     *     tags={"User"},
     *     path="/user/editRole/{userId}",
     *     summary="Update Role of User",
     *     operationId="userId",
     *     @OA\RequestBody(
     *          required=true,
     *          description="Update role user",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/UserEditRoleForm")
     *          )
     *      ),
     *     @OA\Parameter(
     *          parameter="userId",
     *          name="userId",
     *          in="path",
     *          description="Id for user to update",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="No found user",
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
     *          description="Return a game detail",
     *          @OA\JsonContent(ref="#/components/schemas/UserDetailSetupDTO")
     *      )
     * )
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function userEditRoleAction(Request $request)
    {
        try {
            $userEditRoleForm = new UserEditRoleForm();
            $data = json_decode($request->getContent(),true);
            $form = $this->createForm(UserEditRoleFormType::class,$userEditRoleForm);
            $form->handleRequest($request);
            $form->submit($data);
            if($form->isSubmitted() && $form->isValid())
            {
                $user = $this->userService->userEditRole($form->getData(),$request->get('userId'));
                return DataManipulation::arrayMap(UserDetailSetupDTO::class,$user);
            }
            else
            {
                throw new Exception('Form is invalid',400);
            }
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getMessage(),$exception->getCode());
        }
    }

    /**
     * @Rest\Delete(path="/api/user/delete/{userId}")
     * @Rest\View()
     * @OA\Delete(
     *     tags={"User"},
     *     path="/user/delete/{userId}",
     *     summary="Delete User",
     *     operationId="userId",
     *     @OA\Parameter(
     *          parameter="userId",
     *          in="path",
     *          name="userId",
     *          description="Delete user",
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
     *          @OA\JsonContent(ref="#/components/schemas/UserDTO")
     *      )
     * )
     * @param Request $request
     * @return array
     */
    public function userDeleteAction(Request $request)
    {
        try {
            $user = $this->userService->userDelete($request->get('userId'));
            return DataManipulation::arrayMap(UserDTO::class,$user);
        }
        catch (Exception $exception)
        {
            throw new HttpException($exception->getMessage(),$exception->getCode());
        }
    }

}