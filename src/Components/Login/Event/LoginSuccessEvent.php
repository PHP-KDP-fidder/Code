<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Login\Event;

use PhpFidder\Core\Entity\UserEntity;

final class LoginSuccessEvent
{
//    private readonly UserEntity $user;

    public function __construct(private readonly UserEntity $user)
    {
    }


    // TODO: Class erweitern
}
