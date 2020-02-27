<?php

namespace App\AbstractModule\Domain\Entity\EntityColumns;

use DateTime;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Trait CreatedAt
 * @package App\AbstractModule\Domain\Entity\EntityColumns
 */
trait CreatedAt
{
    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
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