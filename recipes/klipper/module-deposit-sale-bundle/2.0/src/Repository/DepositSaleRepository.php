<?php

namespace App\Repository;

use App\Entity\DepositSale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|DepositSale find($id, $lockMode = null, $lockVersion = null)
 * @method null|DepositSale findOneBy(array $criteria, array $orderBy = null)
 * @method DepositSale[]    findAll()
 * @method DepositSale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepositSaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DepositSale::class);
    }

    public function createQueryBuilderForList(string $alias, ?string $indexBy = null): QueryBuilder
    {
        return $this->createQueryBuilder($alias, $indexBy)
            ->addSelect('a')
            ->addSelect('p')
            ->addSelect('d')
            ->addSelect('cs')
            ->addSelect('oAddr')
            ->leftJoin($alias.'.account', 'a')
            ->leftJoin($alias.'.product', 'p')
            ->leftJoin($alias.'.device', 'd')
            ->leftJoin($alias.'.status', 'cs')
            ->leftJoin($alias.'.originalAddress', 'oAddr')
        ;
    }
}
