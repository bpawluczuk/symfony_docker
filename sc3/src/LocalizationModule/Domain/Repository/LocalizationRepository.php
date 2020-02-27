<?php

namespace App\LocalizationModule\Domain\Repository;

use App\LocalizationModule\Domain\Entity\Localization;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Localization|null find($id, $lockMode = null, $lockVersion = null)
 * @method Localization|null findOneBy(array $criteria, array $orderBy = null)
 * @method Localization[]    findAll()
 * @method Localization[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocalizationRepository extends ServiceEntityRepository
{
    /**
     * LocalizationRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Localization::class);
    }
}
