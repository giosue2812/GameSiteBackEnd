<?php


namespace App\Services;


use App\Repository\GenreRepository;
use Symfony\Component\Config\Definition\Exception\Exception;

class GenreService
{
    /**
     * @var GenreRepository $genreRepository
     */
    private $genreRepository;

    /**
     * GenreService constructor.
     * @param GenreRepository $genreRepository
     */
    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

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
}
