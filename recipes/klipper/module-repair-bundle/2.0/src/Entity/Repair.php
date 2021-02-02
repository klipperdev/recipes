<?php

namespace App\Entity;

use App\Repository\RepairRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;
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
 * @KlipperSecurityDoctrineAssert\OrganizationalUniqueEntity(
 *     fields={"usedCoupon"},
 *     ignoreNull=true,
 *     allFilters=true
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     fieldLabel="reference",
 *     defaultSortable="receipted_at:desc, status.position:asc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Repair extends AbstractRepair
{
    use IdTrait;
}
