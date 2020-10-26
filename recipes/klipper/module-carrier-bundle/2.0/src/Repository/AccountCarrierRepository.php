<?php

namespace App\Repository;

use App\Entity\AccountCarrier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|AccountCarrier find($id, $lockMode = null, $lockVersion = null)
 * @method null|AccountCarrier findOneBy(array $criteria, array $orderBy = null)
 * @method AccountCarrier[]    findAll()
 * @method AccountCarrier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountCarrierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountCarrier::class);
    }
}
