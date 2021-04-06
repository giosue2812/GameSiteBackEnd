<?php


namespace App\DTO;


use App\Entity\User;
use OpenApi\Annotations as OA;

/**
 * Class UserDTO
 * @package App\DTO
 * @OA\Schema(
 *      description="Model of user",
 *      type="object",
 *      title="UserDTO"
 * )
 */
class UserDTO
{
    /**
     * @OA\Property(
     *     title="User Nom",
     *     property="nom",
     *     type="string",
     *     description="Name of one user"
     * )
     * @var string $nom
     */
    private $nom;
    /**
     * @OA\Property(
     *     title="User Prenom",
     *     property="prenom",
     *     type="string",
     *     description="Prenom of user"
     * )
     * @var string $prenom
     */
    private $prenom;
    /**
     * @OA\Property(
     *     title="User email",
     *     property="email",
     *     type="string",
     *     description="Email of user"
     * )
     * @var string $email
     */
    private $email;

    /**
     * UserDTO constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->nom = $user->getName();
        $this->email = $user->getEmail();
        $this->prenom = $user->getPrenom();
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

}