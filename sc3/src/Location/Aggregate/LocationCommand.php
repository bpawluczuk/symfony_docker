<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\Location\Aggregate;

use App\BaseAggregate\Aggregate\AbstractAggregate;
use App\Location\Domain\Entity\Location;

/**
 * Class LocationCommand
 * @package App\Location\Aggregate
 */
class LocationCommand extends AbstractAggregate
{
    /**
     * Location factory
     * @param array $data
     * @return object
     */
    public function entityFactory(array $data)
    {
        $object = new Location();
        $object->setName(empty($data['name']) ? "" : $data['name']);

        return $object;
    }

    /**
     * @param object $object
     */
    public function persist(object $object)
    {
        $this->getManager()->persist($object);
        $this->getManager()->flush();
    }

    /**
     * @param object $object
     */
    public function flusch(object $object)
    {
        $this->getManager()->flush();
    }
}