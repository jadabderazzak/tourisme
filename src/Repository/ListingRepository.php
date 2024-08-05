<?php

namespace App\Repository;

use App\Entity\Listing;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
    private $requestStack;
    public function __construct(ManagerRegistry $registry, RequestStack $requestStack)
    {
        parent::__construct($registry, Listing::class);
        $this->requestStack = $requestStack;
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
            ->setParameter('val', true);
             
            /************* Gestion de la latitude et longitude */
            $dql = $dql
                        ->andWhere('l.latitude  <>  :lat')
                        ->setParameter('lat', "" )
                        ->andWhere('l.longitude  <>  :long')
                        ->setParameter('long', "" );

           
          
            
           
            $list = $dql->getQuery();
            
             return $list->getResult()
        ;

        }
    }

    public function findBySearch($data,$amnitiesData) 
    {

        $locale = $this->requestStack->getCurrentRequest()->getLocale();
       
        $keywords =  array_filter(array_map('trim', explode(',', $data->query)));
        $listings = $this->createQueryBuilder('l')
                        
                        ->addSelect('l','v','c','pr','ps','la','a','t','lt')
                        ->leftJoin('l.listingTags', 'lt') 
                        ->leftJoin('lt.tags', 't')
                        ->leftJoin('l.ville','v')
                        ->leftJoin('l.categorie','c')
                        ->leftJoin('v.province','pr')
                        ->leftJoin('l.listingamnities', 'la') 
                        ->leftJoin('la.amnities', 'a')
                        ->leftJoin('l.pension','ps');
               

                        if (trim($data->query) !== "") {
                            $field = 't.nom';
                            if ($locale === 'ar') {
                                $field = 't.ar';
                            } elseif ($locale === 'en') {
                                $field = 't.en';
                            }
                        
                            // Construire les conditions `LIKE` combinées avec `OR`
                            $orX = $listings->expr()->orX();
                            foreach ($keywords as $index => $keyword) {
                                $orX->add($listings->expr()->like($field, ':param' . $index));
                                $listings->setParameter(':param' . $index, '%' . trim($keyword) . '%');
                            }
                        
                            // Appliquer les conditions
                            if ($orX->count() > 0) {
                                $listings->andWhere($orX);
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
        $locale = $this->requestStack->getCurrentRequest()->getLocale();
   
        $keywords =  array_filter(array_map('trim', explode(',', $amnitiesData->query)));

        $listings = $this->createQueryBuilder('l')
                        
                        ->addSelect('l','v','c','pr','ps','la','a','t','lt')
                        ->leftJoin('l.listingTags', 'lt') 
                        ->leftJoin('lt.tags', 't')
                        ->leftJoin('l.ville','v')
                        ->leftJoin('l.categorie','c')
                        ->leftJoin('v.province','pr')
                        ->leftJoin('l.listingamnities', 'la') 
                        ->leftJoin('la.amnities', 'a')
                        ->leftJoin('l.pension','ps');
               
                        if (trim($amnitiesData->query) !== "") {
                            $field = 't.nom';
                            if ($locale === 'ar') {
                                $field = 't.ar';
                            } elseif ($locale === 'en') {
                                $field = 't.en';
                            }
                        
                            // Construire les conditions `LIKE` combinées avec `OR`
                            $orX = $listings->expr()->orX();
                            foreach ($keywords as $index => $keyword) {
                                $orX->add($listings->expr()->like($field, ':param' . $index));
                                $listings->setParameter(':param' . $index, '%' . trim($keyword) . '%');
                            }
                        
                            // Appliquer les conditions
                            if ($orX->count() > 0) {
                                $listings->andWhere($orX);
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

           // Transformer en un tableau d'IDs
    $amnitiesCollection = $amnitiesData->getAmnities();
    $amnitiesIds = array_map(function($amnity) {
        return $amnity->getId();
    }, $amnitiesCollection->toArray());

    if (count($amnitiesIds) > 0) {
        // Créer une sous-requête avec un alias différent
        $subQueryBuilder = $this->createQueryBuilder('sub_l')
            ->select('sub_l.id')
            ->leftJoin('sub_l.listingamnities', 'sub_la')
            ->leftJoin('sub_la.amnities', 'sub_a')
            ->where('sub_a.id IN (:amnitiesIds)')
            ->groupBy('sub_l.id')
            ->having('COUNT(sub_a.id) = :totalAmnities')
            ->getDQL();
    
        $listings = $listings
            ->andWhere($listings->expr()->in(
                'l.id',
                $subQueryBuilder
            ))
            ->setParameter('amnitiesIds', $amnitiesIds)
            ->setParameter('totalAmnities', count($amnitiesIds));
    }
    

           

            $listings = $listings
                             
                                ->addOrderBy('l.id','ASC')
                                 ->addOrderBy('l.createdAt','DESC')
                                
                                ;
       
            return $listings;

    }


    public function findResulBySearch($query) 
    {
        $listings = $this->createQueryBuilder('l')
            ->addSelect('l', 'v', 'c', 'pr', 'ps','lt','t')
            ->leftJoin('l.ville', 'v')
            ->leftJoin('l.categorie', 'c')
            ->leftJoin('v.province', 'pr')
            ->leftJoin('l.listingTags', 'lt') 
            ->leftJoin('lt.tags', 't')
       
            ->leftJoin('l.pension', 'ps')
            ->andWhere('l.name LIKE :value')
            ->setParameter('value', '%' . $query . '%')
            ->andWhere('l.afficher = :aff')
            ->setParameter('aff', true);
    
      
        $resultsWithLimit = $listings->setMaxResults(6)->getQuery()->getResult();
    
        return $resultsWithLimit;
    }
    
    

    public function findBySearchTags($data,$amnitiesData, ) 
    {

        $locale = $this->requestStack->getCurrentRequest()->getLocale();
       
        $keywords =  array_filter(array_map('trim', explode(',', $data->query)));
       
        $listings = $this->createQueryBuilder('l')
                        
                        ->addSelect('l','v','c','pr','ps','la','a','t','lt')
                    
                        ->leftJoin('l.ville','v')
                        ->leftJoin('l.categorie','c')
                        ->leftJoin('v.province','pr')
                        ->leftJoin('l.listingamnities', 'la') 
                        ->leftJoin('la.amnities', 'a')
                        ->leftJoin('l.listingTags', 'lt') 
                        ->leftJoin('lt.tags', 't')
                        ->leftJoin('l.pension','ps');
               

                        if (trim($data->query) !== "") {
                            $field = 't.nom';
                            if ($locale === 'ar') {
                                $field = 't.ar';
                            } elseif ($locale === 'en') {
                                $field = 't.en';
                            }
                        
                            // Construire les conditions `LIKE` combinées avec `OR`
                            $orX = $listings->expr()->orX();
                            foreach ($keywords as $index => $keyword) {
                                $orX->add($listings->expr()->like($field, ':param' . $index));
                                $listings->setParameter(':param' . $index, '%' . trim($keyword) . '%');
                            }
                        
                            // Appliquer les conditions
                            if ($orX->count() > 0) {
                                $listings->andWhere($orX);
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

    public function getInfoGenerals()
    {
       $dql = $this->createQueryBuilder('p')
            ->select('count(p) as nb_listing, v.nom')
            ->addSelect('p','v','c','pr')
           
            ->innerJoin('p.ville','v')
            ->innerJoin('p.categorie','c')
            ->innerJoin('v.province','pr')
          

          
       
          
            ->groupBy('v.id')
            ->getQuery();
            
             return $dql->getResult()
        ;
    }

    public function getInfoGeneralCategory()
    {
       $dql = $this->createQueryBuilder('p')
            ->select('count(p) as nb_listing, v.nom as ville , c.nom as categorie')
            ->addSelect('p','v','c','pr')
           
            ->innerJoin('p.ville','v')
            ->innerJoin('p.categorie','c')
            ->innerJoin('v.province','pr')
          

          
       
          
            ->groupBy('v.id')
            ->addGroupBy('c.id')
            ->orderBy('v.nom',"ASC")
            ->getQuery();
            
             return $dql->getResult()
        ;
    }

    public function getInfoGeneralsByLocalite($localite)
    {
       $dql = $this->createQueryBuilder('p')
            ->select('count(p) as nb_listing, v.nom')
            ->addSelect('p','v','c','pr')
           
            ->innerJoin('p.ville','v')
            ->innerJoin('p.categorie','c')
            ->innerJoin('v.province','pr')
          
            ->andWhere('p.ville = :val')
            ->setParameter('val', $localite)
          
       
          
            ->groupBy('v.id')
            ->getQuery();
            
             return $dql->getResult()
        ;
    }
   
}
