<?php

namespace App\Entity;

use App\Repository\RepairModuleRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\RepairBundle\Model\AbstractRepairModule;

/**
 * @ORM\Entity(repositoryClass=RepairModuleRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_repair_module_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_repair_module_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_repair_module_enabled", columns={"enabled"}),
 *         @ORM\Index(name="idx_repair_module_internal_contract_reference", columns={"internal_contract_reference"}),
 *         @ORM\Index(name="idx_repair_module_customer_reference", columns={"customer_reference"}),
 *         @ORM\Index(name="idx_repair_module_type", columns={"type"}),
 *         @ORM\Index(name="idx_repair_module_swap", columns={"swap"}),
 *         @ORM\Index(name="idx_repair_module_identifier_type", columns={"identifier_type"}),
 *         @ORM\Index(name="idx_repair_module_price_calculation", columns={"price_calculation"}),
 *         @ORM\Index(name="idx_repair_module_repair_time_in_day", columns={"repair_time_in_day"}),
 *         @ORM\Index(name="idx_repair_module_warranty_length_in_month", columns={"warranty_length_in_month"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="label:asc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class RepairModule extends AbstractRepairModule
{
    use IdTrait;
}
