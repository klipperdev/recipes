<?php

namespace App\Repository;

use App\Entity\RepairModule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|RepairModule find($id, $lockMode = null, $lockVersion = null)
 * @method null|RepairModule findOneBy(array $criteria, array $orderBy = null)
 * @method RepairModule[]    findAll()
 * @method RepairModule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepairModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RepairModule::class);
    }
}
