<?php

namespace App\Repository;

use App\Entity\Workcenter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|Workcenter find($id, $lockMode = null, $lockVersion = null)
 * @method null|Workcenter findOneBy(array $criteria, array $orderBy = null)
 * @method Workcenter[]    findAll()
 * @method Workcenter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkcenterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Workcenter::class);
    }
}
