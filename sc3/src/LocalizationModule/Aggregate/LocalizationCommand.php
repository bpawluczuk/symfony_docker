<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\LocalizationModule\Aggregate;

use App\AbstractModule\Aggregate\AbstractAggregate;
use App\LocalizationModule\Domain\Entity\Localization;

/**
 * Class LocalizationCommand
 * @package App\LocalizationModule\Aggregate
 */
class LocalizationCommand extends AbstractAggregate
{
    public function create(string $name)
    {
        $object = new Localization();
        $object->setName($name);
    }
}