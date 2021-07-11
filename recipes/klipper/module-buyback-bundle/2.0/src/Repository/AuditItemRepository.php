<?php

namespace App\Repository;

use App\Entity\AuditItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
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

    public function createQueryBuilder($alias, $indexBy = null): QueryBuilder
    {
        return parent::createQueryBuilder($alias, $indexBy)
            ->addSelect('ar')
            ->addSelect('p')
            ->addSelect('pc')
            ->addSelect('pb')
            ->addSelect('d')
            ->addSelect('cs')
            ->leftJoin($alias.'.auditRequest', 'ar')
            ->leftJoin($alias.'.product', 'p')
            ->leftJoin($alias.'.productCombination', 'pc')
            ->leftJoin('p.brand', 'pb')
            ->leftJoin($alias.'.device', 'd')
            ->leftJoin($alias.'.status', 'cs')
        ;
    }
}
