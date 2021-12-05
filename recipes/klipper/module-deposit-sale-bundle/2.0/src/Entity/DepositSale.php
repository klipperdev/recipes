<?php

namespace App\Entity;

use App\Entity\Traits\AccountPortalableTrait;
use App\Repository\DepositSaleRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;
use Klipper\Module\DepositSaleBundle\Model\AbstractDepositSale;

/**
 * @ORM\Entity(repositoryClass=DepositSaleRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_deposit_sale_external_id", columns={"external_id"}),
 *         @ORM\Index(name="idx_deposit_sale_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_deposit_sale_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_deposit_sale_reference", columns={"reference"})
 *     }
 * )
 *
 * @KlipperSecurityDoctrineAssert\OrganizationalUniqueEntity(
 *     fields={"organization", "reference"},
 *     errorPath="reference",
 *     repositoryMethod="findBy",
 *     ignoreNull=true,
 *     allFilters=true
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     fieldLabel="reference",
 *     deepSearchPaths={"device", "product", "account"},
 *     defaultSortable="receipted_at:desc, status.position:asc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class DepositSale extends AbstractDepositSale
{
    use IdTrait;
}
