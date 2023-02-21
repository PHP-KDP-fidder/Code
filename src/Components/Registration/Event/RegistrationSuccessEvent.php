<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Registration\Event;

use PhpFidder\Core\Entity\UserEntity;

final class RegistrationSuccessEvent
{
    private readonly UserEntity $user;

    public function __construct(UserEntity $user)
    {
        $this->user = $user;
    }


    // TODO: Class erweitern zum E-Mail versenden
}
