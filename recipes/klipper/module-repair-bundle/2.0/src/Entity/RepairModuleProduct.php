<?php

namespace App\Entity;

use App\Repository\RepairModuleProductRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;
use Klipper\Module\RepairBundle\Model\AbstractRepairModuleProduct;

/**
 * @ORM\Entity(repositoryClass=RepairModuleProductRepository::class)
 *
 * @KlipperSecurityDoctrineAssert\OrganizationalUniqueEntity(
 *     fields={"organization", "repairModule", "product"},
 *     ignoreNull=false,
 *     allFilters=true
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="product.name:asc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class RepairModuleProduct extends AbstractRepairModuleProduct
{
    use IdTrait;
}
