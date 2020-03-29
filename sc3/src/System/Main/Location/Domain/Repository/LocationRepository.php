<?php

namespace App\System\Main\Location\Domain\Repository;

use App\System\Main\Location\Domain\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Location|null find($id, $lockMode = null, $lockVersion = null)
 * @method Location|null findOneBy(array $criteria, array $orderBy = null)
 * @method Location[]    findAll()
 * @method Location[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationRepository extends ServiceEntityRepository
{
    /**
     * LocationRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Location::class);
    }

    /**
     * @param object $item
     * @return array
     */
    public function transform(object $item)
    {
        return [
            'id' => (int)$item->getId(),
            "name" => (string)$item->getName(),
            "created_at" => $item->getCreatedAt()->getTimestamp(),
            "updated_at" => $item->getUpdatedAt()->getTimestamp(),
        ];
    }

    /**
     * @param array $filtr
     * @return array
     */
    public function transformAll(array $filtr = [])
    {
        $items = $this->findAll();
        $itemsArray = [];

        foreach ($items as $item) {
            $itemsArray[] = $this->transform($item);
        }

        return $itemsArray;
    }
}
