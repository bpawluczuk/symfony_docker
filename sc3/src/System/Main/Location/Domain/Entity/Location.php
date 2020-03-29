<?php

namespace App\System\Main\Location\Domain\Entity;

use App\System\BaseClass\Domain\Entity\AbstractMainEntity;
use App\System\BaseClass\Domain\Entity\EntityColumns\Main;
use App\System\BaseClass\Domain\Entity\EntityColumns\Name;
use App\System\BaseClass\Domain\Entity\EntityColumns\Status;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Location
 * @package App\System\Main\Location\Domain\Entity
 * @ORM\Entity(repositoryClass="App\System\Main\Location\Domain\Repository\LocationRepository")
 */
class Location extends AbstractMainEntity
{
    use Name;
    use Status;
}
