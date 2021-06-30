<?php

namespace App\Repository;

use App\Entity\AuditRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|AuditRequest find($id, $lockMode = null, $lockVersion = null)
 * @method null|AuditRequest findOneBy(array $criteria, array $orderBy = null)
 * @method AuditRequest[]    findAll()
 * @method AuditRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuditRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuditRequest::class);
    }
}
