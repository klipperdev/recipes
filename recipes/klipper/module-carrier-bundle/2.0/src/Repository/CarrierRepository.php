<?php

namespace App\Repository;

use App\Entity\Carrier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|Carrier find($id, $lockMode = null, $lockVersion = null)
 * @method null|Carrier findOneBy(array $criteria, array $orderBy = null)
 * @method Carrier[]    findAll()
 * @method Carrier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarrierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carrier::class);
    }
}
