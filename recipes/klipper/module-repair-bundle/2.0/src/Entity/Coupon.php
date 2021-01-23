<?php

namespace App\Entity;

use App\Repository\CouponRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Klipper\Component\DoctrineExtensionsExtra\Mapping\Annotation as KlipperMetadata;
use Klipper\Component\Model\Traits\IdTrait;
use Klipper\Module\RepairBundle\Model\AbstractCoupon;

/**
 * @ORM\Entity(repositoryClass=CouponRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="idx_coupon_created_at", columns={"created_at"}),
 *         @ORM\Index(name="idx_coupon_updated_at", columns={"updated_at"}),
 *         @ORM\Index(name="idx_coupon_reference", columns={"reference"}),
 *         @ORM\Index(name="idx_coupon_internal_contract_reference", columns={"internal_contract_reference"}),
 *         @ORM\Index(name="idx_coupon_supplier_reference", columns={"supplier_reference"}),
 *         @ORM\Index(name="idx_coupon_valid_until", columns={"valid_until"})
 *     }
 * )
 *
 * @KlipperMetadata\MetadataObject(
 *     pluralName="coupons",
 *     fieldLabel="reference",
 *     defaultSortable="created_at:desc"
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Coupon extends AbstractCoupon
{
    use IdTrait;
}
