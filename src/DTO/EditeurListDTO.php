<?php


namespace App\DTO;


use App\Entity\Editeur;
use OpenApi\Annotations as OA;

/**
 * Class EditeurListDTO
 * @package App\DTO
 * @OA\Schema(
 *     description="Model of editeur response",
 *     type="object",
 *     title="EditeurListDTO"
 * )
 */
class EditeurListDTO
{
    /**
     * @OA\Property(
     *     title="Editeur ID",
     *     property="id",
     *     type="integer",
     *     description="Id of the one editeur"
     * )
     * @var int|null
     */
    private $id;
    /**
     * @OA\Property(
     *     title="Editeur Label",
     *     property="label",
     *     type="string",
     *     description="Label of editeur"
     * )
     * @var string|null
     */
    private $label;

    /**
     * @OA\Property(
     *     title="Editeur Description",
     *     property="description",
     *     type="string",
     *     description="Description of editeur"
     * )
     * @var string $description
     */
    private $description;

    /**
     * EditeurListDTO constructor.
     * @param Editeur $editeur
     */
    public function __construct(Editeur $editeur)
    {
        $this->id = $editeur->getId();
        $this->label = $editeur->getLabel();
        $this->description = $editeur->getDescription();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return EditeurListDTO
     */
    public function setId(?int $id): EditeurListDTO
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     * @return EditeurListDTO
     */
    public function setLabel(?string $label): EditeurListDTO
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
     * @return EditeurListDTO
     */
    public function setDescription(string $description): EditeurListDTO
    {
        $this->description = $description;
        return $this;
    }


}
