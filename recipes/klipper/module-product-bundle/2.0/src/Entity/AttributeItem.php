<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\SingleExternalableInterface;
use Klipper\Component\Model\Traits\SingleExternalableTrait;
use Klipper\Component\Model\Traits\TranslatableInterface;
use Klipper\Component\Model\Traits\TranslatableTrait;
use Klipper\Component\Security\Model\OrganizationInterface;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;
use Klipper\Module\ProductBundle\Model\AbstractAttributeItem;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttributeItemRepository")
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_attribute_item_external_id", columns={"external_id"}),
 *         @ORM\Index(name="idx_attribute_item_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_attribute_item_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_attribut_item_reference", columns={"reference"}),
 *         @ORM\Index(name="idx_attribute_item_label", columns={"label"})
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="uniq_attribut_item_reference", columns={"organization_id", "reference"})
 *     }
 * )
 *
 * @Gedmo\TranslationEntity(class="App\Entity\AttributeItemTranslation")
 *
 * @KlipperSecurityDoctrineAssert\OrganizationalUniqueEntity(
 *     fields={"organization", "reference"},
 *     ignoreNull=true
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     deepSearchPaths={"attribute"},
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class AttributeItem extends AbstractAttributeItem implements SingleExternalableInterface, TranslatableInterface
{
    use IdTrait;
    use SingleExternalableTrait;
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
     *     targetEntity="App\Entity\Organization"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     *
     * @Gedmo\SortableGroup
     *
     * @Serializer\Type("AssociationId")
     * @Serializer\Expose
     * @Serializer\ReadOnlyProperty
     */
    protected ?OrganizationInterface $organization = null;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\AttributeTranslation",
     *     fetch="EXTRA_LAZY",
     *     mappedBy="object",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    protected ?Collection $translations = null;
}
