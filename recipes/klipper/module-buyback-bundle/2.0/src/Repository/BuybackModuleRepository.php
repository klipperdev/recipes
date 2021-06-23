<?php

namespace App\Repository;

use App\Entity\BuybackModule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|BuybackModule find($id, $lockMode = null, $lockVersion = null)
 * @method null|BuybackModule findOneBy(array $criteria, array $orderBy = null)
 * @method BuybackModule[]    findAll()
 * @method BuybackModule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuybackModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuybackModule::class);
    }
}
