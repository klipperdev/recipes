<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\ProductBundle\Model\AbstractProduct;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_product_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_product_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_product_name", columns={"name"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="updated_at:desc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Product extends AbstractProduct
{
    use IdTrait;
}
