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

    public function createQueryBuilder($alias, $indexBy = null): QueryBuilder
    {
        return parent::createQueryBuilder($alias, $indexBy)
            ->addSelect('a')
            ->addSelect('p')
            ->addSelect('pc')
            ->addSelect('pb')
            ->addSelect('d')
            ->addSelect('cs')
            ->addSelect('ur')
            ->addSelect('dlr')
            ->addSelect('iAddr')
            ->addSelect('sAddr')
            ->addSelect('wc')
            ->addSelect('ship')
            ->leftJoin($alias.'.account', 'a')
            ->leftJoin($alias.'.product', 'p')
            ->leftJoin($alias.'.productCombination', 'pc')
            ->leftJoin('p.brand', 'pb')
            ->leftJoin($alias.'.device', 'd')
            ->leftJoin($alias.'.status', 'cs')
            ->leftJoin($alias.'.repairer', 'ur')
            ->leftJoin('d.lastRepair', 'dlr')
            ->leftJoin($alias.'.invoiceAddress', 'iAddr')
            ->leftJoin($alias.'.shippingAddress', 'sAddr')
            ->leftJoin($alias.'.workcenter', 'wc')
            ->leftJoin($alias.'.shipping', 'ship')
        ;
    }
}
