<?php

namespace App\Repository;

use App\Entity\RepairBreakdown;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|RepairBreakdown find($id, $lockMode = null, $lockVersion = null)
 * @method null|RepairBreakdown findOneBy(array $criteria, array $orderBy = null)
 * @method RepairBreakdown[]    findAll()
 * @method RepairBreakdown[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepairBreakdownRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RepairBreakdown::class);
    }
}
