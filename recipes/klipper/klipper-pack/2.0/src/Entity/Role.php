<?php

namespace App\Entity;

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
use Klipper\Component\Security\Model\RoleHierarchicalInterface;
use Klipper\Component\SecurityExtra\Annotation as KlipperSecurityExtra;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 *
 * @ORM\Table(
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
 *     fields={"name"},
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
    use RoleTrait;
    use RoleHierarchicalTrait;
    use TimestampableTrait;
    use TranslatableTrait;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Gedmo\Translatable
     *
     * @Assert\Type(type="string")
     * @Assert\Length(max=255)
     *
     * @Serializer\Expose
     */
    protected $label;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\Organization",
     *     fetch="EXTRA_LAZY",
     *     inversedBy="organizationRoles"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     *
     * @Serializer\Expose
     * @Serializer\ReadOnly
     */
    protected $organization;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\RoleTranslation",
     *     mappedBy="object",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    protected $translations;
}
