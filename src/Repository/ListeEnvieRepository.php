<?php

namespace App\Repository;

use App\Entity\ListeEnvie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListeEnvie|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeEnvie|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeEnvie[]    findAll()
 * @method ListeEnvie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeEnvieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListeEnvie::class);
    }

    // /**
    //  * @return ListeEnvie[] Returns an array of ListeEnvie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListeEnvie
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
