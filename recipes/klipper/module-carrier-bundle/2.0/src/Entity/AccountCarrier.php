<?php

namespace App\Entity;

use App\Repository\AccountCarrierRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\CarrierBundle\Model\AbstractAccountCarrier;

/**
 * @ORM\Entity(repositoryClass=AccountCarrierRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_account_carrier_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_account_carrier_updated_at", columns={"updated_at"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="carrier.name:asc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class AccountCarrier extends AbstractAccountCarrier
{
    use IdTrait;
}
