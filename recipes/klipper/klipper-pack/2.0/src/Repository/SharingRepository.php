<?php

namespace App\Repository;

use App\Entity\Sharing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|Sharing find($id, $lockMode = null, $lockVersion = null)
 * @method null|Sharing findOneBy(array $criteria, array $orderBy = null)
 * @method Sharing[]    findAll()
 * @method Sharing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SharingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sharing::class);
    }
}
