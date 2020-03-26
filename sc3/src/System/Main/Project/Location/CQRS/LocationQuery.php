<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\System\Main\Project\Location\CQRS;

use App\System\Main\Project\Location\Domain\Entity\Location;
use App\System\Main\Project\Location\Domain\Repository\LocationRepository;
use App\System\BaseClass\CQRS\AbstractCqrsManager;

/**
 * Class LocationQuery
 * @package App\System\Main\Project\Location\CQRS
 * @author Borys Pawluczuk
 */
class LocationQuery extends AbstractCqrsManager
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