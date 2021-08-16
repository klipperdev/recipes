<?php

namespace App\Repository;

use App\Entity\Repair;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|Repair find($id, $lockMode = null, $lockVersion = null)
 * @method null|Repair findOneBy(array $criteria, array $orderBy = null)
 * @method Repair[]    findAll()
 * @method Repair[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepairRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Repair::class);
    }

    public function createQueryBuilderForList(string $alias, ?string $indexBy = null): QueryBuilder
    {
        return $this->createQueryBuilder($alias, $indexBy)
            ->addSelect('a')
            ->addSelect('p')
            ->addSelect('d')
            ->addSelect('cs')
            ->addSelect('sAddr')
            ->leftJoin($alias.'.account', 'a')
            ->leftJoin($alias.'.product', 'p')
            ->leftJoin($alias.'.device', 'd')
            ->leftJoin($alias.'.status', 'cs')
            ->leftJoin($alias.'.shippingAddress', 'sAddr')
        ;
    }
}
