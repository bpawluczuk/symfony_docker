<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\System\BaseClass\Domain\Entity;

use App\System\BaseClass\Domain\Entity\EntityColumns\CreatedAt;
use App\System\BaseClass\Domain\Entity\EntityColumns\Id;
use App\System\BaseClass\Domain\Entity\EntityColumns\UpdatedAt;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Class AbstractEntity
 * @package App\System\BaseClass\Domain\Entity
 * @author Borys Pawluczuk
 * @ORM\MappedSuperclass
 */
abstract class AbstractEntity
{
    use Id;
    use UpdatedAt;
    use CreatedAt;
}