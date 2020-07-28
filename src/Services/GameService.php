<?php

namespace App\Services;


use App\Entity\Game;
use App\Models\Forms\GameEditForm;
use App\Repository\EditeurRepository;
use App\Repository\GameRepository;
use App\Repository\GenreRepository;
use App\Repository\PlatformRepository;
use Doctrine\DBAL\Driver\PDOException;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class GameService
{
    /**
     * @var GameRepository $gameRepoistory
     */
    private $gameRepository;
    /**
     * @var PlatformRepository $platformRepository
     */
    private $platformRepository;
    /**
     * @var EditeurRepository $editeurRepository
     */
    private $editeurRepository;
    /**
     * @var GenreRepository $genreRepository
     */
    private $genreRepository;
    /***
     * @var EntityManagerInterface $manager
     */
    private $manager;
    /**
     * @var UploadService $uploadService
     */
    private $uploadService;

    /**
     * GameService constructor.
     * @param GameRepository $gameRepoistory
     * @param EntityManagerInterface $manager
     * @param PlatformRepository $platformRepository
     * @param EditeurRepository $editeurRepository
     * @param GenreRepository $genreRepository
     * @param UploadService $uploadService
     */
    public function __construct(
        GameRepository $gameRepoistory,
        EntityManagerInterface $manager,
        PlatformRepository $platformRepository,
        EditeurRepository $editeurRepository,
        GenreRepository $genreRepository,
        UploadService $uploadService)
    {
        $this->gameRepository = $gameRepoistory;
        $this->platformRepository = $platformRepository;
        $this->editeurRepository = $editeurRepository;
        $this->genreRepository = $genreRepository;
        $this->manager = $manager;
        $this->uploadService = $uploadService;
    }

    /**
     * @return Game[] if array.lenght > 0
     * @throws Exception if array.lenght <= 0
     */
    public function gamesList()
    {
        $games = $this->gameRepository->findAll();
        if($games)
        {
            return $games;
        }
        else
        {
            throw new Exception('Games not found',404);
        }
    }

    /**
     * @param $id
     * @return Game[] if array.lenght > 0
     * @throws Exception if array.lenght <= 0
     */
    public function game($id)
    {
        $game = $this->gameIdArray($id);
        if($game)
        {
            return $game;
        }
        else
        {
            throw new Exception('No found game',404);
        }
    }
    /**
     * @param GameEditForm $gameEditForm
     * @param $id_game
     * @return Game[] if array.lenght > 0 and if idEditeur and idGenre and idPlatform != null
     * @throws Exception if array.lenght <= 0 or PDOException is rise or if idEditeur and idGenre and idPlatform == null
     */
    public function gameEdit(GameEditForm $gameEditForm,$id_game)
    {
        $game = $this->gameId($id_game);
        if($game)
        {
            $idPlatform = $this->platformRepository->find($gameEditForm->getIdPlatform());
            $idEditeur = $this->editeurRepository->find($gameEditForm->getIdEditeur());
            $idGenre = $this->genreRepository->find($gameEditForm->getIdGenre());
            if($idEditeur && $idGenre && $idPlatform) {
                $game
                    ->setNom($gameEditForm->getNom())
                    ->setDescription($gameEditForm->getDescription())
                    ->setVideo($gameEditForm->getVideo())
                    ->setGenre($idGenre)
                    ->setEditeur($idEditeur)
                    ->setPlatform($idPlatform);
                try {
                    $this->manager->flush();
                    return $this->gameIdArray($game->getId());
                } catch (PDOException $exception) {
                    throw new Exception('Unexpected Error', 500);
                }
            }
            else
            {
                throw new Exception('Not found Editeur or Genre Platform',404);
            }
        }
        else
        {
            throw new Exception('No found Game',404);
        }
    }

    /**
     * @param $image
     * @param $gameId
     * @return Game[] if array.lenght > 0 and if $game != null and $imageName != null
     * @throws Exception if array.lenght <= 0 or if $game == null and $imageName == null or PDOException is rise
     */
    public function upload($gameId,$image)
    {
        $game = $this->gameId($gameId);
        if($game)
        {
            $imageName = $this->uploadService->upload($image);
            if($imageName)
            {
                $game->setImage("http://localhost:8080/Formation/GamesSite/BackEnd/public/Images/".$imageName);
                try {
                    $this->manager->flush();
                    return $this->gameIdArray($gameId);
                }
                catch (PDOException $exception)
                {
                    throw new Exception('Unexpected error',500);
                }
            }
            else
            {
                throw new Exception('No file to upload',404);
            }
        }
        else
        {
            throw new Exception('Not found game',404);
        }
    }

    /**
     * @param $id
     * @return Game[]|null
     */
    private function gameIdArray($id)
    {
        return $this->gameRepository->findBy(['id'=>$id]);
    }

    /**
     * @param $id
     * @return Game|null
     */
    private function gameId($id)
    {
        return $this->gameRepository->find($id);
    }
}
