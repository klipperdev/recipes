<?php

namespace App\Repository;

use App\Entity\ProductCombination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|ProductCombination find($id, $lockMode = null, $lockVersion = null)
 * @method null|ProductCombination findOneBy(array $criteria, array $orderBy = null)
 * @method ProductCombination[]    findAll()
 * @method ProductCombination[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductCombinationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductCombination::class);
    }
}
