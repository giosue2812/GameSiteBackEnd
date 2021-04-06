<?php

namespace App\Services;

use App\Entity\Game;
use App\Entity\Video;
use App\Models\Forms\GameEditForm;
use App\Models\Forms\GameNewForm;
use App\Repository\EditeurRepository;
use App\Repository\GameRepository;
use App\Repository\GenreRepository;
use App\Repository\PlatformRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Validator\Constraints\DateTime;

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
     * @var Video $videoRepository
     */
    private $videoRepository;

    /**
     * GameService constructor.
     * @param GameRepository $gameRepoistory
     * @param EntityManagerInterface $manager
     * @param PlatformRepository $platformRepository
     * @param EditeurRepository $editeurRepository
     * @param GenreRepository $genreRepository
     * @param UploadService $uploadService
     * @param VideoRepository $videoRepository
     */
    public function __construct(
        GameRepository $gameRepoistory,
        EntityManagerInterface $manager,
        PlatformRepository $platformRepository,
        EditeurRepository $editeurRepository,
        GenreRepository $genreRepository,
        UploadService $uploadService,
        VideoRepository $videoRepository)
    {
        $this->gameRepository = $gameRepoistory;
        $this->platformRepository = $platformRepository;
        $this->editeurRepository = $editeurRepository;
        $this->genreRepository = $genreRepository;
        $this->manager = $manager;
        $this->uploadService = $uploadService;
        $this->videoRepository = $videoRepository;
    }

    /**
     * @return Game[] if array.lenght > 0
     * @throws Exception if array.lenght <= 0
     */ 
    public function gamesList()
    {
        $games = $this->gameRepository->findBy(['isBuy' => true]);
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
     * @return Game[] If array.lenght > 0
     * @throws Exception If array.lenght <= 0
     */
    public function listEnvie()
    {
        $listEnvies = $this->gameRepository->findBy(['isBuy' => false]);
        if($listEnvies)
        {
            return $listEnvies;
        }
        else
        {
            throw new Exception('List envien not found',404);
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
            $idPlatform = $this->platformRepository->findOneBy(['label' => $gameEditForm->getPlatform()]);
            $idEditeur = $this->editeurRepository->findOneBy(['label' => $gameEditForm->getEditeur()]);
            $idGenre = $this->genreRepository->findOneBy(['label' => $gameEditForm->getGenre()]);
            if($idGenre && $idEditeur && $idPlatform) {
                $game
                    ->setNom($gameEditForm->getNom())
                    ->setDescription($gameEditForm->getDescription())
                    ->setPrix($gameEditForm->getPrix())
                    ->setDateSortie($gameEditForm->getDateSortie())
                    ->setDateAchat($gameEditForm->getDateAchat())
                    ->setGenre($idGenre)
                    ->setEditeur($idEditeur)
                    ->setPlatform($idPlatform);
                if($gameEditForm->getVideo()) {
                    $video = new Video();
                    $video->setGame($game);
                    $video->setVideo($gameEditForm->getVideo());
                    try {
                        $this->manager->persist($video);
                    }
                    catch (\PDOException $exception)
                    {
                        throw new Exception('Unexpected Error',500);
                    }
                }
                try {
                    $this->manager->flush();
                    return $this->gameIdArray($game->getId());
                } catch (\PDOException $exception) {
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
            if($game->getImage())
            {
                $this->uploadService->removeFile($game->getImage());
            }
            $imageName = $this->uploadService->upload($image);
            if($imageName)
            {
                $game->setImage("http://localhost:8080/GamesSite/BackEnd/public/Images/".$imageName);
                try {
                    $this->manager->flush();
                    return $this->gameIdArray($gameId);
                }
                catch (\PDOException $exception)
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
     * @param GameNewForm $gameNewForm
     * @return array
     * @throws Exception
     */
    public function gameNew(GameNewForm $gameNewForm)
    {
        $editeurId = $this->editeurRepository->findOneBy(["label" => $gameNewForm->getEditeur()]);
        $genreId = $this->genreRepository->findOneBy(["label" => $gameNewForm->getGenre()]);
        $platformId = $this->platformRepository->findOneBy(["label" => $gameNewForm->getPlatform()]);
        $game = new Game();
        $game
            ->setNom($gameNewForm->getNom())
            ->setDescription($gameNewForm->getDescription())
            ->setPrix($gameNewForm->getPrix())
            ->setDateAchat($gameNewForm->getDateAchat())
            ->setDateSortie($gameNewForm->getDateSortie())
            ->setEditeur($editeurId)
            ->setGenre($genreId)
            ->setPlatform($platformId);
        if($gameNewForm->getDateAchat())
        {
            $game->setIsBuy(true);
        }
        else
        {
            $game->setIsBuy(false);
        }
        try{
            $this->manager->persist($game);
            $this->manager->flush();
            return $this->gamesList();
        }catch (\PDOException $exception){
            throw new Exception('Unexpected Error',500);
        }
    }

    /**
     * @param $id
     * @return string|null
     * @throws Exception
     */
    public function gameDelete($id)
    {
        $game = $this->gameId($id);
        if($game)
        {
            try {
                $this->manager->remove($game);
                $this->manager->flush();
                return $this->gamesList();

            }
            catch (\PDOException $exception)
            {
                throw new Exception('Unexpected Error',500);
            }
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
    public function gameId($id)
    {
        return $this->gameRepository->find($id);
    }
}
