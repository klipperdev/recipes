<?php

namespace App\Repository;

use App\Entity\PartnerAddress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|PartnerAddress find($id, $lockMode = null, $lockVersion = null)
 * @method null|PartnerAddress findOneBy(array $criteria, array $orderBy = null)
 * @method PartnerAddress[]    findAll()
 * @method PartnerAddress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartnerAddressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PartnerAddress::class);
    }
}
