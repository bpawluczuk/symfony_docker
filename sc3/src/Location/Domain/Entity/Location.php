<?php

namespace App\Location\Domain\Entity;

use App\BaseAggregate\Domain\Entity\AbstractEntity;
use App\BaseAggregate\Domain\Entity\EntityColumns\Name;
use App\BaseAggregate\Domain\Entity\EntityColumns\Status;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Location
 * @package App\Location\Domain\Entity
 * @ORM\Entity(repositoryClass="App\Location\Domain\Repository\LocationRepository")
 */
class Location extends AbstractEntity
{
    use Name;
    use Status;
}
