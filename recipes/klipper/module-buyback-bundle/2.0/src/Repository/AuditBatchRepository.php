<?php

namespace App\Repository;

use App\Entity\AuditBatch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|AuditBatch find($id, $lockMode = null, $lockVersion = null)
 * @method null|AuditBatch findOneBy(array $criteria, array $orderBy = null)
 * @method AuditBatch[]    findAll()
 * @method AuditBatch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuditBatchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuditBatch::class);
    }
}
