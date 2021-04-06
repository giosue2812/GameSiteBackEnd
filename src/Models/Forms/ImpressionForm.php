<?php


namespace App\Models\Forms;

use Cassandra\Date;
use OpenApi\Annotations as OA;

/**
 * Class ImpressionForm
 * @package App\Models\Forms
 * @OA\Schema(
 *     description="Model of impression form",
 *     type="object",
 *     title="ImpressionForm"
 * )
 */
class ImpressionForm
{
    /**
     * @OA\Property(
     *     title="Game Id",
     *     property="idGame",
     *     type="integer",
     *     description="Id of the game"
     * )
     * @var integer $idGame
     */
    protected int $idGame;
    /**
     * @OA\Property(
     *     title="Game description",
     *     property="description",
     *     type="string",
     *     description="Description of game"
     * )
     * @var string $description
     */
    protected string $description;
    /**
     * @OA\Property(
     *     title="How End Game",
     *     property="howEnd",
     *     type="integer",
     *     description="How End Game"
     * )
     * @var integer $howEnd
     */
    protected int $howEnd;
    /**
     * @OA\Property(
     *     title="Taux de Completion",
     *     property="tauxDeCompletion",
     *     type="integer",
     *     description="Taux de Completion Game"
     * )
     * @var double $tauxDeCompletion
     */
    protected float $tauxDeCompletion;

    /**
     * @return int
     */
    public function getIdGame(): int
    {
        return $this->idGame;
    }

    /**
     * @param int $idGame
     * @return ImpressionForm
     */
    public function setIdGame(int $idGame): ImpressionForm
    {
        $this->idGame = $idGame;
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
     * @return ImpressionForm
     */
    public function setDescription(string $description): ImpressionForm
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getHowEnd(): int
    {
        return $this->howEnd;
    }

    /**
     * @param int $howEnd
     * @return ImpressionForm
     */
    public function setHowEnd(int $howEnd): ImpressionForm
    {
        $this->howEnd = $howEnd;
        return $this;
    }

    /**
     * @return float
     */
    public function getTauxDeCompletion(): float
    {
        return $this->tauxDeCompletion;
    }

    /**
     * @param float $tauxDeCompletion
     * @return ImpressionForm
     */
    public function setTauxDeCompletion(float $tauxDeCompletion): ImpressionForm
    {
        $this->tauxDeCompletion = $tauxDeCompletion;
        return $this;
    }

}