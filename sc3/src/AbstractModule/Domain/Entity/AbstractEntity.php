<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\AbstractModule\Domain\Entity;

use App\AbstractModule\Domain\Entity\EntityColumns\CreatedAt;
use App\AbstractModule\Domain\Entity\EntityColumns\Id;
use App\AbstractModule\Domain\Entity\EntityColumns\UpdatedAt;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Class AbstractEntity
 * @package App\AbstractModule\Domain\Entity
 * @author Borys Pawluczuk
 * @ORM\MappedSuperclass
 */
abstract class AbstractEntity
{
    use Id;
    use UpdatedAt;
    use CreatedAt;
}