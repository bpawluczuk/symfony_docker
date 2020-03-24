<?php

namespace App\LocationModule\Domain\Entity;

use App\AbstractModule\Domain\Entity\AbstractEntity;
use App\AbstractModule\Domain\Entity\EntityColumns\Name;
use App\AbstractModule\Domain\Entity\EntityColumns\Status;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Location
 * @package App\LocationModule\Domain\Entity
 * @ORM\Entity(repositoryClass="App\LocationModule\Domain\Repository\LocationRepository")
 */
class Location extends AbstractEntity
{
    use Name;
    use Status;
}
