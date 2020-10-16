<?php

namespace App\Repository;

use App\Entity\ProductSupplier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|ProductSupplier find($id, $lockMode = null, $lockVersion = null)
 * @method null|ProductSupplier findOneBy(array $criteria, array $orderBy = null)
 * @method ProductSupplier[]    findAll()
 * @method ProductSupplier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductSupplierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductSupplier::class);
    }
}
