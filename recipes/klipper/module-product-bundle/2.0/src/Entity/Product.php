<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\TranslatableInterface;
use Klipper\Component\Model\Traits\TranslatableTrait;
use Klipper\Module\ProductBundle\Model\AbstractProduct;
use Klipper\Module\RepairBundle\Model\Traits\ProductBreakdownableInterface;
use Klipper\Module\RepairBundle\Model\Traits\ProductBreakdownableTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_product_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_product_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_product_name", columns={"name"}),
 *         @ORM\Index(name="idx_product_reference", columns={"reference"}),
 *         @ORM\Index(name="idx_product_code_ean13", columns={"code_ean13"}),
 *         @ORM\Index(name="idx_product_code_upc", columns={"code_upc"}),
 *         @ORM\Index(name="idx_product_can_be_sell", columns={"can_be_sell"}),
 *         @ORM\Index(name="idx_product_can_be_sell", columns={"can_be_sell"}),
 *         @ORM\Index(name="idx_product_price", columns={"price"})
 *     }
 * )
 *
 * @Gedmo\TranslationEntity(class="App\Entity\ProductTranslation")
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="updated_at:desc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Product extends AbstractProduct implements ProductBreakdownableInterface, TranslatableInterface
{
    use IdTrait;
    use ProductBreakdownableTrait;
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
    protected ?string $name = null;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     *
     * @Gedmo\Translatable
     *
     * @Assert\Type(type="string")
     * @Assert\Length(min=0, max=128)
     *
     * @Serializer\Expose
     */
    protected ?string $description = null;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\ProductTranslation",
     *     mappedBy="object",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    protected ?Collection $translations = null;
}
