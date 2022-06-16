<?php

namespace App\Repository;

use App\Entity\RepairStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Gedmo\Sortable\Entity\Repository\SortableRepository;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\TranslatableRepositoryInterface;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\TranslatableRepositoryTrait;

/**
 * @method null|RepairStatus find($id, $lockMode = null, $lockVersion = null)
 * @method null|RepairStatus findOneBy(array $criteria, array $orderBy = null)
 * @method RepairStatus[]    findAll()
 * @method RepairStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepairStatusRepository extends SortableRepository implements
    ServiceEntityRepositoryInterface,
    TranslatableRepositoryInterface
{
    use TranslatableRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        $entityClass = RepairStatus::class;

        /** @var EntityManagerInterface $manager */
        $manager = $registry->getManagerForClass($entityClass);

        if (null === $manager) {
            throw new \LogicException(sprintf(
                'Could not find the entity manager for class "%s". Check your Doctrine configuration to make sure it is configured to load this entity’s metadata.',
                $entityClass
            ));
        }

        parent::__construct($manager, $manager->getClassMetadata($entityClass));
    }
}
