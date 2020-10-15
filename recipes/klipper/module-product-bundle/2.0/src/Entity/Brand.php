<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\ProductBundle\Model\AbstractBrand;

/**
 * @ORM\Entity(repositoryClass=BrandRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_brand_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_brand_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_brand_name", columns={"name"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="name:asc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Brand extends AbstractBrand
{
    use IdTrait;
}
