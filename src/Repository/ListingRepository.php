<?php

namespace App\Repository;

use App\Entity\Listing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Listing>
 *
 * @method Listing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Listing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Listing[]    findAll()
 * @method Listing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Listing::class);
    }

    public function getAll()
    {
       $dql = $this->createQueryBuilder('l')
           
            ->addSelect('l','v','c','pr')
           
            ->leftJoin('l.ville','v')
            ->leftJoin('l.categorie','c')
            ->leftJoin('v.province','pr')
            ->leftJoin('l.pension','ps')
          

          
       
          
           
            ->getQuery();
            
             return $dql->getResult()
        ;
    }

    public function getActiveListings(int $nombre)
    {

        if($nombre != 0 )
        {
       $dql = $this->createQueryBuilder('l')
           
            ->addSelect('l','v','c','pr')
           
            ->leftJoin('l.ville','v')
            ->leftJoin('l.categorie','c')
            ->leftJoin('v.province','pr')
            ->leftJoin('l.pension','ps')
          

            ->andWhere('l.afficher = :val')
            ->setParameter('val', true)
            ->setMaxResults($nombre)
          
            
           
            ->getQuery();
            
             return $dql->getResult()
        ;
        }else{
            $dql = $this->createQueryBuilder('l')
           
            ->addSelect('l','v','c','pr')
           
            ->leftJoin('l.ville','v')
            ->leftJoin('l.categorie','c')
            ->leftJoin('v.province','pr')
            ->leftJoin('l.pension','ps')
          

            ->andWhere('l.afficher = :val')
            ->setParameter('val', true)
           
          
            
           
            ->getQuery();
            
             return $dql->getResult()
        ;

        }
    }

//    public function findOneBySomeField($value): ?Listing
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
