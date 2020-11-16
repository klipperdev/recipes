<?php

namespace App\Entity;

use App\Repository\ProductCombinationRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\ProductBundle\Model\AbstractProductCombination;

/**
 * @ORM\Entity(repositoryClass=ProductCombinationRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_product_combination_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_product_combination_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_product_combination_reference", columns={"reference"}),
 *         @ORM\Index(name="idx_product_combination_code_ean13", columns={"code_ean13"}),
 *         @ORM\Index(name="idx_product_combination_code_upc", columns={"code_upc"})
 *     }
 * )
 *
 * @ORM\AssociationOverrides({
 *     @ORM\AssociationOverride(
 *         name="attributeItems",
 *         joinTable=@ORM\JoinTable(name="product_combination_attribute_item")
 *     )
 * })
 *
 * @KlipperMetadata\MetadataObject
 *
 * @Serializer\ExclusionPolicy("all")
 */
class ProductCombination extends AbstractProductCombination
{
    use IdTrait;
}
