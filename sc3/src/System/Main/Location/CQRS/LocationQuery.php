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
     * @param object $item
     * @return array
     */
    public function getArray(object $item)
    {
        /**
         * @var LocationRepository $repo
         */
        $repo = $this->getRepository(Location::class);
        return $repo->transform($item);
    }

    /**
     * @param array $filtr
     * @return array
     */
    public function getListArray(array $filtr = [])
    {
        /**
         * @var LocationRepository $repo
         */
        $repo = $this->getRepository(Location::class);
        return $repo->transformAll($filtr);
    }

}