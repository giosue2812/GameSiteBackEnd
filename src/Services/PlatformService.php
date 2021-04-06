<?php


namespace App\Services;


use App\Entity\Platform;
use App\Models\Forms\PlatformNewForm;
use App\Repository\PlatformRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class PlatformService
{
    /**
     * @var PlatformRepository $platformRepository
     */
    private $platformRepository;
    /**
     * @var EntityManagerInterface $manger
     */
    private $manger;

    /**
     * PlatformService constructor.
     * @param PlatformRepository $platformRepository
     * @param EntityManagerInterface $manager
     */
    public function __construct(PlatformRepository $platformRepository,EntityManagerInterface $manager)
    {
        $this->manger = $manager;
        $this->platformRepository = $platformRepository;
    }

    /**
     * @return Platform[] if array.lenght > 0
     * @throws Exception if array.lenght <= 0
     */
    public function platformList()
    {
        $platforms = $this->platformRepository->findAll();
        if($platforms)
        {
            return $platforms;
        }
        else
        {
            throw new Exception('Platform not found',404);
        }
    }

    /**
     * @param PlatformNewForm $platformNewForm
     * @return Platform[]
     * @throws \PDOException
     */
    public function platformNew(PlatformNewForm $platformNewForm)
    {
        $platform = new Platform();
        $platform->setLabel($platformNewForm->getLabel());

        try {
            $this->manger->persist($platform);
            $this->manger->flush();
            return $this->platformList();
        }
        catch (\PDOException $exception)
        {
            throw new Exception('Unexpected Error',500);
        }
    }
}
