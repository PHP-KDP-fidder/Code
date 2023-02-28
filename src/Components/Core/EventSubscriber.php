<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Core;

use Psr\EventDispatcher\EventDispatcherInterface;

class EventSubscriber
{
    /**
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly array $listeners
    )
    {
    }

    public function subscribeToEvent(): void
    {
        foreach ($this->listeners as $listener) {
            if (!$listener instanceof EventListenerInterface) {
                $message = sprintf('%s implementiert nicht EventListenerInterface', get_class($listener));
                throw new \Exception($message);
            }
            $subscribeEvents = $listener->getSubscribeEvent();
            foreach ($subscribeEvents as $eventIdentifier => $method) {
                $this->eventDispatcher->subscribeTo($eventIdentifier, [$listener, $method]);
            }
        }
    }
}
