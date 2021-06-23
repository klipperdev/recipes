<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\BuybackBundle\Model\AbstractAuditWorkflowStep;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuditWorkflowStepRepository")
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_audit_workflow_step_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_audit_workflow_step_updated_at", columns={"updated_at"}),
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject
 *
 * @Serializer\ExclusionPolicy("all")
 */
class AuditWorkflowStep extends AbstractAuditWorkflowStep
{
    use IdTrait;
}
