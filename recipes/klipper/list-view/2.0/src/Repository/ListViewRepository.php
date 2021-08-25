<?php

namespace App\Repository;

use App\Entity\ListView;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Gedmo\Sortable\Entity\Repository\SortableRepository;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\InsensitiveTrait;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\TranslatableRepositoryInterface;
use Klipper\Component\DoctrineExtensionsExtra\Entity\Repository\Traits\TranslatableRepositoryTrait;

/**
 * @method null|ListView find($id, $lockMode = null, $lockVersion = null)
 * @method null|ListView findOneBy(array $criteria, array $orderBy = null)
 * @method ListView[]    findAll()
 * @method ListView[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListViewRepository extends SortableRepository implements
    ServiceEntityRepositoryInterface,
    TranslatableRepositoryInterface
{
    use InsensitiveTrait;
    use TranslatableRepositoryTrait;

    /**
     * @param string $entityClass The class name of the entity this repository manages
     */
    public function __construct(ManagerRegistry $registry)
    {
        $entityClass = ListView::class;
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

    protected function getInsensitiveFields(): array
    {
        return [
            'type',
            'name',
        ];
    }
}
