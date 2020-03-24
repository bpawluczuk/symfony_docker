<?php
/**
 * Created by bpawluczuk on gru, 2019
 */

namespace App\LocationModule\Aggregate;

use App\AbstractModule\Aggregate\AbstractAggregate;

use App\LocationModule\Domain\Entity\Location;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ConstraintViolation;

/**
 * Class LocationCommand
 * @package App\LocationModule\Aggregate
 */
class LocationCommand extends AbstractAggregate
{
    /**
     * Location factory
     * @param array $data
     * @return object
     */
    public function createFactory(array $data)
    {
        $object = new Location();
        $object->setName(empty($data['name']) ? null : $data['name']);

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