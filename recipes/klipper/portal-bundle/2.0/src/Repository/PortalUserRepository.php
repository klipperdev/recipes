<?php

namespace App\Repository;

use App\Entity\PortalUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Klipper\Component\Portal\Entity\Repository\PortalUserRepositoryInterface;
use Klipper\Component\Portal\Entity\Repository\Traits\PortalUserRepositoryTrait;

/**
 * @method null|PortalUser find($id, $lockMode = null, $lockVersion = null)
 * @method null|PortalUser findOneBy(array $criteria, array $orderBy = null)
 * @method PortalUser[]    findAll()
 * @method PortalUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortalUserRepository extends ServiceEntityRepository implements PortalUserRepositoryInterface
{
    use PortalUserRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PortalUser::class);
    }

    public function createQueryBuilderForList(string $alias, ?string $indexBy = null): QueryBuilder
    {
        return $this->createQueryBuilder($alias, $indexBy)
            ->select($alias.', u')
            ->join($alias.'.user', 'u')
        ;
    }
}
