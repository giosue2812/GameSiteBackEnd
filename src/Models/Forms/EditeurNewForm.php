<?php


namespace App\Models\Forms;

use OpenApi\Annotations as OA;

/**
 * Class EditeurNewForm
 * @package App\Models\Forms
 * @OA\Schema(
 *     description="Model to create a new Editeur",
 *     type="object",
 *     title="EditeurNewForm"
 * )
 */
class EditeurNewForm
{
    /**
     * @var string $label
     * @OA\Property(
     *     title="Editeur Label",
     *     property="label",
     *     type="string",
     *     description="Label of Editeur"
     * )
     */
    private $label;
    /**
     * @var string $description
     * @OA\Property(
     *     title="Editeur Description",
     *     property="description",
     *     type="string",
     *     description="Description of Editeur"
     * )
     */
    private $description;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return EditeurNewForm
     */
    public function setLabel(string $label): EditeurNewForm
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return EditeurNewForm
     */
    public function setDescription(string $description): EditeurNewForm
    {
        $this->description = $description;
        return $this;
    }


}