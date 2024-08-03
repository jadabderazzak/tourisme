<?php

namespace App\Repository;

use App\Entity\Tags;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Tags>
 *
 * @method Tags|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tags|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tags[]    findAll()
 * @method Tags[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagsRepository extends ServiceEntityRepository
{
    private $requestStack;
    public function __construct(ManagerRegistry $registry,RequestStack $requestStack)
    {
        parent::__construct($registry, Tags::class);
        $this->requestStack = $requestStack;
    }

   /**
    * @return Tags[] Returns an array of Tags objects
    */
   public function findResulByTags($query): array
   {

    $locale = $this->requestStack->getCurrentRequest()->getLocale();

        
    $field = 't.nom'; 
    if ($locale === 'ar') {
        $field = 't.ar';
    } elseif ($locale === 'en') {
        $field = 't.en';
    }
    
    

   $tags =  $this->createQueryBuilder('t')
        ->andWhere($field . ' LIKE :param' )
        ->setParameter('param', '%' . $query . '%')
     
        ->orderBy('t.id', 'ASC');

        $resultsWithLimit = $tags->setMaxResults(6)->getQuery()->getResult();
        return $resultsWithLimit;
    
    
   }

//    public function findOneBySomeField($value): ?Tags
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
