<?php

namespace App\System\BaseClass\Domain\Entity\EntityColumns;

/**
 * Trait Description
 * @package App\System\BaseClass\Domain\Entity\EntityColumns
 * @author Borys Pawluczuk
 */
trait Description
{
    /**
     * @var string
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    private $description;

    /**
     * @return string|null
     */
    public function getDescription() :?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description) :self
    {
        $this->description = $description;
        return $this;
    }

}