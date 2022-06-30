<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\BuybackBundle\Model\AbstractAuditBatch;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuditBatchRepository")
 *
 * @KlipperMetadata\MetadataObject(
 *     fieldLabel="reference",
 *     defaultSortable="created_at:desc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class AuditBatch extends AbstractAuditBatch
{
    use IdTrait;
}
