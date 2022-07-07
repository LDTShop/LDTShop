<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function add(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
    * @return Product[] Returns an array of Product objects
    */
   public function findBySearchProduct($product)
   {
       return $this->createQueryBuilder('p')
           ->select('p.id, p.name, p.price, p.image')
           ->where('p.name LIKE :productName')
           ->setParameter('productName', "%${product}%")
           ->andWhere('p.status = 1')
           ->getQuery()
           ->getResult()
       ;
   }

   public function findByNewProduct()
   {
    //SELECT * FROM `product` WHERE DATEDIFF(CURRENT_DATE(), date) <15;
        $entity = $this->getEntityManager();
       return $entity->createQuery('SELECT p.id, p.name, p.price, p.image
        FROM App\Entity\Product p WHERE (CURRENT_DATE() -  p.date) < 15')
           ->getResult()
       ;
   }

   public function findByCartUser($user): array
   {
       // SELECT * FROM product 
       // INNER JOIN cart_detail on product.id = cart_detail.id 
       // INNER JOIN cart on cart_detail.cart_id=cart.id
       // INNER JOIN customer on customer.id = cart.username_id
       // WHERE customer.username = 'vana'
       $entity = $this->getEntityManager();
       return $entity->createQuery('
       SELECT p.id, p.name, p.price, p.image, cus.username, cd.quantity FROM App\Entity\Product p
,App\Entity\CartDetail cd
,App\Entity\Cart c
,App\Entity\Customer cus where cus.id = c.username AND p.id = cd.product AND cd.cart = c.id AND
cus.username = :user
       ')->setParameter('user', "$user")
       ->getResult()
       ;
   }

//    /**
//     * @return Product[] Returns an array of Product objects
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

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
