<?php


namespace App\DTO;


use App\Entity\Platform;
use OpenApi\Annotations as OA;

/**
 * Class PlatformListDTO
 * @package App\DTO
 * @OA\Schema(
 *     description="Model of platform response",
 *     type="object",
 *     title="PlatformListDTO"
 * )
 */
class PlatformListDTO
{
    /**
     * @OA\Property(
     *     title="Platform ID",
     *     property="id",
     *     type="integer",
     *     description="Id of the one platform"
     * )
     * @var int|null
     */
    private $id;
    /**
     * @OA\Property(
     *     title="Platform label",
     *     property="label",
     *     type="string",
     *     description="Label of platform"
     * )
     * @var string|null
     */
    private $label;

    public function __construct(Platform $platform)
    {
        $this->id = $platform->getId();
        $this->label = $platform->getLabel();
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
     * @return PlatformListDTO
     */
    public function setId(?int $id): PlatformListDTO
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
     * @return PlatformListDTO
     */
    public function setLabel(?string $label): PlatformListDTO
    {
        $this->label = $label;
        return $this;
    }


}
