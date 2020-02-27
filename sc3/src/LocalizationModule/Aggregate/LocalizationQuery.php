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
     * @return object[]
     */
    public function getList()
    {
        return $this->getRepository(Localization::class)->findAll();
    }
}