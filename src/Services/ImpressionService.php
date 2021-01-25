<?php


namespace App\Services;


use App\Entity\Impression;
use App\Models\Forms\ImpressionEditForm;
use App\Models\Forms\ImpressionForm;
use App\Repository\ImpressionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class ImpressionService
{
    /**
     * @var ImpressionRepository $impressionRepository
     */
    private $impressionRepository;

    /**
     * @var EntityManagerInterface $manager
     */
    private $manager;
    /**
     * @var GameService $gamerService
     */
    private $gamerService;
    /**
     * ImpressionService constructor.
     * @param ImpressionRepository $impressionRepository
     * @param EntityManagerInterface $manager
     * @param GameService $gameService
     */
    public function __construct(
        ImpressionRepository $impressionRepository,
        EntityManagerInterface $manager,
        GameService $gameService
    )
    {
        $this->manager = $manager;
        $this->impressionRepository = $impressionRepository;
        $this->gamerService = $gameService;
    }

    /**
     * @return Impression[]
     */
    public function impressionList()
    {
        $impressions = $this->impressionRepository->findAll();
        if($impressions)
        {
            return $impressions;
        }
        else
        {
            throw new Exception('Impression list not found',404);
        }
    }

    /**
     * @param $idImpression
     * @return Impression[]
     */
    public function getImpression($idImpression)
    {
        $impression = $this->impressionRepository->findBy(["id" => $idImpression]);
        if($impression)
        {
            return $impression;
        }
        else
        {
            throw new Exception('Impression not found', 404);
        }
    }

    /**
     * @param ImpressionForm $impressionNewForm
     * @return Impression[]
     * @throws \Exception
     */
    public function impressionNew(ImpressionForm $impressionNewForm)
    {
        $date = new \DateTime();
        $game = $this->gamerService->gameId($impressionNewForm->getIdGame());
        $impression = new Impression();
        $impression
            ->setGame($game)
            ->setDescription($impressionNewForm->getDescription())
            ->setHowEnd($impressionNewForm->getHowEnd())
            ->setDateImpression($date)
            ->setTauxDeCompletion($impressionNewForm->getTauxDeCompletion());
        try {
            $this->manager->persist($impression);
            $this->manager->flush();
            return $this->impressionList();
        }
        catch (\PDOException $exception)
        {
            throw new Exception('Unexpected Error',500);
        }
    }

    /**
     * @param ImpressionForm $impressionForm
     * @param $idImpression
     * @return Impression[]
     * @throws \Exception
     */
    public function impressionEdit(ImpressionForm $impressionForm,$idImpression)
    {
        $date = new \DateTime();
        $impression = $this->impressionRepository->find($idImpression);
        $impression
            ->setDescription($impressionForm->getDescription())
            ->setHowEnd($impressionForm->getHowEnd())
            ->setTauxDeCompletion($impressionForm->getTauxDeCompletion())
            ->setDateImpression($date);
        try {
            $this->manager->flush();
            return $this->impressionList();
        }
        catch (\PDOException $exception)
        {
            throw new Exception('Unexpected Error',500);
        }
    }
}