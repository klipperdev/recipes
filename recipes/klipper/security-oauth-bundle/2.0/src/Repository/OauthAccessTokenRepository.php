<?php

namespace App\Repository;

use App\Entity\OauthAccessToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Klipper\Component\DoctrineExtensions\Util\SqlFilterUtil;
use Klipper\Component\Security\Model\UserInterface;
use Klipper\Component\SecurityOauth\Model\OauthAccessTokenInterface;
use Klipper\Component\SecurityOauth\Model\OauthClientInterface;
use Klipper\Component\SecurityOauth\Repository\OauthAccessTokenRepositoryInterface;

/**
 * @method null|OauthAccessToken find($id, $lockMode = null, $lockVersion = null)
 * @method null|OauthAccessToken findOneBy(array $criteria, array $orderBy = null)
 * @method OauthAccessToken[]    findAll()
 * @method OauthAccessToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OauthAccessTokenRepository extends ServiceEntityRepository implements OauthAccessTokenRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OauthAccessToken::class);
    }

    public function createAccessToken(string $accessToken, string $username, string $clientToken, array $scopes, \DateTimeInterface $expiresAt): OauthAccessTokenInterface
    {
        $em = $this->getEntityManager();
        $filters = SqlFilterUtil::disableFilters($em, [], true);

        /** @var UserInterface $user */
        $user = $em->getRepository(UserInterface::class)->findOneBy([
            'username' => $username,
        ]);
        /** @var OauthClientInterface $client */
        $client = $em->getRepository(OauthClientInterface::class)->findOneBy([
            'clientId' => $clientToken,
        ]);

        $iAccessToken = (new OauthAccessToken())
            ->setOwner($user)
            ->setClient($client)
            ->setToken($accessToken)
            ->setScopes($scopes)
            ->setExpiresAt($expiresAt)
        ;

        $em->persist($iAccessToken);
        $em->flush();
        SqlFilterUtil::enableFilters($em, $filters);

        return $iAccessToken;
    }

    public function revokeAccessToken(string $tokenId): void
    {
        $filters = SqlFilterUtil::disableFilters($this->getEntityManager(), [], true);
        $this->createQueryBuilder('at')
            ->delete()
            ->where('at.token = :token')
            ->setParameter('token', $tokenId)
            ->getQuery()
            ->execute()
        ;
        SqlFilterUtil::enableFilters($this->getEntityManager(), $filters);
    }
}
