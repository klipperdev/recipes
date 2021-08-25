<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\Model\Traits\IdInterface;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\OrganizationalRequiredInterface;
use Klipper\Component\Model\Traits\OrganizationalRequiredTrait;
use Klipper\Component\Model\Traits\OwnerableTrait;
use Klipper\Component\Model\Traits\TimestampableInterface;
use Klipper\Component\Model\Traits\TimestampableTrait;
use Klipper\Component\SecurityOauth\Model\OauthRefreshTokenInterface;
use Klipper\Component\SecurityOauth\Model\Traits\OauthRefreshTokenTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OauthRefreshTokenRepository")
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_oauth_refresh_token_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_oauth_refresh_token_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_oauth_refresh_token_expires_at", columns={"expires_at"}),
 *         @ORM\Index(name="idx_oauth_refresh_token_token", columns={"token"})
 *     }
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class OauthRefreshToken implements
    OauthRefreshTokenInterface,
    IdInterface,
    OrganizationalRequiredInterface,
    TimestampableInterface
{
    use IdTrait;
    use OauthRefreshTokenTrait;
    use OrganizationalRequiredTrait;
    use OwnerableTrait;
    use TimestampableTrait;
}
