<?php

namespace App\Entity;

use App\Repository\DepositSaleModuleRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;
use Klipper\Module\DepositSaleBundle\Model\AbstractDepositSaleModule;

/**
 * @ORM\Entity(repositoryClass=DepositSaleModuleRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_deposit_sale_module_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_deposit_sale_module_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_deposit_sale_module_enabled", columns={"enabled"})
 *     }
 * )
 *
 * @KlipperSecurityDoctrineAssert\OrganizationalUniqueEntity(
 *     fields={"organization", "account"},
 *     ignoreNull=false,
 *     allFilters=true
 * )
 *
 * @KlipperMetadata\MetadataObject
 *
 * @Serializer\ExclusionPolicy("all")
 */
class DepositSaleModule extends AbstractDepositSaleModule
{
    use IdTrait;
}
