<?php

namespace App\Repository;

use App\Entity\AutoNumberConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|AutoNumberConfig find($id, $lockMode = null, $lockVersion = null)
 * @method null|AutoNumberConfig findOneBy(array $criteria, array $orderBy = null)
 * @method AutoNumberConfig[]    findAll()
 * @method AutoNumberConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AutoNumberConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AutoNumberConfig::class);
    }
}
