<?php

namespace App\AbstractModule\Domain\Entity\EntityColumns;

/**
 * Trait Name
 * @package App\AbstractModule\Domain\Entity\EntityColumns
 */
trait Name
{
    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @return string|null
     */
    public function getName() :?string
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name) :self
    {
        $this->name = $name;
        return $this;
    }

}