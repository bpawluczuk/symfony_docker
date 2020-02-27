<?php

namespace App\AbstractModule\Domain\Entity\EntityColumns;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait Id
 * @package App\AbstractModule\Domain\Entity\EntityColumns
 */
trait Id
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}