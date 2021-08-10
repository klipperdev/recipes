<?php

namespace App\Repository;

use App\Entity\OauthAuthCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Klipper\Component\DoctrineExtensions\Util\SqlFilterUtil;
use Klipper\Component\Security\Model\UserInterface;
use Klipper\Component\SecurityOauth\Model\OauthAuthCodeInterface;
use Klipper\Component\SecurityOauth\Model\OauthClientInterface;
use Klipper\Component\SecurityOauth\Repository\OauthAuthCodeRepositoryInterface;

/**
 * @method null|OauthAuthCode find($id, $lockMode = null, $lockVersion = null)
 * @method null|OauthAuthCode findOneBy(array $criteria, array $orderBy = null)
 * @method OauthAuthCode[]    findAll()
 * @method OauthAuthCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OauthAuthCodeRepository extends ServiceEntityRepository implements OauthAuthCodeRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OauthAuthCode::class);
    }

    public function createAuthCode(string $authCode, string $username, string $clientToken, ?string $redirectUri, array $scopes, \DateTimeInterface $expiresAt): OauthAuthCodeInterface
    {
        $em = $this->getEntityManager();
        $filters = SqlFilterUtil::disableFilters($em, [], true);

        /** @var UserInterface $user */
        $user = $em->getRepository(UserInterface::class)->findOneBy([
            'username' => $username,
        ]);
        /** @var OauthClientInterface $client */
        $client = $em->getRepository(OauthClientInterface::class)->findOneBy([
            'token' => $clientToken,
        ]);

        $iAuthCode = (new OauthAuthCode())
            ->setOwner($user)
            ->setClient($client)
            ->setToken($authCode)
            ->setScopes($scopes)
            ->setExpiresAt($expiresAt)
            ->setRedirectUri($redirectUri)
        ;

        $em->persist($iAuthCode);
        $em->flush();
        SqlFilterUtil::enableFilters($em, $filters);

        return $iAuthCode;
    }

    public function revokeAuthCode(string $authCode): void
    {
        $filters = SqlFilterUtil::disableFilters($this->getEntityManager(), [], true);
        $this->createQueryBuilder('ac')
            ->delete()
            ->where('ac.token = :token')
            ->setParameter('token', $authCode)
            ->getQuery()
            ->execute()
        ;
        SqlFilterUtil::enableFilters($this->getEntityManager(), $filters);
    }
}
