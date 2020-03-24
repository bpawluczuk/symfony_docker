<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\LocationModule\Aggregate;

use App\AbstractModule\Aggregate\AbstractAggregate;
use App\LocationModule\Domain\Entity\Location;
use App\LocationModule\Domain\Repository\LocationRepository;

/**
 * Class LocationQuery
 * @package App\LocationModule\Aggregate
 */
class LocationQuery extends AbstractAggregate
{
    /**
     * @param array $filtr
     * @return object[]
     */
    public function getListObj(array $filtr = [])
    {
        return $this->getRepository(Location::class)->findAll();
    }

    /**
     * @param array $filtr
     * @return array
     */
    public function getList(array $filtr = [])
    {
        $result = [];

        /**
         * @var Location $item
         */
        foreach ($this->getListObj($filtr) as $item) {
            $result[] = [
                "name" => $item->getName(),
                "created_at" => $item->getCreatedAt()->getTimestamp(),
                "updated_at" => $item->getUpdatedAt()->getTimestamp(),
            ];
        }
        return $result;
    }
}