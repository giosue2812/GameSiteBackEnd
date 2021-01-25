<?php


namespace App\Services;


use App\Entity\Video;
use App\Repository\VideoRepository;
use Exception;
use Doctrine\ORM\EntityManagerInterface;

class VideoService
{
    /**
     * @var VideoRepository $videoRepository
     */
    private $videoRepository;
    /**
     * @var EntityManagerInterface $manager
     */
    private $manager;

    /**
     * VideoService constructor.
     * @param VideoRepository $videoRepository
     * @param EntityManagerInterface $manager
     */
    public function __construct(
        VideoRepository $videoRepository,
        EntityManagerInterface $manager
    )
    {
        $this->videoRepository = $videoRepository;
        $this->manager = $manager;
    }

    /**
     * @param $id
     * @return Video|null
     * @throws Exception
     */
    public function deleteVideo($id)
    {
        $video = $this->videoRepository->find($id);

        try {
            $this->manager->remove($video);
            $this->manager->flush();
            return $video;
        }
        catch (\PDOException $exception)
        {
            throw new Exception('Not found video',404);
        }
    }
}