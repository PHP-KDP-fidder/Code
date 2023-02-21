<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Registration\Validator;

use PhpFidder\Core\Components\Core\AbstractValidator;
use PhpFidder\Core\Components\Core\ValidatorRequestInterface;
use PhpFidder\Core\Components\Registration\RegisterRequest\RegisterRequest;

#[\AllowDynamicProperties]
final class RegisterValidator extends AbstractValidator
{
    public function enableUsernameExists(): void
    {
        $this->errors[] = 'Username ist schon vorhanden';
    }
    //
    public function enableEmailExists(): void
    {
        $this->errors[] = 'E-Mail existiert bereits';
    }

    /**
     * @param RegisterRequest $request
     * @return array
     */
    public function validate(ValidatorRequestInterface $request): array
    {
        $username = $request->getUsername();
        $email = $request->getEmail();
        $password = $request->getPassword();
        $passwordRepeat = $request->getPasswordRepeat();
        $errors = [];
        if (mb_strlen($username) === 0) {
            $errors[] = 'Username darf nicht leer sein!';
        }
//        if (mb_strlen($username) <= 3 && mb_strlen($username) > 0) {
//            $errors[] = 'Username muss aus mindestens 4 Zeichen bestehen!';
//        }
//        if (mb_strlen($username) > 20) {
//            $errors[] = 'Username darf nur max. 40 Zeichen lang sein!';
//        }
//        // E-Mail validation
//        if (mb_strlen($email) === 0) {
//            $errors[] = 'E-Mail darf nicht leer sein!';
//        }
//        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false && mb_strlen($email) > 1) {
//            $errors[] = 'E-Mail hat ungültiges Format';
//        }
//        // Passwort validation
//        if (mb_strlen($password) === 0) {
//            $errors[] = 'Passwort darf nicht leer sein!';
//        }
//        if (mb_strlen($password) < 8 && mb_strlen($password) > 0) {
//            $errors[] = 'Passwort muss mindestens 8 Zeichen lang sein!';
//        }
//        if ($password !== $passwordRepeat) {
//            $errors[] = 'Passwort und Passwortwiederholung stimmen nicht überein!';
//        }

        return $errors;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
