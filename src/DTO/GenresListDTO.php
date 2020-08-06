<?php


namespace App\DTO;


use App\Entity\Genre;
use OpenApi\Annotations as OA;

/**
 * Class GenresListDTO
 * @package App\DTO
 * @OA\Schema(
 *     description="Model of genres list response",
 *     type="object",
 *     title="GenresListDTO"
 * )
 */
class GenresListDTO
{
    /**
     * @OA\Property(
     *     title="Genre ID",
     *     property="id",
     *     type="integer",
     *     description="Id of the one genre"
     * )
     * @var int|null
     */
    private $id;
    /**
     * @OA\Property(
     *     title="Genre Label",
     *     property="label",
     *     type="string",
     *     description="Label of genre"
     * )
     * @var string|null
     */
    private $label;

    /**
     * GenresListDTO constructor.
     * @param Genre $genre
     */
    public function __construct(Genre $genre)
    {
        $this->id = $genre->getId();
        $this->label = $genre->getLabel();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }


}

