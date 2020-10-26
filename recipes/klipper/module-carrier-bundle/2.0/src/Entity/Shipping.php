<?php

namespace App\Entity;

use App\Repository\ShippingRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\CarrierBundle\Model\AbstractShipping;

/**
 * @ORM\Entity(repositoryClass=ShippingRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_shipping_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_shipping_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_shipping_expedited_at", columns={"expedited_at"}),
 *         @ORM\Index(name="idx_shipping_tracking_number", columns={"tracking_number"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="created_at:desc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Shipping extends AbstractShipping
{
    use IdTrait;
}
