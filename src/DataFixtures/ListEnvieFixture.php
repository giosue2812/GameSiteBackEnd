<?php


namespace App\DataFixtures;


use App\Entity\Editeur;
use App\Entity\Game;
use App\Entity\Genre;
use App\Entity\ListeEnvie;
use App\Entity\Platform;
use Cassandra\Date;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ListEnvieFixture extends Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {

        $platform = new Platform();
        $platform->setLabel('PS4');
        $listeEnvie = new ListeEnvie();
        $listeEnvie
            ->setLabel('Liste 1');
        $genre = new Genre();
        $genre
            ->setLabel('Aventure');
        $editeur = new Editeur();
        $editeur
            ->setLabel('Sucker Punch')
            ->setDescription('We’ve been making well-crafted games for 20 years. We focus on one title and one platform at a time so that we can pour our very best into the experiences. We all have our favorites, but we hope you can feel how much we enjoyed making them.');
        $game = new Game();
        $game
            ->setNom('Ghost of Tsushima')
            ->setDescription('Ghost of Tsushima sur PS4 est un jeu d\'action qui prend place au Japon dans lequel les développeurs ont mis les détails au centre du jeu afin qu\'il respecte l\'Histoire du pays. Le monde étant totalement ouvert, le joueur pourra s\'y balader afin de découvrir ce pays d\'antan')
            ->setPrix(59.99)
            ->setGenre($genre)
            ->setEditeur($editeur)
            ->setImage('C:\xampp\htdocs\Formation\GamesSite\BackEnd\GameBackEnd\public\Images\ghostOfTs.jpg')
            ->setVideo(['https://www.youtube.com/watch?v=1OdLtewxqng','https://www.youtube.com/watch?v=uTyMV2LR8xY'])
            ->setListeEnvie($listeEnvie)
            ->setPlatform($platform);

        $manager->persist($platform);
        $manager->persist($listeEnvie);
        $manager->persist($genre);
        $manager->persist($editeur);
        $manager->persist($game);

        $manager->flush();
    }
}
