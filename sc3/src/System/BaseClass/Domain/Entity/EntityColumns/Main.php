<?php

namespace App\System\BaseClass\Domain\Entity\EntityColumns;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * Trait Main
 * @package App\System\BaseClass\Domain\Entity\EntityColumns
 * @author Borys Pawluczuk
 */
trait Main
{
    /**
     * @var int
     * @ORM\Column(name="main", type="smallint")
     * @NotNull(message="Please provide main")
     */
    protected $main;

    /**
     * @return int
     */
    public function getMain(): int
    {
        return $this->main;
    }

    /**
     * @param int $main
     * @return Main
     */
    public function setMain(int $main): self
    {
        $this->main = $main;
        return $this;
    }
}