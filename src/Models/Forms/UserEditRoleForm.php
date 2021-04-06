<?php


namespace App\Models\Forms;

use OpenApi\Annotations as OA;

/**
 * Class UserEditRoleForm
 * @package App\Models\Forms
 * @OA\Schema(
 *     description="Model of user edit role",
 *     type="object",
 *     title="UserEditRoleForm"
 * )
 */
class UserEditRoleForm
{
    /**
     * @OA\Property(
     *     title="User role",
     *     property="role",
     *     type="string",
     *     description="Role of user"
     * )
     * @var string $role
     */
    private $role;

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return UserEditRoleForm
     */
    public function setRole(string $role): UserEditRoleForm
    {
        $this->role = $role;
        return $this;
    }


}