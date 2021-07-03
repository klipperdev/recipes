<?php

namespace App\Repository;

use App\Entity\BuybackOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|BuybackOffer find($id, $lockMode = null, $lockVersion = null)
 * @method null|BuybackOffer findOneBy(array $criteria, array $orderBy = null)
 * @method BuybackOffer[]    findAll()
 * @method BuybackOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuybackOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuybackOffer::class);
    }
}
