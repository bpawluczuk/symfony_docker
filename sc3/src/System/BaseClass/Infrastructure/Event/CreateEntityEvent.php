<?php
/**
 * Created by bpawluczuk on mar, 2020
 */

namespace App\System\BaseClass\Infrastructure\Event;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class CreateEntityEvent
 * @package App\System\BaseClass\Infrastructure\Event
 * @author Borys Pawluczuk
 */
class CreateEntityEvent extends Event
{
    public const NAME = 'create.entity';

    protected $object;

    /**
     * CreateEntityEvent constructor.
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }
}

