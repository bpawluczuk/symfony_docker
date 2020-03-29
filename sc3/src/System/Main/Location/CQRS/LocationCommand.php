<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\System\Main\Location\CQRS;

use App\System\BaseClass\CQRS\AbstractCommand;
use App\System\Main\Location\Domain\Entity\Location;

/**
 * Class LocationCommand
 * @package App\System\Main\Project\Location\CQRS
 * @author Borys Pawluczuk
 */
class LocationCommand extends AbstractCommand
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

}