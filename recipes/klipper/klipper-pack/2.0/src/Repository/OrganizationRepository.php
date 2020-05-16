<?php

namespace App\Repository;

use App\Entity\Organization;
use Doctrine\Persistence\ManagerRegistry;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\InsensitiveTrait;
use Klipper\Component\SecurityExtra\Entity\Repository\OrganizationRepositoryInterface;
use Klipper\Component\SecurityExtra\Entity\Repository\Traits\OrganizationRepositoryTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method null|Organization find($id, $lockMode = null, $lockVersion = null)
 * @method null|Organization findOneBy(array $criteria, array $orderBy = null)
 * @method Organization[]    findAll()
 * @method Organization[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrganizationRepository extends ServiceEntityRepository implements OrganizationRepositoryInterface
{
    use InsensitiveTrait;
    use OrganizationRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Organization::class);
    }

    /**
     * {@inheritdoc}
     */
    public function findByNames(array $names): array
    {
        $qb = $this->createQueryBuilder('o');
        $alias = current($qb->getRootAliases());

        $qb
            ->andWhere("{$alias}.name IN (:names)")
            ->setParameter('names', $names)
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritdoc}
     */
    protected function getInsensitiveFields(): array
    {
        return [
            'name',
        ];
    }
}
