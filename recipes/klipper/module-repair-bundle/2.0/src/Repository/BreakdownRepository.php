<?php

namespace App\Repository;

use App\Entity\Breakdown;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Gedmo\Sortable\Entity\Repository\SortableRepository;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\TranslatableRepositoryInterface;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\TranslatableRepositoryTrait;

/**
 * @method null|Breakdown find($id, $lockMode = null, $lockVersion = null)
 * @method null|Breakdown findOneBy(array $criteria, array $orderBy = null)
 * @method Breakdown[]    findAll()
 * @method Breakdown[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BreakdownRepository extends SortableRepository implements
    ServiceEntityRepositoryInterface,
    TranslatableRepositoryInterface
{
    use TranslatableRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        $entityClass = Breakdown::class;
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
