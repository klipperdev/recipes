<?php

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\PartnerBundle\Model\AbstractAccount;

/**
 * @ORM\Entity(repositoryClass=AccountRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_account_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_account_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_account_name", columns={"name"}),
 *         @ORM\Index(name="idx_account_street", columns={"street"}),
 *         @ORM\Index(name="idx_account_street_complement", columns={"street_complement"}),
 *         @ORM\Index(name="idx_account_postal_code", columns={"postal_code"}),
 *         @ORM\Index(name="idx_account_city", columns={"city"}),
 *         @ORM\Index(name="idx_account_state", columns={"state"}),
 *         @ORM\Index(name="idx_account_country", columns={"country"}),
 *         @ORM\Index(name="idx_account_website_url", columns={"website_url"}),
 *         @ORM\Index(name="idx_account_email", columns={"email"}),
 *         @ORM\Index(name="idx_account_phone", columns={"phone"}),
 *         @ORM\Index(name="idx_account_fax", columns={"fax"}),
 *         @ORM\Index(name="idx_account_account_number", columns={"account_number"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     defaultSortable="updated_at:desc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Account extends AbstractAccount
{
    use IdTrait;
}
