<?php

namespace App\Entity;

use App\Repository\PortalUserRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\EnableTrait;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\OrganizationalRequiredInterface;
use Klipper\Component\Model\Traits\OrganizationalRequiredTrait;
use Klipper\Component\Model\Traits\TimestampableInterface;
use Klipper\Component\Model\Traits\TimestampableTrait;
use Klipper\Component\Model\Traits\UserTrackableInterface;
use Klipper\Component\Model\Traits\UserTrackableTrait;
use Klipper\Component\Portal\Model\PortalInterface;
use Klipper\Component\Portal\Model\PortalUserInterface;
use Klipper\Component\Portal\Model\Traits\PortalUserTrait;
use Klipper\Component\Security\Annotation as KlipperSecurity;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PortalUserRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_portal_user_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_portal_user_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_portal_user_enabled", columns={"enabled"})
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="uniq_portal_user", columns={"portal_id", "user_id"})
 *     }
 * )
 *
 * @KlipperSecurityDoctrineAssert\OrganizationalUniqueEntity(
 *     fields={"organization", "portal", "user"},
 *     ignoreNull=false,
 *     allFilters=true
 * )
 *
 * @KlipperSecurity\Permission(
 *     mappingPermissions={"create": "invite", "delete": "revoke"}
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     availableContexts={"organization"},
 *     defaultSortable="user.first_name:ASC, user.last_name:ASC",
 *     deepSearchPaths={"user"},
 *     actions={
 *         @KlipperMetadata\MetadataAction(
 *             name="list",
 *             defaults={
 *                 "_method_repository": "createQueryForList"
 *             }
 *         )
 *     }
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class PortalUser implements
    PortalUserInterface,
    OrganizationalRequiredInterface,
    TimestampableInterface,
    UserTrackableInterface
{
    use IdTrait;
    use EnableTrait;
    use OrganizationalRequiredTrait;
    use PortalUserTrait;
    use TimestampableTrait;
    use UserTrackableTrait;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Klipper\Component\Portal\Model\PortalInterface",
     *     fetch="EXTRA_LAZY"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     */
    protected ?PortalInterface $portal = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Klipper\Component\Security\Model\UserInterface",
     *     fetch="EXTRA_LAZY",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     *
     * @Assert\NotNull
     *
     * @Serializer\Expose
     * @Serializer\ReadOnly
     */
    protected ?UserInterface $user = null;
}
