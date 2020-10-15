<?php

namespace App\Repository;

use App\Entity\ProductRange;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|ProductRange find($id, $lockMode = null, $lockVersion = null)
 * @method null|ProductRange findOneBy(array $criteria, array $orderBy = null)
 * @method ProductRange[]    findAll()
 * @method ProductRange[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRangeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductRange::class);
    }
}
