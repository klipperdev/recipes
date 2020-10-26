<?php

namespace App\Repository;

use App\Entity\Shipping;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|Shipping find($id, $lockMode = null, $lockVersion = null)
 * @method null|Shipping findOneBy(array $criteria, array $orderBy = null)
 * @method Shipping[]    findAll()
 * @method Shipping[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShippingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shipping::class);
    }
}
