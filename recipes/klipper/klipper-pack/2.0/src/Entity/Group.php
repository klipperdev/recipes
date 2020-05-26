<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\DoctrineExtensionsExtra\Validator\Constraints as KlipperDoctrineExtensionsExtraAssert;
use Klipper\Component\Model\Traits\GroupTrait;
use Klipper\Component\Model\Traits\IdInterface;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\LabelableInterface;
use Klipper\Component\Model\Traits\LabelableTrait;
use Klipper\Component\Model\Traits\NameableInterface;
use Klipper\Component\Model\Traits\OrganizationalOptionalInterface;
use Klipper\Component\Model\Traits\OrganizationalOptionalTrait;
use Klipper\Component\Model\Traits\TimestampableInterface;
use Klipper\Component\Model\Traits\TimestampableTrait;
use Klipper\Component\Model\Traits\TranslatableInterface;
use Klipper\Component\Model\Traits\TranslatableTrait;
use Klipper\Component\Security\Annotation as KlipperSecurity;
use Klipper\Component\Security\Model\GroupInterface;
use Klipper\Component\Security\Model\OrganizationInterface;
use Klipper\Component\SecurityExtra\Annotation as KlipperSecurityExtra;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupRepository")
 *
 * @ORM\Table(
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="uniq_group_organization_name", columns={"organization_id", "name"})
 *     }
 * )
 *
 * @ORM\AttributeOverrides({
 *     @ORM\AttributeOverride(name="name", column=@ORM\Column(unique=false))
 * })
 *
 * @Gedmo\TranslationEntity(class="App\Entity\GroupTranslation")
 *
 * @KlipperSecurityDoctrineAssert\OrganizationalUniqueEntity(
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
 * @KlipperMetadata\MetadataObject(
 *     availableContexts={"organization"}
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Group implements
    GroupInterface,
    IdInterface,
    LabelableInterface,
    NameableInterface,
    OrganizationalOptionalInterface,
    TimestampableInterface,
    TranslatableInterface
{
    use GroupTrait;
    use IdTrait;
    use LabelableTrait;
    use OrganizationalOptionalTrait;
    use TimestampableTrait;
    use TranslatableTrait;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Gedmo\Translatable
     *
     * @Assert\Type(type="string")
     * @Assert\Length(max=255)
     * @Assert\NotBlank
     *
     * @Serializer\Expose
     */
    protected ?string $label = null;

    /**
     * @ORM\Column(type="json")
     *
     * @KlipperDoctrineExtensionsExtraAssert\EntityChoice("App\Entity\Role", multiple=true)
     *
     * @Serializer\Expose
     */
    protected array $roles = [];

    /**
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\Organization",
     *     fetch="EXTRA_LAZY",
     *     inversedBy="organizationGroups"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     *
     * @Serializer\Expose
     * @Serializer\ReadOnly
     */
    protected ?OrganizationInterface $organization = null;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\GroupTranslation",
     *     mappedBy="object",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    protected ?Collection $translations = null;
}
