<?php

namespace App\Repository;

use App\Entity\DepositSaleModule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|DepositSaleModule find($id, $lockMode = null, $lockVersion = null)
 * @method null|DepositSaleModule findOneBy(array $criteria, array $orderBy = null)
 * @method DepositSaleModule[]    findAll()
 * @method DepositSaleModule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepositSaleModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DepositSaleModule::class);
    }
}
