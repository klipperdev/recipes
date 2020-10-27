<?php

namespace App\Entity;

use App\Repository\RepairPlaceRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\RepairBundle\Model\AbstractRepairPlace;

/**
 * @ORM\Entity(repositoryClass=RepairPlaceRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_repair_place_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_repair_place_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_repair_place_label", columns={"label"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="label:asc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class RepairPlace extends AbstractRepairPlace
{
    use IdTrait;
}
