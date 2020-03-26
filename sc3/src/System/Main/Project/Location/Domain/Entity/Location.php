<?php

namespace App\System\Main\Project\Location\Domain\Entity;

use App\System\BaseClass\Domain\Entity\AbstractEntity;
use App\System\BaseClass\Domain\Entity\EntityColumns\Name;
use App\System\BaseClass\Domain\Entity\EntityColumns\Status;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Location
 * @package App\System\Main\Project\Location\Domain\Entity
 * @ORM\Entity(repositoryClass="App\System\Main\Project\Location\Domain\Repository\LocationRepository")
 */
class Location extends AbstractEntity
{
    use Name;
    use Status;
}
