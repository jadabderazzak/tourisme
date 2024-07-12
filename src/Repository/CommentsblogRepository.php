<?php

namespace App\Repository;

use App\Entity\Commentsblog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commentsblog>
 *
 * @method Commentsblog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentsblog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentsblog[]    findAll()
 * @method Commentsblog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentsblogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentsblog::class);
    }

//    /**
//     * @return Commentsblog[] Returns an array of Commentsblog objects
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

//    public function findOneBySomeField($value): ?Commentsblog
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
