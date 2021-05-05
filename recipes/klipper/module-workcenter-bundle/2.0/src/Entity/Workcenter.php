<?php

namespace App\Entity;

use App\Repository\WorkcenterRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\WorkcenterBundle\Model\AbstractWorkcenter;

/**
 * @ORM\Entity(repositoryClass=WorkcenterRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_workcenter_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_workcenter_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_workcenter_label", columns={"label"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="label:asc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Workcenter extends AbstractWorkcenter
{
    use IdTrait;
}
