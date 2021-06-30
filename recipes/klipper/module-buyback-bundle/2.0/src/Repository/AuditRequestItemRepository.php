<?php

namespace App\Repository;

use App\Entity\AuditRequestItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|AuditRequestItem find($id, $lockMode = null, $lockVersion = null)
 * @method null|AuditRequestItem findOneBy(array $criteria, array $orderBy = null)
 * @method AuditRequestItem[]    findAll()
 * @method AuditRequestItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuditRequestItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuditRequestItem::class);
    }
}
