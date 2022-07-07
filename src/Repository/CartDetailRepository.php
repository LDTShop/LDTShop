<?php

namespace App\Repository;

use App\Entity\CartDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CartDetail>
 *
 * @method CartDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartDetail[]    findAll()
 * @method CartDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartDetail::class);
    }

    public function add(CartDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CartDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     * @return CartDetail[] Returns an array of OrdersDetail objects
     */
    public function checkQuantity($proId, $cartId): array
    {
        return $this->createQueryBuilder('c')
            ->select('Count(c.id) as count, c.quantity as quantity, c.id as id')
            ->innerJoin('c.product', 'p')
            ->innerJoin('c.cart', 'ca')
            ->andWhere('p.id = :proId')
            ->setParameter('proId', $proId)
            ->andWhere('ca.id = :cartId')
            ->setParameter('cartId', $cartId)
            ->getQuery()
            ->getResult();
    }



//    /**
//     * @return CartDetail[] Returns an array of CartDetail objects
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

//    public function findOneBySomeField($value): ?CartDetail
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
