<?php


namespace App\Services;


use App\Entity\Genre;
use App\Models\Forms\GenreNewForm;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class GenreService
{
    /**
     * @var GenreRepository $genreRepository
     */
    private $genreRepository;

    /**
     * @var EntityManagerInterface $manager
     */
    private $manager;

    /**
     * GenreService constructor.
     * @param GenreRepository $genreRepository
     * @param EntityManagerInterface $manager
     */
    public function __construct(
        GenreRepository $genreRepository,
        EntityManagerInterface $manager)
    {
        $this->genreRepository = $genreRepository;
        $this->manager = $manager;
    }

    /**
     * @return Genre[]
     */
    public function genresList()
    {
        $genres = $this->genreRepository->findAll();
        if($genres)
        {
            return $genres;
        }
        else
        {
            throw new Exception('Genres not found',404);
        }
    }

    /**
     * @param GenreNewForm $genreNewForm
     * @return Genre[]
     * @throws \PDOException
     */
    public function genreNew(GenreNewForm $genreNewForm)
    {
        $genre = new Genre();
        $genre->setLabel($genreNewForm->getLabel());

        try {
            $this->manager->persist($genre);
            $this->manager->flush();
            return $this->genresList();
        }
        catch (\PDOException $exception)
        {
            throw new Exception('Unexpected Error',500);
        }


    }
}
