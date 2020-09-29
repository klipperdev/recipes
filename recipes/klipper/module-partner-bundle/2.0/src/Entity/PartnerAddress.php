<?php

namespace App\Entity;

use App\Repository\PartnerAddressRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\PartnerBundle\Model\AbstractPartnerAddress;

/**
 * @ORM\Entity(repositoryClass=PartnerAddressRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_partner_address_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_partner_address_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_partner_address_label", columns={"label"}),
 *         @ORM\Index(name="idx_partner_address_street", columns={"street"}),
 *         @ORM\Index(name="idx_partner_address_street_complement", columns={"street_complement"}),
 *         @ORM\Index(name="idx_partner_address_postal_code", columns={"postal_code"}),
 *         @ORM\Index(name="idx_partner_address_city", columns={"city"}),
 *         @ORM\Index(name="idx_partner_address_state", columns={"state"}),
 *         @ORM\Index(name="idx_partner_address_country", columns={"country"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="label:asc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class PartnerAddress extends AbstractPartnerAddress
{
    use IdTrait;
}
