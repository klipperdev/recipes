<?php

namespace App\Repository;

use App\Entity\PriceListRule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|PriceListRule find($id, $lockMode = null, $lockVersion = null)
 * @method null|PriceListRule findOneBy(array $criteria, array $orderBy = null)
 * @method PriceListRule[]    findAll()
 * @method PriceListRule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceListRuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PriceListRule::class);
    }
}
