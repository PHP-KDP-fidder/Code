<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Login\Event;

use PhpFidder\Core\Components\Core\EventListenerInterface;

class LoginListener implements EventListenerInterface
{
    public function getSubscribeEvent(): array
    {
        return [
            LoginSuccessEvent::class => 'onLoginEvent',
        ];
    }
    //
    public function onLoginEvent(LoginSuccessEvent $loginSuccessEvent)
    {
    }
}
