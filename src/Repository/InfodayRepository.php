<?php

namespace App\Repository;

use App\Entity\Infoday;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Infoday>
 *
 * @method Infoday|null find($id, $lockMode = null, $lockVersion = null)
 * @method Infoday|null findOneBy(array $criteria, array $orderBy = null)
 * @method Infoday[]    findAll()
 * @method Infoday[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfodayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Infoday::class);
    }

//    /**
//     * @return Infoday[] Returns an array of Infoday objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Infoday
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
