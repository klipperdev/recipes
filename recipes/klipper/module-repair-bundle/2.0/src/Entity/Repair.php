<?php

namespace App\Entity;

use App\Repository\RepairRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\RepairBundle\Model\AbstractRepair;

/**
 * @ORM\Entity(repositoryClass=RepairRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_repair_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_repair_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_repair_reference", columns={"reference"}),
 *         @ORM\Index(name="idx_repair_tray_reference", columns={"tray_reference"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     fieldLabel="reference",
 *     defaultSortable="created_at:desc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Repair extends AbstractRepair
{
    use IdTrait;
}
