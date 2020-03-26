<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\BaseAggregate\Domain\Entity;

use App\BaseAggregate\Domain\Entity\EntityColumns\CreatedAt;
use App\BaseAggregate\Domain\Entity\EntityColumns\Id;
use App\BaseAggregate\Domain\Entity\EntityColumns\UpdatedAt;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Class AbstractEntity
 * @package App\BaseAggregate\Domain\Entity
 * @author Borys Pawluczuk
 * @ORM\MappedSuperclass
 */
abstract class AbstractEntity
{
    use Id;
    use UpdatedAt;
    use CreatedAt;
}