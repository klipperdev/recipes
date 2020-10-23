<?php

namespace App\Entity;

use App\Repository\PriceListRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\ProductBundle\Model\AbstractPriceList;

/**
 * @ORM\Entity(repositoryClass=PriceListRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_price_list_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_price_list_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_price_list_label", columns={"label"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="updated_at:desc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class PriceList extends AbstractPriceList
{
    use IdTrait;
}
