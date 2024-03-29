<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\DoctrineExtensionsExtra\Validator\Constraints as KlipperDoctrineExtensionsExtraAssert;
use Klipper\Component\Model\Traits\EditGroupableInterface;
use Klipper\Component\Model\Traits\EditGroupableTrait;
use Klipper\Component\Model\Traits\EnableInterface;
use Klipper\Component\Model\Traits\EnableTrait;
use Klipper\Component\Model\Traits\IdInterface;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\OrganizationUserTrait;
use Klipper\Component\Model\Traits\RoleableInterface;
use Klipper\Component\Model\Traits\RoleableTrait;
use Klipper\Component\Model\Traits\TimestampableInterface;
use Klipper\Component\Model\Traits\TimestampableTrait;
use Klipper\Component\Security\Annotation as KlipperSecurity;
use Klipper\Component\Security\Model\OrganizationInterface;
use Klipper\Component\Security\Model\OrganizationUserInterface;
use Klipper\Component\Security\Model\UserInterface;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrganizationUserRepository")
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_organization_user_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_organization_user_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_organization_user_enabled", columns={"enabled"})
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="uniq_organization_user", columns={"organization_id", "user_id"})
 *     }
 * )
 *
 * @ORM\AssociationOverrides({
 *     @ORM\AssociationOverride(
 *         name="groups",
 *         joinTable=@ORM\JoinTable(name="organization_user_group")
 *     )
 * })
 *
 * @KlipperSecurityDoctrineAssert\OrganizationalUniqueEntity(
 *     fields={"organization", "user"},
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
 *     formType="Klipper\Bundle\ApiUserBundle\Form\Type\OrganizationUserType",
 *     defaultSortable="user.first_name:asc, user.last_name:asc",
 *     deepSearchPaths={"user"},
 *     actions={
 *         @KlipperMetadata\MetadataAction(
 *             name="create",
 *             defaults={
 *                 "_disable_filters": "organization, organization_only, role"
 *             }
 *         ),
 *         @KlipperMetadata\MetadataAction(
 *             name="creates",
 *             defaults={
 *                 "_disable_filters": "organization, organization_only, role"
 *             }
 *         ),
 *         @KlipperMetadata\MetadataAction(
 *             name="update",
 *             defaults={
 *                 "_disable_filters": "organization, organization_only, role"
 *             }
 *         ),
 *         @KlipperMetadata\MetadataAction(
 *             name="updates",
 *             defaults={
 *                 "_disable_filters": "organization, organization_only, role"
 *             }
 *         ),
 *         @KlipperMetadata\MetadataAction(
 *             name="upsert",
 *             defaults={
 *                 "_disable_filters": "organization, organization_only, role"
 *             }
 *         ),
 *         @KlipperMetadata\MetadataAction(
 *             name="upserts",
 *             defaults={
 *                 "_disable_filters": "organization, organization_only, role"
 *             }
 *         )
 *     }
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class OrganizationUser implements
    EditGroupableInterface,
    EnableInterface,
    IdInterface,
    OrganizationUserInterface,
    RoleableInterface,
    TimestampableInterface
{
    use EditGroupableTrait;
    use EnableTrait;
    use IdTrait;
    use OrganizationUserTrait;
    use RoleableTrait;
    use TimestampableTrait;

    /**
     * @ORM\Column(type="json")
     *
     * @KlipperDoctrineExtensionsExtraAssert\EntityChoice("App\Entity\Role", namePath="name", multiple=true)
     *
     * @Serializer\Expose
     */
    protected array $roles = [];

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Klipper\Component\Security\Model\OrganizationInterface",
     *     inversedBy="organizationUsers"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     *
     * @Serializer\Type("AssociationId")
     * @Serializer\Expose
     * @Serializer\ReadOnlyProperty
     */
    protected ?OrganizationInterface $organization = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Klipper\Component\Security\Model\UserInterface",
     *     inversedBy="userOrganizations",
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
     * @ORM\ManyToMany(
     *     targetEntity="Klipper\Component\Security\Model\GroupInterface",
     *     fetch="EXTRA_LAZY",
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
