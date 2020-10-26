<?php

namespace App\Entity;

use App\Repository\CarrierRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\CarrierBundle\Model\AbstractCarrier;

/**
 * @ORM\Entity(repositoryClass=CarrierRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_carrier_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_carrier_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_carrier_name", columns={"name"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="name:asc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Carrier extends AbstractCarrier
{
    use IdTrait;
}
