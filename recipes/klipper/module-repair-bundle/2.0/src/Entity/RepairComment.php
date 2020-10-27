<?php

namespace App\Entity;

use App\Repository\RepairCommentRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\RepairBundle\Model\AbstractRepairComment;

/**
 * @ORM\Entity(repositoryClass=RepairCommentRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_repair_comment_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_repair_comment_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_repair_comment_public", columns={"public"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="created_at:desc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class RepairComment extends AbstractRepairComment
{
    use IdTrait;
}
