<?php

namespace App\Entity;

use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\DoctrineExtensionsExtra\Validator\Constraints as KlipperDoctrineExtensionsExtraAssert;
use Klipper\Component\Model\Traits\EnableInterface;
use Klipper\Component\Model\Traits\EnableTrait;
use Klipper\Component\Model\Traits\IdInterface;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\LabelableInterface;
use Klipper\Component\Model\Traits\LabelableTrait;
use Klipper\Component\Model\Traits\NameableInterface;
use Klipper\Component\Model\Traits\OrganizationGroupsInterface;
use Klipper\Component\Model\Traits\OrganizationGroupsTrait;
use Klipper\Component\Model\Traits\OrganizationRolesInterface;
use Klipper\Component\Model\Traits\OrganizationRolesTrait;
use Klipper\Component\Model\Traits\OrganizationTrait;
use Klipper\Component\Model\Traits\RoleableInterface;
use Klipper\Component\Model\Traits\RoleableTrait;
use Klipper\Component\Model\Traits\TimestampableInterface;
use Klipper\Component\Model\Traits\TimestampableTrait;
use Klipper\Component\SecurityExtra\Annotation as KlipperSecurityExtra;
use Doctrine\ORM\Mapping as ORM;
use Klipper\Component\DoctrineExtensions\Validator\Constraints as KlipperAssert;
use Klipper\Component\Security\Annotation as KlipperSecurity;
use Klipper\Component\Security\Model\OrganizationInterface;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrganizationRepository")
 *
 * @KlipperAssert\UniqueEntity(
 *     fields={"name"},
 *     repositoryMethod="findByInsensitive",
 *     allFilters=true
 * )
 *
 * @KlipperSecurity\Permission
 *
 * @KlipperSecurity\SharingIdentity(
 *     permissible="true"
 * )
 *
 * @KlipperSecurityExtra\SharingEntry(
 *     field="name",
 *     repositoryMethod="findByNames"
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     availableContexts={"user"}
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Organization implements
    EnableInterface,
    IdInterface,
    LabelableInterface,
    NameableInterface,
    OrganizationInterface,
    OrganizationGroupsInterface,
    OrganizationRolesInterface,
    RoleableInterface,
    TimestampableInterface
{
    use EnableTrait;
    use IdTrait;
    use LabelableTrait;
    use OrganizationTrait;
    use OrganizationGroupsTrait;
    use OrganizationRolesTrait;
    use RoleableTrait;
    use TimestampableTrait;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     *
     * @Assert\Type(type="boolean")
     *
     * @Serializer\Expose
     */
    protected $enabled = true;

    /**
     * @ORM\Column(type="json")
     *
     * @KlipperDoctrineExtensionsExtraAssert\EntityChoice("App\Entity\Role", multiple=true)
     *
     * @Serializer\Expose
     */
    protected $roles = [];
}