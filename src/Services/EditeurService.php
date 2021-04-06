<?php


namespace App\Services;


use App\Entity\Editeur;
use App\Models\Forms\EditeurNewForm;
use App\Repository\EditeurRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Runner\Exception;

class EditeurService
{
    /**
     * @var EditeurRepository $editeurRepository
     */
    private $editeurRepository;
    /**
     * @var EntityManagerInterface $manager
     */
    private $manager;

    public function __construct(EditeurRepository $editeurRepository,EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        $this->editeurRepository = $editeurRepository;
    }

    /**
     * @return Editeur[] if array.lenght > 0
     * @throws Exception if array.lenght <= 0
     */
    public function editeurList()
    {
        $editeurs = $this->editeurRepository->findAll();
        if($editeurs)
        {
            return $editeurs;
        }
        else
        {
            throw new Exception('Editeur not found',404);
        }
    }

    /**
     * @param EditeurNewForm $editeurNewForm
     * @return Editeur[]
     * @throws \PDOException
     */
    public function editeurNew(EditeurNewForm $editeurNewForm)
    {
        $editeur = new Editeur();
        $editeur
            ->setLabel($editeurNewForm->getLabel())
            ->setDescription($editeurNewForm->getDescription());

        try {
            $this->manager->persist($editeur);
            $this->manager->flush();
            return $this->editeurList();
        }
        catch (\PDOException $exception)
        {
            throw new Exception('Unexpected Error',500);
        }
    }
}
