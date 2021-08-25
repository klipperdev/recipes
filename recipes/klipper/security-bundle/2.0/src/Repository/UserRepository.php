<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Klipper\Component\DoctrineExtensions\Util\SqlFilterUtil;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\InsensitiveTrait;
use Klipper\Component\Security\Model\UserInterface;
use Klipper\Component\SecurityExtra\Entity\Repository\Traits\UserRepositoryTrait;
use Klipper\Component\SecurityExtra\Entity\Repository\UserRepositoryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @method null|User find($id, $lockMode = null, $lockVersion = null)
 * @method null|User findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface, UserLoaderInterface
{
    use InsensitiveTrait;
    use UserRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function loadUserByIdentifier(string $identifier): ?UserInterface
    {
        $res = $this->findByUserIdentifierOrHavingEmails([$identifier]);

        return 1 === \count($res) ? $res[0] : null;
    }

    /**
     * @see UserRepositoryInterface::findByUserIdentifiers
     */
    public function findByUserIdentifiers(array $userIdentifiers): array
    {
        $qb = $this->createQueryBuilder('u')
            ->select('u, o, g')
            ->leftJoin('u.organization', 'o')
            ->leftJoin('u.groups', 'g')
            ->andWhere('u.username IN (:usernames)')
            ->setParameter('usernames', $userIdentifiers)
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * @see UserRepositoryInterface::findByUserIdentifierOrHavingEmails
     */
    public function findByUserIdentifierOrHavingEmails(array $userIdentifiers): array
    {
        $filters = SqlFilterUtil::disableFilters($this->getEntityManager(), ['organization_only']);

        $qb = $this->createQueryBuilder('u')
            ->select('u, o, g')
            ->leftJoin('u.organization', 'o')
            ->leftJoin('u.groups', 'g')
            ->andWhere('u.username IN (:usernames) OR u.email IN (:usernames)')
            ->setParameter('usernames', $userIdentifiers)
        ;

        $res = $qb->getQuery()->getResult();
        SqlFilterUtil::enableFilters($this->getEntityManager(), $filters);

        return $res;
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
