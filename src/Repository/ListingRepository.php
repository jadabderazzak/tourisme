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

    public function findBySearch($data,$amnitiesData) 
    {
        
        $keywords = explode(' ', $data->query );
        $listings = $this->createQueryBuilder('l')
                        
                        ->addSelect('l','v','c','pr','ps','la','a')
                    
                        ->leftJoin('l.ville','v')
                        ->leftJoin('l.categorie','c')
                        ->leftJoin('v.province','pr')
                        ->leftJoin('l.listingamnities', 'la') 
                        ->leftJoin('la.amnities', 'a')
                        ->leftJoin('l.pension','ps');
               

            if(trim($data->query) != "")
            {
                
                                     
                    foreach ($keywords as $index => $keyword) {
                    $parameter = 'keyword' . $index;
                
                  
                    $listings = $listings
                        ->andWhere('l.name LIKE  :value')
                        ->setParameter('value', '%' . $keyword . '%');
                }
            }


            if($data->categorie != null)
            {
                $listings = $listings
                                     ->andWhere('l.categorie =  :cat')
                                     ->setParameter('cat', $data->categorie);
                                    
            }
            
            
            if($data->ville != null)
            {
             
                $listings = $listings
                                     ->andWhere('v.id =  :ville')
                                     ->setParameter('ville', $data->ville->getId());
            }

            $listings = $listings
                        ->andWhere('l.afficher =  :aff')
                        ->setParameter('aff', true);
            
            /************* Gestion de la latitude et longitude */
            $listings = $listings
                        ->andWhere('l.latitude  <>  :lat')
                        ->setParameter('lat', "" )
                        ->andWhere('l.longitude  <>  :long')
                        ->setParameter('long', "" );

                    
            if ($amnitiesData->getAmnities() !== null && count($amnitiesData->getAmnities())> 0  ) {               
                 $listings = $listings
                ->andWhere('a IN (:amnities)')
                ->setParameter('amnities', $amnitiesData->getAmnities());
                
            }   

            $listings = $listings
                             
                                ->addOrderBy('l.id','ASC')
                                 ->addOrderBy('l.createdAt','DESC')
                                
                                ;
       
            return $listings;

    }


    public function findByFilter($amnitiesData) 
    {
        
        $keywords = explode(' ', $amnitiesData->query );
        $listings = $this->createQueryBuilder('l')
                        
                        ->addSelect('l','v','c','pr','ps','la','a')
                    
                        ->leftJoin('l.ville','v')
                        ->leftJoin('l.categorie','c')
                        ->leftJoin('v.province','pr')
                        ->leftJoin('l.listingamnities', 'la') 
                        ->leftJoin('la.amnities', 'a')
                        ->leftJoin('l.pension','ps');
               

            if(trim($amnitiesData->query) != "")
            {
                
                                     
                    foreach ($keywords as $index => $keyword) {
                    $parameter = 'keyword' . $index;
                
                  
                    $listings = $listings
                        ->andWhere('l.name LIKE  :value')
                        ->setParameter('value', '%' . $keyword . '%');
                }
            }


            if($amnitiesData->categorie != null)
            {
                $listings = $listings
                                     ->andWhere('l.categorie =  :cat')
                                     ->setParameter('cat', $amnitiesData->categorie);
                                    
            }
            
          
            if($amnitiesData->ville != null)
            {
             
                $listings = $listings
                                     ->andWhere('v.id =  :ville')
                                     ->setParameter('ville', $amnitiesData->ville->getId());
            }

            $listings = $listings
                        ->andWhere('l.afficher =  :aff')
                        ->setParameter('aff', true);
            
            /************* Gestion de la latitude et longitude */
            $listings = $listings
                        ->andWhere('l.latitude  <>  :lat')
                        ->setParameter('lat', "" )
                        ->andWhere('l.longitude  <>  :long')
                        ->setParameter('long', "" );

                    
            if ($amnitiesData->getAmnities() !== null && count($amnitiesData->getAmnities())> 0  ) {               
                 $listings = $listings
                ->andWhere('a IN (:amnities)')
                ->setParameter('amnities', $amnitiesData->getAmnities());
                
            }   

            $listings = $listings
                             
                                ->addOrderBy('l.id','ASC')
                                 ->addOrderBy('l.createdAt','DESC')
                                
                                ;
       
            return $listings;

    }

   
}
