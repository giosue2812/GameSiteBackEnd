<?php


namespace App\Models\Forms;


use Cassandra\Date;
use Symfony\Component\Validator\Constraints as Assert;
use OpenApi\Annotations as OA;
/**
 * Class GameNewForm
 * @package App\Models\Forms
 * @OA\Schema(
 *     description="Model to create a new Game",
 *     type="object",
 *     title="GameNewForm"
 * )
 */
class GameNewForm
{
    /**
     * @OA\Property(
     *     title="Name game",
     *     property="nom",
     *     type="string",
     *     description="Name of Game"
     * )
     * @Assert\NotNull()
     * @var string $nom
     */
    private $nom;
    /**
     * @OA\Property(
     *     title="Description Game",
     *     property="description",
     *     type="string",
     *     description="Description of Game"
     * )
     * @Assert\NotNull()
     * @var string $description
     */
    private $description;
    /**
     * @OA\Property(
     *     title="Prix of game",
     *     property="prix",
     *     type="integer",
     *     description="Prix of one game"
     * )
     * @var integer $prix
     */
    private $prix;
    /**
     * @OA\Property(
     *     title="Date achat",
     *     property="dateAchat",
     *     type="string",
     *     format="date",
     *     description="Date achat of game"
     * )
     * @var Date $dateAchat
     */
    private $date_achat;
    /**
     * @OA\Property(
     *     title="Date Sortie",
     *     property="dateSortie",
     *     type="string",
     *     format="date",
     *     description="Date sortie of game"
     * )
     * @var Date $date_sortie
     */
    private $date_sortie;
    /**
     * @OA\Property(
     *     title="Editeur Game",
     *     property="editeur",
     *     type="string",
     *     description="Editeur of game"
     * )
     * @Assert\NotNull()
     * @var string $editeur
     */
    private $editeur;
    /**
     * @OA\Property(
     *     title="Genre game",
     *     property="genre",
     *     type="string",
     *     description="Genre of game"
     * )
     * @Assert\NotNull()
     * @var string $genre
     */
    private $genre;
    /**
     * @OA\Property(
     *     title="Platform game",
     *     property="platform",
     *     type="string",
     *     description="Platform of game"
     * )
     * @Assert\NotNull()
     * @var string $platform
     */
    private $platform;

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return GameNewForm
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return GameNewForm
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     * @return GameNewForm
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateAchat()
    {
        return $this->date_achat;
    }

    /**
     * @param mixed $date_achat
     * @return GameNewForm
     */
    public function setDateAchat($date_achat)
    {
        $this->date_achat = $date_achat;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateSortie()
    {
        return $this->date_sortie;
    }

    /**
     * @param Date $date_sortie
     * @return GameNewForm
     */
    public function setDateSortie($date_sortie)
    {
        $this->date_sortie = $date_sortie;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * @param mixed $editeur
     * @return GameNewForm
     */
    public function setEditeur($editeur)
    {
        $this->editeur = $editeur;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     * @return GameNewForm
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @param mixed $platform
     * @return GameNewForm
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;
        return $this;
    }


}