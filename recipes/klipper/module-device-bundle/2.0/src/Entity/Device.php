<?php

namespace App\Entity;

use App\Repository\DeviceRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;
use Klipper\Module\DeviceBundle\Model\AbstractDevice;

/**
 * @ORM\Entity(repositoryClass=DeviceRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_device_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_device_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_device_serial_number", columns={"serial_number"}),
 *         @ORM\Index(name="idx_device_imei", columns={"imei"}),
 *         @ORM\Index(name="idx_device_imei2", columns={"imei2"}),
 *         @ORM\Index(name="idx_device_terminated_at", columns={"terminated_at"})
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="uniq_device_organization_value", columns={"organization_id", "serial_number", "imei"})
 *     }
 * )
 *
 * @KlipperSecurityDoctrineAssert\OrganizationalUniqueEntity(
 *     fields={"organization", "serialNumber", "imei"},
 *     repositoryMethod="findBy",
 *     ignoreNull=true,
 *     allFilters=true
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     fieldLabel="label",
 *     deepSearchPaths={"product"},
 *     defaultSortable="updated_at:desc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Device extends AbstractDevice
{
    use IdTrait;
}
