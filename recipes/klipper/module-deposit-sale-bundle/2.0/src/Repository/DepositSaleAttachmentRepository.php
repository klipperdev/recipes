<?php

namespace App\Repository;

use App\Entity\DepositSaleAttachment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|DepositSaleAttachment find($id, $lockMode = null, $lockVersion = null)
 * @method null|DepositSaleAttachment findOneBy(array $criteria, array $orderBy = null)
 * @method DepositSaleAttachment[]    findAll()
 * @method DepositSaleAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepositSaleAttachmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DepositSaleAttachment::class);
    }

    public function createQueryBuilderForList(string $alias, ?string $indexBy = null): QueryBuilder
    {
        return $this->createQueryBuilder($alias, $indexBy)
            ->addSelect('ds')
            ->leftJoin($alias.'.depositSale', 'ds')
        ;
    }
}
