<?php

namespace App\AbstractModule\Domain\Entity\EntityColumns;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait StatusId
 * @package App\AbstractModule\Domain\Entity\EntityColumns
 */
trait Status
{
    /**
     * @var int
     * @ORM\Column(name="status", type="smallint", options={"default" = 1})
     */
    private $status = 1;

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }
}