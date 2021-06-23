<?php

namespace App\Entity;

use App\Repository\BuybackModuleRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Portal\Model\AllowedPortalableInterface;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;
use Klipper\Module\BuybackBundle\Model\AbstractBuybackModule;

/**
 * @ORM\Entity(repositoryClass=BuybackModuleRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_buyback_module_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_buyback_module_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_buyback_module_enabled", columns={"enabled"}),
 *         @ORM\Index(name="idx_buyback_module_identifier_type", columns={"identifier_type"})
 *     }
 * )
 *
 * @KlipperSecurityDoctrineAssert\OrganizationalUniqueEntity(
 *     fields={"organization", "account"},
 *     ignoreNull=false,
 *     allFilters=true
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="label:asc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class BuybackModule extends AbstractBuybackModule implements AllowedPortalableInterface
{
    use IdTrait;
}
