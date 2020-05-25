<?php

namespace App\Repository;

use App\Entity\OauthClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\InsensitiveTrait;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\TranslatableRepositoryInterface;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\TranslatableRepositoryTrait;
use Klipper\Component\SecurityOauth\Model\OauthClientInterface;
use Klipper\Component\SecurityOauth\Repository\OauthClientRepositoryInterface;

/**
 * @method null|OauthClient find($id, $lockMode = null, $lockVersion = null)
 * @method null|OauthClient findOneBy(array $criteria, array $orderBy = null)
 * @method OauthClient[]    findAll()
 * @method OauthClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OauthClientRepository extends ServiceEntityRepository implements
    OauthClientRepositoryInterface,
    TranslatableRepositoryInterface
{
    use InsensitiveTrait;
    use TranslatableRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OauthClient::class);
    }

    public function findEnabled($identifier, ?string $locale = null): ?OauthClientInterface
    {
        return $this->findOneBy(['id' => $identifier, 'enabled' => true]);
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
