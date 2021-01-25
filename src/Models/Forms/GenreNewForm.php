<?php


namespace App\Models\Forms;

use OpenApi\Annotations as OA;

/**
 * Class GenreNewForm
 * @package App\Models\Forms)
 * @OA\Schema(
 *     description="Model to create a new genre",
 *     type="object",
 *     title="GenreNewForm"
 * )
 */
class GenreNewForm
{
    /**
     * @OA\Property(
     *     title="Genre Lable",
     *     property="label",
     *     type="string",
     *     description="Label of genre"
     * )
     * @var string $label
     */
    private $label;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return GenreNewForm
     */
    public function setLabel(string $label): GenreNewForm
    {
        $this->label = $label;
        return $this;
    }


}