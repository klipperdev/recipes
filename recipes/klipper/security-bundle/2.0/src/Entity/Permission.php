<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Klipper\Component\Model\Traits\IdInterface;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\LabelableInterface;
use Klipper\Component\Model\Traits\LabelableTrait;
use Klipper\Component\Model\Traits\PermissionSharingEntryInterface;
use Klipper\Component\Model\Traits\PermissionSharingEntryTrait;
use Klipper\Component\Model\Traits\PermissionTrait;
use Klipper\Component\Model\Traits\TranslationDomainInterface;
use Klipper\Component\Model\Traits\TranslationDomainTrait;
use Klipper\Component\Security\Model\PermissionInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PermissionRepository")
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_permission_operation", columns={"operation"}),
 *         @ORM\Index(name="idx_permission_class", columns={"class"}),
 *         @ORM\Index(name="idx_permission_field", columns={"field"})
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="uniq_permission", columns={"operation", "class", "field"})
 *     }
 * )
 */
class Permission implements
    IdInterface,
    LabelableInterface,
    PermissionInterface,
    PermissionSharingEntryInterface,
    TranslationDomainInterface
{
    use IdTrait;
    use LabelableTrait;
    use PermissionSharingEntryTrait;
    use PermissionTrait;
    use TranslationDomainTrait;
}
