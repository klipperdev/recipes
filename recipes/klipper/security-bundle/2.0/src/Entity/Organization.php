<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensions\Validator\Constraints as KlipperAssert;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\DoctrineExtensionsExtra\Validator\Constraints as KlipperDoctrineExtensionsExtraAssert;
use Klipper\Component\Model\Traits\EnableInterface;
use Klipper\Component\Model\Traits\EnableTrait;
use Klipper\Component\Model\Traits\IdInterface;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\ImagePathInterface;
use Klipper\Component\Model\Traits\ImagePathTrait;
use Klipper\Component\Model\Traits\LabelableInterface;
use Klipper\Component\Model\Traits\LabelableTrait;
use Klipper\Component\Model\Traits\NameableInterface;
use Klipper\Component\Model\Traits\OrganizationGroupsInterface;
use Klipper\Component\Model\Traits\OrganizationGroupsTrait;
use Klipper\Component\Model\Traits\OrganizationRolesInterface;
use Klipper\Component\Model\Traits\OrganizationRolesTrait;
use Klipper\Component\Model\Traits\OrganizationTrait;
use Klipper\Component\Model\Traits\RoleableInterface;
use Klipper\Component\Model\Traits\RoleableTrait;
use Klipper\Component\Model\Traits\TimestampableInterface;
use Klipper\Component\Model\Traits\TimestampableTrait;
use Klipper\Component\Security\Annotation as KlipperSecurity;
use Klipper\Component\Security\Model\OrganizationInterface;
use Klipper\Component\SecurityExtra\Annotation as KlipperSecurityExtra;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrganizationRepository")
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_organization_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_organization_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_organization_name", columns={"name"}),
 *         @ORM\Index(name="idx_organization_label", columns={"label"}),
 *         @ORM\Index(name="idx_organization_enabled", columns={"enabled"})
 *     }
 * )
 *
 * @KlipperAssert\UniqueEntity(
 *     fields={"name"},
 *     repositoryMethod="findByInsensitive",
 *     allFilters=true
 * )
 *
 * @KlipperSecurity\Permission
 *
 * @KlipperSecurity\SharingIdentity(
 *     permissible="true"
 * )
 *
 * @KlipperSecurityExtra\SharingEntry(
 *     field="name",
 *     repositoryMethod="findByNames"
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     availableContexts={"user"},
 *     buildDefaultActions=false,
 *     actions={
 *         @KlipperMetadata\MetadataAction(name="list"),
 *         @KlipperMetadata\MetadataAction(name="create"),
 *         @KlipperMetadata\MetadataAction(name="update"),
 *         @KlipperMetadata\MetadataAction(name="view"),
 *         @KlipperMetadata\MetadataAction(name="delete")
 *     }
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Organization implements
    EnableInterface,
    IdInterface,
    ImagePathInterface,
    LabelableInterface,
    NameableInterface,
    OrganizationInterface,
    OrganizationGroupsInterface,
    OrganizationRolesInterface,
    RoleableInterface,
    TimestampableInterface
{
    use EnableTrait;
    use IdTrait;
    use ImagePathTrait;
    use LabelableTrait;
    use OrganizationGroupsTrait;
    use OrganizationRolesTrait;
    use OrganizationTrait;
    use RoleableTrait;
    use TimestampableTrait;

    /**
     * @ORM\Column(type="json")
     *
     * @KlipperDoctrineExtensionsExtraAssert\EntityChoice("App\Entity\Role", namePath="name", multiple=true)
     *
     * @Serializer\Expose
     * @Serializer\ReadOnlyProperty
     * @Serializer\Groups({"ROLE_ADMIN_PLATFORM"})
     */
    protected array $roles = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Type(type="string")
     * @Assert\Length(max=255)
     *
     * @Serializer\Expose
     * @Serializer\ReadOnlyProperty
     * @Serializer\SerializedName("image_url")
     * @Serializer\Type("OrgUrl<'klipper_apiuser_organization_downloadimage', 'organization=`{{name}}`', 'ext=`{{preferredImageExtension}}`'>")
     */
    protected ?string $imagePath = null;
}
