<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Component\Model\Traits\ImagePathTrait;
use Klipper\Component\Model\Traits\TimestampableTrait;
use Klipper\Component\User\Model\ProfileInterface;
use Klipper\Component\User\Model\Traits\ProfileTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfileRepository")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Profile implements ProfileInterface
{
    use IdTrait;
    use ProfileTrait;
    use TimestampableTrait;
    use ImagePathTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @Serializer\Exclude
     * @Serializer\ReadOnly
     */
    protected ?int $id = null;
}
