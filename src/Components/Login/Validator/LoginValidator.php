<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Login\Validator;

use PhpFidder\Core\Components\Core\AbstractValidator;
use PhpFidder\Core\Components\Core\ValidatorRequestInterface;
use PhpFidder\Core\Components\Login\LoginRequest\LoginRequest;

final class LoginValidator extends AbstractValidator
{
    public function enablePasswordIsInvalidError(): void
    {
        $this->setErrors('Passwort ist falsch');
    }
    //
    public function enableUserNotExistsError(): void
    {
        $this->setErrors('User existiert nicht');
    }
    //
    public function enableEmailIsInvalidError(): void
    {
        $this->setErrors('E-Mail ist nicht korrekt');
    }
    /**
     * @param LoginRequest $request
     * @return array
     */
    public function validate(ValidatorRequestInterface $request): array
    {
        $username = $request->getUsername();
        $password = $request->getPassword();
        $usernameIsEmpty = mb_strlen($username) === 0;
        $errors = [];
        if ($usernameIsEmpty) {
            $errors[] = 'Username darf nicht leer sein!';
        }
        if (mb_strlen($password) === 0) {
            $errors[] = 'Passwort darf nicht leer sein';
        }

        return $errors;
    }
}
