<?php

namespace App\AbstractModule\Domain\Entity\EntityColumns;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait StatusId
 * @package App\AbstractModule\Domain\Entity\EntityColumns
 */
trait StatusId
{
    /**
     * @var int
     * @ORM\Column(name="status_id", type="smallint", options={"default" = 1})
     */
    private $status_id = 1;

    /**
     * @return int
     */
    public function getStatusId(): int
    {
        return $this->status_id;
    }

    /**
     * @param int $status_id
     * @return $this
     */
    public function setStatusId(int $status_id): self
    {
        $this->status_id = $status_id;
        return $this;
    }
}