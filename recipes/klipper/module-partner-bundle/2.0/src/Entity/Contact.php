<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\PartnerBundle\Model\AbstractContact;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_contact_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_contact_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_contact_first_name", columns={"first_name"}),
 *         @ORM\Index(name="idx_contact_last_name", columns={"last_name"}),
 *         @ORM\Index(name="idx_contact_email", columns={"email"}),
 *         @ORM\Index(name="idx_contact_phone", columns={"phone"}),
 *         @ORM\Index(name="idx_contact_mobile_phone", columns={"mobile_phone"}),
 *         @ORM\Index(name="idx_contact_fax", columns={"fax"}),
 *         @ORM\Index(name="idx_contact_website_url", columns={"website_url"}),
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="updated_at:desc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Contact extends AbstractContact
{
    use IdTrait;
}
