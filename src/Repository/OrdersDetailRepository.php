<?php

namespace App\Repository;

use App\Entity\OrdersDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrdersDetail>
 *
 * @method OrdersDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdersDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdersDetail[]    findAll()
 * @method OrdersDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdersDetail::class);
    }

    public function add(OrdersDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OrdersDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return OrdersDetail[] Returns an array of OrdersDetail objects
    */
   public function findByOrdersDetail($value): array
   {
        $entity = $this->getEntityManager();
       return $entity->createQuery('
       SELECT od.id, od.proQuantity, od.price, od.total, p.name, o.id as orderId FROM
       App\Entity\OrdersDetail od,
       App\Entity\Product p,
       App\Entity\Orders o WHERE o.id = od.orderId AND od.productId = p.id AND od.orderId = :id
       ')->setParameter('id', $value)
           
           ->getResult()
       ;
   }
//    /**
//     * @return OrdersDetail[] Returns an array of OrdersDetail objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrdersDetail
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
