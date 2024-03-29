<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdInterface;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\LabelableInterface;
use Klipper\Component\Model\Traits\LabelableTrait;
use Klipper\Component\Model\Traits\NameableInterface;
use Klipper\Component\Model\Traits\OrganizationalOptionalInterface;
use Klipper\Component\Model\Traits\OrganizationalOptionalTrait;
use Klipper\Component\Model\Traits\RoleHierarchicalTrait;
use Klipper\Component\Model\Traits\RoleTrait;
use Klipper\Component\Model\Traits\TimestampableInterface;
use Klipper\Component\Model\Traits\TimestampableTrait;
use Klipper\Component\Model\Traits\TranslatableInterface;
use Klipper\Component\Model\Traits\TranslatableTrait;
use Klipper\Component\Security\Annotation as KlipperSecurity;
use Klipper\Component\Security\Model\OrganizationInterface;
use Klipper\Component\Security\Model\RoleHierarchicalInterface;
use Klipper\Component\Security\Model\RoleInterface;
use Klipper\Component\SecurityExtra\Annotation as KlipperSecurityExtra;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_role_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_role_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_role_name", columns={"name"}),
 *         @ORM\Index(name="idx_role_label", columns={"label"})
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="uniq_role_organization_name", columns={"organization_id", "name"})
 *     }
 * )
 *
 * @ORM\AttributeOverrides({
 *     @ORM\AttributeOverride(name="name", column=@ORM\Column(unique=false))
 * })
 *
 * @ORM\AssociationOverrides({
 *     @ORM\AssociationOverride(name="permissions", joinTable=@ORM\JoinTable(name="role_permission"))
 * })
 *
 * @Gedmo\TranslationEntity(class="App\Entity\RoleTranslation")
 *
 * @KlipperSecurityDoctrineAssert\RoleUniqueEntity(
 *     fields={"organization", "name"},
 *     repositoryMethod="findByInsensitive",
 *     ignoreNull=false,
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
 * @KlipperSecurityExtra\OrganizationalFilterOptionalAllFilterClass
 *
 * @KlipperMetadata\MetadataObject(
 *     availableContexts={"organization"}
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Role implements
    RoleHierarchicalInterface,
    IdInterface,
    LabelableInterface,
    NameableInterface,
    OrganizationalOptionalInterface,
    TimestampableInterface,
    TranslatableInterface
{
    use IdTrait;
    use LabelableTrait;
    use OrganizationalOptionalTrait;
    use RoleHierarchicalTrait;
    use RoleTrait;
    use TimestampableTrait;
    use TranslatableTrait;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Gedmo\Translatable
     *
     * @Assert\Type(type="string")
     * @Assert\Length(max=255)
     *
     * @Serializer\Expose
     */
    protected ?string $label = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\Organization",
     *     inversedBy="organizationRoles"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     *
     * @Serializer\Type("AssociationId")
     * @Serializer\Expose
     * @Serializer\ReadOnlyProperty
     */
    protected ?OrganizationInterface $organization = null;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\RoleTranslation",
     *     fetch="EXTRA_LAZY",
     *     mappedBy="object",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    protected ?Collection $translations = null;

    /**
     * @var null|Collection|RoleInterface[]
     *
     * @ORM\ManyToMany(
     *     targetEntity="Klipper\Component\Security\Model\RoleInterface",
     *     inversedBy="parents"
     * )
     * @ORM\JoinTable(
     *     name="role_children",
     *     joinColumns={
     *         @ORM\JoinColumn(onDelete="CASCADE")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(onDelete="CASCADE", name="children_role_id")
     *     }
     * )
     *
     * @Serializer\Expose
     * @Serializer\MaxDepth(1)
     */
    protected ?Collection $children = null;
}
