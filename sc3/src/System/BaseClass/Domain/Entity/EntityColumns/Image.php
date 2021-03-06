<?php

namespace App\System\BaseClass\Domain\Entity\EntityColumns;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait Image
 * @package App\System\BaseClass\Domain\Entity\EntityColumns
 * @author Borys Pawluczuk
 */
trait Image
{
    /**
     * @var string
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    protected $image;

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