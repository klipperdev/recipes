<?php

namespace App\Repository;

use App\Entity\AuditBatchRequestItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|AuditBatchRequestItem find($id, $lockMode = null, $lockVersion = null)
 * @method null|AuditBatchRequestItem findOneBy(array $criteria, array $orderBy = null)
 * @method AuditBatchRequestItem[]    findAll()
 * @method AuditBatchRequestItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuditBatchRequestItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuditBatchRequestItem::class);
    }
}
