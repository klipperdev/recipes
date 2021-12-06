<?php

namespace App\Repository;

use App\Entity\DeviceAttachment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|DeviceAttachment find($id, $lockMode = null, $lockVersion = null)
 * @method null|DeviceAttachment findOneBy(array $criteria, array $orderBy = null)
 * @method DeviceAttachment[]    findAll()
 * @method DeviceAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeviceAttachmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeviceAttachment::class);
    }

    public function createQueryBuilderForList(string $alias, ?string $indexBy = null): QueryBuilder
    {
        return $this->createQueryBuilder($alias, $indexBy)
            ->addSelect('d')
            ->leftJoin($alias.'.device', 'd')
        ;
    }
}
