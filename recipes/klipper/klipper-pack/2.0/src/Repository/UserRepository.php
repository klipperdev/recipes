<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\InsensitiveTrait;
use Klipper\Component\SecurityExtra\Entity\Repository\Traits\UserRepositoryTrait;
use Klipper\Component\SecurityExtra\Entity\Repository\UserRepositoryInterface;

/**
 * @method null|User find($id, $lockMode = null, $lockVersion = null)
 * @method null|User findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    use UserRepositoryTrait;
    use InsensitiveTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * {@inheritdoc}
     */
    public function findByUsernames(array $usernames): array
    {
        $qb = $this->createQueryBuilder('u')
            ->select('u')
            ->andWhere('u.username IN (:usernames)')
            ->setParameter('usernames', $usernames)
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
