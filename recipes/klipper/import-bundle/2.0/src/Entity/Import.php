<?php

namespace App\Entity;

use App\Repository\ImportRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Import\Model\AbstractImport;
use Klipper\Component\Model\Traits\IdTrait;

/**
 * @ORM\Entity(repositoryClass=ImportRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_import_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_import_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_import_metadata", columns={"metadata"}),
 *         @ORM\Index(name="idx_import_adapter", columns={"adapter"}),
 *         @ORM\Index(name="idx_import_status", columns={"status"}),
 *         @ORM\Index(name="idx_import_started_at", columns={"started_at"}),
 *         @ORM\Index(name="idx_import_ended_at", columns={"ended_at"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="created_at:desc",
 *     buildDefaultActions=false,
 *     actions={
 *         @KlipperMetadata\MetadataAction(name="list"),
 *         @KlipperMetadata\MetadataAction(name="view"),
 *         @KlipperMetadata\MetadataAction(name="delete"),
 *         @KlipperMetadata\MetadataAction(name="deletes")
 *     }
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Import extends AbstractImport
{
    use IdTrait;
}
