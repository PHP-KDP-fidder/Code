<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Login\Action;

use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Session\Container;

final class Logout
{
    public function __construct(private readonly Container $container)
    {
    }

    public function __invoke()
    {
        unset($this->container->userId);
        $this->container->flashMessage[] = 'Logout successfull';
        return new RedirectResponse('/');
    }
}
