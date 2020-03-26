<?php

namespace App\BaseAggregate\Domain\Entity\EntityColumns;

use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Trait Name
 * @package App\BaseAggregate\Domain\Entity\EntityColumns
 */
trait Name
{
    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     * @NotBlank(message="Please provide name")
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
     * @param string $name
     * @return $this
     */
    public function setName(string $name) :self
    {
        $this->name = $name;
        return $this;
    }

}