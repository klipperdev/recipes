<?php

namespace App\Entity;

use App\Entity\Traits\AccountPortalableTrait;
use App\Repository\DepositSaleAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\DepositSaleBundle\Model\AbstractDepositSaleAttachment;

/**
 * @ORM\Entity(repositoryClass=DepositSaleAttachmentRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_deposit_sale_attachment_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_deposit_sale_attachment_updated_at", columns={"updated_at"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     fieldLabel="name",
 *     defaultSortable="name:asc",
 *     excludedDefaultActions={
 *         "create",
 *         "creates",
 *         "upsert",
 *         "upserts",
 *         "import"
 *     }
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class DepositSaleAttachment extends AbstractDepositSaleAttachment
{
    use IdTrait;
}
