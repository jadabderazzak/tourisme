<?php

namespace App\Repository;

use App\Entity\TypePension;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypePension>
 *
 * @method TypePension|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePension|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePension[]    findAll()
 * @method TypePension[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePensionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypePension::class);
    }

//    /**
//     * @return TypePension[] Returns an array of TypePension objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypePension
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
