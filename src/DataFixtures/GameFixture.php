<?php

namespace App\DataFixtures;

use App\Entity\Editeur;
use App\Entity\Game;
use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GameFixture extends Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $date = new \DateTime();
        $genre = new Genre();
        $genre
            ->setLabel('Adventure');
        $editeur = new Editeur();
        $editeur
            ->setLabel('Naughty Dog')
            ->setDescription('Established in 1984, Naughty Dog is one of the most successful and prolific game development studios in the world and a flagship first-party studio within PlayStation’s Worldwide Studios group. From creating the iconic Crash Bandicoot and Jak and Daxter series to modern franchises like Uncharted and The Last of Us, Naughty Dog is responsible for some of the most critically acclaimed and commercially successful games on Sony’s PlayStation platforms. Through its use of cutting-edge technology and evocative, character-driven storytelling, Naughty Dog has received hundreds of industry and media awards, while developing a passionate fan base of millions of players around the globe.');
        $game = new Game();
        $game
            ->setNom('The last of us part2')
            ->setDescription('Au centre de l\'intrigue du premier volet, nous retrouvons à nouveau Joel et Ellie plus déterminée que jamais à éradiquer les infectés jusqu\'au dernier. Se déroulant à nouveau dans un monde post apocalyptique, le duo toujours aussi soudé devra prendre les décisions qui s\'imposent afin de survivre un seul jour de plus à cette pandémie.')
            ->setDateAchat($date->setDate(2020,06,25))
            ->setImage('test')
            ->setPrix(64.99)
            ->setEditeur($editeur)
            ->setGenre($genre);

        $manager->persist($genre);
        $manager->persist($editeur);
        $manager->persist($game);

        $manager->flush();
    }
}
