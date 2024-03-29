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
use Klipper\Module\BuybackBundle\Model\AbstractAuditCondition;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuditConditionRepository")
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_audit_condition_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_audit_condition_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_audit_condition_state", columns={"state"}),
 *         @ORM\Index(name="idx_audit_condition_name", columns={"name"}),
 *         @ORM\Index(name="idx_audit_condition_label", columns={"label"})
 *     }
 * )
 *
 * @Gedmo\TranslationEntity(class="App\Entity\AuditConditionTranslation")
 *
 * @KlipperSecurityExtra\OrganizationalFilterOptionalAllFilterClass
 *
 * @KlipperMetadata\MetadataObject
 *
 * @Serializer\ExclusionPolicy("all")
 */
class AuditCondition extends AbstractAuditCondition implements TranslatableInterface
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
     *     targetEntity="App\Entity\AuditConditionTranslation",
     *     fetch="EXTRA_LAZY",
     *     mappedBy="object",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    protected ?Collection $translations = null;
}
