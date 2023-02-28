<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Core;

interface EmailValidatorInterface
{
    public function validateEmail(string $requestEmail, string $loginEmail): bool;
}
