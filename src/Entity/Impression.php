<?php

namespace App\Entity;

use App\Repository\ImpressionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImpressionRepository::class)
 */
class Impression extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer",nullable=false)
     */
    private $howEnd;
    /**
     * @ORM\Column(type="float",nullable=false)
     */
    private $tauxDeCompletion;
    /**
     * @ORM\Column(type="date")
     */
    private $dateImpression;
    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="impressions")
     * @ORM\JoinColumn(name="id_game")
     */
    private $Game;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHowEnd()
    {
        return $this->howEnd;
    }

    /**
     * @param mixed $howEnd
     * @return Impression
     */
    public function setHowEnd($howEnd)
    {
        $this->howEnd = $howEnd;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTauxDeCompletion()
    {
        return $this->tauxDeCompletion;
    }

    /**
     * @param mixed $tauxDeCompletion
     * @return Impression
     */
    public function setTauxDeCompletion($tauxDeCompletion)
    {
        $this->tauxDeCompletion = $tauxDeCompletion;
        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->Game;
    }

    public function setGame(?Game $Game): self
    {
        $this->Game = $Game;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateImpression()
    {
        return $this->dateImpression;
    }

    /**
     * @param mixed $dateImpression
     * @return Impression
     */
    public function setDateImpression($dateImpression)
    {
        $this->dateImpression = $dateImpression;
        return $this;
    }

}
