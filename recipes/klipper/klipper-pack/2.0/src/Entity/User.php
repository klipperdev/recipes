<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensions\Validator\Constraints as KlipperAssert;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\DoctrineExtensionsExtra\Validator\Constraints as KlipperDoctrineExtensionsAssert;
use Klipper\Component\Model\Traits\EditGroupableInterface;
use Klipper\Component\Model\Traits\EditGroupableTrait;
use Klipper\Component\Model\Traits\EmailableInterface;
use Klipper\Component\Model\Traits\EmailableTrait;
use Klipper\Component\Model\Traits\IdInterface;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\LocaleableInterface;
use Klipper\Component\Model\Traits\OrganizationalRequiredInterface;
use Klipper\Component\Model\Traits\OrganizationalRequiredTrait;
use Klipper\Component\Model\Traits\RoleableTrait;
use Klipper\Component\Model\Traits\TimestampableInterface;
use Klipper\Component\Model\Traits\TimestampableTrait;
use Klipper\Component\Model\Traits\TimezoneableInterface;
use Klipper\Component\Model\Traits\UserOrganizationUsersInterface;
use Klipper\Component\Model\Traits\UserOrganizationUsersTrait;
use Klipper\Component\Model\Traits\UserTrait;
use Klipper\Component\Security\Annotation as KlipperSecurity;
use Klipper\Component\Security\Model\OrganizationInterface;
use Klipper\Component\Security\Model\UserInterface;
use Klipper\Component\SecurityExtra\Annotation as KlipperSecurityExtra;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;
use Klipper\Component\SecurityExtra\Validator\Constraints as KlipperSecurityAssert;
use Klipper\Component\User\Model\Traits\ProfileableInterface;
use Klipper\Component\User\Model\Traits\ProfileableTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @ORM\AssociationOverrides({
 *     @ORM\AssociationOverride(
 *         name="groups",
 *         joinTable=@ORM\JoinTable(name="user_group")
 *     )
 * })
 *
 * @KlipperAssert\UniqueEntity(
 *     fields={"username"},
 *     repositoryMethod="findByInsensitive",
 *     allFilters=true,
 *     message="user.username.already_used"
 * )
 *
 * @KlipperAssert\UniqueEntity(
 *     fields={"email"},
 *     repositoryMethod="findByInsensitive",
 *     allFilters=true,
 *     message="user.email.already_used"
 * )
 *
 * @KlipperSecurityDoctrineAssert\UsernameSameOrgName
 *
 * @KlipperSecurity\Permission
 *
 * @KlipperSecurity\SharingIdentity(
 *     roleable="true",
 *     permissible="true"
 * )
 *
 * @KlipperSecurityExtra\SharingEntry(
 *     field="username",
 *     repositoryMethod="findByUsernames"
 * )
 *
 * @KlipperMetadata\MetadataObject
 *
 * @Serializer\ExclusionPolicy("all")
 */
class User implements
    UserInterface,
    IdInterface,
    EmailableInterface,
    EditGroupableInterface,
    LocaleableInterface,
    OrganizationalRequiredInterface,
    TimestampableInterface,
    TimezoneableInterface,
    ProfileableInterface,
    UserOrganizationUsersInterface
{
    use IdTrait;
    use UserTrait;
    use EmailableTrait;
    use EditGroupableTrait;
    use OrganizationalRequiredTrait;
    use UserOrganizationUsersTrait;
    use RoleableTrait;
    use TimestampableTrait;
    use ProfileableTrait;

    /**
     * @ORM\OneToOne(
     *     targetEntity="App\Entity\Organization",
     *     mappedBy="user",
     *     fetch="EAGER",
     *     orphanRemoval=true,
     *     cascade={"persist", "remove"}
     * )
     *
     * @Assert\Valid
     *
     * @Serializer\Type("Relation")
     * @Serializer\Expose
     * @Serializer\ReadOnly
     */
    protected ?OrganizationInterface $organization = null;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     *
     * @Assert\Length(max=50)
     * @Assert\Regex(pattern="/^[A-Za-z0-9\_\-.]+$/")
     *
     * @Serializer\Expose
     *
     * @KlipperSecurityAssert\IsReservedName
     */
    protected ?string $username = null;

    /**
     * @ORM\Column(type="json")
     *
     * @KlipperDoctrineExtensionsAssert\EntityChoice(
     *     "App\Entity\Role",
     *     namePath="name",
     *     multiple=true,
     *     filters={"role"}
     * )
     *
     * @Serializer\Expose
     * @Serializer\ReadOnly
     * @Serializer\Groups({"ROLE_ADMIN_PLATFORM", "CurrentUser"})
     */
    protected array $roles = [];

    /**
     * @var null|string The hashed password
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(groups={"edit"})
     */
    protected ?string $password = null;

    /**
     * @see LocaleableInterface::getLocale()
     */
    public function getLocale(): ?string
    {
        return null;
    }

    /**
     * @see TimezoneableInterface::getTimezone()
     */
    public function getTimezone(): ?string
    {
        return null;
    }
}
