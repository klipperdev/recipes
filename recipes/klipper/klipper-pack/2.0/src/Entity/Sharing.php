<?php

namespace App\Entity;

use Klipper\Component\Model\Traits\IdInterface;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\SharingTrait;
use Klipper\Component\SecurityExtra\Validator\Constraints as KlipperSecurityExtraAssert;
use Doctrine\ORM\Mapping as ORM;
use Klipper\Component\DoctrineExtensions\Validator\Constraints as KlipperAssert;
use Klipper\Component\Security\Model\SharingInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SharingRepository")
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_sharing_subject_class", columns={"subject_class"}),
 *         @ORM\Index(name="idx_sharing_subject_id", columns={"subject_id"}),
 *         @ORM\Index(name="idx_sharing_identity_class", columns={"identity_class"}),
 *         @ORM\Index(name="idx_sharing_identity_name", columns={"identity_name"})
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="uniq_sharing", columns={"subject_class", "subject_id", "identity_class", "identity_name"})
 *     }
 * )
 *
 * @ORM\AssociationOverrides({
 *     @ORM\AssociationOverride(
 *         name="permissions",
 *         joinTable=@ORM\JoinTable(name="sharing_permission")
 *     )
 * })
 *
 * @KlipperSecurityExtraAssert\Sharing
 *
 * @KlipperAssert\UniqueEntity(
 *     fields={"subjectClass", "subjectId", "identityClass", "identityName"},
 *     allFilters=true,
 *     message="sharing.already_exists"
 * )
 */
class Sharing implements
    SharingInterface,
    IdInterface
{
    use IdTrait;
    use SharingTrait;
}
