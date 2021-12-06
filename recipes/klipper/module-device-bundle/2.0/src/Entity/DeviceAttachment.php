<?php

namespace App\Entity;

use App\Repository\DeviceAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\SingleExternalableInterface;
use Klipper\Component\Model\Traits\SingleExternalableTrait;
use Klipper\Component\Portal\Model\AllowedPortalableInterface;
use Klipper\Module\DeviceBundle\Model\AbstractDeviceAttachment;

/**
 * @ORM\Entity(repositoryClass=DeviceAttachmentRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_device_attachment_external_id", columns={"external_id"}),
 *         @ORM\Index(name="idx_device_attachment_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_device_attachment_updated_at", columns={"updated_at"})
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
class DeviceAttachment extends AbstractDeviceAttachment implements
    SingleExternalableInterface,
    AllowedPortalableInterface
{
    use IdTrait;
    use SingleExternalableTrait;
}
