<?php


namespace App\DTO;

use App\Entity\User;
use OpenApi\Annotations as OA;

/**
 * Class UserDetailSetupDTO
 * @package App\DTO
 * @OA\Schema(
 *      description="Model of user detail",
 *      type="object",
 *      title="UserDetailSetupDTO"
 * )
 */
class UserDetailSetupDTO
{
    /**
     * @OA\Property(
     *     title="User Id",
     *     property="id",
     *     type="integer",
     *     description="Id of user"
     * )
     * @var int|null
     */
    private $id;
    /**
     * @OA\Property(
     *     title="User nom",
     *     property="nom",
     *     type="string",
     *     description="Nom of user"
     * )
     * @var mixed
     */
    private $nom;
    /**
     * @OA\Property(
     *     title="User Prenom",
     *     property="prenom",
     *     type="string",
     *     description="Prenom of user"
     * )
     * @var mixed
     */
    private $prenom;
    /**
     * @OA\Property(
     *     title="User email",
     *     property="email",
     *     type="string",
     *     description="email of user"
     * )
     * @var string|null
     */
    private $email;
    /**
     * @OA\Property(
     *     title="User Role",
     *     property="role",
     *     type="array",
     *     items="role",
     *     description="Role Array of user"
     * )
     * @var array
     */
    private $role;

    public function __construct(User $user)
    {
        $this->id = $user->getId();
        $this->nom = $user->getName();
        $this->prenom = $user->getPrenom();
        $this->email = $user->getEmail();
        $this->role = $user->getRoles();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return array
     */
    public function getRole(): array
    {
        return $this->role;
    }


}