<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\BuybackBundle\Model\AbstractAuditBatchRequestItem;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuditBatchRequestItemRepository")
 *
 * @ORM\Table(
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="uniq_audit_batch_request_item_product_product_combination", columns={"organization_id", "audit_batch_id", "product_id", "product_combination_id"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject
 *
 * @Serializer\ExclusionPolicy("all")
 */
class AuditBatchRequestItem extends AbstractAuditBatchRequestItem
{
    use IdTrait;
}
