<?php

namespace App\AbstractModule\Domain\Entity\EntityColumns;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait IdProject
 * @package App\AbstractModule\Domain\Entity\EntityColumns
 */
trait ProjectId
{
    /**
     * @var int
     * @ORM\Column(name="project_id", type="integer")
     */
    private $project_id = null;

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->project_id;
    }

    /**
     * @param int $project_id
     * @return $this
     */
    public function setProjectId(int $project_id): self
    {
        $this->project_id = $project_id;
        return $this;
    }
}