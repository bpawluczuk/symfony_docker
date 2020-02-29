<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\LocalizationModule\Aggregate;

use App\AbstractModule\Aggregate\AbstractAggregate;
use App\LocalizationModule\Domain\Entity\Localization;
use App\LocalizationModule\Domain\Repository\LocalizationRepository;

/**
 * Class LocalizationQuery
 * @package App\LocalizationModule\Aggregate
 */
class LocalizationQuery extends AbstractAggregate
{
    /**
     * @param array $filtr
     * @return object[]
     */
    public function getListObj(array $filtr = [])
    {
        return $this->getRepository(Localization::class)->findAll();
    }

    /**
     * @param array $filtr
     * @return array
     */
    public function getList(array $filtr = [])
    {
        $result = [];

        /**
         * @var Localization $item
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