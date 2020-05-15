<?php

namespace App\Entity;

use Klipper\Component\DoctrineExtensionsExtra\Model\BaseTranslation;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class GroupTranslation extends BaseTranslation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\Group",
     *     inversedBy="translations"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     */
    protected $object;
}
