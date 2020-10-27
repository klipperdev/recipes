<?php

namespace App\Repository;

use App\Entity\RepairItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|RepairItem find($id, $lockMode = null, $lockVersion = null)
 * @method null|RepairItem findOneBy(array $criteria, array $orderBy = null)
 * @method RepairItem[]    findAll()
 * @method RepairItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepairItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RepairItem::class);
    }
}
