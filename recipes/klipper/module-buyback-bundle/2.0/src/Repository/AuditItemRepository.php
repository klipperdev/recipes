<?php

namespace App\Repository;

use App\Entity\AuditItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|AuditItem find($id, $lockMode = null, $lockVersion = null)
 * @method null|AuditItem findOneBy(array $criteria, array $orderBy = null)
 * @method AuditItem[]    findAll()
 * @method AuditItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuditItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuditItem::class);
    }
}
