<?php

namespace App\Entity;

use App\Repository\PortalUserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\DoctrineExtensionsExtra\Validator\Constraints as KlipperDoctrineExtensionsExtraAssert;
use Klipper\Component\Model\Traits\EditGroupableInterface;
use Klipper\Component\Model\Traits\EditGroupableTrait;
use Klipper\Component\Model\Traits\EnableTrait;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\OrganizationalRequiredInterface;
use Klipper\Component\Model\Traits\OrganizationalRequiredTrait;
use Klipper\Component\Model\Traits\RoleableInterface;
use Klipper\Component\Model\Traits\RoleableTrait;
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
 * @ORM\AssociationOverrides({
 *     @ORM\AssociationOverride(
 *         name="groups",
 *         joinTable=@ORM\JoinTable(name="portal_user_group")
 *     )
 * })
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
 *     formType="Klipper\Bundle\ApiPortalBundle\Form\Type\PortalUserType",
 *     defaultSortable="user.first_name:asc, user.last_name:asc",
 *     deepSearchPaths={"user"},
 *     actions={
 *         @KlipperMetadata\MetadataAction(
 *             name="list",
 *             defaults={
 *                 "_repository_method": "createQueryForList"
 *             }
 *         )
 *     }
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class PortalUser implements
    EditGroupableInterface,
    PortalUserInterface,
    OrganizationalRequiredInterface,
    RoleableInterface,
    TimestampableInterface,
    UserTrackableInterface
{
    use EditGroupableTrait;
    use EnableTrait;
    use IdTrait;
    use OrganizationalRequiredTrait;
    use PortalUserTrait;
    use RoleableTrait;
    use TimestampableTrait;
    use UserTrackableTrait;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Klipper\Component\Portal\Model\PortalInterface",
     *     fetch="EXTRA_LAZY"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     *
     * @Serializer\Type("AssociationId")
     * @Serializer\Expose
     * @Serializer\ReadOnlyProperty
     */
    protected ?PortalInterface $portal = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Klipper\Component\Security\Model\UserInterface",
     *     fetch="EAGER",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     *
     * @Assert\NotNull
     *
     * @Serializer\Expose
     * @Serializer\ReadOnlyProperty
     */
    protected ?UserInterface $user = null;

    /**
     * @ORM\Column(type="json")
     *
     * @KlipperDoctrineExtensionsExtraAssert\EntityChoice("App\Entity\Role", namePath="name", multiple=true)
     *
     * @Serializer\Expose
     */
    protected array $roles = [];

    /**
     * @ORM\ManyToMany(
     *     targetEntity="Klipper\Component\Security\Model\GroupInterface",
     *     fetch="EAGER",
     *     cascade={"persist"}
     * )
     * @ORM\JoinTable(
     *     joinColumns={
     *         @ORM\JoinColumn(onDelete="CASCADE")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(onDelete="CASCADE", name="group_id")
     *     }
     * )
     *
     * @Serializer\Expose
     */
    protected ?Collection $groups = null;
}
