<?php


namespace App\Models\Forms;

use OpenApi\Annotations as OA;

/**
 * Class UserEditForm
 * @package App\Models\Forms
 * @OA\Schema(
 *     description="Model of UserEditForm",
 *     type="object",
 *     title="UserEditForm"
 * )
 */
class UserEditForm
{
    /**
     * @OA\Property(
     *     title="User Email",
     *     property="email",
     *     type="string",
     *     description="Email for user"
     * )
     * @var string $email
     */
    private $email;
    /**
     * @OA\Property(
     *     title="User name",
     *     property="name",
     *     type="string",
     *     description="Name for user"
     * )
     * @var string $name
     */
    private $name;
    /**
     * @OA\Property(
     *     title="User prenom",
     *     property="prenom",
     *     type="string",
     *     description="Prenom of user"
     * )
     * @var string $prenom
     */
    private $prenom;
    /**
     * @OA\Property(
     *     title="User Password",
     *     property="password",
     *     type="string",
     *     description="Password of user"
     * )
     * @var string $password
     */
    private $password;


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UserEditForm
     */
    public function setEmail(string $email): UserEditForm
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UserEditForm
     */
    public function setName(string $name): UserEditForm
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return UserEditForm
     */
    public function setPrenom(string $prenom): UserEditForm
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return UserEditForm
     */
    public function setPassword(string $password): UserEditForm
    {
        $this->password = $password;
        return $this;
    }

}