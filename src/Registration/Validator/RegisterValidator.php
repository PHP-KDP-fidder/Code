<?php
declare(strict_types=1);

namespace PhpFidder\Core\Registration\Validator;

final class RegisterValidator
{
    private array $errors = [];
    public function isValid(string $username, string $email, string $password, string $passwordRepeat):bool {
        // Username validation
        if (mb_strlen($username) === 0) {
            $this->errors[] = 'Username darf nicht leer sein!';
        }
        if (mb_strlen($username) <= 3 && mb_strlen($username) > 0) {
            $this->errors[] = 'Username muss aus mindestens 4 Zeichen bestehen!';
        }
        if (mb_strlen($username) > 20) {
            $this->errors[] = 'Username darf nur max. 40 Zeichen lang sein!';
        }
        // E-Mail validation
        if (mb_strlen($email) === 0) {
            $this->errors[] = 'E-Mail darf nicht leer sein!';
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false && mb_strlen($email) > 1) {
            $this->errors[] = 'E-Mail hat ungültiges Format';
        }
        // Passwort validation
        if (mb_strlen($password) === 0) {
            $this->errors[] = 'Passwort darf nicht leer sein!';
        }
        if (mb_strlen($password) < 8 && mb_strlen($password) > 0) {
            $this->errors[] = 'Passwort muss mindestens 8 Zeichen lang sein!';
        }
        if ($password !== $passwordRepeat) {
            $this->errors[] = 'Passwort und Passwortwiederholung stimmen nicht überein!';
        }

        return count($this->errors) === 0;
    }

    public function getErrors():array {
        return $this->errors;
    }
}
