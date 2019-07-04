<?php

namespace App\Repository;

use App\Entity\Coordinador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Coordinador|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coordinador|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coordinador[]    findAll()
 * @method Coordinador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoordinadorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Coordinador::class);
    }

    // /**
    //  * @return Coordinador[] Returns an array of Coordinador objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Coordinador
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
