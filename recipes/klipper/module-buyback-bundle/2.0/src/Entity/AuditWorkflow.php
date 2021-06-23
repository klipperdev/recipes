<?php

namespace App\Entity;

use App\Repository\AuditWorkflowRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\BuybackBundle\Model\AbstractAuditWorkflow;

/**
 * @ORM\Entity(repositoryClass=AuditWorkflowRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_audit_workflow_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_audit_workflow_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_audit_workflow_label", columns={"label"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="updated_at:desc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class AuditWorkflow extends AbstractAuditWorkflow
{
    use IdTrait;
}
