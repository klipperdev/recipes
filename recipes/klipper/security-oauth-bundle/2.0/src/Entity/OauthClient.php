<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensions\Validator\Constraints as KlipperDoctrineAssert;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\EnableTrait;
use Klipper\Component\Model\Traits\IdInterface;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\LabelableInterface;
use Klipper\Component\Model\Traits\LabelableTrait;
use Klipper\Component\Model\Traits\NameableTrait;
use Klipper\Component\Model\Traits\OrganizationalRequiredInterface;
use Klipper\Component\Model\Traits\OrganizationalRequiredTrait;
use Klipper\Component\Model\Traits\TimestampableInterface;
use Klipper\Component\Model\Traits\TimestampableTrait;
use Klipper\Component\Model\Traits\TranslatableInterface;
use Klipper\Component\Model\Traits\TranslatableTrait;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;
use Klipper\Component\SecurityOauth\Model\OauthClientInterface;
use Klipper\Component\SecurityOauth\Model\Traits\OauthClientTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OauthClientRepository")
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_oauth_client_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_oauth_client_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_oauth_client_name", columns={"name"}),
 *         @ORM\Index(name="idx_oauth_client_label", columns={"label"}),
 *         @ORM\Index(name="idx_oauth_client_enabled", columns={"enabled"})
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="uniq_oauth_client_organization_name", columns={"organization_id", "name"}),
 *         @ORM\UniqueConstraint(name="uniq_oauth_client_organization_client_id", columns={"client_id"})
 *     }
 * )
 *
 * @ORM\AttributeOverrides({
 *     @ORM\AttributeOverride(name="name", column=@ORM\Column(unique=false))
 * })
 *
 * @Gedmo\TranslationEntity(class="App\Entity\OauthClientTranslation")
 *
 * @KlipperSecurityDoctrineAssert\OrganizationalUniqueEntity(
 *     fields={"organization", "name"},
 *     repositoryMethod="findByInsensitive",
 *     ignoreNull=false,
 *     allFilters=true
 * )
 *
 * @KlipperDoctrineAssert\UniqueEntity(
 *     fields={"clientId"},
 *     ignoreNull=false,
 *     allFilters=true
 * )
 *
 * @KlipperMetadata\MetadataObject
 *
 * @Serializer\ExclusionPolicy("all")
 */
class OauthClient implements
    OauthClientInterface,
    IdInterface,
    LabelableInterface,
    OrganizationalRequiredInterface,
    TimestampableInterface,
    TranslatableInterface
{
    use EnableTrait;
    use IdTrait;
    use LabelableTrait;
    use NameableTrait;
    use OauthClientTrait;
    use OrganizationalRequiredTrait;
    use TimestampableTrait;
    use TranslatableTrait;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Gedmo\Translatable
     *
     * @Assert\Type(type="string")
     * @Assert\Length(max=255)
     *
     * @Serializer\Expose
     */
    protected ?string $label = null;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\OauthClientTranslation",
     *     fetch="EXTRA_LAZY",
     *     mappedBy="object",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    protected ?Collection $translations = null;
}
