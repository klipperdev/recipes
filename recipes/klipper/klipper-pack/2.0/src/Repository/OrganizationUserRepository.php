<?php

namespace App\Repository;

use App\Entity\OrganizationUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Klipper\Component\SecurityExtra\Entity\Repository\OrganizationUserRepositoryInterface;
use Klipper\Component\SecurityExtra\Entity\Repository\Traits\OrganizationUserRepositoryTrait;

/**
 * @method null|OrganizationUser find($id, $lockMode = null, $lockVersion = null)
 * @method null|OrganizationUser findOneBy(array $criteria, array $orderBy = null)
 * @method OrganizationUser[]    findAll()
 * @method OrganizationUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrganizationUserRepository extends ServiceEntityRepository implements OrganizationUserRepositoryInterface
{
    use OrganizationUserRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrganizationUser::class);
    }

    public function createQueryBuilderForList(string $alias, ?string $indexBy = null): QueryBuilder
    {
        return $this->createQueryBuilder($alias, $indexBy)
            ->addSelect('u')
            ->join($alias.'.user', 'u')
            ->addSelect('og')
            ->leftJoin($alias.'.groups', 'og')
        ;
    }
}
