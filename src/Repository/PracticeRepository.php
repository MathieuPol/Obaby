<?php

namespace App\Repository;

use App\Entity\Practice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Practice>
 *
 * @method Practice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Practice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Practice[]    findAll()
 * @method Practice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PracticeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Practice::class);
    }

    public function add(Practice $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Practice $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    /**
     * Custom query return active practices by category id
     * @param int $categoryId
     */
    public function selectActivatedPractices($categoryId): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.status = 1')
            ->andWhere('p.category = :category')
            ->setParameter('category', $categoryId)
            ->orderBy('p.id', 'Desc')
            ->getQuery()
            ->getResult();
    }


    /**
     * Custom query return active practices
     * 
     */
    public function selectActivatedPracticesHomepage(): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.status = 1')
            ->orderBy('p.id', 'Desc')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Practice[] Returns an array of Practice objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Practice
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
