<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\System\Main\Project\Location\CQRS;

use App\System\BaseClass\CQRS\AbstractCqrsManager;
use App\System\Main\Project\Location\Domain\Entity\Location;

/**
 * Class LocationCommand
 * @package App\System\Main\Project\Location\CQRS
 * @author Borys Pawluczuk
 */
class LocationCommand extends AbstractCqrsManager
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