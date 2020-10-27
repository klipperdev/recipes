<?php

namespace App\Repository;

use App\Entity\RepairPlace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|RepairPlace find($id, $lockMode = null, $lockVersion = null)
 * @method null|RepairPlace findOneBy(array $criteria, array $orderBy = null)
 * @method RepairPlace[]    findAll()
 * @method RepairPlace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepairPlaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RepairPlace::class);
    }
}
