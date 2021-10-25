<?php

namespace App\Entity;

use App\Repository\AutoNumberConfigRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\AutoNumberable\Model\AutoNumberConfigInterface;
use Klipper\Component\DoctrineExtensionsExtra\AutoNumberable\Model\Traits\AutoNumberConfigTrait;
use Klipper\Component\Model\Traits\IdInterface;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\OrganizationalRequiredInterface;
use Klipper\Component\Model\Traits\OrganizationalRequiredTrait;

/**
 * @ORM\Entity(
 *     repositoryClass=AutoNumberConfigRepository::class
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class AutoNumberConfig implements
    AutoNumberConfigInterface,
    IdInterface,
    OrganizationalRequiredInterface
{
    use AutoNumberConfigTrait;
    use IdTrait;
    use OrganizationalRequiredTrait;
}
