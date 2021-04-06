<?php


namespace App\Models\Forms;

use OpenApi\Annotations as OA;

/**
 * Class PlatformNewForm
 * @package App\Models\Forms
 * @OA\Schema(
 *     description="Model to create a new Platform",
 *     type="object",
 *     title="PlatformNewForm"
 * )
 */
class PlatformNewForm
{
    /**
     * @OA\Property(
     *     title="Platform Label",
     *     property="label",
     *     type="string",
     *     description="Label of Platform"
     * )
     * @var string $label
     */
    private $label;

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     * @return PlatformNewForm
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

}