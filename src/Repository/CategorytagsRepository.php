<?php

namespace App\Repository;

use App\Entity\Categorytags;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Categorytags>
 *
 * @method Categorytags|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorytags|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorytags[]    findAll()
 * @method Categorytags[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorytagsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorytags::class);
    }

//    /**
//     * @return Categorytags[] Returns an array of Categorytags objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Categorytags
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
