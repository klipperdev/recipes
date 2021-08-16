<?php

namespace App\Entity;

use App\Repository\ProductRangeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\TranslatableInterface;
use Klipper\Component\Model\Traits\TranslatableTrait;
use Klipper\Module\ProductBundle\Model\AbstractProductRange;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRangeRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_product_range_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_product_range_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_product_name", columns={"name"}),
 *         @ORM\Index(name="idx_product_label", columns={"label"})
 *     }
 * )
 *
 * @Gedmo\TranslationEntity(class="App\Entity\ProductRangeTranslation")
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="updated_at:desc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class ProductRange extends AbstractProductRange implements TranslatableInterface
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
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\ProductRangeTranslation",
     *     fetch="EXTRA_LAZY",
     *     mappedBy="object",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    protected ?Collection $translations = null;
}
