<?php

namespace App\Repository;

use App\Entity\UniversityGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UniversityGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method UniversityGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method UniversityGroup[]    findAll()
 * @method UniversityGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UniversityGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UniversityGroup::class);
    }

    // /**
    //  * @return UniversityGroup[] Returns an array of UniversityGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UniversityGroup
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
