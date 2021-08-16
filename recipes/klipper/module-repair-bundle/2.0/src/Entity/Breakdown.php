<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\TranslatableInterface;
use Klipper\Component\Model\Traits\TranslatableTrait;
use Klipper\Component\SecurityExtra\Annotation as KlipperSecurityExtra;
use Klipper\Module\RepairBundle\Model\AbstractBreakdown;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BreakdownRepository")
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_breakdown_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_breakdown_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_breakdown_label", columns={"label"})
 *     }
 * )
 *
 * @Gedmo\TranslationEntity(class="App\Entity\BreakdownTranslation")
 *
 * @KlipperSecurityExtra\OrganizationalFilterOptionalAllFilterClass
 *
 * @KlipperMetadata\MetadataObject
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Breakdown extends AbstractBreakdown implements
    TranslatableInterface
{
    use IdTrait;
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
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\BreakdownTranslation",
     *     fetch="EXTRA_LAZY",
     *     mappedBy="object",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    protected ?Collection $translations = null;
}
