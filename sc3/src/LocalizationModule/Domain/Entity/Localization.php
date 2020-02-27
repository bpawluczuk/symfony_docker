<?php

namespace App\LocalizationModule\Domain\Entity;

use App\AbstractModule\Domain\Entity\AbstractEntity;
use App\AbstractModule\Domain\Entity\EntityColumns\Name;
use App\AbstractModule\Domain\Entity\EntityColumns\StatusId;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Localization
 * @package App\LocalizationModule\Domain\Entity
 * @ORM\Entity(repositoryClass="App\LocalizationModule\Domain\Repository\LocalizationRepository")
 */
class Localization extends AbstractEntity
{
    use Name;
    use StatusId;
}
