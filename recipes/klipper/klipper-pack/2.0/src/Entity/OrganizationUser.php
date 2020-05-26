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

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrganizationUserRepository")
 *
 * @ORM\AssociationOverrides({
 *     @ORM\AssociationOverride(
 *         name="groups",
 *         joinTable=@ORM\JoinTable(name="organization_user_group")
 *     )
 * })
 *
 * @KlipperSecurity\Permission(
 *     mappingPermissions={"create": "invite", "delete": "revoke"}
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     availableContexts={"organization"}
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
     *     fetch="EXTRA_LAZY",
     *     inversedBy="organizationUsers"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     *
     * @Serializer\Type("Relation")
     * @Serializer\Expose
     * @Serializer\ReadOnly
     */
    protected ?OrganizationInterface $organization = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Klipper\Component\Security\Model\UserInterface",
     *     fetch="EXTRA_LAZY",
     *     inversedBy="userOrganizations",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     *
     * @Serializer\Type("Relation")
     * @Serializer\Expose
     * @Serializer\ReadOnly
     */
    protected ?UserInterface $user = null;

    /**
     * @ORM\ManyToMany(
     *     targetEntity="Klipper\Component\Security\Model\GroupInterface",
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
