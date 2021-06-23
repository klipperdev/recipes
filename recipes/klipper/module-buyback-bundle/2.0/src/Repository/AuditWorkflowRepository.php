<?php

namespace App\Repository;

use App\Entity\AuditWorkflow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|AuditWorkflow find($id, $lockMode = null, $lockVersion = null)
 * @method null|AuditWorkflow findOneBy(array $criteria, array $orderBy = null)
 * @method AuditWorkflow[]    findAll()
 * @method AuditWorkflow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuditWorkflowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuditWorkflow::class);
    }
}
