<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\TranslatableRepositoryInterface;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\TranslatableRepositoryTrait;

/**
 * @method null|Product find($id, $lockMode = null, $lockVersion = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository implements TranslatableRepositoryInterface
{
    use TranslatableRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function createQueryBuilderForList(string $alias, ?string $indexBy = null): QueryBuilder
    {
        return $this->createQueryBuilder($alias, $indexBy)
            ->addSelect('pt')
            ->addSelect('pr')
            ->addSelect('ob')
            ->addSelect('b')
            ->addSelect('dfc')
            ->leftJoin($alias.'.productType', 'pt')
            ->leftJoin($alias.'.productRange', 'pr')
            ->leftJoin($alias.'.operationBreakdown', 'ob')
            ->leftJoin($alias.'.brand', 'b')
            ->leftJoin($alias.'.defaultProductCombination', 'dfc')
        ;
    }

    public function findOneBy(array $criteria, array $orderBy = null)
    {
        return $this->findOneTranslatedBy($criteria);
    }
}
