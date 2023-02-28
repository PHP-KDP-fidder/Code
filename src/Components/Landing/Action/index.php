<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Landing\Action;

use PhpFidder\Core\Components\Landing\Event\IndexEvent;
use PhpFidder\Core\Components\Landing\Response\IndexResponse;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class index
{
    public function __construct(private readonly EventDispatcherInterface $eventDispatcher)
    {
    }

    public function __invoke(ServerRequestInterface $serverRequest): ResponseInterface
    {
        $welcomeMessage = 'Hallo indexseite';
        $event = new IndexEvent($welcomeMessage);
        /**
         * eventDispatcher->dispatch ruft IndexListener->onIndexEvent auf!!!
         */
        $this->eventDispatcher->dispatch($event);
        return new IndexResponse([
            'welcomeMessage' => $event->getWelcomeMessage(),
            'titel' => 'open fidder',
            'username' => 'unbekannt'
            ]);
    }
}
