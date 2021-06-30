<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\BuybackBundle\Model\AbstractAuditRequestItem;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuditRequestItemRepository")
 *
 * @KlipperMetadata\MetadataObject
 *
 * @Serializer\ExclusionPolicy("all")
 */
class AuditRequestItem extends AbstractAuditRequestItem
{
    use IdTrait;
}
