<?php

namespace App\Repository;

use App\Entity\Coupon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|Coupon find($id, $lockMode = null, $lockVersion = null)
 * @method null|Coupon findOneBy(array $criteria, array $orderBy = null)
 * @method Coupon[]    findAll()
 * @method Coupon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CouponRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coupon::class);
    }

    public function createQueryBuilderForList($alias, $indexBy = null): QueryBuilder
    {
        return $this->createQueryBuilder($alias, $indexBy)
            ->addSelect('a')
            ->addSelect('cs')
            ->addSelect('iAddr')
            ->addSelect('sAddr')
            ->leftJoin($alias.'.account', 'a')
            ->leftJoin($alias.'.status', 'cs')
            ->leftJoin($alias.'.invoiceAddress', 'iAddr')
            ->leftJoin($alias.'.shippingAddress', 'sAddr')
        ;
    }
}
