<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\SingleExternalableInterface;
use Klipper\Component\Model\Traits\SingleExternalableTrait;
use Klipper\Component\Model\Traits\TranslatableInterface;
use Klipper\Component\Model\Traits\TranslatableTrait;
use Klipper\Component\SecurityExtra\Annotation as KlipperSecurityExtra;
use Klipper\Module\RepairBundle\Model\AbstractRepairStatus;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RepairStatusRepository")
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_repair_status_external_id", columns={"external_id"}),
 *         @ORM\Index(name="idx_repair_status_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_repair_status_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_repair_status_label", columns={"label"}),
 *         @ORM\Index(name="idx_repair_status_name", columns={"name"})
 *     }
 * )
 *
 * @Gedmo\TranslationEntity(class="App\Entity\RepairStatusTranslation")
 *
 * @KlipperSecurityExtra\OrganizationalFilterOptionalAllFilterClass
 *
 * @KlipperMetadata\MetadataObject
 *
 * @Serializer\ExclusionPolicy("all")
 */
class RepairStatus extends AbstractRepairStatus implements SingleExternalableInterface, TranslatableInterface
{
    use IdTrait;
    use SingleExternalableTrait;
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
     *     targetEntity="App\Entity\RepairStatusTranslation",
     *     fetch="EXTRA_LAZY",
     *     mappedBy="object",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    protected ?Collection $translations = null;
}
