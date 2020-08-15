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
use Klipper\Component\SecurityOauth\Model\OauthAuthCodeInterface;
use Klipper\Component\SecurityOauth\Model\Traits\OauthAuthCodeTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OauthAuthCodeRepository")
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_oauth_code_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_oauth_code_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_oauth_code_expires_at", columns={"expires_at"}),
 *         @ORM\Index(name="idx_oauth_code_token", columns={"token"}),
 *         @ORM\Index(name="idx_oauth_code_redirect_uri", columns={"redirect_uri"})
 *     }
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class OauthAuthCode implements
    OauthAuthCodeInterface,
    IdInterface,
    OrganizationalRequiredInterface,
    TimestampableInterface
{
    use IdTrait;
    use OrganizationalRequiredTrait;
    use OwnerableTrait;
    use TimestampableTrait;
    use OauthAuthCodeTrait;
}
