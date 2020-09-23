<?php

namespace App\Entity;

use App\Repository\PortalRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensions\Validator\Constraints as KlipperAssert;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\EnableTrait;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\LabelableTrait;
use Klipper\Component\Model\Traits\NameableTrait;
use Klipper\Component\Model\Traits\OrganizationalRequiredInterface;
use Klipper\Component\Model\Traits\OrganizationalRequiredTrait;
use Klipper\Component\Model\Traits\TimestampableInterface;
use Klipper\Component\Model\Traits\TimestampableTrait;
use Klipper\Component\Model\Traits\UserTrackableInterface;
use Klipper\Component\Model\Traits\UserTrackableTrait;
use Klipper\Component\Portal\Model\PortalInterface;
use Klipper\Component\Portal\Model\Traits\PortalTrait;

/**
 * @ORM\Entity(repositoryClass=PortalRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_portal_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_portal_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_portal_name", columns={"name"}),
 *         @ORM\Index(name="idx_portal_label", columns={"label"}),
 *         @ORM\Index(name="idx_portal_enabled", columns={"enabled"})
 *     }
 * )
 *
 * @KlipperAssert\UniqueEntity(
 *     fields={"name"},
 *     repositoryMethod="findByInsensitive",
 *     allFilters=true
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     availableContexts={"organization"},
 *     buildDefaultActions=false,
 *     actions={
 *         @KlipperMetadata\MetadataAction(name="list"),
 *         @KlipperMetadata\MetadataAction(name="create")
 *     },
 *     defaultSortable="label:asc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Portal implements
    PortalInterface,
    OrganizationalRequiredInterface,
    TimestampableInterface,
    UserTrackableInterface
{
    use IdTrait;
    use EnableTrait;
    use LabelableTrait;
    use NameableTrait;
    use OrganizationalRequiredTrait;
    use PortalTrait;
    use TimestampableTrait;
    use UserTrackableTrait;
}
