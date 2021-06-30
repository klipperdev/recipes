<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\BuybackBundle\Model\AbstractAuditRequest;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuditRequestRepository")
 *
 * @KlipperMetadata\MetadataObject
 *
 * @Serializer\ExclusionPolicy("all")
 */
class AuditRequest extends AbstractAuditRequest
{
    use IdTrait;
}
