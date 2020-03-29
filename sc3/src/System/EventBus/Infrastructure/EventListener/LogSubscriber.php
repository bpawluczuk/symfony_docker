<?php
/**
 * Created by bpawluczuk on mar, 2020
 */

namespace App\System\EventBus\Infrastructure\EventListener;


use App\System\BaseClass\Infrastructure\Event\CreateEntityEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LogSubscriber implements EventSubscriberInterface
{
    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            CreateEntityEvent::NAME => 'getCreateEvent'
        ];
    }

    public function getCreateEvent(CreateEntityEvent $event)
    {
//        $event->stopPropagation();
    }
}