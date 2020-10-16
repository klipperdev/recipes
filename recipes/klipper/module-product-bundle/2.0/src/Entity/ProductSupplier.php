<?php

namespace App\Entity;

use App\Repository\ProductSupplierRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\ProductBundle\Model\AbstractProductSupplier;

/**
 * @ORM\Entity(repositoryClass=ProductSupplierRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_product_range_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_product_range_updated_at", columns={"updated_at"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="updated_at:desc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class ProductSupplier extends AbstractProductSupplier
{
    use IdTrait;
}
