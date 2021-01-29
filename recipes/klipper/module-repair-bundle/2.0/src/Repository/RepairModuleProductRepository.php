<?php

namespace App\Repository;

use App\Entity\RepairModuleProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|RepairModuleProduct find($id, $lockMode = null, $lockVersion = null)
 * @method null|RepairModuleProduct findOneBy(array $criteria, array $orderBy = null)
 * @method RepairModuleProduct[]    findAll()
 * @method RepairModuleProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepairModuleProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RepairModuleProduct::class);
    }
}
