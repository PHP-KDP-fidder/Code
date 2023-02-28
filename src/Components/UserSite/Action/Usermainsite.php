<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\UserSite\Action;

use PhpFidder\Core\Components\UserSite\Response\UserSiteResponse;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Usermainsite
{
    public function __construct(private readonly EventDispatcherInterface $eventDispatcher)
    {
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $username = 'Hallo Username';

        return new UserSiteResponse($username);
    }
}
