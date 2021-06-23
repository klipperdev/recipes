<?php

namespace App\Repository;

use App\Entity\AuditWorkflowStep;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|AuditWorkflowStep find($id, $lockMode = null, $lockVersion = null)
 * @method null|AuditWorkflowStep findOneBy(array $criteria, array $orderBy = null)
 * @method AuditWorkflowStep[]    findAll()
 * @method AuditWorkflowStep[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuditWorkflowStepRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuditWorkflowStep::class);
    }
}
