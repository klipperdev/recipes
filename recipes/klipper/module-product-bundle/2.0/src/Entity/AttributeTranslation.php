<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Klipper\Component\DoctrineExtensionsExtra\Model\BaseTranslation;

/**
 * @ORM\Entity
 */
class AttributeTranslation extends BaseTranslation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\Attribute",
     *     inversedBy="translations"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     */
    protected $object;
}
