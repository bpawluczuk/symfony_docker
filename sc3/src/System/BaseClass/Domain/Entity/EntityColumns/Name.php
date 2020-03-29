<?php

namespace App\System\BaseClass\Domain\Entity\EntityColumns;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Trait Name
 * @package App\System\BaseClass\Domain\Entity\EntityColumns
 * @author Borys Pawluczuk
 */
trait Name
{
    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     * @NotBlank(message="Please provide name")
     */
    protected $name;

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
    public function setName(?string $name) :self
    {
        $this->name = $name;
        return $this;
    }

}