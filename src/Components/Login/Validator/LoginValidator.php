<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Login\Validator;

use PhpFidder\Core\Components\Core\AbstractValidator;
use PhpFidder\Core\Components\Core\ValidatorRequestInterface;
use PhpFidder\Core\Components\Login\LoginRequest\LoginRequest;

final class LoginValidator extends AbstractValidator
{
    public bool $userNotExists = false;
    public bool $passwordIsInvalid = false;
    public function enablePasswordIsInvalidError(): void
    {
        $this->passwordIsInvalid = true;
    }
    //
    public function enableUserNotExistsError(): void
    {
        $this->userNotExists = true;
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
        $passwordIsEmpty = mb_strlen($password) === 0;
        $errors = [];

        if ($usernameIsEmpty) {
            $errors[] = 'Username darf nicht leer sein!';
        }
        if ($usernameIsEmpty === false &&
        $this->userNotExists) {
            $errors[] = 'User existiert nicht';
        }
        if (mb_strlen($password) === 0) {
            $errors[] = 'Passwort darf nicht leer sein';
        }
        if ($passwordIsEmpty === false &&
        $this->passwordIsInvalid) {
            $errors[] = 'Passwort nicht korrekt';
        }

        return $errors;
    }
}
