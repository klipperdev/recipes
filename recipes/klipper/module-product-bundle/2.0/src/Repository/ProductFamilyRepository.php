<?php

namespace App\Repository;

use App\Entity\ProductFamily;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\TranslatableRepositoryInterface;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\TranslatableRepositoryTrait;

/**
 * @method null|ProductFamily find($id, $lockMode = null, $lockVersion = null)
 * @method null|ProductFamily findOneBy(array $criteria, array $orderBy = null)
 * @method ProductFamily[]    findAll()
 * @method ProductFamily[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductFamilyRepository extends ServiceEntityRepository implements TranslatableRepositoryInterface
{
    use TranslatableRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductFamily::class);
    }
}
