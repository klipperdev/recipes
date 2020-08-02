<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\ListView\Model\ListViewInterface;
use Klipper\Component\ListView\Model\Traits\ListViewTrait;
use Klipper\Component\Model\Traits\IdInterface;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\OrganizationalOptionalInterface;
use Klipper\Component\Model\Traits\OrganizationalOptionalTrait;
use Klipper\Component\Model\Traits\TimestampableInterface;
use Klipper\Component\Model\Traits\TimestampableTrait;
use Klipper\Component\Model\Traits\TranslatableInterface;
use Klipper\Component\Model\Traits\TranslatableTrait;
use Klipper\Component\Security\Model\OrganizationInterface;
use Klipper\Component\SecurityExtra\Doctrine\Validator\Constraints as KlipperSecurityDoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ListViewRepository")
 *
 * @ORM\Table(
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="uniq_list_view_organization_value", columns={"organization_id", "type", "name"})
 *     }
 * )
 *
 * @Gedmo\TranslationEntity(class="App\Entity\ListViewTranslation")
 *
 * @KlipperSecurityDoctrineAssert\OrganizationalUniqueEntity(
 *     fields={"type", "name"},
 *     repositoryMethod="findByInsensitive",
 *     ignoreNull=false,
 *     allFilters=true
 * )
 *
 * @KlipperMetadata\MetadataObject
 *
 * @Serializer\ExclusionPolicy("all")
 */
class ListView implements
    ListViewInterface,
    IdInterface,
    OrganizationalOptionalInterface,
    TimestampableInterface,
    TranslatableInterface
{
    use ListViewTrait;
    use IdTrait;
    use OrganizationalOptionalTrait;
    use TimestampableTrait;
    use TranslatableTrait;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Gedmo\Translatable
     *
     * @Assert\Type(type="string")
     * @Assert\Length(max=255)
     * @Assert\NotBlank
     *
     * @Serializer\Expose
     */
    protected ?string $label = null;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\Organization",
     *     fetch="EXTRA_LAZY"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     *
     * @Serializer\Type("Relation")
     * @Serializer\Expose
     * @Serializer\ReadOnly
     */
    protected ?OrganizationInterface $organization = null;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\ListViewTranslation",
     *     mappedBy="object",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    protected ?Collection $translations = null;
}
