<?php

namespace App\Repository;

use App\Entity\RepairComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|RepairComment find($id, $lockMode = null, $lockVersion = null)
 * @method null|RepairComment findOneBy(array $criteria, array $orderBy = null)
 * @method RepairComment[]    findAll()
 * @method RepairComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepairCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RepairComment::class);
    }
}
