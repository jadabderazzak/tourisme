<?php

namespace App\Repository;

use App\Entity\Video;
use App\Entity\Categorie;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Video>
 *
 * @method Video|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video[]    findAll()
 * @method Video[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Video::class);
    }

 public function getVideos(int $nombre)
    {

        if($nombre != 0 )
        {
       $dql = $this->createQueryBuilder('v')
           
            ->addSelect('v','c')
            ->leftJoin('v.categorie','c')
           
            ->setMaxResults($nombre)
          
            
           
            ;
            
             return $dql
        ;
        }else{
            $dql = $this->createQueryBuilder('v')
           
            ->addSelect('v','c')
            ->leftJoin('v.categorie','c')
           
          
           
          
            
           
            ;
            
             return $dql
        ;

        }
    }

    public function getVideosByCategorie(Categorie $categorie)
    {

    
       $dql = $this->createQueryBuilder('v')
           
            ->addSelect('v','c')
            ->leftJoin('v.categorie','c')
            ->andWhere('v.categorie = :cat')
            ->setParameter('cat', $categorie)
            
            
           
            ;
            
             return $dql
        ;
        
    }

    public function getVideosSearch(String $query)
    {

    
       $dql = $this->createQueryBuilder('v')
           
            ->addSelect('v','c')
            ->leftJoin('v.categorie','c')
            ->andWhere('v.titre like :val')
            ->setParameter('val', '%' . $query . '%')
            
            
           
            ;
            
             return $dql
        ;
        
    }

//    public function findOneBySomeField($value): ?Video
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
