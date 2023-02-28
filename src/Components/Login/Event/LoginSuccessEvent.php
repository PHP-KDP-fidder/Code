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
    //
    public function getUsername()
    {
        return $this->user->getUsername();
    }
    //
    public function getEmail()
    {
        return $this->user->getEmail();
    }
    //
    public function getUserId()
    {
        return $this->user->getId();
    }
}
