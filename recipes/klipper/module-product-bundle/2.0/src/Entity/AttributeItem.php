<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\TranslatableInterface;
use Klipper\Component\Model\Traits\TranslatableTrait;
use Klipper\Component\Security\Model\OrganizationInterface;
use Klipper\Module\ProductBundle\Model\AbstractAttributeItem;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttributeItemRepository")
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_attribute_item_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_attribute_item_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_attribute_item_label", columns={"label"})
 *     }
 * )
 *
 * @Gedmo\TranslationEntity(class="App\Entity\AttributeItemTranslation")
 *
 * @KlipperMetadata\MetadataObject
 *
 * @Serializer\ExclusionPolicy("all")
 */
class AttributeItem extends AbstractAttributeItem implements
    TranslatableInterface
{
    use IdTrait;
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
     * @Serializer\Type("AssociationId")
     * @Serializer\Expose
     * @Serializer\ReadOnly
     */
    protected ?OrganizationInterface $organization = null;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\AttributeTranslation",
     *     mappedBy="object",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    protected ?Collection $translations = null;
}
