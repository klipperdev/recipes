<?php

namespace App\Repository;

use App\Entity\Group;
use Doctrine\Persistence\ManagerRegistry;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\InsensitiveTrait;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\TranslatableRepositoryInterface;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\TranslatableRepositoryTrait;
use Klipper\Component\SecurityExtra\Entity\Repository\GroupRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method null|Group find($id, $lockMode = null, $lockVersion = null)
 * @method null|Group findOneBy(array $criteria, array $orderBy = null)
 * @method Group[]    findAll()
 * @method Group[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupRepository extends ServiceEntityRepository implements
    GroupRepositoryInterface,
    TranslatableRepositoryInterface
{
    use InsensitiveTrait;
    use TranslatableRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Group::class);
    }

    /**
     * {@inheritdoc}
     */
    public function findByNames(array $names, $locale = null): array
    {
        $qb = $this->createQueryBuilder('g');
        $alias = current($qb->getRootAliases());

        $qb
            ->andWhere("{$alias}.name IN (:names)")
            ->setParameter('names', $names)
        ;

        return $this->getResult($qb, $locale);
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
