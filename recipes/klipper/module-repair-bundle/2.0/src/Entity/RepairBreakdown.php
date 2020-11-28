<?php

namespace App\Entity;

use App\Repository\RepairBreakdownRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\RepairBundle\Model\AbstractRepairBreakdown;

/**
 * @ORM\Entity(repositoryClass=RepairBreakdownRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_repair_breakdown_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_repair_breakdown_updated_at", columns={"updated_at"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="breakdown.label:asc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class RepairBreakdown extends AbstractRepairBreakdown
{
    use IdTrait;
}
