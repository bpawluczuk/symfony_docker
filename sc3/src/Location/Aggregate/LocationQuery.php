<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\Location\Aggregate;

use App\BaseAggregate\Aggregate\AbstractAggregate;
use App\Location\Domain\Entity\Location;
use App\Location\Domain\Repository\LocationRepository;

/**
 * Class LocationQuery
 * @package App\Location\Aggregate
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