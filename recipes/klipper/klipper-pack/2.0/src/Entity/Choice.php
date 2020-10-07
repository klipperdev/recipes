<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineChoice\Model\ChoiceInterface;
use Klipper\Component\DoctrineChoice\Model\Traits\ChoiceTrait;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdInterface;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\OrganizationalOptionalInterface;
use Klipper\Component\Model\Traits\OrganizationalOptionalTrait;
use Klipper\Component\Model\Traits\TimestampableInterface;
use Klipper\Component\Model\Traits\TimestampableTrait;
use Klipper\Component\Model\Traits\TranslatableInterface;
use Klipper\Component\Model\Traits\TranslatableTrait;
use Klipper\Component\Security\Model\OrganizationInterface;
use Klipper\Component\SecurityExtra\Annotation as KlipperSecurityExtra;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChoiceRepository")
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_choice_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_choice_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_choice_type", columns={"type"}),
 *         @ORM\Index(name="idx_choice_label", columns={"label"}),
 *         @ORM\Index(name="idx_choice_value", columns={"value"})
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="uniq_choice_organization_value", columns={"organization_id", "type", "value"})
 *     }
 * )
 *
 * @Gedmo\TranslationEntity(class="App\Entity\ChoiceTranslation")
 *
 * @KlipperSecurityDoctrineAssert\OrganizationalUniqueEntity(
 *     fields={"organization", "type", "value"},
 *     repositoryMethod="findByInsensitive",
 *     ignoreNull=false,
 *     allFilters=true
 * )
 *
 * @KlipperSecurityExtra\OrganizationalFilterOptionalAllFilterClass
 *
 * @KlipperMetadata\MetadataObject
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Choice implements
    ChoiceInterface,
    IdInterface,
    OrganizationalOptionalInterface,
    TimestampableInterface,
    TranslatableInterface
{
    use ChoiceTrait;
    use IdTrait;
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
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\Organization",
     *     fetch="EXTRA_LAZY"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     *
     * @Gedmo\SortableGroup
     *
     * @Serializer\Type("Relation")
     * @Serializer\Expose
     * @Serializer\ReadOnly
     */
    protected ?OrganizationInterface $organization = null;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\ChoiceTranslation",
     *     mappedBy="object",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    protected ?Collection $translations = null;
}
