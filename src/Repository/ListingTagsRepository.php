<?php

namespace App\Repository;

use App\Entity\ListingTags;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListingTags>
 *
 * @method ListingTags|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListingTags|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListingTags[]    findAll()
 * @method ListingTags[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListingTagsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListingTags::class);
    }

//    /**
//     * @return ListingTags[] Returns an array of ListingTags objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ListingTags
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
