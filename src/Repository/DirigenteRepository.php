<?php

namespace App\Repository;

use App\Entity\Dirigente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dirigente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dirigente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dirigente[]    findAll()
 * @method Dirigente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DirigenteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dirigente::class);
    }

    // /**
    //  * @return Dirigente[] Returns an array of Dirigente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dirigente
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
