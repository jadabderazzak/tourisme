<?php

namespace App\Repository;

use App\Entity\Amnities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Amnities>
 *
 * @method Amnities|null find($id, $lockMode = null, $lockVersion = null)
 * @method Amnities|null findOneBy(array $criteria, array $orderBy = null)
 * @method Amnities[]    findAll()
 * @method Amnities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AmnitiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Amnities::class);
    }

//    /**
//     * @return Amnities[] Returns an array of Amnities objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Amnities
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
