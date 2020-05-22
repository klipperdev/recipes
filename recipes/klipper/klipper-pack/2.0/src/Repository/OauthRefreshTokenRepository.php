<?php

namespace App\Repository;

use App\Entity\OauthRefreshToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Klipper\Component\DoctrineExtensions\Util\SqlFilterUtil;
use Klipper\Component\SecurityOauth\Model\OauthAccessTokenInterface;
use Klipper\Component\SecurityOauth\Model\OauthRefreshTokenInterface;
use Klipper\Component\SecurityOauth\Repository\OauthRefreshTokenRepositoryInterface;

/**
 * @method null|OauthRefreshToken find($id, $lockMode = null, $lockVersion = null)
 * @method null|OauthRefreshToken findOneBy(array $criteria, array $orderBy = null)
 * @method OauthRefreshToken[]    findAll()
 * @method OauthRefreshToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OauthRefreshTokenRepository extends ServiceEntityRepository implements
    OauthRefreshTokenRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OauthRefreshToken::class);
    }

    public function createRefreshToken(string $refreshToken, string $accessToken, \DateTimeInterface $expiresAt): OauthRefreshTokenInterface
    {
        $em = $this->getEntityManager();
        $filters = SqlFilterUtil::disableFilters($em, [], true);

        /** @var OauthAccessTokenInterface $iAccessToken */
        $iAccessToken = $em->getRepository(OauthAccessTokenInterface::class)->findOneBy([
            'token' => $accessToken,
        ]);

        $iRefreshToken = (new OauthRefreshToken())
            ->setAccessToken($iAccessToken)
            ->setToken($refreshToken)
            ->setExpiresAt($expiresAt)
        ;

        $em->persist($iRefreshToken);
        $em->flush();
        SqlFilterUtil::enableFilters($em, $filters);

        return $iRefreshToken;
    }

    public function revokeRefreshToken(string $tokenId): void
    {
        $filters = SqlFilterUtil::disableFilters($this->getEntityManager(), [], true);
        $this->createQueryBuilder('rt')
            ->delete()
            ->where('rt.token = :token')
            ->setParameter('token', $tokenId)
            ->getQuery()
            ->execute()
        ;
        SqlFilterUtil::enableFilters($this->getEntityManager(), $filters);
    }
}
