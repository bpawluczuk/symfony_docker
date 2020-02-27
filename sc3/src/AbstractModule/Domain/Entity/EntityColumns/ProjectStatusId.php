<?php

namespace App\AbstractModule\Domain\Entity\EntityColumns;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait ProjectStatusId
 * @package App\AbstractModule\Domain\Entity\EntityColumns
 */
trait ProjectStatusId
{
    /**
     * @var int
     * @ORM\Column(name="project_status_id", type="smallint", options={"default" = 1})
     */
    private $project_status_id = 1;

    /**
     * @return int
     */
    public function getProjectStatusId(): int
    {
        return $this->project_status_id;
    }

    /**
     * @param int $project_status_id
     * @return $this
     */
    public function setProjectStatusId(int $project_status_id): self
    {
        $this->project_status_id = $project_status_id;
        return $this;
    }
}