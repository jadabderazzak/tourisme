<?php

namespace App\Repository;

use App\Entity\Listingamnities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Listingamnities>
 *
 * @method Listingamnities|null find($id, $lockMode = null, $lockVersion = null)
 * @method Listingamnities|null findOneBy(array $criteria, array $orderBy = null)
 * @method Listingamnities[]    findAll()
 * @method Listingamnities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListingamnitiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Listingamnities::class);
    }

//    /**
//     * @return Listingamnities[] Returns an array of Listingamnities objects
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

//    public function findOneBySomeField($value): ?Listingamnities
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
