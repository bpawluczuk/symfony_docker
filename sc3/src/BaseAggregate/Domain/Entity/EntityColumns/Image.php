<?php

namespace App\BaseAggregate\Domain\Entity\EntityColumns;

/**
 * Trait Image
 * @package App\BaseAggregate\Domain\Entity\EntityColumns
 */
trait Image
{
    /**
     * @var string
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    private $image;

    /**
     * @return string|null
     */
    public function getImage() :?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return $this
     */
    public function setImage(string $image) :self
    {
        $this->image = $image;
        return $this;
    }

}