<?php

namespace App\Entity;

use App\Repository\PriceListRuleRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\ProductBundle\Model\AbstractPriceListRule;

/**
 * @ORM\Entity(repositoryClass=PriceListRuleRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_price_list_rule_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_price_list_rule_updated_at", columns={"updated_at"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="position:asc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class PriceListRule extends AbstractPriceListRule
{
    use IdTrait;
}
