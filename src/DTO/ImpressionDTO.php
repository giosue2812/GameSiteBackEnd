<?php


namespace App\DTO;


use App\Entity\Impression;
use OpenApi\Annotations as OA;
/**
 * Class ImpressionDTO
 * @package App\DTO
 * @OA\Schema(
 *     description="Model of impression list",
 *     type="object",
 *     title="ImpressionDTO"
 * )
 */
class ImpressionDTO
{
    /**
     * @OA\Property(
     *     title="Impression Id",
     *     property="id",
     *     type="integer",
     *     description="Id of impression"
     * )
     * @var integer $id
     */
    private $id;
    /**
     * @OA\Property(
     *     title="Impression Game",
     *     property="gameTitre",
     *     type="string",
     *     description="Impression Game Titre"
     * )
     * @var string $gameTitre
     */
    private $gameTitre;
    /**
     * @OA\Property(
     *     title="Impression Description",
     *     property="description",
     *     type="string",
     *     description="Impression Game Description"
     * )
     * @var string $description
     */
    private $description;
    /**
     * @OA\Property(
     *     title="Impression How End",
     *     property="howEnd",
     *     type="integer",
     *     description="Impression How End Game"
     * )
     * @var integer $howEnd
     */
    private $howEnd;
    /**
     * @OA\Property(
     *     title="Impression Taux de Completion",
     *     property="tauxDeCompletion",
     *     type="integer",
     *     description="Impression Taux de Completion Game"
     * )
     * @var integer $tauxDeCompletion
     */
    private $tauxDeCompletion;
    /**
     * @OA\Property(
     *     title="Impression Date Impression",
     *     property="dateImpression",
     *     type="string",
     *     format="date",
     *     description="Impression Date Impression Game"
     * )
     * @var mixed $dateImpression
     */
    private $dateImpression;
    /**
     * @OA\Property(
     *     title="Impression Image",
     *     property="image",
     *     type="string",
     *     description="Impression Image Game"
     * )
     * @var string $image
     */
    private $image;
    /**
     * ImpressionDTO constructor.
     * @param Impression $impression
     */
    public function __construct(Impression $impression)
    {
        $this->id  = $impression->getId();
        $this->gameTitre = $impression->getGame()->getNom();
        $this->description = $impression->getDescription();
        $this->howEnd = $impression->getHowEnd();
        $this->tauxDeCompletion = $impression->getTauxDeCompletion();
        $this->dateImpression = $impression->getDateImpression();
        $this->image = $impression->getGame()->getImage();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getGameTitre()
    {
        return $this->gameTitre;
    }


    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getHowEnd()
    {
        return $this->howEnd;
    }

    /**
     * @return mixed
     */
    public function getTauxDeCompletion()
    {
        return $this->tauxDeCompletion;
    }

    /**
     * @return mixed
     */
    public function getDateImpression()
    {
        return $this->dateImpression;
    }

}