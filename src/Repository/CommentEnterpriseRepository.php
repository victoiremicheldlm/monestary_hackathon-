<?php

namespace App\Repository;

use App\Entity\CommentEnterprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommentEnterprise>
 *
 * @method CommentEnterprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentEnterprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentEnterprise[]    findAll()
 * @method CommentEnterprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentEnterpriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentEnterprise::class);
    }

    public function add(CommentEnterprise $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CommentEnterprise $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CommentEnterprise[] Returns an array of CommentEnterprise objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CommentEnterprise
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
