<?php

namespace App\Entity;

use App\Repository\RepairItemRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\RepairBundle\Model\AbstractRepairItem;

/**
 * @ORM\Entity(repositoryClass=RepairItemRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_repair_item_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_repair_item_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_repair_item_type", columns={"type"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="created_at:asc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class RepairItem extends AbstractRepairItem
{
    use IdTrait;
}
