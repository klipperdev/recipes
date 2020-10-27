<?php

namespace App\Repository;

use App\Entity\RepairHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|RepairHistory find($id, $lockMode = null, $lockVersion = null)
 * @method null|RepairHistory findOneBy(array $criteria, array $orderBy = null)
 * @method RepairHistory[]    findAll()
 * @method RepairHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepairHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RepairHistory::class);
    }
}
