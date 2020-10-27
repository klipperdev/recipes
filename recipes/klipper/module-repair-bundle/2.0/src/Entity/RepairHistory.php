<?php

namespace App\Entity;

use App\Repository\RepairHistoryRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\RepairBundle\Model\AbstractRepairHistory;

/**
 * @ORM\Entity(repositoryClass=RepairHistoryRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_repair_history_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_repair_history_updated_at", columns={"updated_at"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     actions={
 *         @KlipperMetadata\MetadataAction(name="list"),
 *         @KlipperMetadata\MetadataAction(name="view")
 *     },
 *     defaultSortable="created_at:desc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class RepairHistory extends AbstractRepairHistory
{
    use IdTrait;
}
