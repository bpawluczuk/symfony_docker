<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\System\Main\Location\CQRS;

use App\System\Main\Location\Domain\Entity\Location;
use App\System\Main\Location\Domain\Repository\LocationRepository;
use App\System\BaseClass\CQRS\AbstractQuery;

/**
 * Class LocationQuery
 * @package App\System\Main\Location\CQRS
 * @author Borys Pawluczuk
 */
class LocationQuery extends AbstractQuery
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