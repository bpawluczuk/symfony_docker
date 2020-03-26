<?php

namespace App\BaseAggregate\Domain\Entity\EntityColumns;

use DateTime;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Trait CreatedAt
 * @package App\BaseAggregate\Domain\Entity\EntityColumns
 */
trait CreatedAt
{
    /**
     * @var DateTime
     * @ORM\Column(type="datetime", name="created_at")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}