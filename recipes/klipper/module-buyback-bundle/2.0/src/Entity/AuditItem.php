<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\BuybackBundle\Model\AbstractAuditItem;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuditItemRepository")
 *
 * @KlipperMetadata\MetadataObject(
 *     deepSearchPaths={"audit_request", "device", "product"}
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class AuditItem extends AbstractAuditItem
{
    use IdTrait;
}
