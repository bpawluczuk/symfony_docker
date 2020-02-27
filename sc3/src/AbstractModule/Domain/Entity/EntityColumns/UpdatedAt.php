<?php

namespace App\AbstractModule\Domain\Entity\EntityColumns;

use DateTime;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Trait UpdatedAt
 * @package App\AbstractModule\Domain\Entity\EntityColumns
 */
trait UpdatedAt
{
    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}