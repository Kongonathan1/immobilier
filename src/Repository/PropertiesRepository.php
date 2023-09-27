<?php

namespace App\Repository;

use App\Entity\Properties;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

/**
 * @extends ServiceEntityRepository<Properties>
 *
 * @method Properties|null find($id, $lockMode = null, $lockVersion = null)
 * @method Properties|null findOneBy(array $criteria, array $orderBy = null)
 * @method Properties[]    findAll()
 * @method Properties[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Properties::class);
    }

    public function findAllResult(Request $request)
    {
        $query = $this->createQueryBuilder('p')
           ->orderBy('p.id', 'ASC')
           ->andwhere('p.sold = false');

           $minPrice = $request->query->get('minPrice', "");
           $maxPrice = $request->query->get('maxPrice', "");
           $minRooms = $request->query->get('minRooms', "");
           $maxRooms = $request->query->get('maxRooms', "");
           $minSurface = $request->query->get('minSurface', "");
           $maxSurface = $request->query->get('maxSurface', "");

        if($minPrice !== "") {
            $query = $query
                    ->andWhere('p.price >= :minPrice')
                    ->setParameter('minPrice', $minPrice);
        }

        if($maxPrice !== "" ){
            $query = $query
                    ->andWhere('p.price <= :maxPrice')
                    ->setParameter('maxPrice', $maxPrice);
        }

        if($minRooms !== "") {
            $query = $query
                    ->andWhere('p.rooms >= :minRooms')
                    ->setParameter('minRooms', $minRooms);
        }

        if($maxRooms !== "") {
            $query = $query
                    ->andWhere('p.rooms <= :maxRooms')
                    ->setParameter('maxRooms', $maxRooms);
        }
        
        if($minSurface !== "") {
            $query = $query
                    ->andWhere('p.surface >= :minSurface')
                    ->setParameter('minSurface', $minSurface);
        }

        if($maxSurface !== "") {
            $query = $query
                    ->andWhere('p.surface <= :maxSurface')
                    ->setParameter('maxSurface', $maxSurface);
        }

           return $query->getQuery()
       ;
   }

//    public function findOneBySomeField($value): ?Properties
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
