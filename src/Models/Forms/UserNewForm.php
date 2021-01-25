<?php


namespace App\Models\Forms;

use OpenApi\Annotations as OA;

/**
 * Class UserNewForm
 * @package App\Models\Forms
 * @OA\Schema(
 *     description="Model of user new form",
 *     type="object",
 *     title="UserNewForm"
 * )
 */
class UserNewForm
{
    /**
     * @OA\Property(
     *     title="User Email",
     *     property="email",
     *     type="string",
     *     description="Email of one user"
     * )
     * @var string $email
     */
    private $email;
    /**
     * @OA\Property(
     *     title="User name",
     *     property="name",
     *     type="string",
     *     description="Name of user"
     * )
     * @var string $name
     */
    private $name;
    /**
     * @OA\Property(
     *     title="User Prenom",
     *     property="prenom",
     *     type="string",
     *     description="Prenom of User"
     * )
     * @var string $prenom
     */
    private $prenom;
    /**
     * @OA\Property(
     *     title="User Password",
     *     property="password",
     *     type="string",
     *     description="Password of User"
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
     * @return UserNewForm
     */
    public function setEmail(string $email): UserNewForm
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
     * @return UserNewForm
     */
    public function setName(string $name): UserNewForm
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
     * @return UserNewForm
     */
    public function setPrenom(string $prenom): UserNewForm
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
     * @return UserNewForm
     */
    public function setPassword(string $password): UserNewForm
    {
        $this->password = $password;
        return $this;
    }

}