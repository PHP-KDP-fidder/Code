<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Login\Validator;

use PhpFidder\Core\Components\Core\EmailValidatorInterface;

final class EmailValidator implements EmailValidatorInterface
{
    public function validateEmail(string $requestEmail, string $loginEmail): bool
    {
        return $requestEmail === $loginEmail;
    }
}
