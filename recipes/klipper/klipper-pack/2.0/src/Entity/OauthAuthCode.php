<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
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
 *
 *
 * @KlipperMetadata\MetadataObject
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

    /**
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\Organization",
     *     fetch="EXTRA_LAZY"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     *
     * @Serializer\Expose
     * @Serializer\ReadOnly
     */
    protected $organization;
}
